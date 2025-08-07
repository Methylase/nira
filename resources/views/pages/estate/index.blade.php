
@extends('layouts.app')
  @section('content')
  <main id="main">

    <!-- ======= Services Section ======= -->
    <section class="section-services section-t8">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="title-wrap d-flex justify-content-between">
              <div class="title-box">
                <h2 class="title-a">Our Services</h2>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-4">
            <div class="card-box-c foo">
              <div class="card-header-c d-flex">
                <div class="card-box-ico">
                  <span class="bi bi-cart"></span>
                </div>
                <div class="card-title-c align-self-center">
                  <h2 class="title-c">Lifestyle</h2>
                </div>
              </div>
              <div class="card-body-c">
                <p class="content-c">
                  Find homes that match your dream lifestyle—urban chic, coastal calm, or suburban ease.
                  Enjoy curated communities with amenities that matter to you.
                  Live closer to work, nature, or the nightlife you love.
                  Your lifestyle, your location, your perfect home—just a search away.
                </p>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="card-box-c foo">
              <div class="card-header-c d-flex">
                <div class="card-box-ico">
                  <span class="bi bi-calendar4-week"></span>
                </div>
                <div class="card-title-c align-self-center">
                  <h2 class="title-c">Loans</h2>
                </div>
              </div>
              <div class="card-body-c">
                <p class="content-c">
                  Get expert guidance on home loans from trusted partners.
                  We connect you with competitive rates and fast approvals.
                  From pre-approval to closing, we simplify every step.
                  Own your dream home with the right financing, hassle-free.
                </p>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="card-box-c foo">
              <div class="card-header-c d-flex">
                <div class="card-box-ico">
                  <span class="bi bi-card-checklist"></span>
                </div>
                <div class="card-title-c align-self-center">
                  <h2 class="title-c">Sell</h2>
                </div>
              </div>
              <div class="card-body-c">
                <p class="content-c">
                  Selling your property? Let us handle everything for you.
                  From pricing strategy to professional listings—we’ve got it covered.
                  Reach serious buyers faster with our targeted marketing tools.
                  List smart, sell quicker, stress less—leave it to the pros.
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section><!-- End Services Section -->

    <!-- ======= Latest Properties Section ======= -->
    <section class="section-property section-t8">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="title-wrap d-flex justify-content-between">
              <div class="title-box">
                <h2 class="title-a">Latest Properties</h2>
              </div>
              <div class="title-link">
                <a href="/properties">All Property
                  <span class="bi bi-chevron-right"></span>
                </a>
              </div>
            </div>
          </div>
        </div>

        <div id="property-carousel" class="swiper">
          <div class="swiper-wrapper">
            @foreach ($latestProperties as $latestProperty )
            <div class="carousel-item-b swiper-slide">
              <div class="card-box-a card-shadow">
                <div class="img-box-a">
                  <img src="{{asset('/property_images/'.$latestProperty->id.'/'.$latestProperty->image)}}" alt="" class="img-a img-fluid" style="height:500px;">
                </div>
                <div class="card-overlay">
                  <div class="card-overlay-a-content">
                    <div class="card-header-a">
                      <h2 class="card-title-a">
                        <a href="{{route('property', $latestProperty->id)}}">{{substr($latestProperty->address,0, 3)}}
                          <br /> {{substr($latestProperty->address, 4)}}</a>
                      </h2>
                    </div>
                    <div class="card-body-a">
                      <div class="price-box d-flex">
                        <span class="price-a">{{$latestProperty->status}} | &#8358;{{number_format($latestProperty->amount,2)}}</span>
                      </div>
                      <a href="{{route('property', $latestProperty->id)}}" class="link-a">Click here to view
                        <span class="bi bi-chevron-right"></span>
                      </a>
                    </div>
                    <div class="card-footer-a">
                      <ul class="card-info d-flex justify-content-around">
                        <li>
                          <h4 class="card-info-title">Area</h4>
                          <span>{{$latestProperty->area}}m
                            <sup>2</sup>
                          </span>
                        </li>
                        <li>
                          <h4 class="card-info-title">Beds</h4>
                          <span>{{$latestProperty->bed}}</span>
                        </li>
                        <li>
                          <h4 class="card-info-title">Baths</h4>
                          <span>{{$latestProperty->baths}}</span>
                        </li>
                        <li>
                          <h4 class="card-info-title">Garages</h4>
                          <span>{{$latestProperty->garage}}</span>
                        </li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
            </div><!-- End carousel item -->
            @endforeach
          </div>
        </div>
        <div class="propery-carousel-pagination carousel-pagination"></div>

      </div>
    </section><!-- End Latest Properties Section -->

    <!-- ======= Agents Section ======= -->
    <section class="section-agents section-t8">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="title-wrap d-flex justify-content-between">
              <div class="title-box">
                <h2 class="title-a">Best Agents</h2>
              </div>
              <div class="title-link">
                <a href="{{route('agents')}}">All Agents
                  <span class="bi bi-chevron-right"></span>
                </a>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          @foreach ($agents as $agent)
            <div class="col-md-4">
              <div class="card-box-d">
                <div class="card-img-d">
                 
                  <img src="{{asset('/uploads/'.$agent->profile->id.'/'.$agent->profile->profile_image)}}" alt="" class="img-d img-fluid">
                </div>
                <div class="card-overlay card-overlay-hover">
                  <div class="card-header-d">
                    <div class="card-title-d align-self-center">
                      <h3 class="title-d">
                        <a href="/agent?id={{$agent->id}}" class="link-two"> {{$agent->profile->firstname.' '.$agent->profile->lastname}}
                          <br> Agent</a>
                      </h3>
                    </div>
                  </div>
                  <div class="card-body-d">
                    <p class="content-d color-text-a">
                      {{$agent->profile->description}}
                    </p>
                    <div class="info-agents color-a">
                      <p>
                        <strong>Phone: </strong> {{$agent->profile->phone_number}}
                      </p>
                      <p>
                        <strong>Email: </strong> {{$agent->email}}
                      </p>
                    </div>
                  </div>
                  <div class="card-footer-d">
                    <div class="socials-footer d-flex justify-content-center">
                      <ul class="list-inline">
                        <li class="list-inline-item">
                          <a href="{{$agent->profile->facebook}}" class="link-one">
                            <i class="bi bi-facebook" aria-hidden="true"></i>
                          </a>
                        </li>
                        <li class="list-inline-item">
                          <a href="{{$agent->profile->twitter}}" class="link-one">
                            <i class="bi bi-twitter" aria-hidden="true"></i>
                          </a>
                        </li>
                        <li class="list-inline-item">
                          <a href="{{$agent->profile->instagram}}" class="link-one">
                            <i class="bi bi-instagram" aria-hidden="true"></i>
                          </a>
                        </li>
                        <li class="list-inline-item">
                          <a href="{{$agent->profile->linkedin}}" class="link-one">
                            <i class="bi bi-linkedin" aria-hidden="true"></i>
                          </a>
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
    </section><!-- End Agents Section -->

    <!-- ======= Latest News Section ======= -->
    <section class="section-news section-t8">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="title-wrap d-flex justify-content-between">
              <div class="title-box">
                <h2 class="title-a">Latest News</h2>
              </div>
              <div class="title-link">
                <a href="{{route('blogs')}}">All News
                  <span class="bi bi-chevron-right"></span>
                </a>
              </div>
            </div>
          </div>
        </div>

        <div id="news-carousel" class="swiper">
          <div class="swiper-wrapper">
            @foreach ($blogs as $blog)
              <div class="carousel-item-c swiper-slide">
                <div class="card-box-b card-shadow news-box">
                  <div class="img-box-b">
                    <img src="{{asset('/blog_images/'.$blog->id.'/'.$blog->image)}}" alt="" class="img-b img-fluid">
                  </div>
                  <div class="card-overlay">
                    <div class="card-header-b">
                      <div class="card-category-b">
                        <a href="/blog?id={{$blog->id}}" class="category-b">{{$blog->type}}</a>
                      </div>
                      <div class="card-title-b">
                        <h2 class="title-2">
                          <a href="/blog?id={{$blog->id}}"> {{$blog->title}}
                            <br> {{($blog->updated_at != NULL ?  'old' : 'new')}}</a>
                        </h2>
                      </div>
                      <div class="card-date">
                        <span class="date-b">{{date('d M. Y', strtotime($blog->created_at))}}</span>
                      </div>
                    </div>
                  </div>
                </div>
              </div><!-- End carousel item -->
            @endforeach
          </div>
        </div>

        <div class="news-carousel-pagination carousel-pagination"></div>
      </div>
    </section><!-- End Latest News Section -->

    <!-- ======= Testimonials Section ======= -->
    <section class="section-testimonials section-t8 nav-arrow-a">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="title-wrap d-flex justify-content-between">
              <div class="title-box">
                <h2 class="title-a">Testimonials</h2>
              </div>
            </div>
          </div>
        </div>

        <div id="testimonial-carousel" class="swiper">
          <div class="swiper-wrapper">

            @foreach ($testimonials as $testimonial)
              <div class="carousel-item-a swiper-slide">
                <div class="testimonials-box">
                  <div class="row">
                    <div class="col-sm-12 col-md-6">
                      <div class="testimonial-img">
                        <img src="{{isset($testimonial->image) && $testimonial->image !=='' ? url('testimonial_images/'.$testimonial->id.'/'.$testimonial->image) : asset('images/user.jpg') }}" class="img-fluid"  alt="profile image"/>
                      </div>
                    </div>
                    <div class="col-sm-12 col-md-6">
                      <div class="testimonial-ico">
                        <i class="bi bi-chat-quote-fill"></i>
                      </div>
                      <div class="testimonials-content">
                        <p class="testimonial-text">
                          {{$testimonial->feedback}}
                        </p>
                      </div>
                      <div class="testimonial-author-box">
                        <img src="{{isset($testimonial->image) && $testimonial->image !=='' ? url('testimonial_images/'.$testimonial->id.'/'.$testimonial->image) : asset('images/user.jpg') }}" class="testimonial-avatar img-round"  alt="profile image"/>
                        <h5 class="testimonial-author">{{$testimonial->name}}</h5>
                      </div>
                    </div>
                  </div>
                </div>
              </div><!-- End carousel item -->
            @endforeach
          </div>
        </div>
        <div class="testimonial-carousel-pagination carousel-pagination"></div>

      </div>
    </section><!-- End Testimonials Section -->

  </main><!-- End #main -->
@endsection
 