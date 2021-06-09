<?php

namespace App\Http\Controllers;
Use App\Email;
use Illuminate\Http\Request;
Use App\User;
Use App\properties;
Use App\Mail\EmailFromAPotentialTenant;
use Illuminate\Support\Facades\Mail;
class emailController extends Controller
{
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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'name' => 'required',
            'number' => 'required',
            'email' => 'required',
            'message' => 'required'
        ]);



            $Email = new Email;
            $Email->name = $request->input('name');
            $Email->email = $request->input('email');
            $Email->number = $request->input('number');
            $Email->message = $request->input('message');
            $Email->property_id = $request->input('property_id');

            $mailData = array('name'=>$request->input('name'),
                              'email'=>$request->input('email'),
                              'number'=>$request->input('number'),
                              'message'=>$request->input('message')  );

            $user=User::find($Email->property_id);
            $user_email = $user->email;
            $Email->landlord_email =  $user_email;
            $Email->save();
            
            Mail::to($user_email)->send(new EmailFromAPotentialTenant($mailData));
     
            return redirect('/')->with('success','Email send successfully.....');
    }

    public function contact_us(Request $request)
    {
        $this->validate($request,[
            'name' => 'required',
            'number' => 'required',
            'email' => 'required',
            'message' => 'required'
        ]);



            // $Email = new Email;
            // $Email->name = $request->input('name');
            // $Email->email = $request->input('email');
            // $Email->number = $request->input('number');
            // $Email->message = $request->input('message');
            // $Email->property_id = $request->input('property_id');

            $mailData = array('name'=>$request->input('name'),
                              'email'=>$request->input('email'),
                              'number'=>$request->input('number'),
                              'message'=>$request->input('message')  );

            // $user=User::find($Email->property_id);
            $user_email = env("MAIL_USERNAME", "alphacomodate@gmail.com");;
            // $Email->landlord_email =  $user_email;
            // $Email->save();
            
            Mail::to($user_email)->send(new EmailFromAPotentialTenant($mailData));
     
            return redirect('/contact_us')->with('success','Email send successfully.....');
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
