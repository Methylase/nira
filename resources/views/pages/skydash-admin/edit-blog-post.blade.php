@extends('layouts.admin')
  @section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-12 grid-margin">
                <div class="card">
                    <div class="card-body">
                        @if(session()->has('successMessage'))
                            <div class="offset-md-1 col-md-10 offset-sm-1 col-sm-10 alert
                            alert-success alert-dismissable text-center" style="margin-top:20px">
                                <a href='' class='close' data-dismiss='alert' aria-label='close'> &times</a>
                                <strong>
                                Success
                                </strong>
                                {{session('successMessage')}}
                            </div>
                        @endif
                        @if(session()->has('errorMessager'))
                            <div class="offset-md-1 col-md-10 offset-sm-1 col-sm-10 alert
                            alert-danger alert-dismissable text-center" style="margin-top:20px">
                            <a href='' class='close' data-dismiss='alert' aria-label='close'> &times</a>
                            <strong>
                                Danger
                            </strong>
                            {{session('errorMessage')}}
                            </div>
                        @endif
                    <h4 class="card-title">{{$blog->title}}</h4>
                    <img src="{{isset($blog->image) && $blog->image !=='' ? url('blog_images/'.$blog->id.'/'.$blog->image) : asset('images/user.jpg') }}" class="profile-img"  alt="Blog image"/>
                        
                    <form class="form-sample" action="/update-blog-post" enctype="multipart/form-data" method="POST">
                        {{method_field('PUT')}}

                        {{csrf_field()}}
                        <input type="hidden" name="id" value="{{old('id', $blog->id)}}">

                        <hr>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="blog-image" class="control-label">Upload image</label>
                                    <div class="file-drop-area">
                                        <span class="choose-file-button">Choose files</span>
                                        <span class="file-message">or drag and drop blog post image here</span>
                                        <input type="file" name="image" class="form-control file-input">
                                   
                                    </div>
                                    <br>
                                        @if($errors->has('image'))
                                            <div class="text-danger">
                                                {{ $blogImage= $errors->first('image')}}
                                            </div>
                                        @else
                                            {{$blogImage=''}}
                                        @endif

                                        @if(session()->has('image_error'))
                                            <div class="text-danger">
                                                {{session('image_error')}}
                                            </div>
                                        @endif
                                </div>
                            </div>
                        </div>
                        <br>                    
                        <div class="row">
                            <div class="col-md-6 col-sm-12 col-lg-6">
                                <div class="form-group row">
                                    <div class="col-sm-12">
                                        <label class="control-label">Type</label>
                                        <select name="type" class="form-control">

                                            @if(  $blog->type ==="none" || $blog->type =='Travel')
                                                <option value="">Select blog Type</option>
                                                <option selected value="Travel">Travel</option>
                                                <option value="Food">Food</option>
                                                <option value="Lifestyle">Lifestyle</option>
                                                <option value="beautification">Beautification</option>
                                                <option value="Business Talk">Business Talk</option>
                                                
                                            @elseif( $blog->type ==="Food")
                                                <option value="">Select blog Type</option>
                                                <option value="Travel">Travel</option>
                                                <option selected value="Food">Food</option>
                                                <option value="Lifestyle">Lifestyle</option>
                                                <option value="Beautification">Beautification</option>
                                                <option value="Business Talk">Business Talk</option>                              
                                               
                                            @elseif($blog->type ==="Lifestyle")
                                                <option value="">Select blog Type</option>
                                                <option value="Travel">Travel</option>
                                                <option value="Food">Food</option>
                                                <option selected value="Lifestyle">Lifestyle</option>
                                                <option value="Beautification">Beautification</option>
                                                <option value="Business Talk">Business Talk</option>      

                                            @elseif($blog->type ==="Beautification")
                                                <option value="">Select blog Type</option>
                                                <option value="Travel">Travel</option>
                                                <option value="Food">Food</option>
                                                <option value="Lifestyle">Lifestyle</option>
                                                <option selected value="Beautification">Beautification</option>
                                                <option value="Business Talk">Business Talk</option>
                                            @elseif($blog->type ==="Business Talk")
                                                <option value="">Select blog Type</option>
                                                <option value="Travel">Travel</option>
                                                <option value="Food">Food</option>
                                                <option value="Lifestyle">Lifestyle</option>
                                                <option value="Beautification">Beautification</option>
                                                <option selected value="Business Talk">Business Talk</option>                                                
                                            @endif 
                                            
                                        </select>
                                        @if($errors->has('type'))
                                            <span class="text-danger">
                                                {{ $type= $errors->first('type')}}
                                            </span>
                                        @else
                                            {{$type=''}}
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>                         
                        <div class="row">
                            <div class="col-md-6 col-sm-12 col-lg-6">
                                <div class="form-group row">
                                    <div class="col-sm-12">
                                        <label class="control-label">Title</label>
                                        <input type="text"  name="title" value="{{ $blog->title !== null ? $blog->title :old('title', $blog->title) }}" class="form-control" placeholder="Enter blog title" />
                                        @if($errors->has('title'))
                                            <span class="text-danger">
                                                {{ $title= $errors->first('title')}}
                                            </span>   
                                        @else
                                            {{$title=''}}
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>                                              
                        <div class="row">
                            <div class="col-md-6 col-sm-12 col-lg-6">
                                <div class="form-group row">
                                    <div class="col-sm-12">
                                        <label for="Blog description" class="control-label">Description</label>
                                        <textarea name="description" id="description" class="form-control" placeholder="Enter blog description" rows="10" >{{ $blog->description !== null ? $blog->description :old('description', $blog->description) }}</textarea>
                                        @if($errors->has('description'))
                                            <span class="text-danger">
                                                {{ $description=$errors->first('description')}}
                                            </span>
                                        @else
                                            {{$description=''}}
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 offset-sm-12 col-lg-6">
                            <div class="form-group d-flex justify-content-end">
                                <button type="submit"   class="btn btn-success" ><i class="fa fa-save"></i> Save Blog Post </button>
                            </div>
                            </div>
                        </div>
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- content-wrapper ends -->
@endsection
