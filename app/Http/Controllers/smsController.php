<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\sms;

class smsController extends Controller
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
            'message' => 'required'
        ]);
        // $properties->number_of_rooms = $request->input('number_of_rooms');
        // $properties->post_code = $request->input('post_code');
        $sms = new sms;
        $name = $request->input('name');
        $message = $request->input('message');
        $number = $request->input('number');
        $sms->from= $request->input('name');
        $sms->from= $request->input('name');
        $sms->number = $request->input('number');
        $sms->to=$request->input('landlord');
        $sms->message = $request->input('message');
        $sms->save();

        $fullMessage = ['name:'.$name,
                        'number:'.$number,
                        'message:'.$message
                                     ];

        $basic  = new \Nexmo\Client\Credentials\Basic('c6a19afc', '7Ezz9mndXxmlMmGN');
        $client = new \Nexmo\Client($basic);

        $message = $client->message()->send([
            'to' => '447375043773',
            'from' => 'Vonage APIs',
            'text' => $fullMessage
        ]);


            return redirect('/sendsms')->with('success','sms send.....');
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
