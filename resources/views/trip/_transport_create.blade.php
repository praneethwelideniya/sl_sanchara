<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            <label>Transpotation Type</label>
            <select class="form-controll" id="sel1" name="transpotation_type_id" >
                @foreach($transpotation_types as $key => $transport)
                <option value="{{$transport->id}}"
                        @if ($activity->transpotation_type_id===$transport->id)
                            selected="selected"
                        @endif
                    >{{$transport->name}}</option>
                @endforeach               
            </select>
        </div>
    </div> 
    <div class="col-md-4">
        <div class="form-group">
            <label>Start Location:</label>
            <input type="text" id="budget" class="form-controll" name="start_location" placeholder="Start Location" value="{{ $activity!=null?$activity->start_location : ''}}">
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label>End Location:</label>
            <input type="text" id="budget" class="form-controll" name="end_location" placeholder="End Location" value="{{ $activity!=null?$activity->end_location : ''}}">
        </div>
    </div>   
</div>