@extends('layouts.master')
@section('styles')
<link href="{{ mix('/css/app.css') }}" rel="stylesheet">
@endsection
@section('content') 
            <div class="main-contant">
                <section class="pb-0">
                    <!-- SECTION HEADING START -->
                    <!-- SECTION HEADING END -->
                    <div class="gray-bg about-caption d-flex align-items-center">
                        <div class="col-md-10 col-sm-10 col-md-offset-1">
                            <!-- MAIN PREVIEW START -->
                            <div class="bg-slider arrow-2">
                                @foreach($article->images()->wherePivot('image_type','cover')->get() as $image)
                                <div class="thumb bg-thumb">
                                    <img src="{{asset('/users').'/'.$article->user->id.'/article/'.$image->src}}" height="600" alt="">
                                    <div class=" banner-caption-wrapper text-center">
                                        <div class="container">
                                            <div class="banner-caption caption-style-1">
                                                <h6 class="title small-title">{{$article->heading}}</h6>
                                                <div class="clear"></div>
                                                <h4 data-animation="fadeInUp" data-delay="0.3s" class="title title-bigger">{{$article->heading}}</h4>
                                                <h5 data-animation="fadeInUp" data-delay="0.3s" class="title title-medium">{{$article->heading}}</h5>
                                                <ul class="blog-meta">
                                                    <li>
                                                        <i class="icon-calendar5"></i>
                                                        <a href="#">{{$article->published_at->format('d M')}}</a>
                                                    </li>
                                                    <li>
                                                        <i class="icon-user"></i>
                                                        <a href="#">{{$article->user->name}}</a>
                                                    </li>
                                                    <li>
                                                        <i class="icon-tag6"></i>
                                                        @foreach($article->keywords as $keyword)
                                                        <a href="#">{{$keyword->name}}</a>
                                                        @endforeach
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>                                   
                                </div>
                                @endforeach
                                
                            </div>
                            <!-- MAIN PREVIEW END -->
                        </div>
                    </div>
                </section> 
                <div class="section">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-10">
                                <div class="tour-detail-section">
                                    <!-- TOUR TEXT DETAIL HOLDER -->
                                    <div class="text">
                                        <!-- Tab Wrap Start -->
                                        <div class="tours-tabs">
                                            <!-- Nav tabs -->
                                            <ul class="nav nav-tabs theme-tab th-bg" role="tablist">
                                                <li role="presentation" class="active"><a href="#detail" aria-controls="detail" role="tab" data-toggle="tab">Detail</a></li>
                                                <li role="presentation"><a href="#photos" aria-controls="photos" role="tab" data-toggle="tab">Photos</a></li>
                                                @if(Auth::check() and Auth::user()->id==$article->user->id)
                                                <li role="presentation"><a href="{{route('edit-article',$article->id)}}" >Edit</a></li>
                                                @endif
                                            </ul>
                                            <!-- Tab panes -->
                                            <div class="tab-content">
                                                <div role="tabpanel" class="tab-pane active" id="detail">
                                                    <div class="theme-tab-content">
                                                        <h4 class="section-title font-26">Tour Details</h4>
                                                        <p id="idshow">{!!$article->content!!}</p>
                                                        <!-- List Row Start -->
                                                    
                                                        </div>

                                                </div>
                                                <div role="tabpanel" class="tab-pane" id="photos">
                                                <div class="theme-tab-content">
                                                      @include('traveller._article_images', ['article' => $article, 'edit' => false])  
                                                </div>
                                            </div>
                                            </div>
                                        </div>
                                        <!-- Tab Wrap End -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!-- / Container -->
                </div><!-- /Blog Grid Section -->
                <!-- News Letter Item Start -->
                <div class="section overlay newsletter-widget">
                    <div class="container">
                        <!-- SECTION HEADING START -->
                        <div class="section-heading text-center">
                            <h3 class="title">Join Us Today</h3>
                            <h6 class="small-title">We are the best</h6>
                            <p>Dignissimos asperiores vitae velit veniam totam fuga molestias accusamus alias autem provident. Odit ab aliquam dolor eius. Facilis ipsum reprehenderit nemo molestias. Aut cum mollitia reprehenderit.</p>
                        </div>
                        <!-- SECTION HEADING END -->
                        <div id="mc_embed_signup" class="input-field nl-form-container clearfix">
                            <form action="https://twitter.us16.list-manage.com/subscribe/post-json?u=c768d55d7a9fca1c581bc5614&amp;id=ab9bd9a654&amp;c=?" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="newsletterform validate" target="_blank" novalidate>
                                <input 
                                    value="" 
                                    type="email" 
                                    name="EMAIL"
                                    id="mce-EMAIL" 
                                    maxlength="32"
                                    placeholder="Email address" 
                                    class="email form-control nl-email-input" 
                                    required>
                                <div style="position: absolute; left: -5000px;">
                                    <input 
                                        type="text" 
                                        name="b_ba37086d08bdc9f56f3592af0_e38247f7cc" 
                                        tabindex="-1" 
                                        value="">
                                </div>
                                <label class="mb-0">
                                    <input class="font-16 rounded-100 ps-middle" id="mc-embedded-subscribe" type="submit" name="subscribe" value="Submit">
                                </label>
                            </form>
                        </div><!-- /Input Field End-->
                    </div>
                </div>
                <!-- / News Letter Item End -->
            </div><!-- /Main Contant End -->
@endsection
@section('scripts')
<script src="{{ mix('js/user_profile.js') }}" type="application/javascript"></script>
<script type="text/javascript">
    $(document).ready(function(){
       $('#edit_content').click(function(){
            $("#idshow").hide();
            $("#idedit").show();
        });            
    }); 
</script>
@endsection