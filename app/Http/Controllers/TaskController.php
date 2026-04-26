<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tasks = Auth::user()->tasks;
        return view('tasks.index',compact('tasks'));
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
        $request->validate([
            'title'=>'required|string',
            'description'=>'nullable|string',
            'due_date'=>'date|after:today',
            'priority'=>'required|in:low,medium,high'
        ]);
        Auth::user()->tasks()->create([
            'title'=>$request->title,
            'description'=>$request->description,
            'status'=>'pending',
            'due_date'=>$request->due_date,
            'priority'=>$request->priority
        ]);
        return redirect()->route('tasks.index')->with('create','The task was successfully created');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $task = Auth::user()->tasks()->findOrFail($id);
        return view('tasks.show', compact('task'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $task = Auth::user()->tasks()->findOrFail($id);
        return view('tasks.edit',compact('task'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'title'=>'required|string',
            'description'=>'nullable|string',
            'due_date'=>'date|after:today',
            'priority'=>'required|in:low,medium,high'
        ]);
        Auth::user()->tasks()->findOrFail($id)->update([
            'title'=>$request->title,
            'description'=>$request->description,
            'due_date'=>$request->due_date,
            'priority'=>$request->priority
        ]);
        
        return redirect()->route('tasks.index')->with('update','The task was successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Auth::user()->tasks()->findOrFail($id)->delete();
        return redirect()->route('tasks.index')->with('delete','The task was successfully deleted');
    }

    public function toggleStatus(string $id){
        $task = Auth::user()->tasks()->findOrFail($id);
        $task->update([
            'status'=>$task->status == 'pending' ? 'completed' : 'pending'
        ]);
        return redirect()->route('tasks.index')->with('update','The task status was successfully updated');
    }

    public function filterByStatus(Request $request){
        if($request->status == 'all'){
            return redirect()->route('tasks.index');
        }
        $tasks = Auth::user()->tasks()->where('status',$request->status)->get();
        return view('tasks.index',compact('tasks'));
    }

    public function search(Request $request){
        $tasks = Auth::user()->tasks()->where('title','like',"%$request->title%")->get();
        return view('tasks.index',compact('tasks'));
    }
    public function filterByPriority(Request $request){
        if($request->priority == 'all'){
            return redirect()->route('tasks.index');
        }
        $tasks = Auth::user()->tasks()->where('priority',$request->priority)->get();
        return view('tasks.index',compact('tasks'));
    }

    public function dashboard(){
        $total_tasks = Auth::user()->tasks()->count();
        $pending_tasks = Auth::user()->tasks()->where('status','pending')->count();
        $completed_tasks = Auth::user()->tasks()->where('status','completed')->count();
        $high_priority_tasks = Auth::user()->tasks()->where('priority','high')->count();
        $medium_priority_tasks = Auth::user()->tasks()->where('priority','medium')->count();
        $low_priority_tasks = Auth::user()->tasks()->where('priority','low')->count();
        $today_tasks = Auth::user()->tasks()->where('due_date',Carbon::today())->get();

        return view('dashboard', compact('total_tasks', 'pending_tasks', 'completed_tasks', 'high_priority_tasks', 'medium_priority_tasks', 'low_priority_tasks','today_tasks'));
    }
}
