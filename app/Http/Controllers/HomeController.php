<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

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
        $user_id = auth()->user()->id;
        $user = User::find($user_id);
        return view('properties.profile')->with(['properties'=> $user->properties, 'user'=>$user]);
    }


    // public function update(Request $request, $id)
    // {
    //     $this->validate($request,[
    //         'name' => 'required',
    //         'number' => 'required'
           
    //     ]);

    //     $User = User::find($id);
    //     $User->name =$request->input('name');
    //     $User->mobile =$request->input('number');
    //     $User->save();
    //     return redirect('/profile')->with('success','Details updated');
    // }


}
