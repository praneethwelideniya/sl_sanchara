@extends('admin.layout')

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="header">
                            <div class="row">
                                <div class="col-md-4">
                                    <h4 class="title">Articles</h4>
                                    <p class="category">list</p>
                                </div>
                                <div class="col-md-4">
                                    <a href="{{route('create-article')}}"
                                                   type="button" class="btn btn-success" style="float: right">Create New &nbsp;<i class="fa fa-plus"></i>
                                                </a>
                                </div>     
                            </div>
                        </div>
                        <div class="content table-responsive table-full-width">
                            <table class="table table-hover table-striped">
                                <thead>
                                    <th>ID</th>
                                    <th>Title</th>
                                    <th>Category</th>
                                    <th>Written</th>
                                    <th>Language</th>
                                    <th>Published</th>
                                    <th>Edited</th>
                                    <th>Comments</th>
                                    <th>Hits</th>
                                    <th>Operations</th>
                                </thead>
                                <tbody>
                                    @foreach($articles as $article)
                                        <tr>
                                            <td>{{$article->id}}</td>
                                            <td>
                                                <a href="{{route('get-article', [$article->id, make_slug($article->heading)])}}" target="_blank">{{$article->heading}}</a>
                                            </td>
                                            <td>{{$article->categoryName}}</td>
                                            <td class="text-center">{{$article->createdAtHuman}}</td>
                                            <td class="text-center">{{$article->language}}</td>
                                            <td class="text-center">
                                                <span class="{{!$article->is_published?'hide':''}}">{{$article->publishedAtHuman}}</span>
                                            </td>
                                            <td class="text-center">{{$article->updatedAtHuman}}</td>
                                            <td class="text-center">{{$article->comment_count}}</td>
                                            <td class="text-center">{{$article->hit_count}}</td>
                                            <td class="text-center">
                                                <a href="{{route('edit-article', $article->id)}}">
                                                    <span class="fa fa-edit text-primary"></span>
                                                </a>&nbsp;
                                                <a href="{{route('toggle-article-publish', $article->id)}}">
                                                    <strong class="fa fa-lg {{$article->is_published ? 'fa-toggle-on text-success' : 'fa-toggle-off text-grey'}}" title="Toggle publish"></strong>
                                                </a>&nbsp;
                                                <a href="{{route('delete-article', $article->id)}}"
                                                   onclick="return confirm('Are you sure to delete?')">
                                                    <span class="fa fa-trash text-danger"></span>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection