<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        return view('home');
    }


    public function getTasks(Request $request)
    {
        $user = auth()->user();
        if(!$user->isAdmin()){
            $data = $user->tasks;
            foreach($data as $d){
                $d->status = ($d->status == 0) ? 'Not Done' : "Done";
            }
            // helpers
            return getDataTablesWithoutAction($request, $data);
        }
        $data = Task::get();
        foreach($data as $d){
            $d->officer = $d->user->name;
            $d->status = ($d->status == 0) ? 'Not Done' : "Done";
        }
        return getDataTables($request, $data);

    }

}
