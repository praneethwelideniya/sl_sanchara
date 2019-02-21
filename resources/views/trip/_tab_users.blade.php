<div role="tabpanel" class="tab-pane active" id="trip_users">
	<div class="section">
        <div class="container">
            <div class="row">
                <div id="traveller">
                	<input type="hidden" :value="trip_id={{$id}}">
                    @include('traveller._traveller_list');
                </div>
            </div>
        </div><!-- / Container -->
    </div><!-- /Blog Grid Section -->
 </div>