<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;

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
        return inertia('Task/Create');
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
            'created_by_user_id' => 'required|exists:users,id'
        ]);

        Task::create($request->all());
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
            'tasks' => $task
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
            'deadline' => 'required',
            'created_by_user_id' => 'required|exists:users,id'
        ]);

        $task->update($request->all());
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
}
