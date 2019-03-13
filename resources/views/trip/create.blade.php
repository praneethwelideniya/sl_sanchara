@extends('layouts.master')
@section('styles')
<link href="{{ mix('/css/app.css') }}" rel="stylesheet">
@endsection
@section('content') 
            <div class="main-contant">
                <div class="section">
                    <div class="container">
                        <div class="row">
                            <div >
                                <div class="tour-detail-section">
                                    <!-- TOUR TEXT DETAIL HOLDER -->
                                    <div class="text">
                                        <!-- Tab Wrap Start -->
                                        <div id="trip" asset_id="{{$trip!=null?$trip->id:0}}"  class="tours-tabs">
                                            <!-- Nav tabs -->
                                            <ul class="nav nav-tabs theme-tab th-bg" role="tablist">
                                                <li role="presentation" class="active"><a href="#detail" aria-controls="detail" role="tab" data-toggle="tab">Detail</a></li>
                                                @if(!is_null($trip))
                                                    <li role="presentation"><a href="#activity" aria-controls="activity" role="tab" data-toggle="tab">Trip Activities</a></li>
                                                    <li role="presentation"><a href="#create_activity" aria-controls="create_activity" role="tab" data-toggle="tab">Create Activities</a></li>
                                                    <li role="presentation"><a href="#activity_calander" aria-controls="activity_calander" role="tab" data-toggle="tab">Activity Calender</a></li>
                                                    <li role="presentation"><a href="#trip_users" aria-controls="trip_users" role="tab" data-toggle="tab">Travellers</a></li>
                                                    <li role="presentation"><a aria-controls="photos" role="tab" @click="prepareToDelete()" data-toggle="tab">Delete</a></li>
                                                    @include('traveller._delete_confirm')
                                                    <li role="presentation"><a href="#maps" aria-controls="maps" role="tab" data-toggle="tab">Travellers</a></li>
                                                @endif    
                                            </ul>
                                            <!-- Tab panes -->
                                            <div class="tab-content">
                                                @include('trip._tab_details',['trip'=>$trip])

                                                @if(!is_null($trip))
                                                    @include('trip._tab_update_activities',['trip'=>$trip])
                                                    @include('trip._tab_create_activity',['trip'=>$trip])
                                                    @include('trip._tab_activity_calender',['trip'=>$trip,'calender'=>$calender])
                                                    @include('trip._tab_users',['id'=>$trip->id])
                                                @endif
                                                @include('maps._map');
                                            </div>
                                        </div>
                                        <!-- Tab Wrap End -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!-- / Container -->
                </div><!-- /Blog Grid Section -->
          </div>
        </div>
            </div><!-- /Main Contant End -->


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