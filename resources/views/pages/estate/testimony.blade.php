@extends('layouts.app')
  @section('content')    
    <main id="main">

        <!-- ======= Intro Single ======= -->
        <section class="intro-single">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-lg-8">
                    <div class="title-single-box">
                    <h1 class="title-single">Testimony</h1>
                    <span class="color-text-a">We’d love to hear about your experience with our real estate platform!
Your feedback helps others find their dream home or sell with confidence.
Whether you bought, sold, or just explored, every story matters.
Share your journey and let your voice guide future homeowners.
Leave a quick testimony and help us grow a trusted community!</span>
                    </div>
                </div>
                <div class="col-md-12 col-lg-4">
                    <nav aria-label="breadcrumb" class="breadcrumb-box d-flex justify-content-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                            <a href="{{route('home')}}">Home</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">
                            Testimony
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        </section><!-- End Intro Single-->

        <!-- ======= Testimony Single ======= -->
        <section class="contact">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 section-t8">
                    <div class="row">

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

                        <div class="col-md-12">
                            <form action="/testimony" enctype="multipart/form-data" method="POST" role="form" class="php-email-form">
                                {{csrf_field()}}
                                <div class="row">
                                    <div class="col-md-12 mb-3">                                  
                                        <div class="form-group">
                                            <label for="testimony-image" class="control-label mb-3">Upload your image</label>
                                            <input type="file" name="testimonyImage" class="form-control form-control-lg form-control-a" required>
                                            @if($errors->has('testimonyImage'))
                                                <span class="text-danger">
                                                    {{ $testimony_image= $errors->first('testimonyImage')}}
                                                </span>
                                            @else
                                                {{$testiomoy_image=''}}
                                            @endif

                                            @if(session()->has('image_error'))
                                                <span class="text-danger">
                                                    {{session('image_error')}}
                                                </span>
                                            @endif
                                        </div>
                                    </div>                                    
                                    <div class="col-md-6 mb-3">
                                        <div class="form-group">
                                            <input type="text" name="name" class="form-control form-control-lg form-control-a" placeholder="Your Name" required>
                                            @if($errors->has('name'))
                                                <span class="text-danger">
                                                    {{ $name= $errors->first('name')}}
                                                </span>
                                            @else
                                                {{$name=''}}
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <div class="form-group">
                                            <input name="email" type="email" class="form-control form-control-lg form-control-a" placeholder="Your Email" required>
                                            @if($errors->has('email'))
                                                <span class="text-danger">
                                                    {{ $email= $errors->first('email')}}
                                                </span>
                                            @else
                                                {{$email=''}}
                                            @endif                                        
                                        </div>
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <div class="form-group">
                                            <input type="text" name="subject" class="form-control form-control-lg form-control-a" placeholder="Subject" required>
                                            @if($errors->has('subject'))
                                                <span class="text-danger">
                                                    {{ $subject= $errors->first('subject')}}
                                                </span>
                                            @else
                                                {{$subject=''}}
                                            @endif                                        
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <textarea name="feedback" class="form-control" cols="45" rows="8" placeholder="Share your experience with us" required></textarea>
                                            @if($errors->has('feedback'))
                                                <span class="text-danger">
                                                    {{ $feedback= $errors->first('feedback')}}
                                                </span>
                                            @else
                                                {{$feedback=''}}
                                            @endif                                        
                                        </div>
                                    </div>                                   

                                    <div class="col-md-12 text-center mt-5">
                                        <button type="submit" class="btn btn-a">Send Message</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </section><!-- End Testimony Single-->

    </main><!-- End #main -->
@endsection    