<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
Use App\propertiesForRent;

class PropertyForRentController extends Controller
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
        $propertiesForRent =  propertiesForRent::orderBy('created_at', 'desc')->paginate(10);  
        return view('propertiesForRent.index')-> with('propertiesForRent',$propertiesForRent);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('propertiesForRent.create');
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
            'header' => 'required',
            'monthly_price' => 'required',
            'property_type' => 'required',
            'number_of_baths' => 'required',
            'number_of_rooms' => 'required',
            'post_code' => 'required',
            'Description' => 'required',
            'address' => 'required',
            'cover_image' => 'required',
            'cover_image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',

            ]);

            if($request->hasfile('cover_image'))
            {
                $data = [];
                foreach($request->file('cover_image') as $file)
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
                    $path = $request->$file->storeAs('public/cover_images', $fileNameToStore);
                    array_push($data , $fileNameToStore);
                }
                $fileNameToStore = serialize($data);
            }else{
                $fileNameToStore = 'noimage.jpg';
            }

            
            $propertiesForRent = new propertiesForRent;
            $propertiesForRent->header = $request->input('header');
            $propertiesForRent->monthly_price = $request->input('monthly_price');
            $propertiesForRent->property_type = $request->input('property_type');
            $propertiesForRent->number_of_baths = $request->input('number_of_baths');
            $propertiesForRent->number_of_rooms = $request->input('number_of_rooms');
            $propertiesForRent->post_code = $request->input('post_code');
            $propertiesForRent->Description = $request->input('Description');
            $propertiesForRent->address = $request->input('address');
            $propertiesForRent->user_id = auth()->user()->id;
            $propertiesForRent->cover_image = $fileNameToStore ;
           // $properties->default_image = $fileNameTostore;json_encode($data);
            $propertiesForRent->save();
          
            return redirect('/propertiesForRent')->with('success','Property listed successfully.....');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $propertiesForRent =  propertiesForRent::find($id);
        return view('propertiesForRent.show')->with('propertiesForRent', $propertiesForRent);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $propertiesForRent =  propertiesForRent::find($id);
        if(auth()->user()->id !==$propertiesForRent->user_id){
            return redirect('/propertiesForRent')->with('error', 'Unauthorised Page');

        }
        return view('propertiesForRent.edit')-> with('propertiesForRent',$propertiesForRent);
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
            'header' => 'required',
            'monthly_price' => 'required',
            'property_type' => 'required',
            'number_of_baths' => 'required',
            'number_of_rooms' => 'required',
            'post_code' => 'required',
            'Description' => 'required',
            'address' => 'required',
        ]);
            $propertiesForRent = propertiesForRent::find($id);
            $propertiesForRent->header = $request->input('header');
            $propertiesForRent->monthly_price = $request->input('monthly_price');
            $propertiesForRent->property_type = $request->input('property_type');
            $propertiesForRent->number_of_baths = $request->input('number_of_baths');
            $propertiesForRent->number_of_rooms = $request->input('number_of_rooms');
            $propertiesForRent->post_code = $request->input('post_code');
            $propertiesForRent->Description = $request->input('Description');
            $propertiesForRent->address = $request->input('address');
          
            return redirect('/propertiesForRent')->with('success','listing updated successfully.....');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $propertiesForRent = propertiesForRent:: find($id);
        $propertiesForRent->delete();
        return redirect('/propertiesForRent')->with('success', 'Your listing has been deleted successfully......');

    }
}
