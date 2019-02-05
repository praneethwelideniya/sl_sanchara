@extends('layouts.master')
@section('styles')
<link href="{{ mix('/css/app.css') }}" rel="stylesheet">
@endsection
@section('content')
            
            <div id="sl_sanchara">
                @include('traveller._profile_bar', ['user' => $user,'public'=>$public, 'complete'=>0])
                @include('traveller._upload_modal')
            </div>
            <div class="main-contant">
                <div id="blogs" user_id="{{$user->id}}">  
                @include('blogs._blogs') 
            </div>
            <div class="section">
                <section class="pd-0 gallery-slider-wrap">

                    <div class="row ">
                        
                        <div class="col-md-10 col-sm-12">
                            <ul class="gallery-slider arrow-2">
                                @foreach ($user->images as $image)
                                <li class="col-md-3 col-sm-4">
                                    <!-- GALLERY THUMB START -->
                                    <div class="gallery-thumb th-bg">
                                        <figure>
                                            <img src="{{asset('/users').'/'.$image->img_type.'/'.$image->src}}" alt="" height="300" />
                                            <figcaption>
                                                <a href="#">{{$image->caption}}</a>
                                                <ul>
                                                    <li>
                                                        <a href="#other_image" data-toggle="modal" data-target="#deleteModal" ><i class="icon-recycle"></i></a>
                                                    </li>    
                                                </ul>
                                            </figcaption>
                                        </figure>
                                    </div>
                                    <!-- GALLERY THUMB END -->
                                </li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="col-md-2 hidden-sm hidden-xs">
                                                <!-- SECTION HEADING START -->
                            <div class="section-heading text-center mb-0">
                                <h3 class="title">Photo Gallery</h3>
                                <h5 class="title" id="other_pic"><i class="icon-camera"></i></h5>
                            </div>
                            <!-- SECTION HEADING END -->
                        </div>
                    </div>
                </section> 
                </div>
            </div><!-- /Main Contant End -->
                    <!-- Modal -->
        
        <div id="deleteModal" class="modal fade" role="dialog">
          <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">File upload form</h4>
                </div>
                <div class="modal-body">
                    <!-- Form -->
                    <form method='post' action="{{route('delete_pic')}}">
                        @csrf
                        <input type="hidden" id="del-user-id" name="id" >
                        <button type="submit" class="btn btn-primary btn-xs">Delete</button>
                    </form>

                    <!-- Preview-->
                    <div id='preview'></div>
                </div>
                
            </div>

          </div>
        </div>
@endsection
@section('scripts')
<script src="{{ mix('js/user_profile.js') }}" type="application/javascript"></script>
@endsection