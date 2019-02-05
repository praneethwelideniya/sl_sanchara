@extends('layouts.master')
@section('styles')
<link href="{{ mix('/css/app.css') }}" rel="stylesheet">
@endsection
@section('content')
<div class="main-contant">
<div id="blogs" user_id="0">
@include('blogs._blogs') 
</div>
</div>
@endsection
@section('scripts')
    <script src="{{ mix('js/user_profile.js') }}" type="application/javascript"></script>
@endsection
