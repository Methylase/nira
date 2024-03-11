@extends('layouts.container')
  @section('content')
    <div class="brand-logo">
      <h2 class="text-left text-success">Nira Properties</h2>
    </div>
    <h4>Great! let's get started</h4>
    <h6 class="font-weight-light">Reset Password.</h6>
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
    <form method="POST" action="{{route('password')}}" class="pt-3">
    {{csrf_field()}}
        <div class="form-group class-subject-group">
            <label for="password" class="control-label text-info"> Password</label>
            <input type="hidden" name="checker" value="{{$checker}}">
            <input type="password" name="password" class="form-control form-control-user" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Enter New Password...">
            <span class="text-danger">
                @if($errors->has('password'))
                    {{ $password=$errors->first('password')}}
                @else
                    {{$password=''}}
                @endif
            </span>
        </div>
        <div class="mt-3">
            <input  type="submit" class="btn btn-block btn-success btn-lg font-weight-medium auth-form-btn" value="SUBMIT">
        </div>
        <div class="my-2 mx-4 d-flex justify-content-between align-items-center mt-3">
            <a href="{{route('login')}}" class="auth-link text-black">Login</a>
            <a href="{{route('signup')}}" class="auth-link text-success">Create Account</a>
        </div>

    </form>
@endsection
