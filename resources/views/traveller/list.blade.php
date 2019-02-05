@extends('layouts.master')
@section('content')
            <div class="main-contant"> 
                <div class="section">
                    <div class="container">
                        <div class="row">
                            @include('traveller._traveller_list');
                        </div>
                    </div><!-- / Container -->
                </div><!-- /Blog Grid Section -->
                <!-- News Letter Item Start -->
                <!-- / News Letter Item End -->
            </div><!-- /Main Contant End -->
@endsection
@section('scripts')
<script src="{{ mix('js/user_profile.js') }}" type="application/javascript"></script>
@endsection