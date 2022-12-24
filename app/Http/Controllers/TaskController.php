<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TaskController extends Controller
{

    public function __construct()
    {
        return $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::all();
        return view('tasks.create', ['users' => $users]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'dec' => 'required',
            'deadline' => 'required',
        ]);
        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }
        Task::create(['name' => $request->name, 'user_id' => $request->officer, 'dec' => $request->dec, 'dead_line' => $request->deadline]);
        return redirect('/')->with('success_update','Task is added successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function edit(Task $task)
    {
        $users = User::all();
        return view('tasks.edit',['task' => $task,'users' => $users]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Task $task)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'dec' => 'required',
            'deadline' => 'required',
            'status' => 'required',
            'officer' => 'required'
        ]);
        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }
        $task->update([
            'name'=> $request->name,
            'dec'=> $request->dec,
            'user_id'=> $request->officer,
            'dead_line'=> $request->deadline,
            'status' => intval($request->status),
        ]);
        return redirect('/')->with('success_update','Task is updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy($task)
    {
        $res = Task::findOrFail($task);
        $res->delete();
        return back()->with('success_update','Task is deleted successfully!');
    }


    public function done($task)
    {
        $res = Task::findOrFail($task);
        $res->status = 1;
        $res->save();
        return back()->with('success_update','Task is Done successfully!');
    }
}
