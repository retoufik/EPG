<?php

namespace App\Http\Controllers;

use App\Models\Stagiaire;
use App\Models\Document;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

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
        return view('stagiaire.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            "prenom" => "required|string|max:255",
            "nom" => "required|string|max:255",
            "email" => "required|email|unique:stagiaires",
            "tel" => "required|string|max:20",
            "debut" => "required|date",
            "fin" => "required|date|after:debut",
            "details" => "nullable|string",
            "path" => "required|file|max:2048",
        ]);

        if ($request->hasFile('path')) {
            $path = $request->file('path')->store('stagiaires', 'public');
            $validated['path'] = $path;
        }

        Stagiaire::create($validated);
        return redirect()->route("stagiaire.index")->with("success", "Stagiaire ajouté avec succès");
    }

    public function show(Stagiaire $stagiaire)
    {
        $stagiaire->load('documents');
        return view('stagiaire.pdf', compact('stagiaire'));
    }

    public function edit(Stagiaire $stagiaire)
    {
        return view('stagiaire.edit', compact('stagiaire'));
    }

    public function update(Request $request, Stagiaire $stagiaire)
    {
        $validated = $request->validate([
            "prenom" => "required|string|max:255",
            "nom" => "required|string|max:255",
            "email" => "required|email|unique:stagiaires,email,".$stagiaire->id,
            "tel" => "required|string|max:20",
            "debut" => "required|date",
            "fin" => "required|date|after:debut",
            "details" => "nullable|string",
            "path" => "nullable|file|max:2048",
        ]);

        if ($request->hasFile('path')) {
            if ($stagiaire->path) {
                Storage::disk('public')->delete($stagiaire->path);
            }
            $path = $request->file('path')->store('stagiaires', 'local');
            $validated['path'] = $path;
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
        $stagiaire = Stagiaire::findOrFail($stagiaire->id);
        
        $pdf = PDF::loadView('attestation', compact('stagiaire'))
                 ->setPaper('A4', 'portrait');

        return $pdf->download("attestation-{$stagiaire->id}.pdf");
    }
}