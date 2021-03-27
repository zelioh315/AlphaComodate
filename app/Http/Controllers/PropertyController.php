<?php

namespace App\Http\Controllers;
use Illuminate\Pagination\Paginator;
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
        $this->middleware('auth',['except'=>['index', 'show','gettingProperties','propertyonmap','propertiesOnLocation','propertyCities' ]]);
    }
    public function propertiesOnLocation(Request $request){
        // $userIp = '5.151.5.251';
        // $locationData = \Location::get($userIp);
        // dd($locationData);
        // $location = file_get_contents('http://freegeoip.net/json/'.$_SERVER['REMOTE_ADDR']);
        // print_r($location);
        $userIp = $request->ip();
        $res = file_get_contents('https://www.iplocate.io/api/lookup/$userIp');
        $res = json_decode($res);

        echo $res->country; // United States
        echo $res->continent; // North America
        echo $res->latitude; // 37.751
        echo $res->longitude; // -97.822

        var_dump($res);

        // return view('pages.forsale')->with('locationData',$locationData);
    }

    public function gettingProperties(Request $request){
        $this->validate($request,[
            'searchTextField' => 'required']);
        $userIp = $request->ip();
        $locationData = \Location::get($userIp);
        $latit  = $locationData['latitude'];
        $longi = $locationData['longitude'];

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
        if($addr != null){
            $address  = $geocoder->getCoordinatesForAddress($addr);
            $lt= $address['lat'];
            $ln = $address['lng'];
            if($lat == null){
                $lat = $ln;
                $lng =$lt;}
        }
   

        $max_p = $max_price;
        $min_p = $min_price;
        $bed = $rooms;
        $prop = $prop_type;
        // if($lat == null){
        //     $lat = $ln;
        //     $lng =$lt;}
        if($lat == null){
            $lat = $longi;
            $lng =$latit;
        }
        
        
        if($rooms == null || $rooms == 5 ){
            $bed = 5;
        }
        if($max_price == null){
            $max_p = 20000;
        }
        if($min_price == null){
            $min_p = 100;
        }
        
        $sql_distance = " ,(((acos(sin((".$lat."*pi()/180)) * sin((`properties`.`latitude`*pi()/180))+cos((".$lat."*pi()/180)) * cos((`properties`.`latitude`*pi()/180)) * cos(((".$lng."-`properties`.`longitude`)*pi()/180))))*180/pi())*60*1.1515*1.609344) as distance "; 
        if ($radius == '15+' || $radius == 'Any'){
            $having = " HAVING (distance ) "; 
        }else{
            $having = " HAVING (distance <= $radius) "; 
        }
            if ($rooms == 'Any' ){
                if ($prop_type == 'show all'){
                    $where =   "WHERE ( price BETWEEN $min_p AND $max_p )";
                }else{
                    $where =   "WHERE ( price BETWEEN $min_p AND $max_p and property_type='$prop')";
                }
            }else if ($rooms == '+5'){
                if ($prop_type == 'show all'){
                    $where =   "WHERE ( price BETWEEN $min_p AND $max_p and number_of_rooms>5 )";
                }else{
                    $where =   "WHERE ( price BETWEEN $min_p AND $max_p and property_type='$prop' and number_of_rooms>5)";
                }
            }else{
                if ($prop_type == 'show all'){
                    $where =   "WHERE ( price BETWEEN $min_p AND $max_p and number_of_rooms=$rooms)";
                }else{
                    $where =   "WHERE ( price BETWEEN $min_p AND $max_p and number_of_rooms=$rooms and property_type='$prop')";
                }
               
            }
                
            
        

    $order_by = ' distance ASC '; 
    $photos=Photos::get();
    $user = User::get();
    $properties = DB::select("SELECT  *".$sql_distance." FROM properties $where $having ORDER BY $order_by"); 
    
            
       return view('properties.index')->with(['properties'=>$properties, 'photos'=>$photos, 'user'=>$user,'addr'=>$addr, 'min_price'=>$min_price, 'max_price'=>$max_price,'radius'=>$radius, 'rooms'=>$rooms, 'prop_type'=>$prop_type]);
    }

    public function propertyCities($city)
    {   $addr = $city;
        $photos=Photos::get();
        $user = User::get();
        $where =   "WHERE ( City=$city)";
        // $properties =  properties::find($city);
        $properties = DB::select("SELECT * FROM properties WHERE (City= '$city')");

       // with(['properties'=> $user->properties, 'propertiesForRent'=>$user->propertiesForRent])
       return view('properties.cities')->with(['properties'=>$properties, 'photos'=>$photos, 'user'=>$user,'addr'=>$addr]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {


       $properties =  properties::get();  

    //   $properties= properties::whereHas('photos','user',function($query){
    //     $query->where('id', 44);
    //   } );
      return view('pages.forRent')->with('properties',$properties);
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

    public function propertyonmap($id)
    {
        $properties =  properties::find($id);

        $client = new \GuzzleHttp\Client();

        $geocoder = new Geocoder($client);
       
        $geocoder->setApiKey(config('geocoder.key'));
       
        $geocoder->setCountry(config('geocoder.country', 'UK'));
       
       $address = $geocoder->getCoordinatesForAddress($properties->post_code);
       // with(['properties'=> $user->properties, 'propertiesForRent'=>$user->propertiesForRent])
        return view('properties.prop_on_map')->with(['properties'=>$properties, 'address'=>$address]);
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
