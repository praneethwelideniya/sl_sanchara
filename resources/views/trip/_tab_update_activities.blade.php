<div role="tabpanel" class="tab-pane" id="activity">
    <div class="section">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    @foreach($trip->activities as $key => $activity)
                    <!-- Blog Thumb Start -->
                    <div class="thinn-event-list mb-30">
                        <figure>
                            <img src="{{asset('/trip').'/'.$activity->activity_type.'.jpg'}}" alt=""> 
                        </figure>
                        <div class="text">
                            <div class="form-group">
                                    <div class="content">
                                        <form action="{{ route('update-activity',$activity->id) }}" 
                                        method="post">
                                            {{ csrf_field() }}
                                            <input type="hidden" value="{{$trip->id}}" name="trip_id">
                                            <div class="trip-edit-form">
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label>Type</label>
                                                        <input type="text" class="form-controll" id="sel1" value="{{ucfirst($activity->activity_type)}}" name="activity_type" disabled>
                                                            
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label>Cost:</label>
                                                        <input type="text" id="cost" class="form-controll" name="cost" placeholder="Cost" value="{{$activity->cost}}">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Duration:</label>
                                                        <input type="text" name="daterange" placeholder="Calendar" class="form-controll" value="{{$activity->start->format('Y/m/d H:i').' - '.$activity->end->format('Y/m/d H:i')}}" />
                                                    </div>
                                                </div>
                                                
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label>Description</label>
                                                        <input type="text" class="form-controll" placeholder="Here can be your description" name="description" value="{!! $activity->description !!}">
                                                            
                                                            
                                                        </textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            @if($activity->activity_type==='transport')
                                                @include('trip._transport_create', ['activity' => $activity->currentActivity, 'transpotation_types' => $transpotation_types])
                                            @elseif($activity->activity_type==='accommodate')
                                                @include('trip._accommodation_create', ['activity' => $activity->currentActivity])
                                            @elseif($activity->activity_type==='meal')
                                                @include('trip._meal_create', ['activity' => $activity->currentActivity])
                                            @else
                                                @include('trip._place_create', ['activity' => $activity->currentActivity, 'transpotation_types' => $transpotation_types])    
                                            @endif

                                            <button type="submit" class="btn btn-info btn-fill pull-right">
                                            @if($trip==null)
                                            Create
                                            @else
                                            Update
                                            @endif
                                            </button>
                                            <div class="clearfix"></div>
                                        </div>    
                                            
                                    </form>
                                    </div>
                                </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div><!-- / Container -->
    </div>        
</div>