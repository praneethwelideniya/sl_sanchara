@extends('layouts.master')
@section('styles')
<link href="{{ mix('/css/app.css') }}" rel="stylesheet">
@endsection
@section('content') 
            <div class="main-contant">
                <div class="section">
                    <div class="container">
                        <div class="row">
                                <div class="tour-detail-section">
                                    <!-- TOUR TEXT DETAIL HOLDER -->
                                    <div class="text">
                                        <div class="tour-info-widget">
                                            <div class="row mb-17">
                                                <div class="col-md-3 col-xs-6 col-sm-6 col-md-offset-3 ">
                                                    <ul class="tour-info-list th-cl">
                                                        <li>
                                                            <div class="info-title">
                                                                <i class="icon-calendar5"></i>
                                                                <span>9 Days 8 Nights</span>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="info-title">
                                                                <i class="icon-map-pin2"></i>
                                                                <span>San Francisco</span>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="info-title">
                                                                <i class="icon-pricetags"></i>
                                                                <span>min Age : 10+</span>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="col-md-3 col-xs-6 col-sm-6">
                                                    <ul class="tour-info-list th-cl">
                                                        <li>
                                                            <div class="info-title">
                                                                <i class="icon-calendar5"></i>
                                                                <span>Availability : Jan 16’ - Dec 16’</span>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="info-title">
                                                                <i class="icon-map-pin2"></i>
                                                                <span>San Francisco</span>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="info-title">
                                                                <i class="icon-pricetags"></i>
                                                                <span>Max People : 80</span>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tours-tabs">
                                            <!-- Nav tabs -->
                                            <ul class="nav nav-tabs theme-tab th-bg" role="tablist">
                                                <li role="presentation" class="active"><a href="#activities" aria-controls="activities" role="tab" data-toggle="tab">Activities</a></li>
                                                <li role="presentation"><a href="#activity_calander" aria-controls="activity_calander" role="tab" data-toggle="tab">Calender</a></li>
                                                <li role="presentation"><a href="#trip_users" aria-controls="trip_users" role="tab" data-toggle="tab">Travellers</a></li>
                                            </ul>
                                            <!-- Tab panes -->
                                            <div class="tab-content">
                                                @include('trip._tab_activities_list',['trip'=>$trip])
                                                @include('trip._tab_activity_calender',['trip'=>$trip,'calender'=>$calender])
                                                @include('trip._tab_users',['id'=>$trip->id])
                                            </div>
                                        </div>
                                        <!-- Tab Wrap End -->
                                    </div>
                                </div>
                        </div>
                    </div><!-- / Container -->
                </div><!-- /Blog Grid Section -->
          </div>


@endsection
@section('scripts')
<script src="{{ mix('js/user_profile.js') }}" type="application/javascript"></script>
<script>
$(function() {
  $('input[name="daterange"]').daterangepicker({
    timePicker: true,
    locale: {
      format: 'YYYY/MM/DD HH:mm:ss'
    }
  });
});
</script>
@endsection