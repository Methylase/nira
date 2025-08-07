@extends('layouts.admin')
  @section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-12 grid-margin">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title"> Grant Privilege</h4>
                        <hr>
                        <div class="card-body">
                            <div class="message_success text-success"></div>
                            <strong>Grant user access type to the application</strong>
                            <div class="row">
                                <div class="col-md-4 col-sm-6 col-xs-12">
                                    <div class="form-group">
                                        <label>Select User</label>
                                        <select name="user" id="user" class="form-control">
                                            <option value="">Select-User</option>
                                            @foreach($users as $user)
                                                <option value="{{$user->id}}">{{ucwords($user->email)}}</option>
                                            @endforeach
                                        </select>
                                        <span class="user-group text-danger"></span>
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-6 col-xs-12">
                                    <div class="form-group">
                                        <label>Select Access Type</label>
                                        <select name="access_type" id="access-type" class="form-control">
                                            <option value="">Select-Access-Type</option>
                                            <option value="locked">Lock Out</option>
                                            <option value="approved">Approved</option>
                                        </select>
                                        <span class="user-type-group text-danger"></span>
                                    </div>
                                </div>                      
                            </div>
                            <div class="row">
                                <div class="col-md-4 col-sm-6 col-xs-12">
                                    <div class="form-group">
                                        <button type="button" class="btn btn-success form-control grant-access"> Grant Access</button>     
                                    </div>
                                </div> 
                            </div>                                                     
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 grid-margin">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12 grid-margin stretch-card">
                                <div class="card">
                                    <div class="card-body">
                                        <p class="card-title">Registered Users</p>
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="table-responsive">
                                                    <table id="list-properties" class="display expandable-table text-center" style="width:100%">
                                                        <thead>
                                                            <tr>
                                                                <th>S/N</th>
                                                                <th>Username</th>
                                                                <th>Email</th>
                                                                <th>Status</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            {{$i= 1}}
                                                            @foreach ($registeredUsers as $registeredUser )
                                                            <tr>
                                                                <td class="pl-0 pb-0">{{$i}}</td>
                                                                <td class="pl-0 pb-0">{{$registeredUser->name}}</td>
                                                                <td class="pl-0 pb-0">{{$registeredUser->email}}</td>
                                                                <td> 
                                                                    @if(isset($registeredUser->check) && $registeredUser->check =='approved')
                                                                        <span class="badge badge-warning py-2">{{ucfirst($registeredUser->check)}}</span> 
                                                                    @elseif(isset($registeredUser->check) && $registeredUser->check =='locked')
                                                                    <span class="badge badge-danger py-2">{{ucfirst($registeredUser->check)}}</span>
                                                                                                                                     
                                                                    @else
                                                                        <span class="badge badge-danger py-2">waiting</span>
                                                                    @endif
                                                                </td>
                                                            </tr>
                                                            {{$i++}}
                                                            @endforeach
                                                        </tbody>                 
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>        
    </div>
    <!-- content-wrapper ends -->
@endsection
