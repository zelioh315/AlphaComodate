<?php

namespace App\Http\Controllers;
use Geocoder\Laravel\Facades\GMaps;
use Geocoder\Laravel\Providers\GeocoderService;
use Illuminate\Http\Request;
use Spatie\Geocoder\Geocoder;

class MapController extends Controller
{
    public function map(){
         $client = new \GuzzleHttp\Client();

         $geocoder = new Geocoder($client);
        
         $geocoder->setApiKey(config('geocoder.key'));
        
         $geocoder->setCountry(config('geocoder.country', 'UK'));
        
        $address = $geocoder->getCoordinatesForAddress('se18 3yw');

        return view('properties.map')->with('address', $address);
    }
   


}
