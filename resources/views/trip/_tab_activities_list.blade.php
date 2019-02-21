<div role="tabpanel" class="tab-pane active" id="activities">
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
                                        <h5 class="title font-18">{{$key+1}}</h5>
                                        <ul class="blog-meta event-meta">
                                            <li>
                                                <i class="icon-calendar5"></i>
                                                <span>{{$activity->start->format('d M Y H:i:s')}}</span>
                                                ---
                                                <span>{{$activity->end->format('d M Y H:i:s')}}</span>
                                            </li>
                                            <li>
                                                <i class="icon-pricetags"></i>
                                                <span>Rs.{{$activity->cost}}</span>
                                            </li>
                                            <li>
                                                <i class="icon-pricetags"></i>
                                                <span>{{$activity->activity_type}}</span>
                                            </li>
                                        </ul>
                                        <p>{{$activity->description}}</p>
                                        <p>
                                            @if($activity->currentActivity!=null)
                                            @if($activity->activity_type==='transport')
                                            <h5 class="title font-18"><a href="#"><i class="icon-map-pin2"></i></a> Start Location:{{$activity->currentActivity->start_location}} </h5>
                                            <h5 class="title font-18"><a href="#"><i class="icon-map-pin2"></a></i> End Location:{{$activity->currentActivity->end_location}}</h5>
                                            <h5 class="title font-18">Travel By:{{$activity->currentActivity->transportType->name}}</h5>
                                            @elseif($activity->activity_type==='accommodate')
                                            <h5 class="title font-18"><a href="#"><i class="icon-map-pin2"></i></a> Location:{{$activity->currentActivity->accommodation_name}} </h5>
                                            @elseif($activity->activity_type==='meal')
                                            @else
                                            <h5 class="title font-18"><a href="#"><i class="icon-map-pin2"></i></a>Location:{{$activity->currentActivity->place_name}} </h5>
                                            @endif
                                            @endif
                                        </p>
                                        <a class="btn btn-2" href="#">Join Event</a>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div><!-- / Container -->
                </div><!-- /Blog Grid Section -->
</dev></div>