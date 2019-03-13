@extends('layouts.master')
@section('styles')
<link href="{{ mix('/css/app.css') }}" rel="stylesheet">
@endsection
@section('content')
                <div class="main-banner">
                <div class="slider arrow-2">
                    @if($photos!=null)
                    @foreach($photos as $photo)
                    <div>
                        <img  src="{{$photo->urls->raw}}" alt="oscarthemes">
                        <div class=" banner-caption-wrapper text-left">
                            <div class="container">
                                <div class="banner-caption caption-style-1">
                                    <h6 class="title small-title">SL Sanchara</h6>
                                    <div class="clear"></div>
                                    <h5 data-animation="fadeInUp" data-delay="0.3s" class="title title-medium">{{$photo->description}}</h5>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    @endif
                </div><!-- /Main Banner -->
            </div><!-- /Banner Wrap -->
            <!-- Oscar Contant Wrapper Start-->  
            <div class="main-contant">
            @if($ads_enable) 
                <section class="gray-bg">
                    <div class="container">
                        <!-- SECTION HEADING START -->
                        <div class="section-heading text-center">
                            <h3 class="title">Top Hotels</h3>
                            <h6 class="small-title">This Week</h6>
                        </div>
                        <!-- SECTION HEADING END -->
                        <div class="destination-slider arrow-2">
                            <div class="top-destination">
                            <div class="list-slider arrow-2">
                            <div class="col-md-3 col-sm-3">
                                <!-- HOLIDAY PACKAGES START -->
                                <div class="thinn-tours-grid2 mb-30">
                                    <figure>
                                        <img src="../assets/extra-images/gallery/ocenrock.jpg" alt=""/>
                                        <span class="price-tag th-bg">$ 625 </span><a href="#" class="btn">Book Now</a>
                                    </figure>
                                    <div class="text">
                                        <ul class="blog-meta">
                                            <li><i class=" icon-calendar-1"></i><a href="#">Number of days: 2</a></li>
                                            <li><i class=" icon-user4"></i><a href="#">Persons: 3</a></li>
                                        </ul>
                                        <h5 class="title"><a href="#">London Vacation Package</a></h5>
                                        
                                    </div>
                                </div>
                                <!-- HOLIDAY PACKAGES END -->
                            </div>
                            <div class="col-md-3 col-sm-3">
                                <!-- HOLIDAY PACKAGES START -->
                                <div class="thinn-tours-grid2 mb-30">
                                    <figure>
                                        <img src="../assets/extra-images/gallery/hotel_ella.jpg" alt=""/>
                                        <span class="price-tag th-bg red">$ 525</span>
                                    </figure>
                                    <div class="text">
                                        <ul class="blog-meta">
                                            <li><i class=" icon-calendar-1"></i><a href="#">Number of days: 2</a></li>
                                            <li><i class=" icon-user4"></i><a href="#">Persons: 3</a></li>
                                        </ul>
                                        <h5 class="title"><a href="#">Paris Vacation Package</a></h5>
                                        <a href="#" class="btn">Book Now</a>
                                    </div>
                                </div>
                                <!-- HOLIDAY PACKAGES END -->
                            </div>
                            <div class="col-md-3 col-sm-3">
                                <!-- HOLIDAY PACKAGES START -->
                                <div class="thinn-tours-grid2 mb-30">
                                    <figure>
                                        <img src="../assets/extra-images/gallery/flower_garden.jpg" alt=""/>
                                        <span class="price-tag th-bg">$ 225</span>
                                    </figure>
                                    <div class="text">
                                        <ul class="blog-meta">
                                            <li><i class=" icon-calendar-1"></i><a href="#">Number of days: 2</a></li>
                                            <li><i class=" icon-user4"></i><a href="#">Persons: 3</a></li>
                                        </ul>
                                        <h5 class="title"><a href="#">Rome Vacation Package</a></h5>
                                        <a href="#" class="btn">Book Now</a>
                                    </div>
                                </div>
                                <!-- HOLIDAY PACKAGES END -->
                            </div>
                            <div class="col-md-3 col-sm-3">
                                <!-- HOLIDAY PACKAGES START -->
                                <div class="thinn-tours-grid2 mb-30">
                                    <figure>
                                        <img src="../assets/extra-images/gallery/98_acres.jpg" alt=""/>
                                        <span class="price-tag th-bg red">$ 525</span>
                                    </figure>
                                    <div class="text">
                                        <ul class="blog-meta">
                                            <li><i class=" icon-calendar-1"></i><a href="#">Number of days: 2</a></li>
                                            <li><i class=" icon-user4"></i><a href="#">Persons: 3</a></li>
                                        </ul>
                                        <h5 class="title"><a href="#">Barcelona Vacation Packag</a></h5>
                                        <a href="#" class="btn">Book Now</a>
                                    </div>
                                </div>
                                <!-- HOLIDAY PACKAGES END -->
                            </div>
                        </div>
                            </div>
                            <!-- TOP DESTINATION END -->
                        </div>
                    </div>
                </section>
                @endif
                <!-- /Top Destination Section End --> 
                <!-- Blog Section Start --> 
                <section>
                    <div class="container">
                        <div class="section-heading text-center">
                            <h2 class="title">From The Blog</h2>
                            <h6 class="small-title">Most Recent</h6>
                        </div><!-- / Section Heading --> 
                        <div id="blogs" user_id="0">
                        <div class="row">
                            <div v-for="article in blogs">
                            <div class="col-md-4 col-sm-6">
                                <!-- Blog Thumb Start -->
                                <div class="thinn-blog-thumb thinn-blog-grid-blog mb-30">
                                    <figure>
                                        <img :src="'{{asset('')}}'+article.img_src" alt="profile Pic"/ height="220"> 
                                    </figure>
                                    <div class="text">
                                        <div class="date-box-holder">
                                            <div class="title-holder">
                                                <h5 class="title font-18"><a :href="'{{route('articles')}}'+'/'+article.id">@{{article.heading}}</a></h5>
                                                <ul class="blog-meta">
                                                    <li>
                                                        <i class="icon-user"></i>
                                                        <a :href="'{{route('user-profile')}}'+'/'+article.author_id">@{{article.author_name}}</a>
                                                    </li>
                                                    <li>
                                                        <i class="icon-comment"></i>
                                                        <a href="#">@{{article.comment_count}}</a>
                                                    </li>
                                                    <li>
                                                        <i class="icon-eye"></i>
                                                        <a href="#">0</a>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="date-box">
                                                <strong class="font-50">@{{article.d}}</strong>
                                                <strong class="font-18">@{{article.M}}</strong>
                                                <strong class="font-15">@{{article.Y}}</strong>
                                            </div>
                                        </div>
                                        
                                    </div>
                                </div>
                                <!-- /Blog Thumb End -->
                            </div>
                        </div>
                        </div>
                        </div>
                    </div><!-- / Container -->
                </section>
                <!-- /Blog Section End --> 
                <!-- /Gallery Section End --> 
                <!-- News Section Start -->
                @if($haritha_challenge_enable) 
                <section class="news-section gray-bg overlay">
                    <div class="container">
                        <div class="section-heading text-center">
                            <h2 class="title">Haritha Chalange</h2>
                            <h6 class="small-title">Little changes can make big affects</h6>
                        </div><!-- / Section Heading --> 
                        <div class="news-slider arrow-2">
                            <div>
                                <!-- Blog Thumb Start -->
                                <div class="thinn-blog-thumb thinn-news thinn-blog-list">
                                    <figure>
                                        <img src="../assets/extra-images/blog/blog-list/rain.jpg" alt=""> 
                                    </figure>
                                    <div class="text">
                                        <h5 class="title font-24"><a href="blog-detail.html">No say to Polithen</a></h5>
                                        <ul class="blog-meta">
                                            <li>
                                                <i class="icon-user"></i>
                                                <a href="#">Sl sanchara</a>
                                            </li>
                                            <li>
                                                <i class="icon-like"></i>
                                                <a href="#">236</a>
                                            </li>
                                        </ul> 
                                        <p> </p>
                                    </div>
                                </div>
                                <!-- /Blog Thumb End -->
                            </div>
                            <div>
                                <!-- Blog Thumb Start -->
                                <div class="thinn-blog-thumb thinn-news thinn-blog-list">
                                    <figure>
                                        <img src="../assets/extra-images/blog/blog-list/rain.jpg" alt=""> 
                                    </figure>
                                    <div class="text">
                                        <h5 class="title font-24"><a href="blog-detail.html">Reduce to buy blastic water bottles</a></h5>
                                        <ul class="blog-meta">
                                            <li>
                                                <i class="icon-user"></i>
                                                <a href="#">Admin</a>
                                            </li>
                                            <li>
                                                <i class="icon-like"></i>
                                                <a href="#">236</a>
                                            </li>
                                        </ul> 
                                        <p> </p>
                                        <a class="btn btn-2" href="#">View detail</a>
                                    </div>
                                </div>
                                <!-- /Blog Thumb End -->
                            </div>
                            <div>
                                <!-- Blog Thumb Start -->
                                <div class="thinn-blog-thumb thinn-news thinn-blog-list">
                                    <figure>
                                        <img src="../assets/extra-images/blog/blog-list/rain.jpg" alt=""> 
                                    </figure>
                                    <div class="text">
                                        <h5 class="title font-24"><a href="blog-detail.html">Join with a team on 4th of Feb to make a change</a></h5>
                                        <ul class="blog-meta">
                                            <li>
                                                <i class="icon-user"></i>
                                                <a href="#">Sl sanchara</a>
                                            </li>
                                            <li>
                                                <i class="icon-like"></i>
                                                <a href="#">236</a>
                                            </li>
                                        </ul> 
                                        <p></p>
                                        <a class="btn btn-2" href="#">View detail</a>
                                    </div>
                                </div>
                                <!-- /Blog Thumb End -->
                            </div>
                        </div>
                    </div><!-- / Container -->
                </section>
                @endif
                <!-- /News Section End --> 
            </div><!--/Main Contant End-->  
@endsection
@section('scripts')
    <script src="{{ mix('js/user_profile.js') }}" type="application/javascript"></script>
@endsection
