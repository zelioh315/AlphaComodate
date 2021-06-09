<?php

namespace App\Http\Controllers;
use Geocoder\Laravel\Facades\GMaps;
use Geocoder\Laravel\Providers\GeocoderService;
Use App\properties;
use Illuminate\Http\Request;
Use App\Photos;
Use App\User;
Use DB;
class pagesController extends Controller
{
  
    public function index(Request $request){
        // $max_p = 20000;
        // $min_p = 100;
        // $radius = 5;
        // $lat = 52.591370;//$request->user_lng;
        // $lng = -2.110748; //$request->user_lat;
        // $sql_distance = " ,(((acos(sin((".$lat."*pi()/180)) * sin((`properties`.`latitude`*pi()/180))+cos((".$lat."*pi()/180)) * cos((`properties`.`latitude`*pi()/180)) * cos(((".$lng."-`properties`.`longitude`)*pi()/180))))*180/pi())*60*1.1515*1.609344) as distance "; 
        // $order_by = ' distance ASC '; 
        // $having = " HAVING (distance > $radius) "; 
        // $where =   "WHERE ( price BETWEEN $min_p AND $max_p )";
        $photos=Photos::get();
        // $user = User::get();
        // $properties = DB::select("SELECT  *".$sql_distance." FROM properties $where $having ORDER BY $order_by");     
       $properties =  properties::get();    
        return view('pages.index') ->with(['properties'=>$properties, 'photos'=>$photos]);
    }

    public function forRent(){
        $title = 'Rent';
        return view('pages.forRent')->with('title', $title);
    }

    public function about(){
         $title = 'About';
        return view('pages.about')->with('title', $title);
    }

    public function contact(){
        $title = 'Contact Us';
       return view('pages.contact')->with('title', $title);
   }

    public function forSale(){
        $title = 'Sales';
        return view('pages.forSale')->with('title', $title);
    }

    public function students(){
        $properties =  properties::orderBy('created_at', 'desc')->paginate(10); 
        return view('properties.students')->with('properties', $properties);
    }

    public function servicedAccomodations(){
        $properties =  properties::orderBy('created_at', 'desc')->paginate(10); 
        return view('properties.serviced')->with('properties', $properties);
    }

    public function sendAnEmail($id){
        $properties =  properties::find($id);
        return view('properties.emailSending')->with('properties', $properties);
    }


}
