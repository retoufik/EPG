<?php

namespace App\Http\Controllers;

use App\Models\ImportHistory;
use App\Models\Stagiaire;
use App\Models\TypeStage;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;

class ImportController extends Controller
{
    public function index()
    {
        $importHistory = ImportHistory::latest()->take(10)->get();
        return view('import.index', compact('importHistory'));
    }

    public function export($type)
    {
        $stagiaires = Stagiaire::with('typeStage')->get();

        if ($type === 'excel') {
            $spreadsheet = new Spreadsheet();
            $sheet = $spreadsheet->getActiveSheet();
            $sheet->setCellValue('A1', 'Prénom');
            $sheet->setCellValue('B1', 'Nom');
            $sheet->setCellValue('C1', "Carte d'Identité");
            $sheet->setCellValue('D1', 'Email');
            $sheet->setCellValue('E1', 'Téléphone');
            $sheet->setCellValue('F1', 'Type de Stage');
            $sheet->setCellValue('G1', 'Date de Début');
            $sheet->setCellValue('H1', 'Date de Fin');
            $sheet->setCellValue('I1', 'Date de Naissance');
            $sheet->setCellValue('J1', 'Genre');
            $sheet->setCellValue('K1', 'Détails');

            $sheet->getStyle('A1:K1')->getFont()->setBold(true);
            $sheet->getStyle('A1:K1')->getFill()
                ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                ->getStartColor()->setRGB('F97316');
            $sheet->getStyle('A1:K1')->getFont()->getColor()->setRGB('FFFFFF');

            $row = 2;
            foreach ($stagiaires as $stagiaire) {
                $sheet->setCellValue('A' . $row, $stagiaire->prenom);
                $sheet->setCellValue('B' . $row, $stagiaire->nom);
                $sheet->setCellValue('C' . $row, $stagiaire->CIN);
                $sheet->setCellValue('D' . $row, $stagiaire->email);
                $sheet->setCellValue('E' . $row, $stagiaire->tel);
                $sheet->setCellValue('F' . $row, $stagiaire->typeStage ? $stagiaire->typeStage->name : '');
                $sheet->setCellValue('G' . $row, $stagiaire->debut ? $stagiaire->debut->format('d/m/Y') : '');
                $sheet->setCellValue('H' . $row, $stagiaire->fin ? $stagiaire->fin->format('d/m/Y') : '');
                $sheet->setCellValue('I' . $row, $stagiaire->date_naissance ? $stagiaire->date_naissance->format('d/m/Y') : '');
                $sheet->setCellValue('J' . $row, $stagiaire->genre);
                $sheet->setCellValue('K' . $row, $stagiaire->details);
                $row++;
            }

            foreach (range('A', 'K') as $col) {
                $sheet->getColumnDimension($col)->setAutoSize(true);
            }

            $writer = new Xlsx($spreadsheet);
            $filename = 'stagiaires_' . date('Y-m-d_His') . '.xlsx';
            
            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header('Content-Disposition: attachment;filename="' . $filename . '"');
            header('Cache-Control: max-age=0');
            
            $writer->save('php://output');
            exit;

        } elseif ($type === 'pdf') {
            $pdf = Pdf::loadView('exports.stagiaires-pdf', compact('stagiaires'));
            return $pdf->download('stagiaires_' . date('Y-m-d_His') . '.pdf');
        }

        return redirect()->back()->with('error', 'Type d\'export invalide');
    }

    public function process(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:xlsx,xls'
        ]);

        try {
            $file = $request->file('file');
            $spreadsheet = IOFactory::load($file->getPathname());
            $worksheet = $spreadsheet->getActiveSheet();
            $rows = $worksheet->toArray();

            array_shift($rows);

            $totalRecords = count($rows);
            $successfulRecords = 0;
            $failedRecords = 0;
            $errors = [];

            foreach ($rows as $index => $row) {
                try {
                    if (empty($row[0]) || empty($row[1]) || empty($row[2]) || empty($row[3]) || empty($row[4])) {
                        throw new \Exception('Missing required fields');
                    }

                    $typeStage = TypeStage::firstOrCreate(['name' => trim($row[5])]);

                    Stagiaire::create([
                        'prenom' => trim($row[0]),
                        'nom' => trim($row[1]),
                        'CIN' => trim($row[2]),
                        'email' => trim($row[3]),
                        'tel' => trim($row[4]),
                        'type_stage_id' => $typeStage->id,
                        'debut' => $this->parseDate($row[6]),
                        'fin' => $this->parseDate($row[7]),
                        'date_naissance' => $this->parseDate($row[8]),
                        'genre' => trim($row[9] ?? ''),
                        'details' => trim($row[10] ?? ''),
                        'path' => 'local'
                    ]);

                    $successfulRecords++;
                } catch (\Exception $e) {
                    $failedRecords++;
                    $errors[] = "Row " . ($index + 2) . ": " . $e->getMessage();
                }
            }

            ImportHistory::create([
                'filename' => $file->getClientOriginalName(),
                'total_records' => $totalRecords,
                'successful_records' => $successfulRecords,
                'failed_records' => $failedRecords,
                'errors' => $errors
            ]);

            return redirect()->route('import.index')
                ->with('success', "Import completed: {$successfulRecords} successful, {$failedRecords} failed");

        } catch (\Exception $e) {
            return redirect()->route('import.index')
                ->with('error', 'Import failed: ' . $e->getMessage());
        }
    }

    private function parseDate($value)
    {
        if (empty($value)) {
            return null;
        }

        try {
            if (is_numeric($value)) {
                return Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($value));
            }
            return Carbon::parse($value);
        } catch (\Exception $e) {
            throw new \Exception('Invalid date format');
        }
    }

    public function downloadTemplate($type)
    {
        if (!in_array($type, ['users', 'projects', 'tasks'])) {
            return redirect()->back()->with('error', 'Invalid template type');
        }

        $templatePath = "templates/{$type}_template.xlsx";
        
        if (!Storage::exists($templatePath)) {
            return redirect()->back()->with('error', 'Template not found');
        }

        return Storage::download($templatePath);
    }
} 