@extends('layouts.admin')
  @section('content')   
    <div class="content-wrapper">
        <div class="row">
        <div class="col-md-12 grid-margin">
            <div class="row">
            <div class="col-12 col-xl-8 mb-4 mb-xl-0">

                @can('is_admin')

                    <h3 class="font-weight-bold">Welcome {{isset($profile) && $profile->id !=='' ? ucwords($profile->firstname.' '.$profile->lastname) : $email }}</h3>
                    @if($usersCount!==0)
                    <h6 class="font-weight-normal mb-0">All systems are running smoothly! You have <span class="text-success">{{$usersCount}} unread alerts!</span></h6>
                    @else
                    <h6 class="font-weight-normal mb-0">All systems are running smoothly! You have <span class="text-success">No unread Alert!</span></h6>
                    @endif
                @endcan

                @can('is_agent')
                <h3 class="font-weight-bold">Welcome {{isset($profile) && $profile->id !=='' ? ucwords($profile->firstname.' '.$profile->lastname) : $email }}</h3>
                @endcan   

            </div>
            <div class="col-12 col-xl-4">
                <div class="justify-content-end d-flex">
                <div class="dropdown flex-md-grow-1 flex-xl-grow-0">
                    <button class="btn btn-sm btn-light bg-white">
                        Today {{date('j M Y')}}
                    </button>
                </div>
                </div>
            </div>
            </div>
        </div>
        </div>
        <div class="row">
        <div class="col-md-12 grid-margin transparent">
            <div class="row">
                <div class="col-md-4 mb-4 stretch-card transparent">
                    <div class="card card-tale">
                    <div class="card-body">
                        <p class="mb-4">Total Number Of Users</p>
                        <p class="fs-30 mb-2">{{$usersRegCount}}</p>
                    </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4 stretch-card transparent">
                    <div class="card card-dark-blue">
                    <div class="card-body">
                        <p class="mb-4">Total Of Properties For Rent</p>
                        <p class="fs-30 mb-2">{{$rentCount}}</p>
                    </div>
                    </div>
                </div>

                <div class="col-md-4 mb-4 stretch-card transparent">
                    <div class="card card-light-danger">
                    <div class="card-body">
                        <p class="mb-4">Total Of Properties For sale</p>
                        <p class="fs-30 mb-2">{{$salesCount}}</p>
                    </div>
                    </div>
                </div>

                
                
            </div>

        </div>
        </div>

        @if(Auth::user()->hasRole('ROLE_ADMIN'))
            <div class="row">
                <div class="col-md-8 stretch-card grid-margin">
                    <div class="card">
                    <div class="card-body">
                        <p class="card-title mb-0">Projects</p>
                        <div class="table-responsive">
                        <table class="table table-borderless">
                            <thead>
                            <tr>
                                <th>S/N</th>
                                <th class="pl-0  pb-2 border-bottom">Name</th>
                                <th class="border-bottom pb-2">Email</th>
                                <th class="border-bottom pb-2">Staus</th>
                            </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1 ?>
                                @foreach ($agents as $agent )
                                <tr>
                                    <td class="pl-0 pb-0">{{$i}}</td>
                                    <td class="pl-0">{{((isset($agent->profile) && $agent->profile->firstname !='' && $agent->profile->lastname !='') ? $agent->profile->firstname.' '.$agent->profile->lastname : $agent->name)}}</td>
                                    <td><p class="mb-0">{{$agent->email}}</td>
                                    <td class="text-muted">
                                        @if(isset($agent->check) && $agent->check =='approved')
                                            <span  class="bg-warning rounded p-2">{{ucfirst($agent->check)}}</a> 
                                        @elseif(isset($agent->check) && $agent->check =='new')
                                            <span class="bg-danger rounded p-2">{{ucfirst('pending')}}</a>
                                        @endif
                                    </td>
                                </tr>
                                <? $i++ ?>
                                @endforeach
                            </tbody>
                        </table>
                        </div>
                    </div>
                    </div>
                </div>
                <div class="col-md-4 stretch-card grid-margin">
                    <div class="card">
                    <div class="card-body">
                        <p class="card-title">Notifications</p>
                        <ul class="icon-data-list">
                            @if($newUsers->isNotEmpty())
                                @foreach ($newUsers as $user)
                                <li>
                                    <div class="d-flex">
                                    <img src="{{asset('skydash-admin/template/images/faces/face1.jpg')}}" alt="user">
                                    <div>
                                        <p class="text-info mb-1">{{((isset($user->profile) && $user->profile->firstname !='' && $user->profile->lastname !='') ? $user->profile->firstname.' '.$user->profile->lastname : $user->name)}}</p>
                                        <p class="mb-0">{{ucfirst($user->check)}}</p>
                                        <small>{{date('H:M a', strtotime($user->created_at))}}</small>
                                    </div>
                                    </div>
                                </li>
                                @endforeach
                            @else
                                <li>
                                    <div class="d-flex">
                                        No available notification
                                    </div>
                                </li>
                            @endif
                        </ul>
                    </div>
                    </div>
                </div>
            </div>
        @endif

        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body" id="property-body">
                        <p class="card-title">Properties List</p>
                        <div class="row">
                            <div class="col-12">
                                <div class="table-responsive">
                                    <table id="list-properties" class="display expandable-table text-center" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>S/N</th>
                                                <th>Type</th>
                                                <th>Area Covered</th>
                                                <th>Number Of Bed</th>
                                                <th>Number Of Baths</th>
                                                <th>Number Of Gaurage</th>
                                                <th>Amount</th>
                                                <th>Postal Code</th>
                                                <th>Address</th>
                                                <th>State</th>
                                                <th>Local Govt</th>
                                                <th>Status</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $i = 1 ?>
                                            @foreach ($properties as $property )
                                            <tr>
    
                                                <td class="pl-0 pb-0">{{$i}}</td>
                                                <td class="pl-0 pb-0">{{$property->type}}</td>
                                                <td class="pl-0 pb-0">{{$property->area}}</td>
                                                <td class="pl-0 pb-0">{{$property->bed}}</td>
                                                <td class="pl-0 pb-0">{{$property->baths}}</td>
                                                <td class="pl-0 pb-0">{{$property->garage}}</td>
                                                <td class="pl-0 pb-0">{{$property->amount}}</td>
                                                <td class="pl-0 pb-0">{{$property->postalCode}}</td>
                                                <td class="pl-0 pb-0">{{$property->address}}</td>
                                                <td class="pl-0 pb-0">{{$property->state}}</td>
                                                <td class="pl-0 pb-0">{{$property->localG}}</td>
                                                <td class="pl-0 pb-0"> 
                                                    @if(isset($property->status) && $property->status =='rent')
                                                        <span  class="bg-warning rounded p-2">{{ucfirst($property->status)}}</a> 
                                                    @elseif(isset($property->status) && $property->status =='sale')
                                                        <span class="bg-danger rounded p-2">{{ucfirst($property->status)}}</a>
                                                    @endif
                                                </td>
                                                <td>
                                                    @can('update', $property)
                                                        <a href="/edit-property/{{$property->id}}" class="btn" title="Edit"><span class="fa fa-edit h3"></span></a>  
                                                    @endcan 

                                                    @can('delete', $property)                                
                                                        <a href="" class="btn deleteProperty"  id='del {{$property->id}}' data-title="Delete" data-toggle="modal" data-target="#confirm-delete"><span class="fa fa-trash h3" title="Delete"></span></a>
                                                    @endcan
                                                </td>
                                            </tr>
                                            <?php $i++ ?>
                                            @endforeach
                                        </tbody>                 
                                    </table>

                                    <!-- modal for delete staff -->
                                    <div class="modal col-md-10 offset-md-2  col-sm-10 offset-sm-2 " id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="delete" aria-hidden="true">                  
                                        <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                            <h4 class="modal-title" id="Heading">Delete this Property</h4>
                                            </div>
                                            <div class="modal-body">
                                            <div class="alert alert-danger  format"><span class="fa fa-warning text-danger"></span> Are you sure you want to delete this property?</div>
                                            </div>
                                            <div class="modal-footer">
                                            <button  class="btn btn-success del_property"><span class="fa fa-check-circle"></span> Yes</button>
                                            <button type="button" class="btn btn-danger" data-dismiss="modal"><span class="fa fa-remove"></span> No</button>
                                            </div>
                                        </div>
                                        </div>
                                    </div>
                                    <!-- end of modal for delete property -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection