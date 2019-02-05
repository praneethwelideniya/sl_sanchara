@extends('layouts.master')

@section('content')
            <div class="main-contant"> 
                <div class="section">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-8 col-md-offset-2">
                                <div class="contact-form">
                                    <h2 class="section-title font-26 mb-22">Login Form</h2>
                                    <form id="contact-form" method="POST" action="{{ route('login') }}">
                                     {{ csrf_field() }}    
                                        <div class="row">
                                            <div class="col-md-10 col-sm-10">

                                                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                                    <h5 class="font-10 mb-10">Email:</h5>
                                                    <input type="email" value="" data-msg-required="Please enter your email address" data-msg-email="Please enter a valid email address" maxlength="80" class="form-control " name="email" id="email" placeholder="E-mail *" value="{{ old('email') }}" required>
                                                    <div class="col-md-6">

                                                        @if ($errors->has('email'))
                                                            <span class="help-block">
                                                                <strong>{{ $errors->first('email') }}</strong>
                                                            </span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                                    <h5 class="font-10 mb-10">Password:</h5>
                                                    <input type="password" data-msg-required="Please enter your email address" data-msg-email="Please enter a valid email address" maxlength="100" class="form-control " name="password" id="password" placeholder="Password" required>
                                                    <div class="col-md-6">

                                                        @if ($errors->has('password'))
                                                            <span class="help-block">
                                                                <strong>{{ $errors->first('password') }}</strong>
                                                            </span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="col-md-6 col-md-offset-4">
                                                        <div class="checkbox">
                                                            <label>
                                                                <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
                                                            </label>
                                                        </div>
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
                <!-- News Letter Item Start -->
                @endsection
