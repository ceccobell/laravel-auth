<?php

namespace App\Http\Controllers\Admin;

use App\Models\Project;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateProjectRequest;
use App\Http\Requests\StoreProjectRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects = Project::all();
        return view ('admin.projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.projects.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProjectRequest $request)
    {
        // Tutti i dati validati sono ora accessibili tramite $request->validated()
        $form_data = $request->validated();

        // Aggiungi lo slug generato
        $form_data['slug'] = Project::generateSlug($form_data['name']);

        // Gestisci il caricamento dell'immagine, se presente
        if ($request->hasFile('project_image')) {
            $path = Storage::disk('public')->put('project_image', $form_data['project_image']);
            $form_data['project_image'] = $path;
        }
        else {
            $form_data['project_image'] = 'https://placehold.co/600x400?text=MISSING+IMG';
        }

        // Crea il progetto
        $project = Project::create($form_data);

        return redirect()->route('admin.projects.index')->with('success', 'Progetto creato con successo.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        return view('admin.projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        return view('admin.projects.edit', compact('project'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Project $project)
    {
        // Validazione dei campi
        $request->validate([
            'name' => 'required|max:100',
            'slug' => 'required|unique:projects,slug,' . $project->id,
            'summary' => 'nullable'
        ]);

        // Aggiorna il progetto esistente
        $project->name = $request->name; 
        $project->summary = $request->summary;
        
        $project->save();

        // Redirect alla pagina index con messaggio di successo
        return redirect()->route('admin.projects.index')->with('success', 'Progetto aggiornato con successo.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        $project->delete();

        return redirect()->route('admin.projects.index');
    }
}
