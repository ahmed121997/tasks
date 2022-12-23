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
        return $this->getDataTables($request, $data);

    }

   public function getDataTables($request, $data)
{
    if ($request->ajax()) {
        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {

                if($row->status == 'Not Done'){
                    $actionBtn =
                    '<a href="task/done/' . $row->id . '" class="mr-2"><i class="far fa-check-circle text-success"></i></a>
                    <a onClick="return confirm(\'Are you sure to delete ?\');" href="task/delete/' . $row->id . '" ><i class="far fa-trash-alt text-danger"></a>';
                }else{
                    $actionBtn =
                    '<a onClick="return confirm(\'Are you sure to delete ?\');" href="task/delete/' . $row->id . '" ><i class="far fa-trash-alt text-danger"></a>';
                }

                return $actionBtn;
            })
            ->rawColumns(['action'])
            ->make(true);
    }
}
}
