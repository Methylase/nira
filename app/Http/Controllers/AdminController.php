<?php

namespace App\Http\Controllers;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
use Illuminate\Http\Request;
use Session;
use Illuminate\Support\Facades\Auth;
use App\Http\Middleware\RevalidateBackHistory;
use Illuminate\Support\Facades\Storage;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Facades\Hash;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\Gate;
use Illuminate\Auth\Access\Response;
use App\User;
use App\Role;
use App\Profile;
use App\Property;
use App\Carousel;
use Validator;
use App\Events\SendMail;
use App\Jobs\SendAdminMail;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Cache;

class AdminController extends Controller
{

    public function __construct(){

      $user = User::where('email','methyl2007@gmail.com')->first();

      if($user === null){
        $date_time = date('Y-m-d h:i:s');
        $user = User::create(['email'=> 'methyl2007@gmail.com','name'=> 'methyl2007', 'email_verified_at'=>$date_time,'check'=>'approved', 'password'=>Hash::make('smoothless')]);
        $role_name ='ROLE_ADMIN';
        $role = Role::where('name',$role_name)->first();
        $role_id = $role->id;
        $user->roles()->attach($role_id);
      }

    }

    //admin dashboard
    public function index(){
    
      $userId = Auth::user()->id;
      $email = Auth::user()->email;
      $usersCount= User::where("check", "new")->get()->count();
      $date = date('Y');
      if(Profile::where("user_id",$userId)->exists()){
        $profile = Profile::where("user_id",$userId)->first();

      }else{
        $profile= new Profile;
      }

      return view('pages.skydash-admin.index',['date'=>$date,'profile'=>$profile,'email'=> $email,'userId'=>$userId, 'usersCount'=>$usersCount, 'title'=>'Profile']);

    }

    //admin login
    public function login(){

      return view('pages.skydash-admin.login');

    }

    //admin login post
    public function loginPost(Request $request){
      $email=$request->input('email');
      $pass=$request->input('password');
      $rules=array(
        'email'=>'required|email',
        'password'=>'required',
      );
      $validator= Validator::make($request->all(),$rules);
      if($validator->fails()){
        //fail request
        return redirect()->route('login')->withErrors($validator);
      }else{

        $email=protectData($request->input('email'));
        $pass=protectData($request->input('password'));
        $data=array('email'=>$email,'password'=>$pass);

        if($request->input('remember_me')=='on'){
          $remember=true;
        }else{
          $remember=false;
        }

        if(!$this->confirmUser($email)){
          return  back()->with('errorMessage', 'Your login detail is wrong');
        }else{
          if(Auth::attempt($data,$remember)){
            return redirect()->route('dashboard');
          }else{
            return  back()->with('errorMessage', 'Your login detail is wrong');
          }
        }

      }

    }

    public function confirmUser($email){
      $confirm_user = User::where(["email" => $email, "check" =>"approved"])->exists();
      if($confirm_user ){
        return true;
      }else{
        return false;
      }
    }


    //admin signup
    public function signup(){

      if($_SERVER['REQUEST_METHOD'] =='POST'){

        $user= new User;
        $username=protectData($request->input('username'));
        $email=protectData($request->input('email'));
        $pass=protectData(Hash::make($request->input('password')));
        $condition =protectData($request->input('condition'));
        if($condition != "on"){
          $request->session()->flash('agreement', 'KIndly select the checkbox to agree to all Terms & Conditions');
          return  redirect()->route('signup');
        }else{
          $condition ="agreed";
        }

        $role_name ='ROLE_AGENT';
        $rules=array(
          'username'=>'required',
          'email'=>'required|email|unique:users,email',
          'password'=>'required',
          'condition'=>'required',
        );
        $validator= Validator::make($request->all(),$rules);
        if($validator->fails()){
          return redirect()->route('signup')->withErrors($validator);
        }else{
          $role_id=DB::table('roles')->where('name',$role_name)->first();
          $user_id=$result=DB::table('users')->where('email',$email)->first();
          $roleCheck=DB::table('role_user')->where('role_id',$role_id)->where('user_id',$user_id);
          if($roleCheck == null){
            $request->session()->flash('errorMessage', $email.' has already been registered as an '.$role_name );
            return  redirect()->route('signup');
          }
          $user->name=protectData($username);
          $user->email=protectData($email);
          $user->password=protectData($pass);
          $user->check='new';
          if($user->save()){
            $role = Role::where('name',$role_name)->first();
            $role_id = $role->id;
            $user->roles()->attach($role_id);
              $request->session()->flash('successMessage', 'You have successfully registered '.$email.' as an agent');
              SendAdminMail::dispatch($email)->onQueue('emails');
              return  redirect()->route('signup');

          };
        }

      }else{
          return view('pages.skydash-admin.signup');
      }

    }

  //logout here
  public  function logout(){
    Auth::logout();
    Session::flush();
    return redirect()->route('login');;
  }

  //setup profile
  public function setupProfile(Request $request, Profile $profile){
    //Gate
    /*Gate::allows('is_admin') ? Response::allow() : abort(403); or Response::deny('You do not own this profile.');*/
    //Policy
    // $this->authorize('create', $profile);
    if($_SERVER['REQUEST_METHOD'] =='POST'){
      
      $data = array();
      $image = $request->file('profileImage');

      $firstname=$request->input('firstname');
      $lastname=$request->input('lastname');
      $middlename=$request->input('middlename');
      $phone=$request->input('phone');
      $email=$request->input('email');
      $gender=$request->input('gender');
      $city=$request->input('city');
      $hobbies=$request->input('hobbies');
      $address1=$request->input('address1');
      $address2=$request->input('address2');
      $dob=$request->input('dob');
      $maritalStatus=$request->input('maritalStatus');
      $state=$request->input('state');
      $localG=$request->input('localG');
      $country=$request->input('country');
      $postalCode=$request->input('postalCode');
      $description=$request->input('description');
      $facebook=$request->input('facebook');
      $twitter=$request->input('twitter');
      $instagram=$request->input('instagram');
      $linkedin=$request->input('linkedin');
      if(User::where("email",protectData($email))->exists()){

        $rules=array(
          'firstname'=>'required',
          'lastname'=>'required',
          'middlename'=>'required',
          'email'=>'required',
          'phone'=>'required',
          'city'=>'required',
          'hobbies'=>'required',
          'address1'=>'required',
          'dob'=>'required',
          'maritalStatus'=>'required',
          'state'=>'required',
          'localG'=>'required',
          'country'=>'required',
          'postalCode'=>'required',
          'description'=>'required',
        );
        $validator= Validator::make($request->all(),$rules);
        if($validator->fails()){
          return redirect()->route('setup-profile')->withErrors($validator);
        }else{
          if(!empty($request->input('id'))){
            $profile_id = protectData($request->input('id'));
            $profile = Profile::find($profile_id);
            $FileSystem = new Filesystem();
            $directory = public_path().'/uploads/'.$profile_id.'/';
            if(!isset($image) || $image ==NULL || $image =='' ){
              if($profile->profile_image !=='' && file_exists($directory.$profile->profile_image)){
                unlink(public_path( $directory.$profile->profile_image));
              }
              $image='';
              $profile->profile_image=$image;
            }else if($image->getFilename().'.'.$image->getClientOriginalExtension() != $profile->profile_image){
              if($profile->profile_image !==''){
                if(file_exists($directory.$profile->profile_image)){
                  unlink($directory.$profile->profile_image);
                }
              }
              $image->move($directory,$image->getFilename().'.'.$image->getClientOriginalExtension());
              $profile->profile_image=$image->getFilename().'.'.$image->getClientOriginalExtension();
            }else{
              if(file_exists($directory.$profile->profile_image)){
                unlink($directory.$profile->profile_image);
                $profile->profile_image=$image->getFilename().'.'.$image->getClientOriginalExtension();
              }

              $image->move($directory,$image->getFilename().'.'.$image->getClientOriginalExtension());

              $profile->profile_image=$image->getFilename().'.'.$image->getClientOriginalExtension();
            }


            $profile->firstname =protectData($firstname);
            $profile->lastname =protectData($lastname);
            $profile->middlename =protectData($middlename);
            $profile->phone_number =protectData($phone);
            $profile->gender =protectData($gender);
            $profile->city =protectData($city);
            $profile->hobbies =protectData($hobbies);
            $profile->address_1 =protectData($address1);
            $profile->address_2 =protectData($address2);
            $profile->dob =protectData($dob);
            $profile->marital_status =protectData($maritalStatus);
            $profile->state =protectData($state);
            $profile->localG =protectData($localG);
            $profile->country =protectData($country);
            $profile->postalCode =protectData($postalCode);
            $profile->description =protectData($description);
            $profile->facebook =protectData($facebook);
            $profile->twitter =protectData($twitter);
            $profile->instagram =protectData($instagram);
            $profile->linkedin =protectData($linkedin);
            $profile->save();
            $request->session()->flash('successMessage', ucwords($firstname.' '.$lastname).' profile successfully updated');

          }else{

            $data['firstname'] =protectData($firstname);
            $data['lastname'] =protectData($lastname);
            $data['middlename'] =protectData($middlename);
            $data['phone_number'] =protectData($phone);
            $data['gender'] =protectData($gender);
            $data['city'] =protectData($city);
            $data['hobbies'] =protectData($hobbies);
            $data['address_1'] =protectData($address1);
            $data['address_2'] =protectData($address2);
            $data['dob'] =protectData($dob);
            $data['marital_status'] =protectData($maritalStatus);
            $data['state'] =protectData($state);
            $data['localG'] =protectData($localG);
            $data['country'] =protectData($country);
            $data['postalCode'] =protectData($postalCode);
            $data['description'] =protectData($description);
            $data['facebook'] =protectData($facebook);
            $data['twitter'] =protectData($twitter);
            $data['instagram'] =protectData($instagram);
            $data['linkedin'] =protectData($linkedin);
            $data['user_id'] =Auth::user()->id;
            $profile= Profile::create($data);
            
            if(!isset($image) || $image ==NULL || $image =='' ){
              $image='';
              $data['profile_image']  =$image;
            }else{
                $directory = public_path().'/uploads/'.$profile->id.'/';
                $image->move($directory,$image->getFilename().'.'.$image->getClientOriginalExtension());
                $data['profile_image'] =$image->getFilename().'.'.$image->getClientOriginalExtension();
            }

          }
          $request->session()->flash('successMessage', ucwords($firstname.' '.$lastname).' profile successfully updated');
          return redirect()->route('setup-profile');
        }
      }else{
        $request->session()->flash('errorMessage', 'This email , '.$request->email.' is not available');
        return redirect()->route('setup-profile');
      }

    }else{

      $userId = Auth::user()->id;
      $email = Auth::user()->email;
      $usersCount= User::where("check", "new")->get()->count();
      $date = date('Y');
      if(Profile::where("user_id",$userId)->exists()){
        $profile = Profile::where("user_id",$userId)->first();

      }else{
        $profile= new Profile;
      }
      return view('pages.skydash-admin.profile',['date'=>$date,'profile'=>$profile,'email'=> $email,'userId'=>$userId, 'usersCount'=>$usersCount, 'title'=>'Profile']);
    }

  }

  public function addProperty(Request $request){

    if($_SERVER['REQUEST_METHOD'] =='POST'){
      
      $data = array();
    
      $image = $request->file('propertyImage');
      $address = $request->input('address');
      $amount = $request->input('amount');
      $state = $request->input('state');
      $localGovt = $request->input('localGovt');
      $postalCode = $request->input('postalCode');
      $area = $request->input('area');
      $bed = $request->input('bed');
      $baths = $request->input('baths');
      $garage = $request->input('garage');
      $type = $request->input('type');
      $status = $request->input('status');
      $video = $request->file('propertyVideo');
      $map = $request->input('map');
      $amenities = $request->input('amenities');
      $carousels = $request->file('carousel');
      $description = $request->input('description');
        $rules=array(
          'address' => 'required',
          'amount' => 'required',
          'state' => 'required',
          'localGovt' => 'required',
          'postalCode' => 'required',
          'area' => 'required',
          'bed' => 'required',
          'baths' => 'required',
          'garage' => 'required',
          'amenities' => 'required|array',
          'status' => 'required',
          'type' => 'required',
          'description' => 'required',
          'propertyImage' => 'required'
        );
        $validator= Validator::make($request->all(),$rules);
        if($validator->fails()){
          return redirect()->route('add-property')->withErrors($validator);
        }else{
              $data['address'] = protectData($address);
              $data['amount'] = protectData($amount);
              $data['state'] = protectData($state);
              $data['localG'] = protectData($localGovt);
              $data['postalCode'] = protectData($postalCode);
              $data['area'] = protectData($area);
              $data['bed'] = protectData($bed);
              $data['baths'] = protectData($baths);
              $data['garage'] = protectData($garage);
              $data['type'] = protectData($type);
              $data['description'] = protectData($description);
              $data['status'] = protectData($status);
              $data['map'] = protectData($map);
              $data['image'] = $image->getFilename().'.'.$image->getClientOriginalExtension();
              $data['video'] = $video->getClientOriginalName();
              $data['user_id'] =Auth::user()->id;


              if(isset($amenities) && !empty($amenities)){
                $amenities_result = array();
                foreach($amenities as $amenity){
                  $amenities_result[$amenity] = $amenity;
                }
                $data['amenities'] = json_encode($amenities_result);
              }else{
                $data['amenities'] = '';
              }



              $property= Property::create($data);
              $FileSystem = new Filesystem();
              $directory_images = public_path().'/property_images/'.$property->id.'/';
              $directory_videos = '/property_videos/'.$property->id.'/';
              $directory_carousels = public_path().'/property_carousels/'.$property->id.'/';
              
              if(in_array($image->getClientOriginalExtension(),array('png','jpg','jpeg'))){
                  $image->move($directory_images,$image->getFilename().'.'.$image->getClientOriginalExtension());
                  
              }else{
                  $request->session()->flash('image_error', 'Upload the right image format');
                  return redirect()->route('add-property');
              }


              if(isset($video) && !empty($video)){
                if(in_array($video->getClientOriginalExtension(),array('mp4', 'avi', 'wmv', 'webm', 'flv', 'mkv', 'avchd', 'hevc'))){
                  
                  Storage::disk('public')->put( $directory_videos.$video->getClientOriginalName(), file_get_contents($video));
                }else{
                  $request->session()->flash('video_error', 'upload the right vido format');
                  return redirect()->route('add-property');
                }

              }

              if($property){

                if(isset($carousels) && !empty($carousels)){
 
                  $data_carousel = array();
                  foreach($carousels as $carousel){
                    if(in_array($carousel->getClientOriginalExtension(),array('png','jpg','jpeg'))){
                      $carousel->move($directory_carousels,$carousel->getFilename().'.'.$carousel->getClientOriginalExtension());
                      $data_carousel['carousel'] = $carousel->getFilename().'.'.$carousel->getClientOriginalExtension();
                      $data_carousel['user_id'] =Auth::user()->id;
                      $data_carousel['property_id'] =$property->id;
                    }else{
                        $request->session()->flash('carousel_error', 'Upload the right image format');
                        return redirect()->route('add-property');
                    }
                  }
                  Carousel::create($data_carousel);
                }
                $request->session()->flash('successMessage', ucfirst($type).' type property '. ucwords($address).'  successfully saved');
                return redirect()->route('add-property');
              }else{
                $request->session()->flash('errorMessage', 'Oops something went wrong');
                return redirect()->route('add-property');
              }



          }
     
    }else{

      $userId = Auth::user()->id;
      $email = Auth::user()->email;
      $usersCount= User::where("check", "new")->get()->count();
      $date = date('Y');
      if(Profile::where("user_id",$userId)->exists()){
        $profile = Profile::where("user_id",$userId)->first();

      }else{
        $profile= new Profile;
      }
      return view('pages.skydash-admin.add-property',['date'=>$date,'profile'=> $profile, 'email'=>$email, 'usersCount' =>$usersCount, 'userId'=>$userId, 'title'=>'Add Property']);
    }

  }

  //List all properties
  public function listProperties(){

    $userId = Auth::user()->id;
      $email = Auth::user()->email;
      $usersCount= User::where("check", "new")->get()->count();
      $date = date('Y');
      if(Profile::where("user_id",$userId)->exists()){
        $profile = Profile::where("user_id",$userId)->first();

      }else{
        $profile= new Profile;
      }
    $properties = Property::where(['user_id'=>$userId,'delete_status'=>NULL])->paginate(10);

    return view('pages.skydash-admin.list-properties',['date'=>$date,'profile'=>$profile,'properties'=>$properties,'email'=> $email,'userId'=>$userId, 'usersCount'=>$usersCount, 'title'=>'List Properties']);

  }




  public function editProperty($id){

    $userId = Auth::user()->id;
    $email = Auth::user()->email;
    $usersCount= User::where("check", "new")->get()->count();
    $date = date('Y');
    if(Profile::where("user_id",$userId)->exists()){
      $profile = Profile::where("user_id",$userId)->first();

    }else{
      $profile= new Profile;
    }

    if(Property::where(["id"=>protectData($id)])->exists()){
      $property = Property::where(["id"=>protectData($id)])->first();
    }else{
      $request->session()->flash('message', 'You are not allowed to edit this property');                               
      return redirect()->route('404');    
    } 

    return view('pages.skydash-admin.edit-property',['date'=>$date,'profile'=> $profile, 'email'=>$email, 'usersCount' =>$usersCount, 'userId'=>$userId, 'property'=>$property, 'title'=>'Edit Property']);

  }

    //tracking page to post update property detail
  public function updateProperty(Request $request){
            
    if($request->id == null || $request->id == '' || !is_numeric($request->id)){
      $request->session()->flash('message', 'You are not allowed to update this property');
      return redirect()->route('404'); 
    }
    if( Property::where(['id'=>protectData($request->id)])->exists()){
      $image = $request->file('propertyImage');
      $address = $request->input('address');
      $amount = $request->input('amount');
      $state = $request->input('state');
      $localGovt = $request->input('localGovt');
      $postalCode = $request->input('postalCode');
      $area = $request->input('area');
      $bed = $request->input('bed');
      $baths = $request->input('baths');
      $garage = $request->input('garage');
      $type = $request->input('type');
      $status = $request->input('status');
      $video = $request->file('propertyVideo');
      $map = $request->input('map');
      $amenities = $request->input('amenities');
      $carousels = $request->file('carousel');
      $description = $request->input('description');
        $rules=array(
          'address' => 'required',
          'amount' => 'required',
          'state' => 'required',
          'localGovt' => 'required',
          'postalCode' => 'required',
          'area' => 'required',
          'bed' => 'required',
          'baths' => 'required',
          'garage' => 'required',
          'amenities' => 'required|array',
          'status' => 'required',
          'type' => 'required',
          'description' => 'required',
          'propertyImage' => 'required'
        );
        $validator= Validator::make($request->all(),$rules);
        if($validator->fails()){
           return redirect()->route('edit-property',['id' => $request->id])->withErrors($validator);
        }else{  

        $property = Property::find(protectData($request->id));
                     
        $FileSystem = new Filesystem();
        $directory = public_path().'/property_images/';
        if($image ==NULL || $image =='' ){
          
          if($property->image !=Null || $property->image !='' ){
            
          }else{
            $property->image = $image->getFilename().'.'.$image->getClientOriginalExtension();  
          }
        
        }elseif($image->getFilename().'.'.$image->getClientOriginalExtension() != $property->image){
          if(file_exists($directory.$property->id.'/'.$image->getFilename().'.'.$image->getClientOriginalExtension())){
            unlink($directory.$property->id.'/'.$property->image);                                
            $image->move($directory.$property->id,$image->getFilename().'.'.$image->getClientOriginalExtension());
            $property->image=$image->getFilename().'.'.$image->getClientOriginalExtension();                                          
          }else{

            unlink($directory.$property->id.'/'.$property->image);                                
            $image->move($directory.$property->id,$image->getFilename().'.'.$image->getClientOriginalExtension());
            $property->image=$image->getFilename().'.'.$image->getClientOriginalExtension();   
          }
                              
        }

        if(isset($video) && !empty($video)){
          $directory_videos = '/property_videos/'.$request->id.'/';
          if(in_array($video->getClientOriginalExtension(),array('mp4', 'avi', 'wmv', 'webm', 'flv', 'mkv', 'avchd', 'hevc'))){
            //unlink(public_path('/property_videos/'.$request->id.'/'.$property->video));  
            Storage::disk('public')->put( $directory_videos.$video->getClientOriginalName(), file_get_contents($video));
            $property->video = $video->getFilename().'.'.$video->getClientOriginalExtension(); 
          }else{
            $request->session()->flash('video_error', 'upload the right vido format');
            return back()->with($request->id); 
          }

        }

        if(isset($carousels) && !empty($carousels)){
          $directory_carousels = '/property_carousels/'.$request->id.'/'; 
          $old_carousels = Carousel::where("property_id",$request->id)->get();
          foreach($old_carousels as $carousel){
            unlink(public_path('/property_carousels/'.$carousel->id.'/'.$carousel->carousel));
            Carousel::where("id",$carousel->id)->delete();
          }
          $data_carousel = array();
          foreach($carousels as $carousel){
            $directory_carousels = public_path().'/property_carousels/'.$request->id.'/'; 
            if(in_array($carousel->getClientOriginalExtension(),array('png','jpg','jpeg'))){
              $carousel->move($directory_carousels,$carousel->getFilename().'.'.$carousel->getClientOriginalExtension());
              $data_carousel['carousel'] = $carousel->getFilename().'.'.$carousel->getClientOriginalExtension();
              $data_carousel['user_id'] =Auth::user()->id;
              $data_carousel['property_id'] =$property->id;
              Carousel::create($data_carousel);
            }else{
                $request->session()->flash('carousel_error', 'Upload the right image format');
                return back()->with($request->id); 
            }
          }
          Carousel::create($data_carousel);
        }
      
        if(isset($amenities) && !empty($amenities)){
          $amenities_result = array();
          foreach($amenities as $amenity){
            $amenities_result[$amenity] = $amenity;
          }
          $property->amenities= json_encode($amenities_result);
          
        }else{
          $property->amenities= '';
        }                                                
        $property->address= protectData($address);
        $property->amount= protectData($amount);
        $property->state= protectData($state);            
        $property->localG= protectData($localGovt);
        $property->postalCode= protectData($postalCode);            
        $property->area= protectData($area);
        $property->bed= protectData($bed);
        $property->baths= protectData($baths);
        $property->garage= protectData($garage);
        $property->status= protectData($status);
        $property->type= protectData($type);
        $property->description= protectData($description);
        
        if($property->save()){
          $request->session()->flash('successMessage', 'Property is successfully updated');                                                           
        }else{
          $request->session()->flash('errorMessage', 'Property is not successfully updated');                       
        }
        return back()->with($request->id);  
      }                         
    }else{
      $request->session()->flash('errorMessage', 'You are not allowed to update this property');
      return back()->with($request->id); 
    }
            
  }


  // delete property here
  public function deleteProperty($id){
 
    if($id == null || $id == '' || is_nan($id)){
      return response()->json(['success'=>'fail','message'=>'You are not allowed to delete this property']);                   
    }
    
    if(Property::where("id",protectData($id))->exists()){

      //soft delete
      if(Property::where("id",$id)->update(['delete_status' => 'delete'])){
        return response()->json(['success'=>'success','message'=>'property with an '.$id.' has been deleted successfully']);
      }                 
    }else{
      return response()->json(['success'=>'danger','message'=> 'No current property record']);                                   
    } 

  }

  //logout here
  public  function resetPassword(Request $request){
    
    if($_SERVER['REQUEST_METHOD'] =='POST'){

      $password=protectData($request->input('password'));
      $rules=array(
        'password'=>'required|confirmed',
      );
      $validator= Validator::make($request->all(),$rules);
      if($validator->fails()){
        return redirect()->route('reset-password')->withErrors($validator);
      }else{
        $userId=Auth::user()->id;
        $user=$result= User::where("id", $userId)->first();
        if($user !==null){
          $user->password =Hash::make($password);
          $user->save();
          $request->session()->flash('successMessage', 'Password successfully changed');
          return  redirect()->route('reset-password');
        }else{
          $request->session()->flash('errorMessage', 'Oop something went wrong');
        return  redirect()->route('reset-password');
        }
      }
     }else{
      $userId = Auth::user()->id;
      $email = Auth::user()->email;
      $usersCount= User::where("check", "new")->get()->count();
      $date = date('Y');
      if(Profile::where("user_id",$userId)->exists()){
        $profile = Profile::where("user_id",$userId)->first();

      }else{
        $profile= new Profile;
      }
      return view('pages.skydash-admin.reset-password', ['date'=>$date,'profile'=> $profile, 'email'=>$email, 'usersCount' =>$usersCount, 'userId'=>$userId, 'title'=>'Forgot Password']);
    }

   }

  //forgot password here
  public  function forgotPassword(Request $request){
   if($_SERVER['REQUEST_METHOD'] =='POST'){

      $email=protectData($request->input('email'));
      $rules=array(
        'email'=>'required|email',
      );
      $validator= Validator::make($request->all(),$rules);
      if($validator->fails()){
        return redirect()->route('forgot-password')->withErrors($validator);
      }else{
        $emailCheck=$result=DB::table('users')->where('email',$email)->first();
        if($emailCheck !== null){

          $mail = new PHPMailer(true);

          try {
              //Email settings
              //generate random string
              $checker =randomString(7);
              $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
              $mail->isSMTP();                                            //Send using SMTP
              $mail->SMTPDebug = 0; // debugging: 1 = errors and messages, 2 = messages only
              $mail->SMTPAuth = true; // authentication enabled
              $mail->SMTPSecure = 'ssl';
              $mail->Host = "smtp.gmail.com";                    //Set the SMTP server to send through                                  //Enable SMTP authentication
              $mail->Username = "methyl2007@gmail.com";
              $mail->Password ="oeyfejwegvgphhua";                                //SMTP password
              $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
              $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
              //Recipients
              $mail->setFrom("methyl2007@gmail.com", 'The Register');
              $mail->addAddress($email);     //Add a recipient
              $body = '<html><body><h2 style="color:white;font-size:14px;">Hello, '.$email.'</h2>';
              $body .= '<table rules="all" style="border-color: #666; color:white:background-color:#5be9ff" cellpadding="10">';
              $body .= '<div style="background-color:#5be9ff;padding:30px;color:white"><p>Kindly change your password wih the link below</p><br><p><a href="http://127.0.0.1:8000/change-password/'.$checker.'">change Password</a></p></div>';
              $body .= "</table>";
              $body .= "</body></html>";
              $mail->isHTML(true);
              $mail->Subject = 'Forgot Password';
              $mail->Body  = $body;
              $mail->send();
              $user= User::where("email",$email)->first();
              $user->checker = $checker;
              $user->save();
              $request->session()->flash('successMessage', 'Check your email, if you have account with us');
              return  redirect()->route('forgot-password');
          } catch (Exception $e) {
            $request->session()->flash('errorMessage', $e->getMessage());
            return  redirect()->route('forgot-password');
          }
        }
      }
    }else{

      $userId = Auth::user()->id;
      $email = Auth::user()->email;
      $usersCount= User::where("check", "new")->get()->count();
      $date = date('Y');
      if(Profile::where("user_id",$userId)->exists()){
        $profile = Profile::where("user_id",$userId)->first();

      }else{
        $profile= new Profile;
      }
      return view('pages.skydash-admin.forgot-password',['date'=>$date,'profile'=> $profile, 'email'=>$email, 'usersCount' =>$usersCount, 'userId'=>$userId, 'title'=>'Forgot Password']);
    }
  }

  //change password
  public  function changePassword(Request $request){
    $checker = $request->name;
      $userId = Auth::user()->id;
      $email = Auth::user()->email;
      $usersCount= User::where("check", "new")->get()->count();
      $date = date('Y');
      if(Profile::where("user_id",$userId)->exists()){
        $profile = Profile::where("user_id",$userId)->first();

      }else{
        $profile= new Profile;
      }
    return view('pages.skydash-admin.change-password',['date'=>$date,'profile'=> $profile, 'email'=>$email, 'usersCount' =>$usersCount, 'userId'=>$userId, 'checker'=>$checker,'title'=>'Change Password']);
  }

  public  function password(Request $request){
    $password=protectData($request->input('password'));
    $rules=array(
      'password'=>'required',
    );
    $validator= Validator::make($request->all(),$rules);
    if($validator->fails()){
      return redirect()->route('change-password',['checker'=>$request->checker])->withErrors($validator);
    }else{
      if($request->checker !==''){
        $checker = protectData($request->checker);
        $checkResult=$result=DB::table('users')->where('checker',$checker)->first();
        if($checkResult !==null){

          $user = User::where("checker", $checker)->first();
          $user->password =Hash::make($password);
          $user->checker =NULL;
          $user->save();
          $request->session()->flash('successMessage', 'Password successfully changed');
          return  redirect()->route('change-password',['checker'=>$checker]);
        }else{
          $request->session()->flash('errorMessage', 'Oop link has expired');
        return  redirect()->route('change-password',['checker'=>$checker]);
        }
      }else{
        $request->session()->flash('errorMessage', ' Oops not allowed' );
      return  redirect()->route('change-password',['checker'=>$checker]);
      }
    }
  }


  function settings(){
    $userId = Auth::user()->id;
      $email = Auth::user()->email;
      $usersCount= User::where("check", "new")->get()->count();
      $date = date('Y');
      if(Profile::where("user_id",$userId)->exists()){
        $profile = Profile::where("user_id",$userId)->first();

      }else{
        $profile= new Profile;
      }
    $users = User::get(['id','email'])->skip(1);
    $registeredUsers = User::get()->skip(1);
    return view('pages.skydash-admin.settings',['date'=>$date,'registeredUsers' => $registeredUsers, 'profile'=> $profile, 'email'=>$email, 'usersCount' =>$usersCount, 'userId'=>$userId, 'title'=>'Settings', 'users'=>$users]);

  }


  function grant_access(Request $request){


      $user_id = protectData($request->input('user'));
      $access_type = protectData($request->input('access_type'));
      if(empty($user_id)){
        return response()->json(['user' => 'failure', 'error_message'=>'User is required']); 
      }elseif(empty($access_type) ){
        return response()->json(['access_type' => 'failure', 'error_message'=>'User access type is required']); 
      }

      $user = User::where('id', $user_id)->first();

      if($user === null){
        return response()->json(['status' => 'error_message', 'message'=>'Oops something went wrong']); 
      }else{
        $date_time = date('Y-m-d h:i:s');
        if($user->check != $access_type){
          User::where("id",$user_id)->update(["check" => $access_type, "email_verified_at"=>$date_time]);
          return response()->json(['status' => 'success', 'message'=>'User with email '.$user->email.' has been '.$access_type]);          
        }else{
          User::where("id",$user_id)->update(["check" => $access_type, "email_verified_at"=>$date_time]);
          return response()->json(['status' => 'success', 'message'=>'User with email '.$user->email.' has been '.$access_type]);			
        }
      }  
    
  }

}
