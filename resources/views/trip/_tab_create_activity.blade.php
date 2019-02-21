<div role="tabpanel" class="tab-pane" id="create_activity">
    <div class="section">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <!-- Blog Thumb Start -->
                    <div id="trip_activity" class="thinn-event-list mb-30">
                        <figure>
                            <img :src="'{{asset('/trip')}}'+'/'+activity_type+'.jpg'" alt=""> 
                        </figure>
                        <div class="text">
                            <div class="form-group">
                                                <div >
                                                <div class="content">
                                                    <form action="{{ route('create-activity') }}" 
                                                    method="post">
                                                        {{ csrf_field() }}
                                                        <input type="hidden" value="{{$trip->id}}" name="trip_id">
                                                        <div class="trip-edit-form">
                                                        <div class="row">
                                                            <div class="col-md-3">
                                                                <div class="form-group">
                                                                    <label>Type</label>
                                                                    <select class="form-controll" id="sel1" name="activity_type" v-model="activity_type">
                                                                        <option value="transport">Transport</option>
                                                                        <option value="accommodate">Accommodate</option>
                                                                        <option value="meal">Meal</option>
                                                                        <option value="travel">Travel</option>
                                                                        <option value="shopping">Shopping</option>
                                                                        <option value="stay">Stay</option>
                                                                     </select>   
                                                                        
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="form-group">
                                                                    <label>Cost:</label>
                                                                    <input type="text" id="cost" class="form-controll" name="cost" placeholder="Cost" value="">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label>Duration:</label>
                                                                    <input type="text" name="daterange" placeholder="Calendar" class="form-controll" value="" />
                                                                </div>
                                                            </div>
                                                            
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <label>Description</label>
                                                                    <input type="text" class="form-controll" placeholder="Here can be your description" name="description" value="">
                                                                        
                                                                        
                                                                    </textarea>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row" v-if="activity_type=='transport'">
                                                                <div class="col-md-4">
                                                                    <div class="form-group">
                                                                        <label>Transpotation Type</label>
                                                                        <select class="form-controll" id="sel1" name="transpotation_type_id" >
                                                                            @foreach($transpotation_types as $key => $transport_type)
                                                                            <option value="{{$transport_type->id}}"
                                                                                    
                                                                                >{{$transport_type->name}}</option>
                                                                            @endforeach               
                                                                        </select>
                                                                    </div>
                                                                </div> 
                                                                <div class="col-md-4">
                                                                    <div class="form-group">
                                                                        <label>Start Location:</label>
                                                                        <input type="text" id="budget" class="form-controll" name="start_location" placeholder="Start Location">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="form-group">
                                                                        <label>End Location:</label>
                                                                        <input type="text" id="budget" class="form-controll" name="end_location" placeholder="End Location">
                                                                    </div>
                                                                </div>
                                                        </div>
                                                        <div class="row" v-else-if="activity_type=='accommodate'">
                                                                <div class="col-md-8">
                                                                    <div class="form-group">
                                                                        <label>Place:</label>
                                                                        <input type="text" id="cost" class="form-controll" name="accommodation_name" placeholder="Place" value="">
                                                                    </div>
                                                                </div>
                                                        </div>
                                                        <div class="row" v-else-if="activity_type=='meal'">
                                                            meal
                                                        </div>
                                                        <div class="row" v-else>
                                                                <div class="col-md-8">
                                                                    <div class="form-group">
                                                                        <label>Place:</label>
                                                                        <input type="text" id="cost" class="form-controll" name="place_name" placeholder="Place" value="">
                                                                    </div>
                                                                </div>
                                                        </div>    
                                                            <!-- @include('trip._activity_create', ['transpotation_types' => $transpotation_types]) -->
                                                     

                                                        <button type="submit" class="btn btn-info btn-fill pull-right">
                                                        
                                                        Create
                                                        </button>
                                                        <div class="clearfix"></div>
                                                    </div>    
                                                        
                                                    </form>
                                                </div>
                                            </div>
                                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- / Container -->
    </div>        
</div>