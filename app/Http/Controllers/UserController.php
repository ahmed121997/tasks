<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;


use App\Models\User;


class UserController extends Controller
{

    function __construct()
    {
        $this->middleware('auth');
    }
    /***********************
    ** function index user
    ** return view (user's properties)
    ** no parameters
    **
    */

    public function index(){
        $id= Auth::user()->id;
        $count = Task::where(['status'=>1,'user_id'=>$id])->count();
        return view('users.index',['count'=>$count]);
    }


    /**********************
    ** function edit user
    ** return view (user's edit)
    ** no parameters
    **
    */
    public function edit(){
        $user = Auth::user();

        return view('users.edit',compact('user'));
    }


    /***********************
    ** function update  user data
    ** return
    **  parameters $request and $id
    **
    */
    public function update(Request $request,$id){
        $res = User::findorfail($id);
        // if existed email equal inserted email
        if($res->email == $request->email){
            $validator  = Validator::make($request->all(), [
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255'],
            ]);
        }else{
            $validator  = Validator::make($request->all(), [
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            ]);
        }

        if($validator->passes()) {
            $res->update($request->all());
            return redirect()->route('user.profile')->with('success_update','data is updated successfully');
        }
        return redirect()->back()->withErrors($validator)->withInput($request->all());
    }

    /***********************
    ** function change  user password
    ** return view
    ** no parameters
    **
    */
    public function change_password(){
        $user = Auth::user();
        return view('users.change_password',compact('user'));
    }

    /***********************
    ** function change  user password
    ** return redirect with messages
    ** no parameters
    **
    */
    public function store_change_password(Request $request, $id){

        $res = User::findorfail($id);

        if (Hash::check($request->old_password, $res->password)){
            if($request->new_password == $request->confirm_new_password)
                $res->update(['password' => Hash::make($request->new_password)]);
            else
                return redirect()->back()->withErrors(['not_same'=>'The Password is not the same']);    // not same
        }else
            return redirect()->back()->withErrors(['pass_wrong'=>'The password is Wrong']);  // pass is wrong
        return redirect()->route('user.profile')->with('success_update','data is updated successfully');
    }

}
