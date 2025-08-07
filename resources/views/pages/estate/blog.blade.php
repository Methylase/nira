@extends('layouts.app')
  @section('content')
    <main id="main">

        <!-- ======= Intro Single ======= -->
        <section class="intro-single">
        <div class="container">
            <div class="row">
            <div class="col-md-12 col-lg-8">
                <div class="title-single-box">
                <h1 class="title-single">{{$blog->title}}</h1>
                <span class="color-text-a">News Single.</span>
                </div>
            </div>
            <div class="col-md-12 col-lg-4">
                <nav aria-label="breadcrumb" class="breadcrumb-box d-flex justify-content-lg-end">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                    <a href="{{route('home')}}">Home</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                    {{$blog->title}}
                    </li>
                </ol>
                </nav>
            </div>
            </div>
        </div>
        </section><!-- End Intro Single-->

        <!-- ======= Blog Single ======= -->
        <section class="news-single nav-arrow-b">
        <div class="container">
            <div class="row">
            <div class="col-sm-12">
                <div class="news-img-box">
                <img src="{{asset('/blog_images/'.$blog->id.'/'.$blog->image)}}" alt="" class="img-fluid">
                </div>
            </div>
            <div class="col-md-10 offset-md-1 col-lg-8 offset-lg-2">
                <div class="post-information">
                <ul class="list-inline text-center color-a">
                    <li class="list-inline-item mr-2">
                    <strong>Author: </strong>
                    <span class="color-text-a">{{$blog->user->profile->firstname.' '.$blog->user->profile->lastname}}</span>
                    </li>
                    <li class="list-inline-item mr-2">
                    <strong>Category: </strong>
                    <span class="color-text-a">{{$blog->type}}</span>
                    </li>
                    <li class="list-inline-item">
                    <strong>Date: </strong>
                    <span class="color-text-a">{{date('d M. Y', strtotime($blog->created_at))}}</span>
                    </li>
                </ul>
                </div>
                <div class="post-content color-text-a">
                <p class="post-intro"> {{$blog->description}}</p>
 
                </div>
                <div class="post-footer">
                    <div class="post-share">
                        <span>Share: </span>
                        <ul class="list-inline socials">
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
                <div class="row">
                    <div class="col-sm-12 col-md-12 col-lg-12">
                        <h3>Leave a Comment</h3>
                        <form action="{{ route('comments') }}" method="POST">
                            {{csrf_field()}}
                            <input type="hidden" name="blog_id"  value="{{ $blog->id }}">
                            <input type="hidden" name="parent_id"  value="">
                            <input type="text" name="name" required class="form-control form-control-lg form-control-a mb-3" placeholder="Enter your name">
                            <input type="text" name="email" required class="form-control form-control-lg form-control-a mb-3" placeholder="Enter your email">
                            <textarea name="content" required class="form-control form-control-lg form-control-a mb-3" cols="45" rows="8" placeholder="Entre your comment..."></textarea>
                            <button type="submit" class="btn btn-a mb-5">Post Comment</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-10 offset-md-1 col-lg-10 offset-lg-1">
                <div class="title-box-d">
                    <h3 class="title-d">Comments {{count($blog->comments()->whereNull('parent_id')->latest()->get())}}</h3>
                </div>
                <div class="box-comments">
                    <ul class="list-comments">
                        @foreach ($blog->comments()->whereNull('parent_id')->with('replies')->latest()->get() as $comment)
                            @include('pages.estate._comment', ['comment' => $comment, 'level' => 0])
                        @endforeach
                    </ul>
                </div>
            </div>
            </div>
        </div>
        </section><!-- End Blog Single-->

    </main><!-- End #main -->
@endsection  