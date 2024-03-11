<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EstateController extends Controller
{
    public function __construct(){
   
      }
      //home page
      public function index(){

        return view('pages.estate.index');
        
      }

      //about page
      public function about(){

        return view('pages.estate.about');
        
      } 
      
      //properties page
      public function properties(){

        return view('pages.estate.properties');
        
      } 

      //property page
      public function property(){

        return view('pages.estate.property');
        
      }  
      
      //blogs page
      public function blogs(){

        return view('pages.estate.blogs');
        
      } 
      
      //blog page
      public function blog($name=null){

        return view('pages.estate.blog');
        
      }   

      //agents page
      public function agents(){

        return view('pages.estate.agents');
        
      }        

      //agent page
      public function agent($name=null){

        return view('pages.estate.agent');
        
      }      

      public function contact(){

        return view('pages.estate.contact');
        
      }     

}
