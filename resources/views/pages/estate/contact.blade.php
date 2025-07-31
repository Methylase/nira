@extends('layouts.app')
  @section('content')    
    <main id="main">

        <!-- ======= Intro Single ======= -->
        <section class="intro-single">
        <div class="container">
            <div class="row">
            <div class="col-md-12 col-lg-8">
                <div class="title-single-box">
                <h1 class="title-single">Contact US</h1>
                <span class="color-text-a">
                    We don't just offer spaces — we deliver peace of mind and lasting value.
                    Whether you're buying, renting, or investing, we guide you every step of the way.
                    Reach out today — because where you live or invest should be worth it.</span>
                </div>
            </div>
            <div class="col-md-12 col-lg-4">
                <nav aria-label="breadcrumb" class="breadcrumb-box d-flex justify-content-lg-end">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                    <a href="index.html">Home</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                    Contact
                    </li>
                </ol>
                </nav>
            </div>
            </div>
        </div>
        </section><!-- End Intro Single-->

        <!-- ======= Contact Single ======= -->
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

                <div class="col-md-7">
                    <form action="/contact" method="POST" role="form" class="php-email-form">
                    {{csrf_field()}}
                    <div class="row">
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
                                <textarea name="message" class="form-control" cols="45" rows="8" placeholder="Message" required></textarea>
                                @if($errors->has('message'))
                                    <span class="text-danger">
                                        {{ $message= $errors->first('message')}}
                                    </span>
                                @else
                                    {{$message=''}}
                                @endif                                        
                            </div>
                        </div>  
                        <div class="col-md-12 my-3">
                        <div class="mb-3">
                            <div class="loading">Loading</div>
                            <div class="error-message"></div>
                            <div class="sent-message">Your message has been sent. Thank you!</div>
                        </div>
                        </div>

                        <div class="col-md-12 text-center">
                        <button type="submit" class="btn btn-a">Send Message</button>
                        </div>
                    </div>
                    </form>
                </div>
                <div class="col-md-5 section-md-t3">
                    <div class="icon-box section-b2">
                    <div class="icon-box-icon">
                        <span class="bi bi-envelope"></span>
                    </div>
                    <div class="icon-box-content table-cell">
                        <div class="icon-box-title">
                        <h4 class="icon-title">Say Hello</h4>
                        </div>
                        <div class="icon-box-content">
                        <p class="mb-1">Email.
                            <span class="color-a">info@nira-properties.com.</span>
                        </p>
                        <p class="mb-1">Phone.
                            <span class="color-a">+2348188373898</span>
                        </p>
                        </div>
                    </div>
                    </div>
                    <div class="icon-box section-b2">
                    <div class="icon-box-icon">
                        <span class="bi bi-geo-alt"></span>
                    </div>
                    <div class="icon-box-content table-cell">
                        <div class="icon-box-title">
                        <h4 class="icon-title">Find us in</h4>
                        </div>
                        <div class="icon-box-content">
                        <p class="mb-1">
                            Ogba Ikeja, Lagos
                            <br> Nigeria.
                        </p>
                        </div>
                    </div>
                    </div>
                    <div class="icon-box">
                    <div class="icon-box-icon">
                        <span class="bi bi-share"></span>
                    </div>
                    <div class="icon-box-content table-cell">
                        <div class="icon-box-title">
                        <h4 class="icon-title">Social networks</h4>
                        </div>
                        <div class="icon-box-content">
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
                </div>
            </div>
            </div>
        </div>
        </section><!-- End Contact Single-->

    </main><!-- End #main -->
@endsection    