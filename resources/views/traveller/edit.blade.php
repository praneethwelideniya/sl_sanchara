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
                <div class="section">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-10 col-md-offset-1">
                                <div class="trip-edit-form">
                                    <h2 class="section-title font-26 mb-22">Edit User</h2>
                                    <form id="contact-form" method="POST" action="{{ route('user-update') }}">
                                     {{ csrf_field() }}    
                                        <div class="row">
                                            <div class="col-md-10 col-sm-10">

                                                <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                                    <h5 class="font-10 mb-10">NAME:</h5>
                                                    <input type="text" data-msg-required="Please enter your name" maxlength="100" class="form-control " name="name" id="name" placeholder="Name *" value="{{$user->name}}" required>
                                                    <div class="col-md-6">

                                                        @if ($errors->has('name'))
                                                            <span class="help-block">
                                                                <strong>{{ $errors->first('name') }}</strong>
                                                            </span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <!-- <div class="form-group{{ $errors->has('phone_number') ? ' has-error' : '' }}">
                                                    <h5 class="font-10 mb-10">Phone Number:</h5>
                                                    <input type="text" value="" data-msg-required="Please enter your Phone Number" maxlength="10" class="form-control " name="phone_number" id="phone_number" placeholder="Phone Number *" value="{{$user->phone_number}}" required>
                                                    <div class="col-md-6">

                                                        @if ($errors->has('name'))
                                                            <span class="help-block">
                                                                <strong>{{ $errors->first('name') }}</strong>
                                                            </span>
                                                        @endif
                                                    </div>
                                                </div> -->
                                                <div class="form-group{{ $errors->has('fb_url') ? ' has-error' : '' }}">
                                                    <h5 class="font-10 mb-10">FaceBook Page or Profile link:</h5>
                                                    <input type="text" maxlength="1000" class="form-control " name="fb_url" id="fb_url" placeholder="FB Link" value="{{$fb_url}}" >
                                                    <div class="col-md-6">

                                                        @if ($errors->has('fb_url'))
                                                            <span class="help-block">
                                                                <strong>{{ $errors->first('fb_url') }}</strong>
                                                            </span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="form-group{{ $errors->has('insta_url') ? ' has-error' : '' }}">
                                                    <h5 class="font-10 mb-10">Instagran Link:</h5>
                                                    <input type="text" maxlength="1000" class="form-control " name="insta_url" id="insta_url" placeholder="Instagram Link" value="{{$insta_url}}" >
                                                    <div class="col-md-6">

                                                        @if ($errors->has('insta_url'))
                                                            <span class="help-block">
                                                                <strong>{{ $errors->first('insta_url') }}</strong>
                                                            </span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="form-group{{ $errors->has('youtube_url') ? ' has-error' : '' }}">
                                                    <h5 class="font-10 mb-10">Youtube channel Link:</h5>
                                                    <input type="text" maxlength="1000" class="form-control " name="youtube_url" id="youtube_url" placeholder="Youtube Link" value="{{$youtube_url}}" >
                                                    <div class="col-md-6">

                                                        @if ($errors->has('youtube_url'))
                                                            <span class="help-block">
                                                                <strong>{{ $errors->first('youtube_url') }}</strong>
                                                            </span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <input class="btn" type="submit" value="submit" data-loading-text="Loading...">
                                            </div>
                                            <!--Input Field End-->
                                            <div class="alert alert-success hidden animated pulse" id="contactSuccess">
                                                Thanks, your message has been sent to us.
                                            </div>
                                            <div class="alert alert-danger hidden animated shake" id="contactError">
                                                <strong>Error!</strong> There was an error sending your message.
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        
                    </div><!-- / Container -->
                    <br><br><br>
                    <div class="container">
                        <div class="row">
                            <div class="col-md-8 col-md-offset-2">
                                <div class="trip-edit-form">
                                    <h2 class="section-title font-26 mb-22">Change Password</h2>
                                    <form id="contact-form" method="POST" action="{{ route('change-password') }}">
                                     {{ csrf_field() }}    
                                        <div class="row">
                                            <div class="col-md-10 col-sm-10">
                                                <div class="form-group{{ $errors->has('old_password') ? ' has-error' : '' }}">
                                                    <h5 class="font-10 mb-10">Old Password:</h5>
                                                    <input type="password" data-msg-required="Please enter your email address" data-msg-old_password="Please enter old password" maxlength="100" class="form-control " name="old_password" id="old_password" placeholder="Password" >
                                                    <div class="col-md-6">

                                                        @if ($errors->has('old_password'))
                                                            <span class="help-block">
                                                                <strong>{{ $errors->first('old_password') }}</strong>
                                                            </span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="form-group{{ $errors->has('new_password') ? ' has-error' : '' }}">
                                                    <h5 class="font-10 mb-10">New Password:</h5>
                                                    <input type="password" data-msg-required="Please enter your email address" data-msg-new_password="Please enter new Password" maxlength="100" class="form-control " name="new_password" id="new_password" placeholder="Password" required>
                                                    <div class="col-md-6">

                                                        @if ($errors->has('new_password'))
                                                            <span class="help-block">
                                                                <strong>{{ $errors->first('new_password') }}</strong>
                                                            </span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                                                    <h5 class="font-10 mb-10">Password Confimation:</h5>
                                                    <input type="password" value="" data-msg-required="Please enter your email address" data-msg-email="Please confirm the new password" maxlength="100" class="form-control " name="confirm_new_password" id="password-conf" placeholder="Password" required>
                                                    <div class="col-md-6">

                                                        @if ($errors->has('password_confirmation'))
                                                            <span class="help-block">
                                                                <strong>{{ $errors->first('password_confirmation') }}</strong>
                                                            </span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <input class="btn" type="submit" value="submit" data-loading-text="Loading...">
                                            </div>
                                            <!--Input Field End-->
                                            <div class="alert alert-success hidden animated pulse" id="contactSuccess">
                                                Thanks, your message has been sent to us.
                                            </div>
                                            <div class="alert alert-danger hidden animated shake" id="contactError">
                                                <strong>Error!</strong> There was an error sending your message.
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        
                    </div><!-- / Container -->
                </div><!-- /Blog Grid Section -->
            </div>
@endsection
@section('scripts')
<script src="{{ mix('js/user_profile.js') }}" type="application/javascript"></script>
@endsection