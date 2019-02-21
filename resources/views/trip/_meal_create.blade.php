<!-- <div class="row">
    <div class="col-md-3">
        <div class="form-group">
            <label>Type</label>
            <select class="form-controll" id="sel1" name="type" >
                
                <option value="transport"
                        @if ($activity->activity_type==='transport')
                            selected="selected"
                        @endif
                    >Transport</option>
                <option value="accommodate"
                        @if ($activity->activity_type==='accommodate')
                            selected="selected"
                        @endif
                    >Accommodate</option>
                <option value="stay"
                        @if ($activity->activity_type==='stay')
                            selected="selected"
                        @endif
                    >Stay</option> 
                <option value="travel"
                        @if ($activity->activity_type==='travel')
                            selected="selected"
                        @endif
                    >Travel</option>
                <option value="meal"
                        @if ($activity->activity_type==='meal')
                            selected="selected"
                        @endif
                    >Meal</option>           
            </select>
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
            <input type="text" name="daterange" placeholder="Calendar" class="form-control" value="{{$activity->start->format('Y/m/d H:i').' - '.$activity->end->format('Y/m/d H:i')}}" />
        </div>
    </div>
    
</div> -->