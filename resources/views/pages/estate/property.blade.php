@extends('layouts.app')
  @section('content')    
    <main id="main">

        <!-- ======= Intro Single ======= -->
        <section class="intro-single">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-lg-8">
                        <div class="title-single-box">
                            <h1 class="title-single">{{$property->address}}</h1>
                            <span class="color-text-a">{{$property->localG.', '.$property->state}}</span>
                        </div>
                    </div>
                    <div class="col-md-12 col-lg-4">
                        <nav aria-label="breadcrumb" class="breadcrumb-box d-flex justify-content-lg-end">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="{{route('home')}}">Home</a>
                                </li>
                                <li class="breadcrumb-item">
                                    <a href="{{route('properties')}}">Properties</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    {{$property->address}}
                                </li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </section><!-- End Intro Single-->

        <!-- ======= Property Single ======= -->
        <section class="property-single nav-arrow-b">
            <div class="container">
                @if(!empty($carousels))

                    <div class="row justify-content-center mb-4">
                        <div class="col-lg-8">
                            <div id="property-single-carousel" class="swiper">
                                <div class="swiper-wrapper">
                                    @foreach ($carousels as $carousel )
                                    <div class="carousel-item-b swiper-slide">
                                        <img src="{{url('property_carousels/'.$carousel->property_id.'/'.$carousel->carousel)}}" class="img-swipe carousel-img" alt="carousel image">
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                            <div class="property-single-carousel-pagination carousel-pagination"></div>
                        </div>
                    </div>
                @else
                    <div class="row justify-content-center mb-4">
                        <div class="col-lg-8">
                            <div id="property-single-carousel" class="swiper">
                                <div class="swiper-wrapper">
                                    <div class="carousel-item-b swiper-slide">
                                        <img src="{{url('property_images/'.$property->id.'/'.$property->image)}}" class="img-swipe img-fluid" alt="Property image">
                                    </div>
                                </div>
                            </div>
                            <div class="property-single-carousel-pagination carousel-pagination"></div>
                        </div>
                    </div>
                @endif


                <div class="row">
                    <div class=" offset-sm-1 col-sm-10">

                        <div class="row justify-content-between">
                            <div class="col-md-5 col-lg-4">
                                <div class="property-price d-flex justify-content-center foo">
                                    <div class="card-header-c d-flex">
                                        <div class="card-box-ico">
                                        <span class="bi bi-cash"> &#8358; </span>
                                        </div>
                                        <div class="card-title-c align-self-center">
                                        <h5 class="title-c">{{number_format($property->amount,2)}}</h5>
                                        </div>
                                    </div>
                                </div>
                                <div class="property-summary">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="title-box-d section-t4">
                                                <h3 class="title-d">Quick Summary</h3>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="summary-list">
                                        <ul class="list">

                                            <li class="d-flex justify-content-between">
                                                <strong>Location:</strong>
                                                <span>{{$property->localG.', '.$property->state}}</span>
                                            </li>
                                            <li class="d-flex justify-content-between">
                                                <strong>Property Type:</strong>
                                                <span>{{$property->type}}</span>
                                            </li>
                                            <li class="d-flex justify-content-between">
                                                <strong>Status:</strong>
                                                <span>{{$property->status}}</span>
                                            </li>
                                            <li class="d-flex justify-content-between">
                                                <strong>Area:</strong>
                                                <span>
                                                    {{$property->area}}<sup>2</sup>
                                                </span>
                                            </li>
                                            <li class="d-flex justify-content-between">
                                                <strong>Beds:</strong>
                                                <span>{{$property->bed}}</span>
                                            </li>
                                            <li class="d-flex justify-content-between">
                                                <strong>Baths:</strong>
                                                <span>{{$property->baths}}</span>
                                            </li>
                                            <li class="d-flex justify-content-between">
                                                <strong>Garage:</strong>
                                                <span>{{$property->garage}}</span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-7 col-lg-7 section-md-t3">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="title-box-d">
                                        <h3 class="title-d">{{$property->description}}</h3>
                                        </div>
                                    </div>
                                </div>
                                <div class="property-description">
                                    {{$property->description}}
                                </div>
                                <div class="row section-t3">
                                    <div class="col-sm-12">
                                        <div class="title-box-d">
                                            <h3 class="title-d">Amenities</h3>
                                        </div>
                                    </div>
                                </div> 

                                <div class="amenities-list color-text-a">
                                    <ul class="list-a no-margin">
                                        @foreach (array_values((array)json_decode($property->amenities)) as $amenity )
                                            <li>{{$amenity}}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-10">
                        <ul class="nav nav-pills-a nav-pills mb-3 section-t3" id="pills-tab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="pills-video-tab" data-bs-toggle="pill" href="#pills-video" role="tab" aria-controls="pills-video" aria-selected="true">Video</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="pills-plans-tab" data-bs-toggle="pill" href="#pills-plans" role="tab" aria-controls="pills-plans" aria-selected="false">Floor Plans</a>
                            </li>
                        </ul>
                        <div class="tab-content" id="pills-tabContent">
                            <div class="tab-pane fade show active" id="pills-video" role="tabpanel" aria-labelledby="pills-video-tab">
                                @if(  $property->video !="" || $property->video !=NULL)
                                    <video  width="850" height="480" controls>
                                        <source src="{{asset('storage/property_videos/'.$property->id.'/'.$property->video)}}" type="video/mp4">
                                    </video>
                                @else
                                    <p>Not available</p>
                                @endif

                            </div>
                            <div class="tab-pane fade" id="pills-plans" role="tabpanel" aria-labelledby="pills-plans-tab">
                                <img src="{{asset('estate/assets/img/plan2.jpg')}}" alt="Not available" class="img-fluid">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="row section-t3">
                            <div class="col-sm-12">
                                <div class="title-box-d">
                                    <h3 class="title-d">Contact Agent</h3>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 col-lg-4">
                                <img src="{{asset('/uploads/'.$agent->profile->id.'/'.$agent->profile->profile_image)}}" alt="" class="img-fluid">
                            </div>
                            <div class="col-md-6 col-lg-4">
                                <div class="property-agent">
                                    <h4 class="title-agent">{{ (isset($agent) && $agent!=NULL) ? $agent->profile->firstname.' '.$agent->profile->lastname : '' }}</h4>
                                    <p class="color-text-a">
                                        {{ isset($agent) && $agent!=NULL ? $agent->profile->description : ''}} 
                                    </p>
                                    <ul class="list-unstyled">
                                        <li class="d-flex justify-content-between">
                                            <strong>Phone:</strong>
                                            <span class="color-text-a">{{ (isset($agent) && $agent !=NULL) ? $agent->profile->phone_number : ''}}</span>
                                        </li>
                                        <li class="d-flex justify-content-between">
                                            <strong>Email:</strong>
                                            <span class="color-text-a">{{ (isset($agent) && $agent->email !=NULL) ? $agent->email : ''}}</span>
                                        </li>
                                    </ul>
                                    <div class="socials-a">
                                        <ul class="list-inline">
                                            <li class="list-inline-item">
                                                <a href="#">
                                                    <i class="bi bi-facebook" aria-hidden="true"></i>
                                                </a>
                                            </li>
                                            <li class="list-inline-item">
                                                <a href="#">
                                                    <i class="bi bi-twitter" aria-hidden="true"></i>
                                                </a>
                                            </li>
                                            <li class="list-inline-item">
                                                <a href="#">
                                                    <i class="bi bi-instagram" aria-hidden="true"></i>
                                                </a>
                                            </li>
                                            <li class="list-inline-item">
                                                <a href="#">
                                                    <i class="bi bi-linkedin" aria-hidden="true"></i>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 col-lg-4">

                                @if(session()->has('successMessage'))
                                    <div class="col-md-12 alert
                                    alert-success alert-dismissable text-center" style="margin-top:20px">
                                        <a href='' class='close' data-dismiss='alert' aria-label='close'> &times</a>
                                        <strong>
                                        Success
                                        </strong>
                                        {{session('successMessage')}}
                                    </div>
                                @endif
                                @if(session()->has('errorMessage'))
                                    <div class="col-md-12 alert alert
                                    alert-danger alert-dismissable text-center" style="margin-top:20px">
                                    <a href='' class='close' data-dismiss='alert' aria-label='close'> &times</a>
                                    <strong>
                                        Danger
                                    </strong>
                                    {{session('errorMessage')}}
                                    </div>
                                @endif

                                <div class="property-contact">
                                    <form action="/contact_agent"  method="POST" role="form" class="php-email-form">
                                        {{csrf_field()}}

                                        <input type="hidden" value="{{$property->user_id}}" name="agent_id">
                                        <input type="hidden" value="{{$property->id}}" name="property_id">

                                        <div class="row">
                                            <div class="col-md-12 mb-1">
                                                <div class="form-group">
                                                    <input type="text" name="name" class="form-control form-control-lg form-control-a" id="inputName" placeholder="Name *" required>
                                                    @if($errors->has('name'))
                                                        <span class="text-danger">
                                                            {{ $name= $errors->first('name')}}
                                                        </span>
                                                    @else
                                                        {{$name=''}}
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-md-12 mb-1">
                                                <div class="form-group">
                                                    <input type="email" name="email" class="form-control form-control-lg form-control-a" id="inputEmail1" placeholder="Email *" required>
                                                    @if($errors->has('email'))
                                                        <span class="text-danger">
                                                            {{ $email= $errors->first('email')}}
                                                        </span>
                                                    @else
                                                        {{$email=''}}
                                                    @endif 
                                                </div>
                                            </div>
                                            <div class="col-md-12 mb-1">
                                                <div class="form-group">
                                                    <textarea id="textMessage" class="form-control" placeholder="Comment *" name="message" cols="45" rows="8" required></textarea>
                                                    @if($errors->has('message'))
                                                        <span class="text-danger">
                                                            {{ $message= $errors->first('message')}}
                                                        </span>
                                                    @else
                                                        {{$message=''}}
                                                    @endif   
                                                </div>
                                            </div>
                                            <div class="col-md-12 mt-3">
                                                <button type="submit" class="btn btn-a">Send Message</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section><!-- End Property Single-->

    </main><!-- End #main -->
@endsection