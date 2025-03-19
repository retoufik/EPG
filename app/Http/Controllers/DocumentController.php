<?php

namespace App\Http\Controllers;

use App\Models\Document;
use App\Models\Stagiaire;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DocumentController extends Controller
{
    public function index()
    {
        $stagiaires = Stagiaire::orderBy('created_at', 'desc')->paginate(10);
        $documents = Document::orderBy('created_at','desc')->paginate(10);
        return view('documents.index', compact('stagiaires','documents'));
    }
    public function create()
    {
        return view('documents.create');
    }
    public function store(Document $document, Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'file_path' => 'required|file|max:2048',
            'stagiaire_id' => 'required|exists:stagiaires,id',
        ]);
        if ($request->hasFile('file_path')) {
            $path = $request->file('file_path')->store('documents/'.$request->input('stagiaire_id'), 'local');
            $document->addMedia($path)->toMediaCollection('documents');
            Document::create([
                'name' => $request->name,
                'file_path' => $path,
                'stagiaire_id' => $request->stagiaire_id,
            ]);
            return redirect()->route('documents.index')->with('success', 'Document ajouté avec succès');
        }
        return redirect()->route('documents.index')->with('error','the file is required');


        
    }
    public function destroy(Document $document)
    {
        Storage::disk('local')->delete($document->file_path);
        $document->delete();
        return back()->with('success', 'Document supprimé avec succès');
    }
}