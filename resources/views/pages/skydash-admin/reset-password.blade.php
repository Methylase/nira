@extends('layouts.admin')
  @section('content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-12 grid-margin">
            <div class="card">
                <div class="card-body">
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
                    <h4 class="card-title">Reset Password</h4>
                    <form class="form" action="{{route('reset-password')}}" method="POST">
                        {{csrf_field()}}
                        <div class="row">
                            <div class="col-md-6 col-sm-6">
                            <div class="form-group class-subject-group">
                                <label for="password" class="control-label"> Password</label>
                                <input type="password"  name="password" class="form-control" placeholder="Enter password">
                                <span class="text-danger">
                                    @if($errors->has('password'))
                                        {{ $password=$errors->first('password')}}
                                    @else
                                        {{$password=''}}
                                    @endif
                                </span>
                            </div>
                            </div>
                            <div class="col-md-6 col-sm-6">
                            <div class="form-group date-group">
                                <label for="confirm-password" class="control-label"> Confirm Password</label>
                                <input type="password"  name="password_confirmation" class="form-control" Placeholder="Enter confirm password">
                            </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 offset-sm-6 col-sm-6">
                            <div class="form-group">
                                <button type="submit"  class="btn btn-success form-control" > Reset </button>
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
