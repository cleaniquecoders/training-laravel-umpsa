<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tasks = Task::latest()->paginate(10);

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
       $this->validate($request,[
            'title' => ['required', 'min:5', 'max:250'],
       ]);

       $task = Task::create([
        'title' => $request->title,
        'user_id' => auth()->user()->id,
       ]);

       return redirect(
        route('tasks.show', $task->id)
       );
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $task = Task::where('id', $id)->first();

        return view('tasks.show', compact('task'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $task = Task::where('id', $id)->first();

        return view('tasks.edit', compact('task'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->validate($request,[
            'title' => ['required', 'min:5', 'max:250'],
       ]);

       Task::where('id', $id)->update([
        'title' => $request->title,
        'status' => $request->status ? true : false,
       ]);

       return redirect(
        route('tasks.show', $id)
       );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Task::where('id', $id)->delete();

        return redirect(
            route('tasks.index')
        );
    }
}
