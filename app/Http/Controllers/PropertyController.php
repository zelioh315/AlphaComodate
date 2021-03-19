<?php

namespace App\Http\Controllers;

use Geocoder\Laravel\Facades\GMaps;
use Geocoder\Laravel\Providers\GeocoderService;
use Illuminate\Http\Request;
use Spatie\Geocoder\Geocoder;
use Illuminate\support\facades\Storage;
Use App\properties;
Use App\Photos;
Use App\User;
Use DB;

class PropertyController extends Controller
{
    
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth',['except'=>['index', 'show','gettingProperties' ]]);
    }

    public function gettingProperties(Request $request){
        $client = new \GuzzleHttp\Client();

        $geocoder = new Geocoder($client);
       
        $geocoder->setApiKey(config('geocoder.key'));
       
        $geocoder->setCountry(config('geocoder.country', 'UK'));

        $addr = $request->searchTextField;
        $radius = $request->radius;
        $lat = $request->cityLng;
        $lng =$request->cityLat;
        $min_price = $request->min_price;
        $max_price = $request->max_price;
        $rooms =$request->bedrooms;
        $prop_type = $request->property_type;
        $address  = $geocoder->getCoordinatesForAddress($addr);
        $lt= $address['lat'];
        $ln = $address['lng'];
        if($lat == null){
            $lat = $ln;
            $lng =$lt;
        }
        $sql_distance = " ,(((acos(sin((".$lat."*pi()/180)) * sin((`properties`.`latitude`*pi()/180))+cos((".$lat."*pi()/180)) * cos((`properties`.`latitude`*pi()/180)) * cos(((".$lng."-`properties`.`longitude`)*pi()/180))))*180/pi())*60*1.1515*1.609344) as distance "; 
        if ($radius == 15){
            $having = " HAVING (distance ) "; 
        }else{
            $having = " HAVING (distance <= $radius) "; 
        }
        if($min_price == null && $max_price == null ){
            if ($rooms == null || $rooms == 5){
                $where =   "WHERE ( number_of_rooms<1000 )";   
            }else{
                $where =   "WHERE ( number_of_rooms=$rooms )";   
            }      
        }else if($min_price != null ){
            if ($rooms == null || $rooms == 5){
                $where =   "WHERE ( number_of_rooms<1000 and price >= $min_price)";  
            }else{
                $where =   "WHERE ( number_of_rooms=$rooms and price >= $min_price)";    
            }   
            
        }else if($max_price != null ){
            if ($rooms == null || $rooms == 5){
                $where =   "WHERE ( number_of_rooms<1000 and price <= $max_price)";  
            }else{
                $where =   "WHERE ( number_of_rooms=$rooms and price <= $max_price)";    
            }  
        }
        else {
            $where =   "WHERE ( price BETWEEN $min_price AND $max_price and number_of_rooms=$rooms )";
        }

    $order_by = ' distance ASC '; 
    $photos=Photos::get();
    $user = User::get();
    $properties = DB::select("SELECT  *".$sql_distance." FROM properties $where $having ORDER BY $order_by"); 

       return view('pages.forRent')->with(['properties'=>$properties, 'photos'=>$photos, 'user'=>$user,'addr'=>$addr, 'min_price'=>$min_price, 'max_price'=>$max_price,'radius'=>$radius, 'rooms'=>$rooms, 'prop_type'=>$prop_type]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {


       $properties =  properties::orderBy('created_at', 'desc')->paginate(10);  

    //   $properties= properties::whereHas('photos','user',function($query){
    //     $query->where('id', 44);
    //   } );
      return view('properties.index')->with('properties',$properties);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('properties.create');
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
            'price' => 'required',
            'property_type' => 'required',
            'number_of_baths' => 'required',
            'number_of_rooms' => 'required',
            'post_code' => 'required',
            'City' => 'required',
            'Description' => 'required',
            'address' => 'required',
            

            ]);

            $client = new \GuzzleHttp\Client();

            $geocoder = new Geocoder($client);
           
            $geocoder->setApiKey(config('geocoder.key'));
           
            $geocoder->setCountry(config('geocoder.country', 'UK'));
           
           // $address = $geocoder->getCoordinatesForAddress('se18 3yw');

            $features = $request->input('parking')."  ".$request->input('garden')."  "
                .$request->input('dryer')."  ".$request->input('unfurnished')."  "
                .$request->input('fireplace')."  ".$request->input('fridge')."  "
                .$request->input('Washing_machine')."  "
                .$request->input('Furnished')."  ".$request->input('cooker');
            $properties = new properties;
            $properties->header = $request->input('header');
            $properties->price = $request->input('price');
            $properties->property_type = $request->input('property_type');
            $properties->number_of_baths = $request->input('number_of_baths');
            $properties->number_of_rooms = $request->input('number_of_rooms');
            $properties->post_code = $request->input('post_code');
            $properties->City = $request->input('City');
            $address  = $geocoder->getCoordinatesForAddress($request->input('post_code'));
            $properties->longitude =$address['lat'];
            $properties->latitude = $address['lng'];
            $properties->region = $address['formatted_address'];
            $properties->features = $features;
            $properties->Description = $request->input('Description');
            $properties->address = $request->input('address');
            $properties->user_id = auth()->user()->id;
            $properties->save();
           // $propertyId = $properties->id;
            return view('properties.pictureUpload')->with('properties', $properties);
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $properties =  properties::find($id);

        $client = new \GuzzleHttp\Client();

        $geocoder = new Geocoder($client);
       
        $geocoder->setApiKey(config('geocoder.key'));
       
        $geocoder->setCountry(config('geocoder.country', 'UK'));
       
       $address = $geocoder->getCoordinatesForAddress($properties->post_code);
       // with(['properties'=> $user->properties, 'propertiesForRent'=>$user->propertiesForRent])
        return view('properties.show')->with(['properties'=>$properties, 'address'=>$address]);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $properties =  properties::find($id);
        if(auth()->user()->id !==$properties->user_id){
            return redirect('/properties')->with('error', 'Unauthorised Page');

        }
        return view('properties.edit')-> with('properties',$properties);
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
            'price' => 'required',
            'property_type' => 'required',
            'number_of_baths' => 'required',
            'number_of_rooms' => 'required',
            'post_code' => 'required',
            'Description' => 'required',
            'address' => 'required',
            'editphoto'=> 'required'

            ]);
            $properties = properties::find($id);
            $properties->header = $request->input('header');
            $confirmation = $request->input('editphoto');
            $properties->price = $request->input('price');
            $properties->property_type = $request->input('property_type');
            $properties->number_of_baths = $request->input('number_of_baths');
            $properties->number_of_rooms = $request->input('number_of_rooms');
            $properties->post_code = $request->input('post_code');
            $properties->Description = $request->input('Description');
            $properties->address = $request->input('address');
            $properties->save();

            if ( $confirmation == 'yes'){
                return view('properties.pictureUpload')->with('properties', $properties);
            }else{
                return redirect('/properties')->with('success','Property listing updated successfully.....');
            }
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $photo = Photos::get();
        $properties = properties:: find($id);
        if(auth()->user()->id !==$properties->user_id){
            return redirect('/properties')->with('error', 'Unauthorised Page');

        }
        foreach($photo as $p){
            if($p ->properties_id == $properties->id ){
                Storage::delete('public/cover_images/'.$p->filename);
                $p->delete();
            }

        }
        $properties->delete();
        return redirect('/properties')->with('success', 'Your listing has been deleted successfully......');

    }
}
