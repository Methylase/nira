@extends('layouts.admin')
  @section('content')   
    <div class="content-wrapper">
        <div class="row">
        <div class="col-md-12 grid-margin">
            <div class="row">
            <div class="col-12 col-xl-8 mb-4 mb-xl-0">

                @can('is_admin')

                    <h3 class="font-weight-bold">Welcome Admin</h3>
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
                        <p class="mb-4">Total</p>
                        <p class="fs-30 mb-2">4006</p>
                        <p>number of users</p>
                    </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4 stretch-card transparent">
                    <div class="card card-dark-blue">
                    <div class="card-body">
                        <p class="mb-4">Total</p>
                        <p class="fs-30 mb-2">61344</p>
                        <p>number of properties for rent</p>
                    </div>
                    </div>
                </div>

                <div class="col-md-4 mb-4 stretch-card transparent">
                    <div class="card card-light-danger">
                    <div class="card-body">
                        <p class="mb-4">Total</p>
                        <p class="fs-30 mb-2">61344</p>
                        <p>number of properties for sale</p>
                    </div>
                    </div>
                </div>

                
                
            </div>

        </div>
        </div>


        <div class="row">
        <div class="col-md-4 stretch-card grid-margin">
            <div class="card">
            <div class="card-body">
                <p class="card-title mb-0">Projects</p>
                <div class="table-responsive">
                <table class="table table-borderless">
                    <thead>
                    <tr>
                        <th class="pl-0  pb-2 border-bottom">Places</th>
                        <th class="border-bottom pb-2">Orders</th>
                        <th class="border-bottom pb-2">Users</th>
                    </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="pl-0">Kentucky</td>
                            <td><p class="mb-0"><span class="font-weight-bold mr-2">65</span>(2.15%)</p></td>
                            <td class="text-muted">65</td>
                        </tr>
                        <tr>
                            <td class="pl-0">Ohio</td>
                            <td><p class="mb-0"><span class="font-weight-bold mr-2">54</span>(3.25%)</p></td>
                            <td class="text-muted">51</td>
                        </tr>
                        <tr>
                            <td class="pl-0">Nevada</td>
                            <td><p class="mb-0"><span class="font-weight-bold mr-2">22</span>(2.22%)</p></td>
                            <td class="text-muted">32</td>
                        </tr>
                        <tr>
                            <td class="pl-0">North Carolina</td>
                            <td><p class="mb-0"><span class="font-weight-bold mr-2">46</span>(3.27%)</p></td>
                            <td class="text-muted">15</td>
                        </tr>
                        <tr>
                            <td class="pl-0">Montana</td>
                            <td><p class="mb-0"><span class="font-weight-bold mr-2">17</span>(1.25%)</p></td>
                            <td class="text-muted">25</td>
                        </tr>
                        <tr>
                            <td class="pl-0">Nevada</td>
                            <td><p class="mb-0"><span class="font-weight-bold mr-2">52</span>(3.11%)</p></td>
                            <td class="text-muted">71</td>
                        </tr>
                        <tr>
                            <td class="pl-0 pb-0">Louisiana</td>
                            <td class="pb-0"><p class="mb-0"><span class="font-weight-bold mr-2">25</span>(1.32%)</p></td>
                            <td class="pb-0">14</td>
                        </tr>
                    </tbody>
                </table>
                </div>
            </div>
            </div>
        </div>
        <div class="col-md-4 stretch-card grid-margin">
            <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                <div class="card-body">
                    <p class="card-title">Charts</p>
                    <div class="charts-data">
                    <div class="mt-3">
                        <p class="mb-0">Data 1</p>
                        <div class="d-flex justify-content-between align-items-center">
                        <div class="progress progress-md flex-grow-1 mr-4">
                            <div class="progress-bar bg-inf0" role="progressbar" style="width: 95%" aria-valuenow="95" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <p class="mb-0">5k</p>
                        </div>
                    </div>
                    <div class="mt-3">
                        <p class="mb-0">Data 2</p>
                        <div class="d-flex justify-content-between align-items-center">
                        <div class="progress progress-md flex-grow-1 mr-4">
                            <div class="progress-bar bg-info" role="progressbar" style="width: 35%" aria-valuenow="35" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <p class="mb-0">1k</p>
                        </div>
                    </div>
                    <div class="mt-3">
                        <p class="mb-0">Data 3</p>
                        <div class="d-flex justify-content-between align-items-center">
                        <div class="progress progress-md flex-grow-1 mr-4">
                            <div class="progress-bar bg-info" role="progressbar" style="width: 48%" aria-valuenow="48" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <p class="mb-0">992</p>
                        </div>
                    </div>
                    <div class="mt-3">
                        <p class="mb-0">Data 4</p>
                        <div class="d-flex justify-content-between align-items-center">
                        <div class="progress progress-md flex-grow-1 mr-4">
                            <div class="progress-bar bg-info" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <p class="mb-0">687</p>
                        </div>
                    </div>
                    </div>  
                </div>
                </div>
            </div>
            <div class="col-md-12 stretch-card grid-margin grid-margin-md-0">
                <div class="card data-icon-card-primary">
                <div class="card-body">
                    <p class="card-title text-white">Number of Meetings</p>                      
                    <div class="row">
                    <div class="col-8 text-white">
                        <h3>34040</h3>
                        <p class="text-white font-weight-500 mb-0">The total number of sessions within the date range.It is calculated as the sum . </p>
                    </div>
                    <div class="col-4 background-icon">
                    </div>
                    </div>
                </div>
                </div>
            </div>
            </div>
        </div>
        <div class="col-md-4 stretch-card grid-margin">
            <div class="card">
            <div class="card-body">
                <p class="card-title">Notifications</p>
                <ul class="icon-data-list">
                <li>
                    <div class="d-flex">
                    <img src="{{asset('skydash-admin/template/images/faces/face1.jpg')}}" alt="user">
                    <div>
                        <p class="text-info mb-1">Isabella Becker</p>
                        <p class="mb-0">Sales dashboard have been created</p>
                        <small>9:30 am</small>
                    </div>
                    </div>
                </li>
                <li>
                    <div class="d-flex">
                    <img src="{{asset('skydash-admin/template/images/faces/face2.jpg')}}" alt="user">
                    <div>
                        <p class="text-info mb-1">Adam Warren</p>
                        <p class="mb-0">You have done a great job #TW111</p>
                        <small>10:30 am</small>
                    </div>
                    </div>
                </li>
                <li>
                    <div class="d-flex">
                    <img src="{{asset('skydash-admin/template/images/faces/face3.jpg')}}" alt="user">
                    <div>
                    <p class="text-info mb-1">Leonard Thornton</p>
                    <p class="mb-0">Sales dashboard have been created</p>
                    <small>11:30 am</small>
                    </div>
                    </div>
                </li>
                <li>
                    <div class="d-flex">
                    <img src="{{asset('skydash-admin/template/images/faces/face4.jpg')}}" alt="user">
                    <div>
                        <p class="text-info mb-1">George Morrison</p>
                        <p class="mb-0">Sales dashboard have been created</p>
                        <small>8:50 am</small>
                    </div>
                    </div>
                </li>
                <li>
                    <div class="d-flex">
                    <img src="{{asset('skydash-admin/template/images/faces/face5.jpg')}}" alt="user">
                    <div>
                    <p class="text-info mb-1">Ryan Cortez</p>
                    <p class="mb-0">Herbs are fun and easy to grow.</p>
                    <small>9:00 am</small>
                    </div>
                    </div>
                </li>
                </ul>
            </div>
            </div>
        </div>
        </div>
        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <p class="card-title">Advanced Table</p>
                        <div class="row">
                            <div class="col-12">
                                <div class="table-responsive">
                                    <table id="example" class="display expandable-table" style="width:100%">
                                        <thead>
                                        <tr>
                                            <th>Quote#</th>
                                            <th>Product</th>
                                            <th>Business type</th>
                                            <th>Policy holder</th>
                                            <th>Premium</th>
                                            <th>Status</th>
                                            <th>Updated at</th>
                                            <th></th>
                                        </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection