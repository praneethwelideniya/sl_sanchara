@extends('admin.layout')

@section('content')
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Edit Article</h4>
                            </div>
                            <div class="content">
                                <form action="{{ route('store-article') }}" method="post">
                                    {{ csrf_field() }}
                                    <div class="row">
                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <label>Category</label>
                                                <select class="form-control" id="sel1" name="category_id">
                                                    @foreach($categories as $category)
                                                    <option value="{{$category->id}}">{{$category->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <label>Language</label>
                                                <select class="form-control" id="lan" name="language">   
                                                    <option>eng</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <label>Keywords:</label>
                                                <input type="text" id="keyword" class="form-control"
                                                       name="keywords" placeholder="Keywords">
                                            </div>
                                        </div>
                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <label>Comment Enable</label>
                                                <select class="form-control" id="cmnt" name="is_comment_enabled">   
                                                    <option>1</option>
                                                    <option>0</option>
                                                </select>
                                            </div>
                                        </div>               
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Heading</label>
                                                <input type="text" class="form-control" placeholder="Heading" name="heading">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Content</label>
                                                <textarea rows="100" id="article-ckeditor" class="form-control" placeholder="Here can be your description" name="content"></textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <button type="submit" class="btn btn-info btn-fill pull-right">Update</button>
                                    <div class="clearfix"></div>
                                </form>
                            </div>
                        </div>
                    </div>
<!--                     <div class="col-md-4">
                        <div class="card card-user">
                            <div class="image">
                                <img src="https://ununsplash.imgix.net/photo-1431578500526-4d9613015464?fit=crop&fm=jpg&h=300&q=75&w=400" alt="..."/>
                            </div>
                            <div class="content">
                                <div class="author">
                                     <a href="#">
                                    <img class="avatar border-gray" src="assets/img/faces/face-3.jpg" alt="..."/>

                                      <h4 class="title">Mike Andrew<br />
                                         <small>michael24</small>
                                      </h4>
                                    </a>
                                </div>
                                <p class="description text-center"> "Lamborghini Mercy <br>
                                                    Your chick she so thirsty <br>
                                                    I'm in that two seat Lambo"
                                </p>
                            </div>
                            <hr>
                            <div class="text-center">
                                <button href="#" class="btn btn-simple"><i class="fa fa-facebook-square"></i></button>
                                <button href="#" class="btn btn-simple"><i class="fa fa-twitter"></i></button>
                                <button href="#" class="btn btn-simple"><i class="fa fa-google-plus-square"></i></button>

                            </div>
                        </div>
                    </div> -->

                </div>
            </div>
        </div>
@endsection