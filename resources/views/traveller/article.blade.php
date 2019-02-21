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
                                <div class="thumb-landscape bg-thumb">
                                    <img src="{{asset('/users').'/'.'article/'.$image->src}}" alt="">
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
                                                        <a href="#">{{$article->keyword}}</a>
                                                        
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
                                                        <div class="article-body">{!!$article->content!!}</div>
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