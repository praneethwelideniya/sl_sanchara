@extends('admin.layout')

@section('content')
        <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-4">
                    <div class="card">
                        <div class="header">
                            <h4 class="title">Country vs Hits</h4>
                            <p class="category">Here is a subtitle for this table</p>
                        </div>
                        <div class="content table-responsive table-full-width">
                            <table class="table table-hover table-striped">
                                <thead>
                                    <th>#</th>
                                    <th >Country Name</th>
                                    <th>Hit Count</th>
                                </thead>
                                <tbody>
                                    @php($count = 1)
                                    @foreach($hitCountByCountries as $hit)
                                        <tr>
                                            <td>{{$count++}}</td>
                                            <td>{{$hit->country ?? 'Unknown'}}</td>
                                            <td>{{$hit->totalHit}}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="header">
                            <h4 class="title">Article by Category</h4>
                            <p class="category">Here is a subtitle for this table</p>
                        </div>
                        <div class="content table-responsive table-full-width">
                            <table class="table table-hover table-striped">
                                <thead>
                                    <th class="text-left">Category Name</th>
                                    <th class="text-left">Number of Article</th>
                                </thead>
                                <tbody>
                                    @foreach($articleCategories as $key => $category)
                                        <tr><td>{{$key}}</td><td>{{count($category)}}</td></tr>
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