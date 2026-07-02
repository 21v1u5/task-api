<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    
    public function index()
    {
        
        $projects = Project::paginate(10);
        
        return response()->json($projects, 200);
    }

    
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'client_name' => 'required|string|max:255',
        ]);

        $project = Project::create($validated);

        return response()->json([
            'message' => 'Projeto criado com sucesso.',
            'project' => $project
        ], 201); // 201 Created
    }

    
    public function show(Project $project)
    {
        return response()->json($project, 200);
    }

    
    public function update(Request $request, Project $project)
    {
        $validated = $request->validate([
            'name' => 'sometimes|string|max:255',
            'description' => 'nullable|string',
            'client_name' => 'sometimes|string|max:255',
        ]);

        $project->update($validated);

        return response()->json([
            'message' => 'Projeto atualizado com sucesso.',
            'project' => $project
        ], 200);
    }

    
    public function destroy(Project $project)
    {
        $project->delete();

        return response()->json([
            'message' => 'Projeto excluído com sucesso.'
        ], 200);
    }
}