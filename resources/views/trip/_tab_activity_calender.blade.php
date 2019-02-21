<div role="tabpanel" class="tab-pane" id="activity_calander">
    <div class="section">    
        <div class="container">
            <div class="row">
                <div class="col-md-10 col-md-offset-1">
                    @foreach($calender as $key => $activities)
                    <div class="thinn-event-list mb-30">
                           <figure>
                            <div>
                                    <strong class="font-50">{{explode('-', $key, 3)[0]}}</strong>
                                    <br>
                                    <strong class="font-50">{{explode('-', $key, 3)[1]}} /</strong>
                                    
                                    <strong class="font-50">{{explode('-', $key, 3)[2]}}</strong>
                            </div>
                        </figure> 
                        <div class="text">
                            @foreach($activities as $key_0=>$activity)
                            <ul class="blog-meta event-meta">
                                <li>
                                    <i class="icon-calendar5"></i>
                                    <span>{{$activity->start->format('h:i A').'--'.$activity->end->format('h:i A')}},
                                    @if($activity->activity_type=='transport' and $activity->currentActivity!=null)
                                        Travel from {{$activity->currentActivity->start_location}} to {{$activity->currentActivity->end_location}} by {{$activity->currentActivity->transportType->name}}
                                    @elseif($activity->activity_type=='accommodate' and $activity->currentActivity!=null)
                                        Accommodate at {{$activity->currentActivity->accommodation_name}}
                                    @elseif($activity->activity_type=='meal' and $activity->currentActivity!=null)
                                            Have a meal at {{$activity->currentActivity->place_name}}
                                    @elseif($activity->currentActivity!=null)
                                            Travel to {{$activity->currentActivity->place_name}}
                                    @endif    
                                    </span>
                                </li>
                            </ul>
                            @endforeach
                        </div>
                    </div>    
                    @endforeach
                </div>
            </div>

        </div><!-- / Container -->
    </div>  
</div>  
