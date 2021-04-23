<?php

namespace App\Http\Controllers;
Use App\properties;
use Illuminate\Http\Request;

class pagesController extends Controller
{
  
    public function index(){
        $title = 'AlphaComodate';
      //  return view('pages.index', compact('title'));

        return view('pages.index') ->with('title', $title);
    }

    public function forRent(){
        $title = 'Rent';
        return view('pages.forRent')->with('title', $title);
    }

    public function about(){
         $title = 'About';
        return view('pages.about')->with('title', $title);
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
