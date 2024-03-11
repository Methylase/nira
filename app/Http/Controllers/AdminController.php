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
use App\User;
use App\Role;
use App\Profile;
use Validator;

class AdminController extends Controller
{
    public function __construct(){
      $user = User::where('email','methyl2007@gmail.com')->first();
      if($user === null){
        $user = User::create(['email'=> 'methyl2007@gmail.com','name'=> 'methyl2007', 'password'=>Hash::make('smoothless')]);
        $role_name ='ROLE_SUPERADMIN';
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

        if(Auth::attempt($data,$remember)){
          return redirect()->route('dashboard');
        }else{
          return  back()->with('errorMessage', 'Your login detail is wrong');
        }

      }

    }

    //admin signup
    public function signup(){

      return view('pages.skydash-admin.signup');

    }

    //admin signup post
    public function signupPost(Request $request){

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

      $role_name ='ROLE_ADMIN';
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
        $user->condition=protectData($condition);
        $user->check=protectData('new');
        if($user->save()){
          $role = Role::where('name',$role_name)->first();
          $role_id = $role->id;
          $user->roles()->attach($role_id);
            $request->session()->flash('successMessage', 'You have successfully registered '.$email.' as an admin');
            return  redirect()->route('signup');

        };
      }
    }

    //logout here
    public  function logout(){
      Auth::logout();
      Session::flush();
      return redirect()->route('login');;
    }

      // get setup profile
      public function setupProfile(Request $request){
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
              'address2'=>'required',
              'dob'=>'required',
              'maritalStatus'=>'required',
              'state'=>'required',
              'localG'=>'required',
              'country'=>'required',
              'postalCode'=>'required',
              );
            $validator= Validator::make($request->all(),$rules);
            if($validator->fails()){
              return redirect()->route('setup-profile')->withErrors($validator);
            }else{
              if(!empty($request->input('id'))){
                $profile = Profile::find(protectData($request->input('id')));
                $FileSystem = new Filesystem();
                $directory = public_path().'/uploads/';
                if(!isset($image) || $image ==NULL || $image =='' ){
                  if($profile->profile_image !=='' && file_exists($directory.$profile->profile_image)){
                    unlink(public_path('uploads/'.$profile->profile_image));
                  }
                  $image='';
                  $profile->profile_image=$image;
                }else if($image->getFilename().'.'.$image->getClientOriginalExtension() != $profile->profile_image){
                  if($profile->profile_image !==''){
                    if(file_exists(public_path('uploads/'.$profile->profile_image))){
                      unlink(public_path('uploads/'.$profile->profile_image));
                    }
                  }
                  $image->move($directory,$image->getFilename().'.'.$image->getClientOriginalExtension());
                  $profile->profile_image=$image->getFilename().'.'.$image->getClientOriginalExtension();
                }else{
                  if(file_exists($directory.$profile->profile_image)){
                    unlink(public_path('uploads/'.$profile->profile_image));
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
                $profile->save();
                $request->session()->flash('successMessage', ucwords($firstname.' '.$lastname).' profile successfully updated');

              }else{
                if(!isset($image) || $image ==NULL || $image =='' ){
                  $image='';
                  $data['profile_image']  =$image;
                  }else{
                    $directory = public_path().'/uploads/';
                    $image->move($directory,$image->getFilename().'.'.$image->getClientOriginalExtension());

                    $data['profile_image'] =$image->getFilename().'.'.$image->getClientOriginalExtension();
                  }

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
                    $data['user_id'] =Auth::user()->id;
                    $profile= Profile::create($data);
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

          $date = date('Y');
          if(Profile::where("user_id",$userId)->exists()){
            $profile = Profile::where("user_id",$userId)->first();
          }else{
            $profile= new Profile;
          }

          return view('pages.skydash-admin.profile',['date'=>$date,'profile'=> $profile, 'email'=>$email,  'userId'=>$userId, 'title'=>'Profile']);
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

        $date = date('Y');
        if(Profile::where("user_id",$userId)->exists()){
          $profile = Profile::where("user_id",$userId)->first();
        }else{
          $profile= new Profile;
        }
      return view('pages.skydash-admin.reset-password', ['date'=>$date,'profile'=> $profile, 'email'=>$email,  'userId'=>$userId, 'title'=>'Forgot Password']);
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
              //$mail->addEmbeddedImage(public_path().'/my-register/img/school.jpeg','cover');
              $body = '<html><body><h2 style="color:white;font-size:14px;">Hello, '.$email.'</h2>';
              $body .= '<table rules="all" style="border-color: #666; color:white:background-color:#5be9ff" cellpadding="10">';
              $body .= '<div style="background-color:#5be9ff;padding:30px;color:white"><p>Kindly change your password wih the link below</p><br><p><a href="http://127.0.0.1:8000/admin/change-password/'.$checker.'">change Password</a></p></div>';
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
      return view('pages.skydash-admin.forgot-password',['title'=>'Forgot Password']);
    }
  }

  //change password
  public  function changePassword(Request $request){
    $checker = $request->name;

    return view('pages.skydash-admin.change-password',['checker'=>$checker,'title'=>'Change Password']);
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


}
