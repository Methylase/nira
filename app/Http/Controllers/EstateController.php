<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Property;
use App\User;
use App\Profile;
use App\Carousel;
use App\Testimonial;
use App\Contact;
use App\Contact_agent;
use App\Blog;
use App\Comment;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Validator;
use Session;

class EstateController extends Controller
{
    public function __construct(){
   
      }
      //home page
      public function index(){

        $carouselProperties = Property::inRandomOrder()->limit(5)->get();
        $latestProperties = Property::inRandomOrder()->limit(3)->get(); 
        $agents = User::inRandomOrder()->limit(3)->with('profile')->get()->skip(1);
        $testimonials = Testimonial::inRandomOrder()->limit(5)->get();
        
        return view('pages.estate.index',['title'=> 'Home','carouselProperties'=>$carouselProperties, 'agents' => $agents, 'testimonials' => $testimonials, 'latestProperties'=> $latestProperties]);
        
      }

      //about page
      public function about(){

        return view('pages.estate.about', ['title' => 'About Us']);
        
      } 
      
      //properties page
      public function properties(Request $request){
        if($_SERVER['REQUEST_METHOD'] =='POST'){


            $property_type = protectData($request->input('property_type'));

            if($property_type =="all"){
              $properties = Property::query()->paginate('10');
            }elseif($property_type =="1"){
              $properties = Property::query()->orderBy('created_at', 'desc')->paginate('10');
            }elseif($property_type =="2"){
              $properties = Property::query()->where('status','rent')->paginate('10');
            }elseif($property_type =="3"){
              $properties = Property::query()->where('status','sale')->paginate('10'); 
            }

          return view('pages.estate.properties',['title'=> 'Properties','properties'=> $properties, 'property_type'=> $property_type]);

        }else{

          $properties = Property::query()->paginate('10');
          return view('pages.estate.properties',['title'=> 'Properties','properties'=> $properties]);
          
        }
        
      } 

      //property page
      public function property(Request $request){
        $id = $request->id;
        $property = Property::findOrFail(protectData($id));
        $user = User::findOrFail(protectData($property->user_id));
        $email = $user->email;
        $agent = Profile::where('user_id',protectData($property->user_id))->get()[0];

        $carousels = Carousel::where('property_id', $id)->get();
        return view('pages.estate.property',['title'=> 'property','property'=> $property, 'email' =>$email, 'agent'=>$agent, 'carousels'=>$carousels]);
        
      }  
      
      //blogs page
      public function blogs(){
        $blogs = Blog::query()->paginate('10');
        return view('pages.estate.blogs',['title' => 'Blogs', 'blogs' => $blogs]);
        
      } 
      
      //blog page
      public function blog(Request $request){

        $id = $request->id;
        $blog = Blog::with(['user.profile'])->findOrFail(protectData($id));

        return view('pages.estate.blog',['title' => 'Blog', 'blog' =>$blog]);
        
      }  


      
      public function comments(Request $request, Blog $blog)
      {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'content' => 'required',
            'email' => 'required',
            'parent_id' => 'nullable|exists:comments,id',
        ]);

        $comment = new Comment($validated);
        $comment->blog_id = $request->blog_id;
        $comment->save();

        return redirect()->back()->with('success', 'Comment added!');
      }

      public function reply(Request $request, Comment $comment)
      {
          $request->validate(['reply' => 'required']);

          Comment::create([
              'reply' => $request->reply,
              'blog_id' => $comment->post_id,
              'comment_id' => $comment->id,
          ]);

          return back();
      }

      //agents page
      public function agents(){

        return view('pages.estate.agents', ['title' => 'Agents']);
        
      }        

      //agent page
      public function agent($name=null){

        return view('pages.estate.agent');
        
      }      

      public function contact(Request $request){
        if($_SERVER['REQUEST_METHOD'] =='POST'){

          $data = array();
        
          $name = $request->input('name');
          $email = $request->input('email');
          $subject = $request->input('subject');
          $message = $request->input('message');
          $rules=array(
            'name' => 'required',
            'email' => 'required|max:255',
            'subject' => 'required',
            'message' => 'required'
          );


          $validator= Validator::make($request->all(),$rules);
          if($validator->fails()){
            return redirect()->route('contact')->withErrors($validator);
          }else{

 
              $data['name'] = protectData($name);
              $data['email'] = protectData($email);
              $data['subject'] = protectData($subject);
              $data['message'] = protectData($message);
              
              $contact= Contact::create($data);

              if($contact){
                $request->session()->flash('successMessage', 'Feedback successfully submitted');
              }else{
                $request->session()->flash('errorMessage', 'Oop something went wrong'); 
              }

              return redirect()->route('contact');

          }          

        }else{
            return view('pages.estate.contact',['title' => 'Contact Us']);
        }
        
      } 
      
      

      public function testimony(Request $request){

        if($_SERVER['REQUEST_METHOD'] =='POST'){
          
          $data = array();
        
          $image = $request->file('testimonyImage');
          $name = $request->input('name');
          $email = $request->input('email');
          $subject = $request->input('subject');
          $feedback = $request->input('feedback');
          $rules=array(
            'testimonyImage' => 'required',
            'name' => 'required',
            'email' => 'required|max:255',
            'subject' => 'required',
            'feedback' => 'required'
          );


          $validator= Validator::make($request->all(),$rules);
          if($validator->fails()){
            return redirect()->route('testimony')->withErrors($validator);
          }else{

            if( Testimonial::where(['email'=>protectData($email)])->exists()){

              $testimony = Testimonial::where(['email'=>protectData($email)])->get()[0];   
              //$testimony = Testimonial::find($testimony->id);
   
              $FileSystem = new Filesystem();
              $directory = public_path().'/testimonial_images/';
              if($image ==NULL || $image =='' ){
                
                if($testimony->image !=Null || $testimony->image !='' ){
                  
                }else{
                  $testimony->image = $image->getFilename().'.'.$image->getClientOriginalExtension();; 
                }
              
              }elseif($image->getFilename().'.'.$image->getClientOriginalExtension() != $testimony->image){
                if(file_exists($directory.$testimony->id.'/'.$image->getFilename().'.'.$image->getClientOriginalExtension())){

                  unlink($directory.$testimony->id.'/'.$testimony->image);                              
                    $image->move($directory.$testimony->id,$image->getFilename().'.'.$image->getClientOriginalExtension());
                  $testimony->image=$image->getFilename().'.'.$image->getClientOriginalExtension();                                          
                }else{
                                              
                  unlink($directory.$testimony->id.'/'.$testimony->image); 
                  $image->move($directory.$testimony->id,$image->getFilename().'.'.$image->getClientOriginalExtension());
                  $testimony->image=$image->getFilename().'.'.$image->getClientOriginalExtension();  
                }                          
              }
                $testimony->name= protectData($name);
                $testimony->email= protectData($email);
                $testimony->subject= protectData($subject);            
                $testimony->feedback= protectData($feedback);
                
                if($testimony->save()){
                  $request->session()->flash('successMessage', 'Feedback successfully submitted');                                                          
                }else{
                  $request->session()->flash('errorMessage', 'Oop something went wrong');                       
                }

                return redirect()->route('testimony');
            }else{
              $data['name'] = protectData($name);
              $data['email'] = protectData($email);
              $data['subject'] = protectData($subject);
              $data['feedback'] = protectData($feedback);
              $data['image'] = $image->getFilename().'.'.$image->getClientOriginalExtension();
              

              $testimony= Testimonial::create($data);
              $FileSystem = new Filesystem();
              $directory_images = public_path().'/testimonial_images/'.$testimony->id.'/';
                
              if(in_array($image->getClientOriginalExtension(),array('png','jpg','jpeg'))){

                $image->move($directory_images,$image->getFilename().'.'.$image->getClientOriginalExtension());
                $request->session()->flash('successMessage', 'Feedback successfully submitted');
        
              }else{
                  $request->session()->flash('image_error', 'Upload the right image format');
              }

              return redirect()->route('testimony');
            }

          }
        
        }else{
             return view('pages.estate.testimony', ['title' => 'Testimonies']);
        }
       
        
      }  
      
      
      public function contact_agent(Request $request){
        if($_SERVER['REQUEST_METHOD'] =='POST'){

          $data = array();
        
          $name = $request->input('name');
          $email = $request->input('email');
          $message = $request->input('message');
          $agent_id = $request->input('agent_id');
          $property_id = $request->input('property_id');

          $rules=array(
            'name' => 'required',
            'email' => 'required|max:255',
            'message' => 'required'
          );


          $validator= Validator::make($request->all(),$rules);
          if($validator->fails()){
            return redirect()->route('property',['id' => $property_id])->withErrors($validator);
          }else{

 
              $data['name'] = protectData($name);
              $data['email'] = protectData($email);
              $data['comment'] = protectData($message);
              $data['user_id'] = protectData($agent_id);
              $data['property_id'] = protectData($property_id);
              
              $contact= Contact_agent::create($data);

              if($contact){
                $request->session()->flash('successMessage', 'You have successfully submitted your message');
              }else{
                $request->session()->flash('errorMessage', 'Oop something went wrong'); 
              }

              return redirect()->route('property',['id' => $property_id]);

          }          

        }
        
      } 
            

}
