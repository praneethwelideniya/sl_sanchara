@extends('layouts.master')
@section('content')            
    <div class="main-contant">    
        <div class="section">
            <div class="container">
            	<h2>Articles</h2>
                <div class="row">
                	@foreach ($articles as $article)
                    <div class="col-md-4 col-sm-6">
                        <!-- Blog Thumb Start -->
                        <div class="thinn-blog-thumb thinn-blog-grid mb-30">
                            <figure>
                                <img src="{{asset('/users').'/'.$article->user->id.'/article/'.$article->images()->wherePivot('image_type','cover')->first()['src']}}" alt="profile Pic"/ height="220"> 
                            </figure>
                            <div class="text">
                                <div class="date-box-holder">
                                    <div class="title-holder">
                                        <h5 class="title font-18"><a href="blog-detail.html">{{$article->heading}}</a></h5>
                                        <ul class="blog-meta">
                                            <li>
                                                <i class="icon-comment"></i>
                                                <a href="#">{{$article->comment_count}}</a>
                                            </li>
                                            <li>
                                                <i class="icon-eye"></i>
                                                <a href="#">{{$article->hit_count}}</a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="date-box">
                                        <strong class="font-50">{{$article->published_at->format('d')}}</strong>
                                        <strong class="font-18">{{$article->published_at->format('M')}}</strong>
                                        <strong class="font-15">{{$article->published_at->format('Y')}}</strong>
                                    </div>
                                </div>
                                <p>{!! str_limit($article->content, $limit = 50, $end = '...') !!}</p>
                                <a class="btn btn-2" href="{{ route('get-article',$article->id) }}">View detail</a>
                            </div>
                        </div>
                        <!-- /Blog Thumb End -->
                    </div>
                    @endforeach
                    <div class="col-md-12">
                        <!-- Pagination Start-->
                        <div class="thinn-pagination text-center">
                            {{$articles->links()}}
                        </div>
                        <!-- Pagination End-->
                    </div>
                </div>
            </div><!-- / Container -->
        </div><!-- /Blog Grid Section -->
    </div>
@endsection        