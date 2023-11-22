<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{

    public function __construct()
    {
        $this->authorizeResource(Task::class);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tasks = Task::with('user')
            ->where('user_id', auth()->user()->id)
            ->latest()->paginate(10);

        return view('tasks.index', compact('tasks'));
        // return view('tasks.index', ['tugasan' => $tasks]);
        // return view('tasks.index')->with(['tugasan' => $tasks]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('tasks.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => ['required', 'min:5', 'max:250'],
        ]);

        $task = Task::create([
            'title' => $request->title,
            'user_id' => auth()->user()->id,
        ]);

        session()->flash('message', [
            'title' => 'Create Record',
            'text' => 'You have successfully create your task!',
            'icon' => 'success',
        ]);

        return redirect(
            route('tasks.show', $task)
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        return view('tasks.show', compact('task'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task)
    {
        return view('tasks.edit', compact('task'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Task $task)
    {
        $this->validate($request, [
            'title' => ['required', 'min:5', 'max:250'],
        ]);

        $task->update([
            'title' => $request->title,
            'status' => $request->status ? true : false,
        ]);

        session()->flash('message', [
            'title' => 'Update Record',
            'text' => 'You have successfully update your task!',
            'icon' => 'success',
        ]);

        return redirect(
            route('tasks.show', $task)
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        $task->delete();

        session()->flash('message', [
            'title' => 'Delete Record',
            'text' => 'You have successfully delete your task!',
            'icon' => 'error',
        ]);

        return redirect(
            route('tasks.index')
        );
    }
}
