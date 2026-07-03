<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{

    public function index(Request $request)
    {
        $user = $request->user();

        if ($user->role === 'admin') {
            
            $tasks = Task::with(['project', 'user'])->paginate(10);
        } else {
            
            $tasks = Task::with('project')
                ->where('user_id', $user->id)
                ->paginate(10);
        }

        return response()->json($tasks, 200);
    }

    
    public function store(Request $request)
    {
        $validated = $request->validate([
            'project_id' => 'required|exists:projects,id',
            'user_id' => 'required|exists:users,id',
            'title' => 'required|string|max:255',
            'status' => 'in:pendente,em_andamento,concluida',
            'due_date' => 'nullable|date',
        ]);

        $task = Task::create($validated);

        return response()->json([
            'message' => 'Tarefa atribuída com sucesso.',
            'task' => $task
        ], 201);
    }


    public function show(Request $request, Task $task)
    {
        $user = $request->user();

        if ($user->role !== 'admin' && $task->user_id !== $user->id) {
            return response()->json([
                'message' => 'Acesso negado. Esta tarefa não está atribuída a você.'
            ], 403);
        }

        
        return response()->json($task->load(['project', 'user']), 200);
    }

    
    public function update(Request $request, Task $task)
    {
        $user = $request->user();

        if ($user->role === 'admin') {
            // Admin pode alterar qualquer campo da tarefa
            $validated = $request->validate([
                'project_id' => 'sometimes|exists:projects,id',
                'user_id' => 'sometimes|exists:users,id',
                'title' => 'sometimes|string|max:255',
                'status' => 'sometimes|in:pendente,em_andamento,concluida',
                'due_date' => 'nullable|date',
            ]);
            $task->update($validated);
            
        } else {
            
            if ($task->user_id !== $user->id) {
                return response()->json(['message' => 'Acesso negado.'], 403);
            }

            $validated = $request->validate([
                'status' => 'required|in:pendente,em_andamento,concluida',
            ]);
            $task->update($validated);
        }

        return response()->json([
            'message' => 'Tarefa atualizada com sucesso.',
            'task' => $task
        ], 200);
    }

    
    public function destroy(Task $task)
    {
        $task->delete();

        return response()->json([
            'message' => 'Tarefa excluída com sucesso.'
        ], 200);
    }
}
