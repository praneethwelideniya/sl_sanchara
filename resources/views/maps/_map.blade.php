
<div role="tabpanel" class="tab-pane" id="maps">
	<div class="section">
        <div class="container">
            <div class="row">
                <gmapmap
					ref="map"
					:center="{lat:7.2, lng:80}"
					:zoom="zoom"
					map-type-id="terrain"
					style="width: 100%; height: 600px"
					>
					<gmapmarker
					:key="index"
					v-for="(m, index) in markers"
					:position.sync="m.position"
					:clickable="true"
					:draggable="true"
					@click="center=m.position"
					/>
				</gmapmap>
            </div>
        </div><!-- / Container -->
    </div><!-- /Blog Grid Section -->
 </div>