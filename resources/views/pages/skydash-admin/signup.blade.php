@extends('layouts.container')
  @section('content')
   <div class="brand-logo">
      <h2 class="text-left text-success">Nira Properties</h2>
    </div>
    <h4>New here?</h4>
    <h6 class="font-weight-light">Signing up is easy. It only takes a few steps</h6>
    @if(session()->has('successMessage'))
        <div class="offset-md-1 col-md-10 offset-sm-1 col-sm-10 alert
        alert-success alert-dismissable text-center" style="margin-top:20px">
            <a href='' class='close' data-dismiss='alert' aria-label='close'> &times</a>
            <strong>
            Success
            </strong>
            {{session('successMessage')}}
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

    @if(session()->has('agreement'))
      <div class="offset-md-1 col-md-10 offset-sm-1 col-sm-10 alert
      alert-danger alert-dismissable text-center" style="margin-top:20px">
        <a href='' class='close' data-dismiss='alert' aria-label='close'> &times</a>
        <strong>
            Danger
        </strong>
        {{session('agreement')}}
      </div>
    @endif

    <form method="POST" action="{{route('signup')}}" class="pt-3">
        {{csrf_field()}}
        <div class="form-group">
            <input type="text" name="username" class="form-control form-control-lg" id="exampleInputUsername1" placeholder="Username">
            <span class="text-danger">
                @if($errors->has('username'))
                    {{ $username= $errors->first('username')}}
                @else
                    {{$username=''}}
                @endif
            </span>
        </div>
        <div class="form-group">
            <input type="email" name="email" class="form-control form-control-lg" id="exampleInputEmail1" placeholder="Email">
            <span class="text-danger">
                @if($errors->has('email'))
                    {{ $email= $errors->first('email')}}
                @else
                    {{$email=''}}
                @endif
            </span>
        </div>
        <div class="form-group">
            <input type="password" name="password" class="form-control form-control-lg" id="exampleInputPassword1" placeholder="Password">
            <span class="text-danger">
                @if($errors->has('password'))
                    {{ $password= $errors->first('password')}}
                @else
                    {{$password=''}}
                @endif
            </span>
        </div>
        <div class="mb-4">
            <div class="form-check form-check-success">

                <label class="form-check-label text-muted">
                    <input type="checkbox" name="condition" class="form-check-input">
                    I agree to all Terms & Conditions
                </label>
                <span class="text-danger">
                    @if($errors->has('condition'))
                        {{ $condition= $errors->first('condition')}}
                    @else
                        {{$condition=''}}
                    @endif
                </span>
            </div>
        </div>
        <div class="mt-3">
            <input  type="submit" class="btn btn-block btn-success btn-lg font-weight-medium auth-form-btn" value="SIGN UP">
        </div>
        <div class="text-center mt-4 font-weight-light">
            Already have an account? <a href="{{route('login')}}" class="text-success">Login</a>
        </div>
    </form>
@endsection
