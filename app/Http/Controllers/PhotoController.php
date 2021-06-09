<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Photos;
Use App\properties;

class PhotoController extends Controller
{
      /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth',['except'=>['index', 'show']]);
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
            'filename' => 'required',
            'filename.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',

            ]);

            
            if($request->hasfile('filename'))
            {
                
                $p= $request->input('property_id');
                $files = $request->file('filename');
                foreach($files as $file)
                {
                     //Get filename with extension
                    $filenameWithExt = $file->getClientOriginalName();
                    //Get just filename
                    $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                    //Get just extension
                    $extension = $file->getClientOriginalExtension();
                    //Filename to store
                    $fileNameToStore = $filename.'_'.time().'.'.$extension;
                    //upload image
                    $path = $file->storeAs('public/cover_images', $fileNameToStore);
                    $Photos = new Photos;
                    $Photos->properties_id = $p;
                    $Photos->filename = $fileNameToStore ;
                    $Photos->save();

                }
       
            }
            return redirect('/profile')->with('success','Property listed successfully.....');
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
    // public function edit($id)
    // {
    //     //
    // }
    public function edit($id)
    {
        $properties =  properties::find($id);
        if(auth()->user()->id !==$properties->user_id){
            return redirect('/')->with('error', 'Unauthorised Page');

        }
        return view('properties.pictureUpload')-> with('properties',$properties);
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
        $this->validate($request,[
            'filename' => 'required',
            'filename.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',

            ]);

            
            if($request->hasfile('filename'))
            {
                
                $p= $request->input('property_id');
                $files = $request->file('filename');
                foreach($files as $file)
                {
                     //Get filename with extension
                    $filenameWithExt = $file->getClientOriginalName();
                    //Get just filename
                    $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                    //Get just extension
                    $extension = $file->getClientOriginalExtension();
                    //Filename to store
                    $fileNameToStore = $filename.'_'.time().'.'.$extension;
                    //upload image
                    $path = $file->storeAs('public/cover_images', $fileNameToStore);
                    $Photos = new Photos;
                    $Photos->properties_id = $p;
                    $Photos->filename = $fileNameToStore ;
                    $Photos->save();

                }
       
            }
            return redirect('/properties')->with('success','Property listed successfully.....');
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
