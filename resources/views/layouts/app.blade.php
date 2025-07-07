<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Nira Properties - Home</title>
  <meta content="" name="description">
  <meta content="" name="keywords">
  <meta name="csrf-token" content="{{csrf_token()}}"> 
  <!-- Favicons -->
  <link href="{{asset('images/favicon.ico')}}" rel="icon">
  <link href="{{asset('images/favicon.ico')}}" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="{{asset('estate/vendor/animate.css/animate.min.css')}}" rel="stylesheet">
  <link href="{{asset('estate/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
  <link href="{{asset('estate/vendor/bootstrap-icons/bootstrap-icons.css')}}" rel="stylesheet">
  <link href="{{asset('estate/vendor/swiper/swiper-bundle.min.css')}}" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="{{asset('estate/css/style.css')}}" rel="stylesheet">
  <script src="{{asset('estate/js/jquery.min.js')}}"></script>
</head>

<body>

  <!-- ======= Property Search Section ======= -->
  <div class="click-closed"></div>
  <!--/ Form Search Star /-->
  <div class="box-collapse">
    <div class="title-box-d">
      <h3 class="title-d">Search Property</h3>
    </div>
    <span class="close-box-collapse right-boxed bi bi-x"></span>
    <div class="box-collapse-wrap form">
      <form class="form-a">
        <div class="row">
          <div class="col-md-12 mb-2">
            <div class="form-group">
              <label class="pb-2" for="Type">Keyword</label>
              <input type="text" class="form-control form-control-lg form-control-a" placeholder="Keyword">
            </div>
          </div>
          <div class="col-md-6 mb-2">
            <div class="form-group mt-3">
              <label class="pb-2" for="Type">Type</label>
              <select class="form-control form-select form-control-a" id="Type">
                <option>All Type</option>
                <option>For Rent</option>
                <option>For Sale</option>
                <option>Open House</option>
              </select>
            </div>
          </div>
          <div class="col-md-6 mb-2">
            <div class="form-group mt-3">
              <label class="pb-2" for="city">City</label>
              <select class="form-control form-select form-control-a" id="city">
                <option>All City</option>
                <option>Alabama</option>
                <option>Arizona</option>
                <option>California</option>
                <option>Colorado</option>
              </select>
            </div>
          </div>
          <div class="col-md-6 mb-2">
            <div class="form-group mt-3">
              <label class="pb-2" for="bedrooms">Bedrooms</label>
              <select class="form-control form-select form-control-a" id="bedrooms">
                <option>Any</option>
                <option>01</option>
                <option>02</option>
                <option>03</option>
              </select>
            </div>
          </div>
          <div class="col-md-6 mb-2">
            <div class="form-group mt-3">
              <label class="pb-2" for="garages">Garages</label>
              <select class="form-control form-select form-control-a" id="garages">
                <option>Any</option>
                <option>01</option>
                <option>02</option>
                <option>03</option>
                <option>04</option>
              </select>
            </div>
          </div>
          <div class="col-md-6 mb-2">
            <div class="form-group mt-3">
              <label class="pb-2" for="bathrooms">Bathrooms</label>
              <select class="form-control form-select form-control-a" id="bathrooms">
                <option>Any</option>
                <option>01</option>
                <option>02</option>
                <option>03</option>
              </select>
            </div>
          </div>
          <div class="col-md-6 mb-2">
            <div class="form-group mt-3">
              <label class="pb-2" for="price">Min Price</label>
              <select class="form-control form-select form-control-a" id="price">
                <option>Unlimite</option>
                <option>$50,000</option>
                <option>$100,000</option>
                <option>$150,000</option>
                <option>$200,000</option>
              </select>
            </div>
          </div>
          <div class="col-md-12">
            <button type="submit" class="btn btn-b">Search Property</button>
          </div>
        </div>
      </form>
    </div>
  </div><!-- End Property Search Section -->>

  <!-- ======= Header/Navbar ======= -->
  <nav class="navbar navbar-default navbar-trans navbar-expand-lg fixed-top">
    <div class="container">
      <button class="navbar-toggler collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#navbarDefault" aria-controls="navbarDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span></span>
        <span></span>
        <span></span>
      </button>
      <a class="navbar-brand text-brand" href="/">Nira<span class="color-b"> Properties</span></a>

      <div class="navbar-collapse collapse justify-content-center" id="navbarDefault">
        <ul class="navbar-nav">

          <li class="nav-item">
            <a class="nav-link  {{(request()->is('/')) ? 'active': ''}}" href="/">Home</a>
          </li>

          <li class="nav-item">
            <a class="nav-link {{ (request()->is('about')) ? 'active': ''}}" href="/about">About</a>
          </li>

          <li class="nav-item">
            <a class="nav-link  {{(request()->is('properties')) ? 'active': ''}}" href="/properties">Properties</a>
          </li>

          <li class="nav-item">
            <a class="nav-link  {{(request()->is('blogs')) ? 'active': ''}}" href="/blogs">Blogs</a>
          </li>
          <!--<li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Pages</a>
            <div class="dropdown-menu">
              <a class="dropdown-item " href="property-single.html">Property Single</a>
              <a class="dropdown-item " href="blog-single.html">Blog Single</a>
              <a class="dropdown-item " href="agents-grid.html">Agents Grid</a>
              <a class="dropdown-item " href="agent-single.html">Agent Single</a>
            </div>
          </li>-->
          <li class="nav-item">
            <a class="nav-link {{(request()->is('contact')) ? 'active': ''}}" href="/contact">Contact</a>
          </li>
          <!--<li class="nav-item">
            <a class="nav-link {{(request()->is('admin')) ? 'active': ''}}" href="/admin/dashboard">Admin</a>
          </li>-->         
        </ul>
      </div>

      <button type="button" class="btn btn-b-n navbar-toggle-box navbar-toggle-box-collapse" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo01">
        <i class="bi bi-search"></i>
      </button>

    </div>
  </nav><!-- End Header/Navbar -->

    
    @if(isset($carouselProperties))
      <!-- ======= Intro Section ======= -->
      <div class="intro intro-carousel swiper position-relative">

        <div class="swiper-wrapper">
        
            @foreach ($carouselProperties as $carouselProperty )
              <div class="swiper-slide carousel-item-a intro-item bg-image" style="background-image: url({{asset('/property_images/'.$carouselProperty->id.'/'.$carouselProperty->image)}}">
                <div class="overlay overlay-a"></div>
                <div class="intro-content display-table">
                  <div class="table-cell">
                    <div class="container">
                      <div class="row">
                        <div class="col-lg-8">
                          <div class="intro-body">
                            <p class="intro-title-top"><?= $carouselProperty->localG.', '.$carouselProperty->state?>
                              <br> <?= $carouselProperty->postalCode ?>
                            </p>
                            <h1 class="intro-title mb-4 ">
                              <span class="color-b"><?= substr($carouselProperty->address,0, 3) ?></span> 
                              <br><?= substr($carouselProperty->address, 4) ?>
                            </h1>
                            <p class="intro-subtitle intro-price">
                              <a href="#"><span class="price-a"><?= $carouselProperty->type ?> | &#8358;<?= number_format($carouselProperty->amount,2) ?></span></a>
                            </p>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            @endforeach
        </div>
        <div class="swiper-pagination"></div>
      </div>
      <!-- End Intro Section -->
    @endif
  @yield('content')

  <!-- ======= Footer ======= -->
  <section class="section-footer">
    <div class="container">
      <div class="row">
        <div class="col-sm-12 col-md-4">
          <div class="widget-a">
            <div class="w-header-a">
              <h3 class="w-title-a text-brand">Nira Properties</h3>
            </div>
            <div class="w-body-a">
              <p class="w-text-a color-text-a">
                Enim minim veniam quis nostrud exercitation ullamco laboris nisi ut aliquip exea commodo consequat duis
                sed aute irure.
              </p>
            </div>
            <div class="w-footer-a">
              <ul class="list-unstyled">
                <li class="color-a">
                  <span class="color-text-a">Phone .</span> contact@example.com
                </li>
                <li class="color-a">
                  <span class="color-text-a">Email .</span> +54 356 945234
                </li>
              </ul>
            </div>
          </div>
        </div>
        <div class="col-sm-12 col-md-4 section-md-t3">
          <div class="widget-a">
            <div class="w-header-a">
              <h3 class="w-title-a text-brand">The Company</h3>
            </div>
            <div class="w-body-a">
              <div class="w-body-a">
                <ul class="list-unstyled">
                  <li class="item-list-a">
                    <i class="bi bi-chevron-right"></i> <a href="/about">About Us</a>
                  </li>
                  <li class="item-list-a">
                    <i class="bi bi-chevron-right"></i> <a href="/properties">Properties</a>
                  </li>
                  <li class="item-list-a">
                    <i class="bi bi-chevron-right"></i> <a href="/contact">Contact</a>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>
        <div class="col-sm-12 col-md-4 section-md-t3">
          <div class="widget-a">
            <div class="w-header-a">
              <h3 class="w-title-a text-brand">Others</h3>
            </div>
            <div class="w-body-a">
              
              <ul class="list-unstyled">
                <li class="item-list-a">
                    <i class="bi bi-chevron-right"></i> <a href="/blogs">Blogs</a>
                  </li>
                  <li class="item-list-a">
                    <i class="bi bi-chevron-right"></i> <a href="/testimony">Testimony</a>
                  </li>
                  <li class="item-list-a">
                    <i class="bi bi-chevron-right"></i> <a href="/private-policy">Privacy Policy</a>
                  </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <footer>
    <div class="container">
      <div class="row">
        <div class="col-md-12">
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
          <div class="copyright-footer">
            <p class="copyright color-text-a">
              &copy; Copyright
              <span class="color-a">Nira Properties</span> All Rights Reserved.
            </p>
          </div>
          <div class="credits">
            Designed by <a href="/">Codeden</a>
          </div>
        </div>
      </div>
    </div>
  </footer><!-- End  Footer -->

  <div id="preloader"></div>
  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="{{asset('estate/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
  <script src="{{asset('estate/vendor/swiper/swiper-bundle.min.js')}}"></script>

  <!-- Template Main JS File -->
  <script src="{{asset('estate/js/main.js')}}"></script>
  <script>
     function onSelectChange(){
        document.getElementById('form').submit();
     }
  </script>


</body>

</html>