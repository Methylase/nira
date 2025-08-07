@extends('layouts.app')
  @section('content')
  <main id="main">

    <!-- ======= Intro Single ======= -->
    <section class="intro-single">
      <div class="container">
        <div class="row">
          <div class="col-md-12 col-lg-8">
            <div class="title-single-box">
              <h1 class="title-single">{{$agent->profile->firstname.' '.$agent->profile->lastname}}</h1>
              <span class="color-text-a">Agent </span>
            </div>
          </div>
          <div class="col-md-12 col-lg-4">
            <nav aria-label="breadcrumb" class="breadcrumb-box d-flex justify-content-lg-end">
              <ol class="breadcrumb">
                <li class="breadcrumb-item">
                  <a href="{{route('home')}}">Home</a>
                </li>
                <li class="breadcrumb-item">
                  <a href="{{route('agents')}}">Agents</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                  {{$agent->profile->firstname.' '.$agent->profile->lastname}}
                </li>
              </ol>
            </nav>
          </div>
        </div>
      </div>
    </section><!-- End Intro Single -->

    <!-- ======= Agent Single ======= -->
    <section class="agent-single">
      <div class="container">
        <div class="row">
          <div class="col-sm-12">
            <div class="row">
              <div class="col-md-6">
                <div class="agent-avatar-box">
                  <img src="{{asset('/uploads/'.$agent->profile->id.'/'.$agent->profile->profile_image)}}" alt="" class="agent-avatar img-fluid">
                </div>
              </div>
              <div class="col-md-5 section-md-t3">
                <div class="agent-info-box">
                  <div class="agent-title">
                    <div class="title-box-d">
                      <h3 class="title-d">{{$agent->profile->firstname.' '.$agent->profile->lastname}}
                      </h3>
                    </div>
                  </div>
                  <div class="agent-content mb-3">
                    <p class="content-d color-text-a">
                      {{$agent->profile->description}}
                    </p>
                    <div class="info-agents color-a">
                      <p>
                        <strong>Phone: </strong>
                        <span class="color-text-a"> {{$agent->profile->phone_number}} </span>
                      </p>
                      <p>
                        <strong>Email: </strong>
                        <span class="color-text-a"> {{$agent->email}}</span>
                      </p>
                    </div>
                  </div>
                  <div class="socials-footer">
                    <ul class="list-inline">
                      <li class="list-inline-item">
                        <a href="#" class="link-one">
                          <i class="bi bi-facebook" aria-hidden="true"></i>
                        </a>
                      </li>
                      <li class="list-inline-item">
                        <a href="#" class="link-one">
                          <i class="bi bi-twitter" aria-hidden="true"></i>
                        </a>
                      </li>
                      <li class="list-inline-item">
                        <a href="#" class="link-one">
                          <i class="bi bi-instagram" aria-hidden="true"></i>
                        </a>
                      </li>
                      <li class="list-inline-item">
                        <a href="#" class="link-one">
                          <i class="bi bi-linkedin" aria-hidden="true"></i>
                        </a>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-12 section-t8">
            <div class="title-box-d">
              <h3 class="title-d">My Properties {{count($properties)}}</h3>
            </div>
          </div>
          <div class="row property-grid grid">
            <div class="col-sm-12">
              <div class="grid-option">
                <form id="form" action="/properties" method="POST" onchange="onSelectChange()">
                    {{csrf_field()}}
                    <select class="custom-select form-control"  name="property_type" >
                       @if(!isset($property_type))
                            <option selected value="all">All</option>
                            <option value="1">New to Old</option>
                            <option value="2">For Rent</option>
                            <option value="3">For Sale</option>
                        @elseif(isset($property_type) && $property_type =='all')
                            <option selected value="all">All</option>
                            <option value="1">New to Old</option>
                            <option value="2">For Rent</option>
                            <option value="3">For Sale</option>                                    
                        @elseif(isset($property_type) && $property_type =='1')
                            <option value="all">All</option>
                            <option selected value="1">New to Old</option>
                            <option value="2">For Rent</option>
                            <option value="3">For Sale</option>
                        @elseif(isset($property_type) && $property_type =='2')
                            <option value="all">All</option>
                            <option value="1">New to Old</option>
                            <option selected value="2">For Rent</option>
                            <option value="3">For Sale</option>  
                        @elseif(isset($property_type) && $property_type =='3')
                            <option value="all">All</option>
                            <option value="1">New to Old</option>
                            <option value="2">For Rent</option>
                            <option selected value="3">For Sale</option>                                                                      
                        @endif
                    </select>
                </form>
              </div>
            </div>
            @foreach ($properties as $property)
              <div class="col-md-4">
                <div class="card-box-a card-shadow">
                  <div class="img-box-a">
                    <img src="{{asset('/property_images/'.$property->id.'/'.$property->image)}}" alt="" class="img-a img-fluid">
                  </div>
                  <div class="card-overlay">
                    <div class="card-overlay-a-content">
                      <div class="card-header-a">
                        <h2 class="card-title-a">
                          <a href="/property?id={{$property->id}}">{{substr($property->address,0, 3)}}
                          <br /> {{substr($property->address, 4)}}</a>
                        </h2>
                      </div>
                      <div class="card-body-a">
                        <div class="price-box d-flex">
                          <span class="price-a">{{$property->status}} | &#8358;{{number_format($property->amount,2)}}</span>
                        </div>
                        <a href="/property?id={{$property->id}}" class="link-a">Click here to view
                          <span class="bi bi-chevron-right"></span>
                        </a>
                      </div>
                      <div class="card-footer-a">
                        <ul class="card-info d-flex justify-content-around">
                          <li>
                            <h4 class="card-info-title">Area</h4>
                            <span>{{$property->area}}
                              <sup>2</sup>
                            </span>
                          </li>
                          <li>
                            <h4 class="card-info-title">Beds</h4>
                            <span>{{$property->bed}}</span>
                          </li>
                          <li>
                            <h4 class="card-info-title">Baths</h4>
                            <span>{{$property->baths}}</span>
                          </li>
                          <li>
                            <h4 class="card-info-title">Garages</h4>
                            <span>{{$property->garage}}</span>
                          </li>
                        </ul>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            @endforeach
          </div>
        </div>
      </div>
    </section><!-- End Agent Single -->

  </main><!-- End #main -->
@endsection  