<div role="tabpanel" class="tab-pane active" id="detail">
        <div class="theme-tab-content">
            <div class="map"></div>
            <h4 class="section-title font-26">Trip Details</h4>
            <p id="idshow"></p>
            <!-- List Row Start -->
            <div class="form-group">
                <div class="content">
                    <form action="{{ ($trip==null)? route('store-trip') : route('update-trip',$trip->id) }}" 
                    method="post">
                        {{ csrf_field() }}
                        <div class="trip-edit-form">
                        <div class="row">
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label>Type</label>
                                    <select class="form-controll" id="sel1" name="type" >
                                        
                                        <option value="public"
                                                @if ($trip!=null && $trip->type==='public')
                                                    selected="selected"
                                                @endif
                                            >Public</option>
                                        <option value="private"
                                                @if ($trip!=null && $trip->type==='private')
                                                    selected="selected"
                                                @endif
                                            >Private</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label>Budget:</label>
                                    <input type="text" id="budget" class="form-controll" name="budget" placeholder="Budget" value="{{ ($trip!=null)?$trip->budget : ''}}">
                                </div>
                            </div>
                            
                        </div>
                        <div class="row">
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label>Start Location:</label>
                                    <input type="text" id="budget" class="form-controll" name="start_location" placeholder="Start Location" value="{{ ($trip!=null)?$trip->start_location : ''}}">
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label>End Location:</label>
                                    <input type="text" id="budget" class="form-controll" name="end_location" placeholder="End Location" value="{{ ($trip!=null)?$trip->end_location : ''}}">
                                </div>
                            </div>             
                        </div>
                        <div class="row">
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label>Duration:</label>
                                    <input type="text" name="daterange" placeholder="Calendar" class="form-control" value="{{$trip!=null?$trip->start_time->format('Y/m/d H:i').' - '.$trip->end_time->format('Y/m/d H:i'):''}}" />
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="form-group">

                                    <label>Name</label>
                                    <input type="text" class="form-controll" placeholder="NAME" name="name"
                                     value="{{ ($trip!=null)?$trip->name : ''}}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <h1><label>Description</label></h1>
                                    <textarea rows="100" id="trip-ckeditor" class="form-control" placeholder="Here can be your description" name="description">
                                        {!! ($trip!=null)?$trip->description : '' !!}
                                        
                                    </textarea>
                                </div>
                            </div>
                        </div>

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