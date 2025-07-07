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
                    <h4 class="card-title"> Edit Property at <?= $property->address ?></h4>
                
                    <form class="form-sample" action="/update-property" enctype="multipart/form-data" method="POST">
                    {{method_field('PUT')}}

                    {{csrf_field()}}
                    <input type="hidden" name="id" value="{{old('id', $property->id)}}">
                        <hr>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="profile-image" class="control-label">Upload image</label>
                                    <div class="file-drop-area">
                                        <span class="choose-file-button">Choose files</span>
                                        <span class="file-message">or drag and drop property image here</span>
                                        <input type="file" name="propertyImage" class="form-control file-input">
                                   
                                    </div>
                                    <br>
                                        @if($errors->has('propertyImage'))
                                            <div class="text-danger">
                                                {{ $propertyImage= $errors->first('propertyImage')}}
                                            </div>
                                        @else
                                            {{$propertyImage=''}}
                                        @endif

                                        @if(session()->has('image_error'))
                                            <div class="text-danger">
                                                {{session('image_error')}}
                                            </div>
                                        @endif
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Upload Video</label>
                                    <div class="file-drop-area">
                                        <span class="choose-file-button">Choose files</span>
                                        <span class="file-message">or drag and drop property video</span>
                                        <input type="file"  name="propertyVideo" class="form-control file-input" />
                                    </div>
                                    <br>
                                    @if(session()->has('video_error'))
                                        <div class="text-danger">
                                            {{session('video_error')}}
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <br>
                        <p class="card-description">
                            Basic property information
                        </p>
                      
                        <hr>
                        <br>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Property Status</label>
                                    <div class="col-sm-9">
                                        <select name="status" class="form-control">
                                            @if(  $property->status ==="none" || $property->status ===NULL)
                                                <option value="">Select property status</option>
                                                <option value="rent">Rent</option>
                                                <option value="sale">Sale</option>
                                                <option value="loan">Loan</option>
                                                
                                            @elseif( $property->status ==="rent")
                                                <option value="">Select property status</option>
                                                <option value="{{$property->status ==='rent'? $property->status :old('maritalStatus', $property->status) }}" selected>{{ucfirst($property->status)}}</option>
                                                <option value="sale">Sale</option>
                                                <option value="loan">Loan</option>                                
                                               
                                            @elseif($property->status ==="sale")
                                                <option value="">Select property status</option>
                                                <option value="rent">Rent</option>
                                                <option value="{{$property->status ==='rent'? $property->status :old('maritalStatus', $property->status) }}" selected>{{ucfirst($property->status)}}</option>
                                                <option value="loan">Loan</option>       

                                            @elseif($property->status ==="single")
                                                <option value="">Select property status</option>
                                                <option value="rent">Rent</option>
                                                <option value="loan">Loan</option>  
                                                <option value="{{$property->status ==='loan'? $property->status :old('maritalStatus', $property->status) }}" selected>{{ucfirst($property->status)}}</option>
                                            @endif 

                                        </select>
                                        @if($errors->has('status'))
                                            <span class="text-danger">
                                                {{ $status= $errors->first('status')}}
                                            </span>
                                        @else
                                            {{$status=''}}
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Area Covered</label>
                                    <div class="col-sm-9">
                                        <input type="text"  name="area"  value="{{ $property->area !== null ? $property->area :old('phone', $property->area) }}" class="form-control" placeholder="Enter land area covered" />
                                        @if($errors->has('area'))
                                            <span class="text-danger">
                                                {{ $area= $errors->first('area')}}
                                            </span>   
                                        @else
                                            {{$area=''}}
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Number of bed</label>
                                    <div class="col-sm-9">
                                        <select name="bed" class="form-control form-control-lg" >

                                            @if(  $property->bed ==="" || $property->bed ===NULL)
                                                <option value="">Select number of bed(s)</option>
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="4">4</option>
                                                <option value="5">5</option>
                                                <option value="6">6</option>
                                                
                                            @elseif( $property->bed ==="1")
                                                <option value="">Select number of bed(s)</option>
                                                <option value="{{$property->bed ==='1'? $property->bed :old('bed', $property->bed) }}" selected>{{ucfirst($property->bed)}}</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="4">4</option>
                                                <option value="5">5</option>
                                                <option value="6">6</option>                               
                                               
                                            @elseif( $property->bed ==="2")
                                                <option value="">Select number of bed(s)</option>
                                                <option value="1">1</option>
                                                <option value="{{$property->bed ==='2'? $property->bed :old('bed', $property->bed) }}" selected>{{ucfirst($property->bed)}}</option>
                                                <option value="3">3</option>
                                                <option value="4">4</option>
                                                <option value="5">5</option>
                                                <option value="6">6</option>       

                                            @elseif( $property->bed ==="3")
                                                <option value="">Select number of bed(s)</option>
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="{{$property->bed ==='3'? $property->bed :old('bed', $property->bed) }}" selected>{{ucfirst($property->bed)}}</option>
                                                <option value="4">4</option>
                                                <option value="5">5</option>
                                                <option value="6">6</option> 
                                            @elseif( $property->bed ==="4")
                                                <option value="">Select number of bed(s)</option>
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="{{$property->bed ==='4'? $property->bed :old('bed', $property->bed) }}" selected>{{ucfirst($property->bed)}}</option>
                                                <option value="5">5</option>
                                                <option value="6">6</option>  
                                            @elseif( $property->bed ==="5")
                                                <option value="">Select number of bed(s)</option>
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="4">4</option>
                                                <option value="{{$property->bed ==='5'? $property->bed :old('bed', $property->bed) }}" selected>{{ucfirst($property->bed)}}</option>
                                                <option value="6">6</option> 
                                            @elseif( $property->bed ==="6")
                                                <option value="">Select number of bed(s)</option>
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="4">4</option>
                                                <option value="5">5</option>
                                                 <option value="{{$property->bed ==='6'? $property->bed :old('bed', $property->bed) }}" selected>{{ucfirst($property->bed)}}</option>                                                                                                                                               
                                            @endif 
                                        </select>
                                        @if($errors->has('bed'))
                                            <span class="text-danger">
                                                {{ $bed= $errors->first('bed')}}
                                            </span>
                                        @else
                                            {{$bed=''}}
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Number of baths</label>
                                    <div class="col-sm-9">
                                        <select name="baths" class="form-control form-control-lg" >
                                            @if(  $property->baths ==="" || $property->baths ===NULL)
                                                <option value="">Select number of baths</option>
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="4">4</option>
                                                <option value="5">5</option>
                                                <option value="6">6</option>
                                                
                                            @elseif( $property->baths ==="1")
                                                <option value="">Select number of baths</option>
                                                <option value="{{$property->baths ==='1'? $property->baths :old('baths', $property->baths) }}" selected>{{ucfirst($property->baths)}}</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="4">4</option>
                                                <option value="5">5</option>
                                                <option value="6">6</option>                               
                                               
                                            @elseif( $property->baths ==="2")
                                                <option value="">Select number of baths</option>
                                                <option value="1">1</option>
                                                <option value="{{$property->baths ==='2'? $property->baths :old('baths', $property->baths) }}" selected>{{ucfirst($property->baths)}}</option>
                                                <option value="3">3</option>
                                                <option value="4">4</option>
                                                <option value="5">5</option>
                                                <option value="6">6</option>       

                                            @elseif( $property->baths ==="3")
                                                <option value="">Select number of baths</option>
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="{{$property->baths ==='3'? $property->baths :old('baths', $property->baths) }}" selected>{{ucfirst($property->baths)}}</option>
                                                <option value="4">4</option>
                                                <option value="5">5</option>
                                                <option value="6">6</option> 
                                            @elseif( $property->baths ==="4")
                                                <option value="">Select number of baths</option>
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="{{$property->baths ==='4'? $property->baths :old('baths', $property->baths) }}" selected>{{ucfirst($property->baths)}}</option>
                                                <option value="5">5</option>
                                                <option value="6">6</option>  
                                            @elseif( $property->baths ==="5")
                                                <option value="">Select number of baths</option>
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="4">4</option>
                                                <option value="{{$property->baths ==='5'? $property->baths :old('baths', $property->baths) }}" selected>{{ucfirst($property->baths)}}</option>
                                                <option value="6">6</option> 
                                            @elseif( $property->baths ==="6")
                                                <option value="">Select number of baths</option>
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="4">4</option>
                                                <option value="5">5</option>
                                                <option value="{{$property->baths ==='6'? $property->baths :old('baths', $property->baths) }}" selected>{{ucfirst($property->baths)}}</option>
                                            @endif 
                                        </select>
                                        @if($errors->has('baths'))
                                            <span class="text-danger">
                                                {{ $baths=$errors->first('baths')}}
                                            </span>
                                        @else
                                            {{$baths=''}}
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Number of garage</label>
                                    <div class="col-sm-9">
                                        <select name="garage" class="form-control form-control-lg" >

                                            @if(  $property->garage ==="" || $property->garage ===NULL)
                                                <option value="">Select number of garage</option>
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="4">4</option>
                                                <option value="5">5</option>
                                                <option value="6">6</option>
                                                
                                            @elseif( $property->garage ==="1")
                                                <option value="">Select number of garage</option>
                                                <option value="{{$property->garage ==='1'? $property->garage :old('garage', $property->garage) }}" selected>{{ucfirst($property->garage)}}</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="4">4</option>
                                                <option value="5">5</option>
                                                <option value="6">6</option>                               
                                               
                                            @elseif( $property->garage ==="2")
                                                <option value="">Select number of garage</option>
                                                <option value="1">1</option>
                                                <option value="{{$property->garage ==='2'? $property->garage :old('garage', $property->garage) }}" selected>{{ucfirst($property->garage)}}</option>
                                                <option value="3">3</option>
                                                <option value="4">4</option>
                                                <option value="5">5</option>
                                                <option value="6">6</option>       

                                            @elseif( $property->garage ==="3")
                                                <option value="">Select number of garage</option>
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="{{$property->garage ==='3'? $property->garage :old('garage', $property->garage) }}" selected>{{ucfirst($property->garage)}}</option>
                                                <option value="4">4</option>
                                                <option value="5">5</option>
                                                <option value="6">6</option> 
                                            @elseif( $property->garage ==="4")
                                                <option value="">Select number of garage</option>
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="{{$property->garage ==='4'? $property->garage :old('garage', $property->garage) }}" selected>{{ucfirst($property->garage)}}</option>
                                                <option value="5">5</option>
                                                <option value="6">6</option>  
                                            @elseif( $property->garage ==="5")
                                                <option value="">Select number of garage</option>
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="4">4</option>
                                                <option value="{{$property->garage ==='5'? $property->garage :old('garage', $property->garage) }}" selected>{{ucfirst($property->garage)}}</option>
                                                <option value="6">6</option> 
                                            @elseif( $property->garage ==="6")
                                                <option value="">Select number of garage</option>
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="4">4</option>
                                                <option value="5">5</option>
                                                <option value="{{$property->garage ==='6'? $property->garage :old('garage', $property->garage) }}" selected>{{ucfirst($property->garage)}}</option>
                                            @endif 
                                        </select>
                                        @if($errors->has('garage'))
                                            <span class="text-danger">
                                                {{ $garage=$errors->first('garage')}}
                                            </span>
                                        @else
                                            {{$garage=''}}
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Amenities</label>
                                    <div class="col-sm-9">
                                        <select name="amenities[]" class="form-control form-control-lg amenities" multiple="multiple" >

                                            @if(  $property->amenities ==="" || $property->amenities ===NULL)
                                                <option value="">Select amenities</option>
                                                <option value="balcony">Balcony</option>
                                                <option value="outdoor kitchen">Outdoor Kitchen</option>
                                                <option value="cable tv">Cable Tv</option>
                                                <option value="deck">Deck</option>
                                                <option value="tennis courts">Tennis Courts</option>
                                                <option value="internet">Internet</option>
                                                <option value="parking">Parking</option>
                                                <option value="sun room">Sun Room</option>
                                                <option value="concrete flooring">Concrete Flooring</option>
                                                
                                            @else
                                                <option value="">Select amenities</option>
                                                <option value="balcony" <?= in_array('balcony',array_values((array)json_decode($property->amenities))) == true ? 'selected' : '' ?> >Balcony</option>
                                                <option value="outdoor kitchen" <?= in_array('outdoor kitchen',array_values((array)json_decode($property->amenities))) ? 'selected' : '' ?> >Outdoor Kitchen</option>
                                                <option value="cable tv" <?= in_array('cable tv',array_values((array)json_decode($property->amenities))) == true ? 'selected' : '' ?> >Cable Tv</option>
                                                <option value="deck" <?= in_array('deck',array_values((array)json_decode($property->amenities))) == true? 'selected' : '' ?> >Deck</option>
                                                <option value="tennis courts" <?= in_array('tennis courts',array_values((array)json_decode($property->amenities))) == true ? 'selected' : '' ?> >Tennis Courts</option>
                                                <option value="internet" <?= in_array('internet',array_values((array)json_decode($property->amenities))) == true? 'selected' : '' ?> >Internet</option>
                                                <option value="parking" <?= in_array('parking',array_values((array)json_decode($property->amenities))) == true ? 'selected' : '' ?> >Parking</option>
                                                <option value="sun room" <?= in_array('sun room',array_values((array)json_decode($property->amenities)))== true ? 'selected' : '' ?> >Sun Room</option>
                                                <option value="concrete flooring" <?= in_array('concrete flooring',array_values((array)json_decode($property->amenities))) == true ? 'selected' : '' ?> >Concrete Flooring</option>                               
                                               
                                            @endif 
                                        </select>
                                        @if($errors->has('amenities'))
                                            <span class="text-danger">
                                                {{ $amenities=$errors->first('amenities')}}
                                            </span>
                                        @else
                                            {{$amenities=''}}
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Property Type</label>
                                    <div class="col-sm-9">
                                        <select name="type" class="form-control">
                                            <option value="">Select property type</option>
                                            <option value="house">House</option>
                                            <option value="office space">Office Space</option>
                                            <option value="warehouse">Warehouse</option>

                                            @if(  $property->type ==="none" || $property->type ===NULL)
                                                <option value="">Select property type</option>
                                                <option value="house">House</option>
                                                <option value="office space">Office Space</option>
                                                <option value="warehouse">Warehouse</option>
                                                
                                            @elseif( $property->type ==="house")
                                                <option value="">Select property type</option>
                                                <option value="{{$property->type ==='house'? $property->type :old('type', $property->type) }}" selected>{{ucfirst($property->type)}}</option>
                                                <option value="office space">Office Space</option>
                                                <option value="warehouse">Warehouse</option>                               
                                               
                                            @elseif($property->status ==="office space")
                                                <option value="">Select property type</option>
                                                <option value="house">House</option>
                                                <option value="{{$property->type ==='office space'? $property->type :old('type', $property->type) }}" selected>{{ucfirst($property->type)}}</option>
                                                <option value="warehouse">Warehouse</option>   

                                            @elseif($property->status ==="warehouse")
                                                <option value="">Select property type</option>
                                                <option value="house">House</option>
                                                <option value="office space">Office Space</option>
                                                <option value="{{$property->type ==='warehouse'? $property->type :old('type', $property->type) }}" selected>{{ucfirst($property->type)}}</option>
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
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Amount</label>
                                    <div class="col-sm-9">
                                        <input type="text"  name="amount" value="{{ $property->amount !== null ? $property->amount :old('amount', $property->amount) }}" class="form-control" placeholder="Enter property amount" />
                                        @if($errors->has('amount'))
                                            <span class="text-danger">
                                                {{ $amount= $errors->first('amount')}}
                                            </span>
                                        @else
                                            {{$amount=''}}
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Map</label>
                                    <div class="col-sm-9">
                                        <input type="text"  name="map" value="{{ $property->map !== null ? $property->map :old('map', $property->map) }}" class="form-control" placeholder="Paste map link" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Upload Carousel</label>
                                    <div class="col-sm-9">
                                        <div class="file-drop-area">
                                            <span class="choose-file-button">Choose files</span>
                                            <span class="file-message">or drag and drop image carousels here</span>
                                        
                                            <input type="file"  name="carousel[]" class="form-control file-input" multiple>
                                            @if(session()->has('carousel_error'))
                                                <span class="text-danger">
                                                    {{session('carousel_error')}}
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>      
                        <br>                  
                        <p class="card-description">
                         Property location
                        </p>
                        <hr>
                        <br>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Postal code</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="postalCode"  value="{{ $property->postalCode !== null ? $property->postalCode :old('postalCode', $property->postalCode) }}" class="form-control" placeholder="Enter postal code"/>
                                        @if($errors->has('postalCode'))
                                            <span class="text-danger">
                                                {{ $postalCode=$errors->first('postalCode')}}
                                            </span>
                                        @else
                                            {{$postalCode=''}}
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">State</label>
                                    <div class="col-sm-9">
                                        <select class="form-control" id="state" name="state">
                                            <option value="">Select State</option>
                                            @if($property->state !==NULL)
                                                <option value="{{$property->state}}" selected>{{ucfirst($property->state)}}</option>
                                            @endif
                                        </select>
                                        @if($errors->has('state'))
                                            <span class="text-danger">
                                                {{ $state=$errors->first('state')}}
                                            </span>
                                        @else
                                            {{$state=''}}
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Address</label>
                                    <div class="col-sm-9">
                                        <textarea name="address" class="form-control" placeholder="Enter address" rows="4" >{{ $property->address !== null ? $property->address :old('address', $property->address) }}</textarea>
                                        @if($errors->has('address'))
                                            <span class="text-danger">
                                                {{ $address=$errors->first('address')}}
                                            </span>
                                        @else
                                            {{$address=''}}
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Local Govt</label>
                                    <div class="col-sm-9">
                                        <select class="form-control" id="localG" name="localGovt">
                                            <option value="">Select local govt</option>
                                            @if($property->localG !==NULL)
                                                <option value="{{$property->localG}}" selected>{{ucfirst($property->localG)}}</option>
                                            @endif
                                        </select>
                                        @if($errors->has('localGovt'))
                                            <span class="text-danger">
                                                {{ $localGovt=$errors->first('localGovt')}}
                                            </span>
                                        @else
                                            {{$localGovt=''}}
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-12 col-12">
                                <div class="form-group row">
                                    <div class="col-sm-12">
                                        <label for="Describe property" class="control-label">Brief description</label>
                                        <textarea name="description" id="description" class="form-control" placeholder="Describe the property" rows="10" >{{ $property->description !== null ? $property->description :old('description', $property->description) }}</textarea>
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
                            <div class="col-md-6 offset-sm-6 col-sm-6">
                            <div class="form-group d-flex justify-content-end">
                                <button type="submit"   class="btn btn-success" ><i class="fa fa-save"></i> Save </button>
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
