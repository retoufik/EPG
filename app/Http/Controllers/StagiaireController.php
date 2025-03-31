<?php

namespace App\Http\Controllers;

use App\Models\Stagiaire;
use App\Models\Document;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\TypeStage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Mpdf\Mpdf;
use Milon\Barcode\DNS2D;

class StagiaireController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $error = null;

        $query = Stagiaire::query();

        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('nom', 'like', "%{$search}%")
                  ->orWhere('prenom', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }

        $stag = $query->orderBy('created_at', 'desc')->paginate(10);

        if ($search && $stag->isEmpty()) {
            $error = "Aucun stagiaire trouvé pour votre recherche : '{$search}'";
        }

        return view('stagiaire.index', compact('stag', 'error'));
    }

    public function create()
    {
        $types = TypeStage::all();
        return view('stagiaire.create', compact('types'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            "prenom" => "required|string|max:255",
            "nom" => "required|string|max:255",
            "email" => "required|email|unique:stagiaires",
            "tel" => "required|string|max:20",
            'CIN' => 'required',
            'type_stage_id' => 'required',
            'date_naissance' => 'required|date',
            'genre' => 'required',
            "debut" => "required|date",
            "fin" => "required|date|after:debut",
            "details" => "nullable|string",
            "path" => "required|file|max:2048",
            'documents.*.name' => 'required|string|max:255',
            'documents.*.file' => 'nullable|file|max:2048',
        ]);

        $stagiaire = Stagiaire::create($validated);

        if ($request->hasFile('path')) {
            $path = $request->file('path')->store('stagiaires', 'local');
            $stagiaire->update(['path' => $path]);
        }

        
        if ($request->has('documents')) {
            foreach ($request->documents as $document) {
                if (!empty($document['file'])) {
                    $path = $document['file']->store('documents', 'local');
                    $stagiaire->documents()->create([
                        'document_name' => $document['name'] ?? $document['file']->getClientOriginalName(),
                        'file_path' => $path
                    ]);
                }
            }
        }
    
        return redirect()->route("stagiaire.index")->with("success", "Stagiaire ajouté avec succès");
    }

    public function show(Stagiaire $stagiaire)
    {
        $type=TypeStage::find($stagiaire->type_stage_id);
        $stagiaire->load('documents');
        return view('stagiaire.pdf', compact('stagiaire','type'));
    }

    public function edit(Stagiaire $stagiaire)
    {
        $types = TypeStage::all();
        return view('stagiaire.edit', compact('stagiaire','types'));
    }

    public function update(Request $request, Stagiaire $stagiaire)
    {
        $validated = $request->validate([
            "prenom" => "required|string|max:255",
            "nom" => "required|string|max:255",
            "email" => "required|email|unique:stagiaires,email,".$stagiaire->id,
            "tel" => "required|string|max:20",
            "CIN" => "required",
            "type_stage_id" => "required",
            "debut" => "required|date",
            "fin" => "required|date|after:debut",
            "details" => "nullable|string",
            'delete_documents' => 'nullable|array',
            'delete_documents.*' => 'exists:documents,id',
            'new_documents.*.name' => 'nullable|string|max:255',
            'new_documents.*.file' => 'nullable|file|max:2048',
        ]);

        if ($request->hasFile('path')) {
            if ($stagiaire->path) {
                Storage::disk('local')->delete($stagiaire->path);
            }
            $path = $request->file('path')->store('stagiaires', 'local');
            $validated['path'] = $path;
        }

        if ($request->has('delete_documents')) {
            foreach ($request->delete_documents as $documentId) {
                $document = Document::find($documentId);
                if ($document && $document->file_path) {
                    Storage::disk('local')->delete($document->file_path);
                    $document->delete();
                }
            }
        }
        if ($request->has('new_documents')) {
            foreach ($request->new_documents as $document) {
                if (!empty($document['file'])) {
                    $path = $document['file']->store('documents', 'local');
                    $stagiaire->documents()->create([
                        'document_name' => $document['name'] ?? $document['file']->getClientOriginalName(),
                        'file_path' => $path
                    ]);
                }
            }
        }
        
        if($request->has("remove_file")){
            Storage::disk('local')->delete($stagiaire->path);
            $validated['path'] = null;
        }
        
        if($request->has("download_file")) {
            return Storage::disk('local')->download($stagiaire->path);
        }

        $stagiaire->update($validated);
        return redirect()->route("stagiaire.index")->with("success", "Stagiaire mis à jour avec succès");
    }

    public function destroy(Stagiaire $stagiaire)
    {
        if ($stagiaire->path) {
            Storage::disk('local')->delete($stagiaire->path);
        }
        $stagiaire->documents()->delete();
        $stagiaire->delete();
        return redirect()->route("stagiaire.index")->with("success", "Stagiaire supprimé avec succès");
    }

    public function storeDocument(Request $request, Stagiaire $stagiaire)
    {
        $validated = $request->validate([
            "document_name" => "required|string|max:255",
            "document" => "required|file|max:2048",
        ]);

        $path = $request->file('document')->store('documents', 'local');
        
        $stagiaire->documents()->create([
            'document_name' => $validated['document_name'],
            'file_path' => $path
        ]);

        return back()->with("success", "Document ajouté avec succès");
    }

    public function generatePdf(Stagiaire $stagiaire) 
    {
        try {            
            $generator = new \Milon\Barcode\DNS2D();
            $qrcode = $generator->getBarcodeHTML(
                route('stagiaire.show', $stagiaire->id),
                'QRCODE',
                4,
                4
            );
    
            $pdf = Pdf::loadView('stagiaire.attestation', [
                'stagiaire' => $stagiaire,
                'qrcode' => $qrcode
            ]);

            $pdf->setPaper('A4', 'portrait');

            $filename = 'attestation-' . Str::slug($stagiaire->nom . '-' . $stagiaire->prenom) . '.pdf';
            
            return $pdf->download($filename);

        } catch (\Exception $e) {
            Log::error('PDF Generation Error: ' . $e->getMessage());
            Log::error($e->getTraceAsString());
            return back()->with('error', 'Erreur lors de la génération du PDF: ' . $e->getMessage());
        }
    }
}