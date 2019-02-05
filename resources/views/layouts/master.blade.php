<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
        <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <script>
            window.Laravel = { csrfToken: '{{ csrf_token() }}' }
        </script>

        <meta name="robots" content="index, follow" > 
        <meta name="keywords" content="HTML5 Template, Themeforest, Business, Tranding, Top Theme Travelair, oscarthemes,Oscar Themes,Travelair" > 
        <meta name="description" content="Discover Oscar Themes - Travelair HTML5 Template, Travel, adventure, booking, holiday, reservation, tour, tour agency, tour booking, tour management, tour operator, tour package, travel, travel agency, trip, vacation" > 
        <meta name="theme-color" content="#009cff">
        <title>{{ config('app.name', 'SL Sanchara') }}</title>
        <!-- FAVICONS -->
        <link rel="shortcut icon" href="{{ asset('assets/images/favicon/favicon.png') }}">
        <link rel="apple-touch-icon" href="{{asset('')}}assets/images/favicon/apple-touch-icon.png">
        <link rel="apple-touch-icon" sizes="72x72" href="{{asset('assets/images/favicon/apple-touch-icon-72x72.png')}}">
        <link rel="apple-touch-icon" sizes="114x114" href="{{asset('assets/images/favicon/apple-touch-icon-114x114.png')}}">
        <link rel="icon" sizes="192x192" href="{{asset('assets/images/favicon/icon-192x192.png')}}">
        <!--  GOOGLE FONT -->
        <link href="https://fonts.googleapis.com/css?family=Quicksand:400,500,700" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Work+Sans:300,400,600,700,900" rel="stylesheet">
        <!-- Bootstrap -->
                <link href="{{asset('assets/css/bootstrap.css')}}" rel="stylesheet">
        <!-- Animate CSS -->
        <link href="{{asset('assets/css/animate.css')}}" rel="stylesheet">
        <!-- Magnific Popup CSS -->
        <link href="{{asset('assets/css/magnific-popup.css')}}" rel="stylesheet">
        <!-- Slick Slider CSS -->
        <link href="{{asset('assets/css/slick.css')}}" rel="stylesheet">
        <!-- Date Picker CSS -->
        <link href="{{asset('assets/css/daterangepicker.css')}}" rel="stylesheet">
        <!-- Typography CSS -->
        <link href="{{asset('assets/css/typography.css')}}" rel="stylesheet">   
        <!-- Flat Icon CSS -->
        <link href="{{asset('svg/svg.css')}}" rel="stylesheet">
        <!-- Short Code CSS -->
        <link href="{{asset('assets/css/shortcode.css')}}" rel="stylesheet">
        <!-- Widget Css -->
        <link href="{{asset('assets/css/widget.css')}}" rel="stylesheet">
        <!--Dl Menu Script-->
        <link href="{{asset('assets/css/dl-menu/component.css')}}" rel="stylesheet">
        <!-- Custom Style CSS -->
        <link href="{{asset('assets/style.css')}}" rel="stylesheet">
        <!-- Color CSS -->
        <link href="{{asset('assets/css/color.css')}}" rel="stylesheet">
        <!-- Responsive CSS -->
        <link href="{{asset('assets/css/responsive.css')}}" rel="stylesheet">
        @yield('styles')
        
         <script src="https://maps.googleapis.com/maps/api/js?libraries=places&key=AIzaSyBwZGsVxOBgKXku6sBNI6uYxlfetT_SJeY"></script>
         <script src="{{asset('assets/js/jquery.js')}}"></script>
         <script src="https://cdn.jsdelivr.net/gmap3/7.2.0/gmap3.min.js"></script>
        <!-- Animate CSS -->
        
        <!-- Global site tag (gtag.js) - Google Analytics -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=UA-111517361-2"></script>
        <script>
          window.dataLayer = window.dataLayer || [];
          function gtag(){dataLayer.push(arguments);}
          gtag('js', new Date());
          gtag('config', 'UA-111517361-2');
        </script>
    </head>
    <body class="modren-layout parallax-section" data-stellar-background-ratio="0.5">
        
        <!-- LOADER --> 
        <div id="loader-overflow">
          <div id="loader3" class="loader-cont">Please enable JS</div>
        </div> 
        <div class="main-wrapper"> 
            <header id="header" class="header-2">
                <!-- TOP BAR START -->
                <!-- TOP BAR END -->
                <div class="navigation-outer">
                    <div class="container">
                        
                        <!--Navigation Start -->
                        <nav class="navigation">
                            <div class="logo">
                                    <img src="{{asset('assets/images/sl_sanchara_logo.png')}}" alt="">
                            </div>
                            <ul>
                                <li class="active"><a href="{{route('home')}}">Home</a></li>
                                <li><a href="{{route('get-all-blogs')}}">Blogs</a>
                                <li><a href="{{route('get-all-travellers')}}">Travellers</a></li>
                                @if(Auth::guest())
                                <li><a href="{{route('login-form')}}">Sign In</a></li>    
                                <li><a href="{{route('register-form')}}">Sign Up</a></li>
                                @elseif(Auth::user())
                                <li class="menu-item parent-menu">
                                    <a href="#">{{Auth::user()->name}}</a>
                                    <ul class="dl-submenu">
                                        <li><a href="{{route('user-profile')}}">My Profile</a></li>
                                        <li><a href="{{route('user-profile-edit')}}">Edit Profile</a></li>
                                        <li><a href="{{route('edit-article')}}">Create Article</a></li>
                                        <li><a href="{{route('logout')}}">Logout</a></li>
                                    </ul>
                                </li>
                                @endif
                                <li><
                            </ul>
                        </nav>
                        <!--Navigation End -->
                        <!--DL Menu Start-->
                         <div id="responsive-navigation" class="dl-menuwrapper">
                            <button class="dl-trigger">
                                <span class="close-icon">
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                </span>
                            </button>
                            <ul class="dl-menu">
                                <li class="menu-item parent-menu">
                                    <a href="{{route('home')}}">Home</a>
                                </li>
                                <li class="menu-item parent-menu">
                                    <a href="#">Blog</a>
                                </li>
                                @if(Auth::guest())
                                <li class="menu-item parent-menu">
                                    <a href="{{route('login-form')}}">Sign In</a>
                                </li>
                                <li class="menu-item parent-menu">
                                    <a href="{{route('register-form')}}">Sign In</a>
                                </li>
                                @elseif(Auth::user())
                                <li class="menu-item parent-menu">
                                    <a href="#">{{Auth::user()->name}}</a>
                                    <ul class="dl-submenu">
                                        <li><a href="{{route('user-profile')}}">My Profile</a></li>
                                        <li><a href="{{route('user-profile-edit')}}">Edit Profile</a></li>
                                        <li><a href="{{route('logout')}}">Logout</a></li>
                                    </ul>
                                </li>
                                @endif
                                <li><a href="contact-us.html">Contact Us</a></li>
                            </ul>
                        </div>
                        <!--DL Menu END-->
                        <div class="cd-search-trigger visible-sm visible-xs"><span></span></div><!-- cd-header-buttons -->
                    </div>
                </div>
            </header><!-- /header 2 -->  
            

            
                @yield('content')   


            <!-- Footer Start-->
            <footer class="th-bg">
                <div class="container">
                    <div class="row">
                        <div class="col-md-3 col-sm-6">
                            <!--Widget Navigation Start-->
                            <div class="widget widget-about">
                                <h6 class="widget-title">About Us</h6>
                                <p>We are providing a place to write your travel Experiences and read others Experiences.</p>
                                <ul class="contact-list">
                                    <li><i class="icon-email"></i><span>info@slsanchara.com</span></li>
                                </ul>
                            </div>
                            <!--Widget Navigation End-->
                        </div>
                        <div class="col-md-3 col-sm-6">
                            <!--Widget Navigation Start-->
                            <div class="widget widget_nav_menu">
                                <h6 class="widget-title">navigate</h6>
                                <ul>
                                    <li><a href="#">home</a></li>
                                    <li><a href="#">about us</a></li>
                                    <li><a href="#">contact us</a></li>
                                </ul>
                            </div>
                            <!--Widget Navigation End-->
                        </div>
                        <div class="col-md-3 col-sm-6">
                            <!--Widget Navigation Start-->
                            <div class="widget widget_nav_menu">
                                <h6 class="widget-title">information</h6>
                                <ul>
                                    <li><a href="#">FAQ</a></li>
                                    <li><a href="#">privacy policy</a></li>
                                    <li><a href="#">Terms & Conditions</a></li>
                                </ul>
                            </div>
                            <!--Widget Navigation End-->
                        </div>
                    </div>
                </div>
            </footer>
            <!-- Footer End-->
            <div class="copy-right th-bg">
                <div class="container">
                    <p>Copyright © 2019 SL Sanchara</p>
                </div>
            </div><!-- /Copyright End-->
        </div><!-- /Main Wrapper End-->
        <!-- jQuery -->
        
       
        <!-- bootstrap -->
        <script src="{{asset('assets/js/bootstrap.js')}}"></script>
        <!-- Slick Slider -->
        <script src="{{asset('assets/js/slick.min.js')}}"></script>
        <!-- Popup Js -->
        <script src="{{asset('assets/js/magnific-popup.js')}}"></script>
        <!-- Dll Menu Js -->
        <script src="{{asset('assets/js/dl-menu/modernizr.custom.js')}}"></script>
        <script src="{{asset('assets/js/dl-menu/jquery.dlmenu.js')}}"></script>
        <!-- Fontawesome Js -->
        <script src="{{asset('assets/js/fontawesome.js')}}"></script>
        <!-- Date Picker -->
        <script type="text/javascript" src="{{asset('assets/js/moment.min.js')}}"></script>
        <script type="text/javascript" src="{{asset('assets/js/daterangepicker.min.js')}}"></script>
        <!-- Map Api Library -->
<!-- 
          <script>
    $('#map')
      .gmap3({
        center:[7.8, 80.7],
        zoom:8
      })
      .marker([
        {city:"Badulla, Sri Lanka"}
      ])
      .on('click', function (marker) {
        marker.setIcon('http://maps.google.com/mapfiles/marker_green.png');
      });
  </script> -->
        <!-- Input Number Js -->
        <script src="{{asset('assets/js/input-number.js')}}"></script>
        <!--Custom Script-->
        <script src="{{asset('assets/js/custom.js')}}"></script>
        @yield('scripts')
    </div>
    </body>
</html>
