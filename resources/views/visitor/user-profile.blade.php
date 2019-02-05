@extends('layouts.master')
@section('content')
            <div data-stellar-background-ratio="0.5" class="sub-banner overlay pb-0">
                <div class="search-bar-outer">
                    <div class="search-bar">
                        <div class="row">
                            <div class="col-md-3 col-xs-6 col-sm-3">
                                <div class="input-field">
                                    <figure><img src="../assets/extra-images/avtar.jpg" alt=""/></figure>
                                </div>
                            </div>
                            <div class="col-md-3 col-xs-6 col-sm-3">
                                <div class="input-field">
                                    Followers
                                    <br>
                                    230
                                </div>
                            </div>
                            <div class="col-md-3 col-xs-6 col-sm-3">
                                Followings
                                <br>
                                230
                            </div>
                            <div class="col-md-3 col-xs-6 col-sm-3">
                                <div class="input-field">
                                    <input type="submit" value="Follow">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>  
            <div class="main-contant">
            	<div class="section">
            	<section class="pd-0 gallery-slider-wrap">
                    <div class="row ">
                        <div class="col-md-10 col-sm-12">
                            <ul class="gallery-slider arrow-2">
                                @for ($i = 0 ; $i < 12 ;i++)
                                <li class="col-md-3 col-sm-4">
                                    <!-- GALLERY THUMB START -->
                                    <div class="gallery-thumb th-bg">
                                        <figure>
                                            <img src="../assets/extra-images/gallery/98_acres.jpg" alt=""/>
                                            <figcaption>
                                                <a href="#">Istanbul, Turkey</a>
                                            </figcaption>
                                        </figure>
                                    </div>
                                    <!-- GALLERY THUMB END -->
                                </li>
                                @endfor
                            </ul>
                        </div>
                        <div class="col-md-2 hidden-sm hidden-xs">
                            <!-- SECTION HEADING START -->
                            <div class="section-heading text-center mb-0">
                                <h3 class="title">Photo Gallery</h3>
                            </div>
                            <!-- SECTION HEADING END -->
                        </div>
                    </div>
                </section> 
            	</div>
                <div class="section">
                    <div class="container">
                    	<h2>Articles</h2>
                        <div class="row">
                        	@for ($i = 0; $i < 12; $i++)
                            <div class="col-md-4 col-sm-6">
                                <!-- Blog Thumb Start -->
                                <div class="thinn-blog-thumb thinn-blog-grid mb-30">
                                    <figure>
                                        <img src="../assets/extra-images/blog/blog-grid/img-1.jpg" alt=""> 
                                    </figure>
                                    <div class="text">
                                        <div class="date-box-holder">
                                            <div class="title-holder">
                                                <h5 class="title font-18"><a href="blog-detail.html">Ishigaki, Japan</a></h5>
                                                <ul class="blog-meta">
                                                    <li>
                                                        <i class="icon-user"></i>
                                                        <a href="#">Admin</a>
                                                    </li>
                                                    <li>
                                                        <i class="icon-comment"></i>
                                                        <a href="#">236</a>
                                                    </li>
                                                    <li>
                                                        <i class="icon-eye"></i>
                                                        <a href="#">456</a>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="date-box">
                                                <strong class="font-50">02</strong>
                                                <strong class="font-18">mar</strong>
                                            </div>
                                        </div>
                                        <p>Dignissimos asperiores vitae velit veniam totam fuga molestias accusamus alias autem provident. Odit ab aliquam dolor eius. Facilis ipsum reprehenderit nemo.</p>
                                        <a class="btn btn-2" href="#">View detail</a>
                                    </div>
                                </div>
                                <!-- /Blog Thumb End -->
                            </div>
                            @endfor
                            <div class="col-md-12">
                                <!-- Pagination Start-->
                                <div class="thinn-pagination text-center">
                                    <span class="page-numbers current">1</span>
                                    <a class="page-numbers" href="#">2</a>
                                    <a class="page-numbers" href="#">3</a>
                                    <a class="page-numbers border_none" href="#">...</a>
                                    <a class="page-numbers" href="#">18</a>
                                    <a class="page-numbers" href="#">19</a>
                                    <a class="page-numbers" href="#">20</a>
                                </div>
                                <!-- Pagination End-->
                            </div>
                        </div>
                    </div><!-- / Container -->
                </div><!-- /Blog Grid Section -->
            </div><!-- /Main Contant End -->
@endsection