@extends('layouts.admin')
  @section('content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-12 grid-margin">
            <div class="card">
                <div class="card-body">
                    @if(session()->has('messageSuccess'))
                        <div class="offset-md-1 col-md-10 offset-sm-1 col-sm-10 alert
                        alert-success alert-dismissable text-center" style="margin-top:20px">
                            <a href='' class='close' data-dismiss='alert' aria-label='close'> &times</a>
                            <strong>
                            Success
                            </strong>
                            {{session('messageSuccess')}}
                        </div>
                    @endif
                    @if(session()->has('errorMessage'))
                        <div class="offset-md-1 col-md-10 offset-sm-1 col-sm-10 alert
                        alert-danger alert-dismissable text-center" style="margin-top:20px">
                        <a href='' class='close' data-dismiss='alert' aria-label='close'> &times</a>
                        <strong>
                            Danger
                        </strong>
                        {{session('errorMessage')}}
                        </div>
                    @endif
                <h4 class="card-title">Update Profile</h4>
                @if(!isset($profile->id))
                    <form class="form-sample" action="/setup-profile" enctype="multipart/form-data" method="POST">
                @else
                    <form class="form" action="/setup-profile" enctype="multipart/form-data" method="POST">
                    <input type="hidden" name="id" value="{{old('id', $profile->id)}}">
                @endif

                {{csrf_field()}}
                    <p class="card-description">
                    Personal info
                    </p>
                    <hr>
                    <div class="row">
                        <div class="col-md-6 col-sm-6">
                            
                            <img src="{{isset($profile->profile_image) && $profile->profile_image !=='' ? url('uploads/'.$profile->id.'/'.$profile->profile_image) : asset('images/user.jpg') }}" class="profile-img"  alt="profile image"/>
                        
                            <div class="form-group">
                            <label for="profile-image" class="control-label"> Upload image</label>
                                <input type="file" id="propertyImage" name="profileImage" class="form-control">
                                <span class="text-danger">
                                    @if($errors->has('profileImage'))
                                        {{ $profileImage= $errors->first('profileImage')}}
                                    @else
                                        {{$profileImage=''}}
                                    @endif
                                </span>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <br>
                    <div class="row">
                        <div class="col-md-6">
                                <div class="form-group row">
                                <label class="col-sm-3 col-form-label">First Name</label>
                                <div class="col-sm-9">
                                    <input type="text" name="firstname" value="{{$profile->firstname !== null ? $profile->firstname :old('firstname', $profile->firstname) }}" class="form-control"  placeholder="Enter your firstname"/>

                                    <span class="text-danger">
                                        @if($errors->has('firstname'))
                                            {{ $firstname= $errors->first('firstname')}}
                                        @else
                                            {{$firstname=''}}
                                        @endif
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Last Name</label>
                            <div class="col-sm-9">
                                <input type="text" value="{{$profile->lastname !== null ? $profile->lastname :old('lastname', $profile->lastname) }}" name="lastname" class="form-control" placeholder="Enter your lastname" />
                                <span class="text-danger">
                                    @if($errors->has('lastname'))
                                        {{ $lastname= $errors->first('lastname')}}
                                    @else
                                        {{$lastname=''}}
                                    @endif
                                </span>
                            </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Middle Name</label>
                            <div class="col-sm-9">
                                <input type="text"value="{{$profile->middlename !== null ? $profile->middlename :old('middlename', $profile->middlename) }}"  name="middlename" class="form-control"  placeholder="Enter your middlename"/>
                                <span class="text-danger">
                                    @if($errors->has('middlename'))
                                        {{ $middlename= $errors->first('middlename')}}
                                    @else
                                        {{$middlename=''}}
                                    @endif
                                </span>
                            </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Email</label>
                            <div class="col-sm-9">
                                <input type="email" value="{{$email !== null ? $email :old('email', $email) }}" name="email" class="form-control" readonly />
                                <span class="text-danger">
                                    @if($errors->has('email'))
                                    {{ $email=$errors->first('email')}}
                                    @else
                                    {{$email=''}}
                                    @endif
                                </span>
                            </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Gender</label>
                            <div class="col-sm-9">
                                <select class="form-control" name="gender">
                                @if($profile->gender ==="none" || $profile->gender ===NULL)
                                    <option value="none">Select-Gender</option>
                                    <option value="male">Male</option>
                                    <option value="female">female</option>
                                @elseif($profile->gender ==="male")
                                    <option value="{{$profile->gender==='male'? $profile->gender :old('gender', $profile->gender) }}" selected>{{ucfirst($profile->gender)}}</option>
                                    <option value="female">Female</option>

                                @elseif($profile->gender ==="female")
                                    <option value="male">Male</option>
                                    <option value="{{$profile->gender==='female'? $profile->gender :old('gender', $profile->gender) }}" selected>{{ucfirst($profile->gender)}}</option>
                                @endif

                                </select>
                                <span class="text-danger">
                                    @if($errors->has('gender'))
                                    {{ $gender=$errors->first('gender')}}
                                    @else
                                    {{$gender=''}}
                                    @endif
                                </span>
                            </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Date of Birth</label>
                            <div class="col-sm-9">
                                <input type="date" value="{{$profile->dob !== null ? $profile->dob :old('dob',date('m/d/y',strtotime($profile->dob))) }}" name="dob" class="form-control" placeholder="dd/mm/yyyy"/>
                                <span class="text-danger">
                                    @if($errors->has('dob'))
                                    {{ $dob=$errors->first('dob')}}
                                    @else
                                    {{$dob=''}}
                                    @endif
                                </span>
                            </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Phone Number</label>
                            <div class="col-sm-9">
                                <input type="text" name="phone"  value="{{$profile->phone_number !== null ? $profile->phone_number :old('phone',$profile->phone_number) }}" class="form-control" placeholder="Enter phone number" />
                                <span class="text-danger">
                                    @if($errors->has('phone'))
                                    {{ $phone=$errors->first('phone')}}
                                    @else
                                    {{$phone=''}}
                                    @endif
                                </span>
                            </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Marital Status</label>
                                @if(!isset($profile->marital_status))
                                <div class="col-sm-4">
                                    <div class="form-check form-check-success">
                                    <label class="form-check-label">
                                        <input type="radio" name="maritalStatus" class="form-check-input" id="membershipRadios1" value="single">
                                        Single
                                    </label>
                                    </div>
                                </div>
                                <div class="col-sm-5">
                                    <div class="form-check form-check-success">
                                    <label class="form-check-label">
                                        <input type="radio" name="maritalStatus" class="form-check-input"  id="membershipRadios2" value="married">
                                        Married
                                    </label>
                                    </div>
                                    <span class="text-danger">
                                        @if($errors->has('maritalStatus'))
                                        {{ $maritalStatus=$errors->first('maritalStatus')}}
                                        @else
                                        {{$maritalStatus=''}}
                                        @endif
                                    </span>
                                </div>
                                @elseif($profile->marital_status ==="single")
                                <div class="col-sm-4">
                                    <div class="form-check form-check-success">
                                    <label class="form-check-label">
                                        <input type="radio" name="maritalStatus" class="form-check-input" id="membershipRadios1" value="{{old('maritalStatus',$profile->marital_status)}}" checked>
                                        Single
                                    </label>
                                    </div>
                                </div>
                                <div class="col-sm-5">
                                    <div class="form-check form-check-success">
                                    <label class="form-check-label">
                                        <input type="radio" name="maritalStatus" class="form-check-input"  id="membershipRadios2" value="married">
                                        Married
                                    </label>
                                    </div>
                                    <span class="text-danger">
                                        @if($errors->has('maritalStatus'))
                                        {{ $maritalStatus=$errors->first('maritalStatus')}}
                                        @else
                                        {{$maritalStatus=''}}
                                        @endif
                                    </span>
                                </div>
                                @elseif($profile->marital_status ==="married")
                                <div class="col-sm-4">
                                    <div class="form-check form-check-success">
                                    <label class="form-check-label">
                                        <input type="radio" name="maritalStatus" class="form-check-input" id="membershipRadios1" value="{{old('maritalStatus',$profile->marital_status)}}" checked>
                                        Married
                                    </label>
                                    </div>
                                </div>
                                <div class="col-sm-5">
                                    <div class="form-check form-check-success">
                                    <label class="form-check-label">
                                        <input type="radio" name="maritalStatus" class="form-check-input"  id="membershipRadios2" value="single">
                                        Single
                                    </label>
                                    </div>
                                    <span class="text-danger">
                                        @if($errors->has('maritalStatus'))
                                        {{ $maritalStatus=$errors->first('maritalStatus')}}
                                        @else
                                        {{$maritalStatus=''}}
                                        @endif
                                    </span>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <p class="card-description">
                    Address
                    </p>
                    <hr>
                    <br>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Address 1</label>
                            <div class="col-sm-9">
                                <input type="text" name="address1" value="{{$profile->address_1 !== null ? $profile->address_1 :old('address1',$profile->address_1)}}" class="form-control" placeholder="Enter Address">
                                <span class="text-danger">
                                    @if($errors->has('address1'))
                                    {{ $address1='The address field is required.'}}
                                    @else
                                    {{$address1=''}}
                                    @endif
                                </span>
                            </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">State</label>
                                <div class="col-sm-9">
                                    @if(isset($profile->state))
                                    <select class="form-control" id="state" name="state">
                                        <option value="{{old('state', $profile->state)}}" selected>{{ucfirst($profile->state)}}</option>
                                    </select>
                                    @else
                                    <select class="form-control" id="state" name="state">
                                        <option value="">Select State</option>
                                    </select>
                                    @endif
                                    <span class="text-danger">
                                    @if($errors->has('state'))
                                        {{ $state=$errors->first('state')}}
                                    @else
                                        {{$state=''}}
                                    @endif
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Hobbies</label>
                            <div class="col-sm-9">
                                <input type="text" name="hobbies"  value="{{$profile->hobbies !== null ? $profile->hobbies :old('hobbies',$profile->hobbies) }}" class="form-control" placeholder="Enter hobbies"/>
                                <span class="text-danger">
                                    @if($errors->has('hobbies'))
                                    {{ $hobbies=$errors->first('hobbies')}}
                                    @else
                                    {{$hobbies=''}}
                                    @endif
                                </span>
                            </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Local Govt</label>
                                <div class="col-sm-9">
                                    @if(isset($profile->localG))
                                    <select class="form-control" id="localG" name="localG">
                                        <option value="{{old('localG', $profile->localG)}}" selected>{{ucfirst($profile->localG)}}</option>
                                    </select>
                                    @else
                                    <select class="form-control" id="localG" name="localG">
                                        <option value="">Select Local Govt</option>
                                    </select>
                                    @endif
                                    <span class="text-danger">
                                        @if($errors->has('localG'))
                                        {{ $localG=$errors->first('localG')}}
                                        @else
                                        {{$localG=''}}
                                        @endif
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Address 2</label>
                            <div class="col-sm-9">
                                <input type="text" name="address2" value="{{$profile->address_2 !== null ? $profile->address_2 :old('address2',$profile->address_2)}}" class="form-control" placeholder="Enter address"/>
                                <span class="text-danger">
                                    @if($errors->has('address2'))
                                        {{ $localG='The address field is required.'}}
                                    @else
                                    {{$address2=''}}
                                    @endif
                                </span>
                            </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Country</label>
                            <div class="col-sm-9">
                            <input type="text" name="country" value="{{$profile->country !== null ? $profile->country :old('country',$profile->country)}}" class="form-control" placeholder="Enter country"/>
                                <span class="text-danger">
                                    @if($errors->has('country'))
                                    {{ $localG=$errors->first('country')}}
                                    @else
                                        {{$country=''}}
                                    @endif
                                </span>
                            </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                            <label class="col-sm-3 col-form-label">City</label>
                            <div class="col-sm-9">
                                <input type="text" name="city" value="{{$profile->city !== null ? $profile->city :old('city',$profile->city)}}" class="form-control" />
                                <span class="text-danger">
                                    @if($errors->has('city'))
                                        {{ $city=$errors->first('city')}}
                                    @else
                                        {{$city=''}}
                                    @endif
                                </span>
                            </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Postal Code</label>
                            <div class="col-sm-9">
                                <input type="text" name="postalCode" value="{{$profile->postalCode !== null ? $profile->postalCode :old('postalCode',$profile->postalCode)}}"  class="form-control" placeholder="Enter postal code"/>
                                <span class="text-danger">
                                    @if($errors->has('postalCode'))
                                        {{ $postalCode=$errors->first('postalCode')}}
                                    @else
                                        {{$postalCode=''}}
                                    @endif
                                </span>
                            </div>
                            </div>
                        </div>
                    </div>
                    <p class="card-description">Brief description about yourself</p>
                    <hr>
                    <div class="row">
                        <div class="col-md-10">
                            <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Description</label>
                            <div class="col-sm-9">
                                <textarea name="description" class="form-control" placeholder="Enter short decrption about yourself" rows=5>{{$profile->description !== null ? $profile->description :old('description',$profile->description)}}</textarea>
                                <span class="text-danger">
                                    @if($errors->has('description'))
                                        {{ $description=$errors->first('description')}}
                                    @else
                                        {{$description=''}}
                                    @endif
                                </span>
                            </div>
                            </div>
                        </div>
                    </div>                    
                    <p class="card-description">Social Media Section</p>
                    <hr>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Facebook</label>
                                <div class="col-sm-9">
                                    <input type="text" name="facebook" value="{{$profile->facebook !== null ? $profile->facebook :old('facebook',$profile->facebook)}}"  class="form-control" placeholder="Enter facebook link handle" />
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">X(Twitter)</label>
                                <div class="col-sm-9">
                                    <input type="text" name="twitter" value="{{$profile->twitter !== null ? $profile->twitter :old('twitter',$profile->twitter)}}"  class="form-control" placeholder="Enter twitter link handle"/>
                                </div>
                            </div>
                        </div>
                    </div> 
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Instagram</label>
                                <div class="col-sm-9">
                                    <input type="text" name="instagram" value="{{$profile->instagram !== null ? $profile->instagram :old('instagram',$profile->instagram)}}"  class="form-control" placeholder="Enter instagram link handle"/>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Linkedin</label>
                                <div class="col-sm-9">
                                    <input type="text" name="linkedin" value="{{$profile->linkedin !== null ? $profile->linkedin :old('linkedin',$profile->linkedin)}}"  class="form-control" placeholder="Enter linkedin link handle"/>
                                </div>
                            </div>
                        </div>
                    </div>                                       
                    <div class="row">
                      <div class="col-md-6 offset-sm-6 col-sm-6">
                        <div class="form-group d-flex justify-content-end">
                           <button type="submit"  id="update"  class="btn btn-success" ><i class="fa fa-save"></i> Update </button>
                        </div>
                      </div>
                    </div>
                </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- content-wrapper ends -->
@endsection
