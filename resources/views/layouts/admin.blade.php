<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="csrf-token" content="{{csrf_token()}}"> 
  <title>Nira - {{$title}}</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="{{asset('skydash-admin/template/vendors/feather/feather.css')}}">
  <link rel="stylesheet" href="{{asset('skydash-admin/template/vendors/ti-icons/css/themify-icons.css')}}">
  <link rel="stylesheet" href="{{asset('skydash-admin/template/vendors/css/vendor.bundle.base.css')}}">
  <link href="{{asset('skydash-admin/template/vendors/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet" type="text/css">
  <!-- endinject -->
  <!-- Plugin css for this page -->
  <link rel="stylesheet" href="{{asset('skydash-admin/template/vendors/datatables.net-bs4/dataTables.bootstrap4.css')}}">
  <link rel="stylesheet" href="{{asset('skydash-admin/template/vendors/ti-icons/css/themify-icons.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('skydash-admin/template/js/select.dataTables.min.css')}}">
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="{{asset('skydash-admin/template/css/vertical-layout-light/style.css')}}">
  <!-- endinject -->

  <link href="{{asset('images/favicon.ico')}}" rel="icon">
  <link href="{{asset('images/favicon.ico')}}" rel="apple-touch-icon">
 
  <script src="{{asset('skydash-admin/template/js/jquery.min.js')}}"></script>
  <script>
        // json to get state and local government to fill state and local goverment dropdown
        $.getJSON("{{asset('states-localgovts/states-localgovts.json')}}",function(states){
          $.each(states.states, function(key, value){
            $('#state').append($("<option></option>").attr('value', states.states[key].state).text(value.state));
            $('#state').on('change', function(){
              var state =$(this).val();
              if (states.states[key].state == state){
                //$('#state').find("option:gt(0)").remove();
                $('#localG').children("option").not(':first').remove();
                $.each(states.states[key].local, function(key, value){
                  $('#localG').append($("<option></option>").attr('value', value).text(value));
                });
              }
            })
          });
        });

       
    $(".state").select2({
      multiple: true,
      placeholder: "Select state",
      allowClear: true
    });

    $(".amenities").select2({
      multiple: true,
      placeholder: "Select Amenities",
      allowClear: true
    });
  
  </script>
</head>
<body>
  <div class="container-scroller">
    <!-- partial:partials/_navbar.html -->
    <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
      <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
        <a class="navbar-brand brand-logo mr-5" href="{{route('dashboard')}}"><img src="{{asset('images/cover.png')}}"></a>
        <a class="navbar-brand brand-logo-mini" href="{{route('dashboard')}}"><img src="{{asset('images/cover.png')}}"></a>
      </div>
      <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
        <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
          <span class="icon-menu"></span>
        </button>

        <ul class="navbar-nav navbar-nav-right">
          @if(Auth::user()->hasRole('ROLE_ADMIN'))
          <li class="nav-item dropdown">
            <a class="nav-link count-indicator dropdown-toggle" id="notificationDropdown" href="#" data-toggle="dropdown">
              <i class="icon-bell mx-0"></i>
              <span class="count"></span>
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="notificationDropdown">
              <p class="mb-0 font-weight-normal float-left dropdown-header">Notifications</p>
              <a class="dropdown-item preview-item">
                <div class="preview-thumbnail">
                  <div class="preview-icon bg-info">
                    <i class="ti-user mx-0"></i>
                  </div>
                </div>
                <div class="preview-item-content">
                  @if($usersCount!==0)
                  <h6 class="preview-subject font-weight-normal"> <span>{{$usersCount}}</span> New user registration</h6>
                  @else
                  <h6 class="preview-subject font-weight-normal"> No new user registration</h6>
                  @endif
                </div>
              </a>
            </div>
          </li>
          @endif
          <li class="nav-item nav-profile dropdown">
            <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" id="profileDropdown">
              <img src="{{isset($profile->profile_image) && $profile->profile_image !=='' ? url('uploads/'.$profile->id.'/'.$profile->profile_image) : asset('images/user.jpg') }}" alt="profile image"/>
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
              <a class="dropdown-item" href="/logout" onclick="event.preventDefault();
                  document.getElementById('logout-form').submit()">
                <i class="ti-power-off text-success"></i>
                Logout
              </a>
            </div>
          </li>
        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
          <span class="icon-menu"></span>
        </button>
      </div>
    </nav>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <div id="right-sidebar" class="settings-panel">
        <i class="settings-close ti-close"></i>
        <ul class="nav nav-tabs border-top" id="setting-panel" role="tablist">
          <li class="nav-item">
            <a class="nav-link active" id="todo-tab" data-toggle="tab" href="#todo-section" role="tab" aria-controls="todo-section" aria-expanded="true">TO DO LIST</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="chats-tab" data-toggle="tab" href="#chats-section" role="tab" aria-controls="chats-section">CHATS</a>
          </li>
        </ul>
        <div class="tab-content" id="setting-content">
          <div class="tab-pane fade show active scroll-wrapper" id="todo-section" role="tabpanel" aria-labelledby="todo-section">
            <div class="add-items d-flex px-3 mb-0">
              <form class="form w-100">
                <div class="form-group d-flex">
                  <input type="text" class="form-control todo-list-input" placeholder="Add To-do">
                  <button type="submit" class="add btn btn-primary todo-list-add-btn" id="add-task">Add</button>
                </div>
              </form>
            </div>
            <div class="list-wrapper px-3">
              <ul class="d-flex flex-column-reverse todo-list">
                <li>
                  <div class="form-check">
                    <label class="form-check-label">
                      <input class="checkbox" type="checkbox">
                      Team review meeting at 3.00 PM
                    </label>
                  </div>
                  <i class="remove ti-close"></i>
                </li>
                <li>
                  <div class="form-check">
                    <label class="form-check-label">
                      <input class="checkbox" type="checkbox">
                      Prepare for presentation
                    </label>
                  </div>
                  <i class="remove ti-close"></i>
                </li>
                <li>
                  <div class="form-check">
                    <label class="form-check-label">
                      <input class="checkbox" type="checkbox">
                      Resolve all the low priority tickets due today
                    </label>
                  </div>
                  <i class="remove ti-close"></i>
                </li>
                <li class="completed">
                  <div class="form-check">
                    <label class="form-check-label">
                      <input class="checkbox" type="checkbox" checked>
                      Schedule meeting for next week
                    </label>
                  </div>
                  <i class="remove ti-close"></i>
                </li>
                <li class="completed">
                  <div class="form-check">
                    <label class="form-check-label">
                      <input class="checkbox" type="checkbox" checked>
                      Project review
                    </label>
                  </div>
                  <i class="remove ti-close"></i>
                </li>
              </ul>
            </div>
            <h4 class="px-3 text-muted mt-5 font-weight-light mb-0">Events</h4>
            <div class="events pt-4 px-3">
              <div class="wrapper d-flex mb-2">
                <i class="ti-control-record text-primary mr-2"></i>
                <span>Feb 11 2018</span>
              </div>
              <p class="mb-0 font-weight-thin text-gray">Creating component page build a js</p>
              <p class="text-gray mb-0">The total number of sessions</p>
            </div>
            <div class="events pt-4 px-3">
              <div class="wrapper d-flex mb-2">
                <i class="ti-control-record text-primary mr-2"></i>
                <span>Feb 7 2018</span>
              </div>
              <p class="mb-0 font-weight-thin text-gray">Meeting with Alisa</p>
              <p class="text-gray mb-0 ">Call Sarah Graves</p>
            </div>
          </div>
          <!-- To do section tab ends -->
          <div class="tab-pane fade" id="chats-section" role="tabpanel" aria-labelledby="chats-section">
            <div class="d-flex align-items-center justify-content-between border-bottom">
              <p class="settings-heading border-top-0 mb-3 pl-3 pt-0 border-bottom-0 pb-0">Friends</p>
              <small class="settings-heading border-top-0 mb-3 pt-0 border-bottom-0 pb-0 pr-3 font-weight-normal">See All</small>
            </div>
            <ul class="chat-list">
              <li class="list active">
                <div class="profile"><img src="{{asset('skydash-admin/template/images/faces/face1.jpg')}}" alt="image"><span class="online"></span></div>
                <div class="info">
                  <p>Thomas Douglas</p>
                  <p>Available</p>
                </div>
                <small class="text-muted my-auto">19 min</small>
              </li>
              <li class="list">
                <div class="profile"><img src="{{asset('skydash-admin/template/images/faces/face2.jpg')}}" alt="image"><span class="offline"></span></div>
                <div class="info">
                  <div class="wrapper d-flex">
                    <p>Catherine</p>
                  </div>
                  <p>Away</p>
                </div>
                <div class="badge badge-success badge-pill my-auto mx-2">4</div>
                <small class="text-muted my-auto">23 min</small>
              </li>
              <li class="list">
                <div class="profile"><img src="{{asset('skydash-admin/template/images/faces/face3.jpg')}}" alt="image"><span class="online"></span></div>
                <div class="info">
                  <p>Daniel Russell</p>
                  <p>Available</p>
                </div>
                <small class="text-muted my-auto">14 min</small>
              </li>
              <li class="list">
                <div class="profile"><img src="{{asset('skydash-admin/template/images/faces/face4.jpg')}}" alt="image"><span class="offline"></span></div>
                <div class="info">
                  <p>James Richardson</p>
                  <p>Away</p>
                </div>
                <small class="text-muted my-auto">2 min</small>
              </li>
              <li class="list">
                <div class="profile"><img src="{{asset('skydash-admin/template/images/faces/face5.jpg')}}" alt="image"><span class="online"></span></div>
                <div class="info">
                  <p>Madeline Kennedy</p>
                  <p>Available</p>
                </div>
                <small class="text-muted my-auto">5 min</small>
              </li>
              <li class="list">
                <div class="profile"><img src="{{asset('skydash-admin/template/images/faces/face6.jpg')}}" alt="image"><span class="online"></span></div>
                <div class="info">
                  <p>Sarah Graves</p>
                  <p>Available</p>
                </div>
                <small class="text-muted my-auto">47 min</small>
              </li>
            </ul>
          </div>
          <!-- chat tab ends -->
        </div>
      </div>
      <!-- partial -->
      <!-- partial:partials/_sidebar.html -->
      <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
          <li class="nav-item {{(request()->is('/')) ? 'active': ''}}">
            <a class="nav-link" href="{{route('dashboard')}}">
              <i class="icon-grid menu-icon"></i>
              <span class="menu-title">Dashboard</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#properties" aria-expanded="false" aria-controls="ui-basic">
              <i class="icon-layout menu-icon"></i>
              <span class="menu-title">Properties</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="properties">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="{{route('add-property')}}">Add property</a></li>
                <li class="nav-item"> <a class="nav-link" href="{{route('list-properties')}}">List Properties</a></li>
              </ul>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#blogs" aria-expanded="false" aria-controls="ui-basic">
              <i class="icon-layout menu-icon"></i>
              <span class="menu-title">Blogs</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="blogs">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="{{route('post')}}">Post Blog</a></li>
                <li class="nav-item"> <a class="nav-link" href="{{route('posts')}}">Blog Posts</a></li>
              </ul>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#profile" aria-expanded="false" aria-controls="profile">
              <i class="icon-head menu-icon"></i>
              <span class="menu-title">Profile</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="profile">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="{{route('setup-profile')}}">Setup Profile</a></li>
                <li class="nav-item"> <a class="nav-link" href="{{route('reset-password')}}">Reset Password</a></li>
              </ul>
            </div>
          </li>

          @can('is_agent')

          @endcan   
          @if(Auth::user()->hasRole('ROLE_ADMIN'))
          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#settings" aria-expanded="false" aria-controls="ui-basic">
              <i class="icon-layout menu-icon"></i>
              <span class="menu-title">Settings</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="settings">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="{{route('settings')}}">Settings</a></li>
              </ul>
            </div>
          </li>
          @endif
          <li class="nav-item logout-item">
            <a class="nav-link" href="/logout" onclick="event.preventDefault();
       document.getElementById('logout-form').submit()">
              <i class="ti-power-off menu-icon"></i>
              <span class="menu-title">Logout</span>
            </a>
          </li>
        </ul>
      </nav>

      <!-- partial -->
      <div class="main-panel">
      @yield('content')
        <!-- content-wrapper ends -->
        <!-- partial:partials/_footer.html -->
        <footer class="footer">
          <div class="d-sm-flex justify-content-center justify-content-sm-between">
            <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © {{$date}}<a href="/" target="_blank"> Nira Properties</a> All rights reserved.</span>
            <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Designed by codeden</span>
          </div>
        </footer>
        <!-- partial -->
      </div>
      <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->


  <script src="{{asset('skydash-admin/template/js/jquery.min.js')}}"></script>
  <!-- plugins:js -->
  <script src="{{asset('skydash-admin/template/vendors/js/vendor.bundle.base.js')}}"></script>
  <!-- endinject -->
  <!-- Plugin js for this page -->
  <script src="{{asset('skydash-admin/template/vendors/chart.js/Chart.min.js')}}"></script>
  <script src="{{asset('skydash-admin/template/vendors/datatables.net/jquery.dataTables.js')}}"></script>
  <script src="{{asset('skydash-admin/template/vendors/datatables.net-bs4/dataTables.bootstrap4.js')}}"></script>
  <script src="{{asset('skydash-admin/template/js/dataTables.select.min.js')}}"></script>

  <!-- End plugin js for this page -->
  <!-- inject:js -->
  <script src="{{asset('skydash-admin/template/js/off-canvas.js')}}"></script>
  <script src="{{asset('skydash-admin/template/js/hoverable-collapse.js')}}"></script>
  <script src="{{asset('skydash-admin/template/js/template.js')}}"></script>
  <script src="{{asset('skydash-admin/template/js/settings.js')}}"></script>
  <script src="{{asset('skydash-admin/template/js/todolist.js')}}"></script>
 <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
  <script src="{{asset('skydash-admin/template/js/select2.js')}}"></script>
  <!-- endinject -->
  <!-- Custom js for this page-->
  <script src="{{asset('skydash-admin/template/js/dashboard.js')}}"></script>
  <script src="{{asset('skydash-admin/template/js/Chart.roundedBarCharts.js')}}"></script>
  <script src="https://cdn.tiny.cloud/1/kwyfuup9xar7ipht7wq534bbq5w3vvzhqvvw3h3slpwonyku/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>
  <!-- End custom js for this page-->
  <form id='logout-form' action="{{route('logout')}}"
    method="POST" style='display:none'>
        {{csrf_field()}}
  </form>
  <script>
    (function($) {
      'use strict';
      $(function() {
        $('#list-properties').dataTable( {
          "aLengthMenu":[[10,2,5,15,20,50,100,200, 500,-1], [10,2,5,10,15,20,50,100,200,500, "All"]],
          "iDisplayLenghth": 10,
            "paginate": true,
            "sort": true
          } );
      });
    })(jQuery);


    $(document).on('change', '.file-input', function() {
        var filesCount = $(this)[0].files.length;
        
        var textbox = $(this).prev();
      
        if (filesCount === 1) {
          var fileName = $(this).val().split('\\').pop();
          textbox.text(fileName);
        } else {
          textbox.text(filesCount + ' files selected');
        }
    });

        // grant user access
        $('.grant-access').on('click',function(){
  
          $('.user-group').empty();
          $('.user-type-group').empty();
          $('.message_success').empty();
          var user =  $('#user').val();
          var access_type =  $('#access-type').val(); 
          var token =$("meta[name='csrf-token']").attr("content");
          values= {
            "user":user,
            "access_type": access_type,
            "_token": token
          }
          $.ajax({
              type: "POST",
              url: "grant_access",
              data: values,
              dataType: 'json',
          }).done(function(result){
            if (result.user=='failure'){
              $(".user-group").append(result.error_message); 
            }else if(result.access_type=='failure'){
                $(".user-type-group").append(result.error_message)
            }              
            if (result.status=='success'){
              $(".message_success").prepend(result.message); 
              setTimeout(function(){
              location.reload();
              }, 3000);
            }
          });
        });   

       $('.deleteProperty').on('click', function(){
          var delProperty = $(this).attr('id');
          delProperty = delProperty.split(' ');
          $('.del_property').attr('id', 'del_property'+delProperty[1])
          $('#del_property'+delProperty[1]).on('click', function(){
          var token =$("meta[name='csrf-token']").attr("content");
          values= {
            "PropertyId": delProperty[1],
            "_token": token,
          }

          // delete staff
          $.ajax({
              type: "DELETE",
              url: "/delete-property/"+delProperty[1],
              data: values,
          }).done(function(result){
            if (result.success=='success'){
              $('#confirm-delete').modal('hide');
              $("#property-body").prepend("<div class='status alert alert-success text-center col-sm-9 offset-sm-1'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times</a><strong >" +result.message+"</strong></div>"); 
              setTimeout(function(){
              location.reload();
              }, 6000);
            }else if(result.success=='fail'){
                $("#property-body").prepend("<div class='status alert alert-danger text-center col-sm-9 offset-sm-1'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times</a><strong >" +result.message+"</strong></div>");
              setTimeout(function(){
              location.reload();
              }, 6000);                  
            }
          });
          });
        });
        
        

       $('.deleteBlog').on('click', function(){
          var delBlog = $(this).attr('id');
          delBlog = delBlog.split(' ');
          $('.del_blog').attr('id', 'del_blog'+delBlog[1])
          $('#del_blog'+delBlog[1]).on('click', function(){
          var token =$("meta[name='csrf-token']").attr("content");
          values= {
            "BlogId": delBlog[1],
            "_token": token,
          }

          // delete staff
          $.ajax({
              type: "DELETE",
              url: "/delete-blog-post/"+delBlog[1],
              data: values,
          }).done(function(result){
            if (result.success=='success'){
              $('#confirm-delete').modal('hide');
              $("#blog-body").prepend("<div class='status alert alert-success text-center col-sm-9 offset-sm-1'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times</a><strong >" +result.message+"</strong></div>"); 
              setTimeout(function(){
              location.reload();
              }, 6000);
            }else if(result.success=='fail'){
                $("#blog-body").prepend("<div class='status alert alert-danger text-center col-sm-9 offset-sm-1'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times</a><strong >" +result.message+"</strong></div>");
              setTimeout(function(){
              location.reload();
              }, 6000);                  
            }
          });
          });
        });   
                

    /*  tinymce.init({
      selector: 'textarea#description',
      skin: 'bootstrap',
      plugins: 'lists, link, image, media',
      toolbar: 'h1 h2 bold italic strikethrough blockquote bullist numlist backcolor | link image media | removeformat help',
      menubar: true,
    });*/

  /*tinymce.init({
    selector: 'textarea#description',
    plugins: [
      // Core editing features
      'anchor', 'autolink', 'charmap', 'codesample', 'emoticons', 'image', 'link', 'lists', 'media', 'searchreplace', 'table', 'visualblocks', 'wordcount',
      // Your account includes a free trial of TinyMCE premium features
      // Try the most popular premium features until Mar 19, 2025:
      'checklist', 'mediaembed', 'casechange', 'export', 'formatpainter', 'pageembed', 'a11ychecker', 'tinymcespellchecker', 'permanentpen', 'powerpaste', 'advtable', 'advcode', 'editimage', 'advtemplate', 'ai', 'mentions', 'tinycomments', 'tableofcontents', 'footnotes', 'mergetags', 'autocorrect', 'typography', 'inlinecss', 'markdown','importword', 'exportword', 'exportpdf'
    ],
    toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table mergetags | addcomment showcomments | spellcheckdialog a11ycheck typography | align lineheight | checklist numlist bullist indent outdent | emoticons charmap | removeformat',
    tinycomments_mode: 'embedded',
    tinycomments_author: 'Author name',
    mergetags_list: [
      { value: 'First.Name', title: 'First Name' },
      { value: 'Email', title: 'Email' },
    ],
    ai_request: (request, respondWith) => respondWith.string(() => Promise.reject('See docs to implement AI Assistant')),
  });*/

  </script>
  
</body>

</html>

