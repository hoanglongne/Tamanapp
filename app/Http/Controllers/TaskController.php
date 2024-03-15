<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use \App\Models\TaskAssignment;
use \App\Models\User;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return inertia('Task/Index', [
            'tasks' => Task::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return inertia('Task/Create', [
            'users' => User::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|min:8|max:60',
            'description' => 'required',
            'status' => 'required',
            'deadline' => 'required|date|after:today|before:+1 year',
            'created_by_user_id' => 'required|exists:users,id',
            'user_id' => 'nullable|exists:users,id' // user to assign the task to
        ]);
    
        // Create the task
        $task = Task::create($request->except('user_id'));
    
        // Create the task assignment if user_id is provided
        if ($request->user_id) {
            $taskAssignment = TaskAssignment::create([
                'task_id' => $task->id,
                'user_id' => $request->user_id
            ]);
        }
    
        return redirect()->route('tasks.index')->with('success', 'Task created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        return inertia('Task/Show', [
            'task' => $task->load('user')
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task)
    {
        return inertia('Task/Edit', [
            'tasks' => $task,
            'users' => User::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Task $task)
    {
        $request->validate([
            'title' => 'required|min:8|max:60',
            'description' => 'required',
            'status' => 'required',
            'deadline' => 'required|date|after:today|before:+1 year',
            'created_by_user_id' => 'required|exists:users,id',
            'user_id' => 'nullable|exists:users,id' // user to assign the task to
        ]);
    
        // Update the task
        $task->update($request->except('user_id'));
    
        // Update the task assignment if user_id is provided
        if ($request->user_id) {
            $taskAssignment = TaskAssignment::where('task_id', $task->id)->first();
            if ($taskAssignment) {
                $taskAssignment->update(['user_id' => $request->user_id]);
            } else {
                TaskAssignment::create([
                    'task_id' => $task->id,
                    'user_id' => $request->user_id
                ]);
            }
        }
    
        return redirect()->route('tasks.index')->with('success', 'Task updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        $task->deleteOrFail();
        return redirect()->route('tasks.index')->with('success', 'Task deleted successfully');
    }

    public function kanban(Task $task)
    {
        return inertia('Kanban/Index', [
            'task' => $task->load('user')
        ]);
    }
}
