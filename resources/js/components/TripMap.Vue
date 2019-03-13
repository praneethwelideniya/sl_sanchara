<template>
  <GmapMap
  v-if="mapLoaded"
  ref="map"
  :center="{lat:7.2, lng:80}"
  :zoom="zoom"
  map-type-id="terrain"
  :style="style"
>
  <GmapMarker
    :key="index"
    v-for="(m, index) in markers"
    :position.sync="m.position"
    :clickable="true"
    :draggable="true"
    @click="center=m.position"
  />
</GmapMap>
</template>

<script>
export default { 
  props: {
    markers: Array,
    zoom: Number,
    style: String
   },
  data() {
    return {
      mapLoaded: false,
      place: null,
      directionsService:null,
directionsDisplay:null,
directionsDisplay:null
    }
  },
  methods: {
    getRoute: function () {
      this.directionsService = new google.maps.DirectionsService()
      this.directionsDisplay = new google.maps.DirectionsRenderer()
      this.directionsDisplay.setMap(this.$refs.map.$mapObject)
      var vm = this
      vm.directionsService.route({
        origin: '{lat:6,9271,lng:79.8612}', // Can be coord or also a search query 6.9271,79.8612
        destination:'{lat:6.9934,lng:81.0550}' ,//6.9934° N, 81.0550°
        travelMode: 'DRIVING'
      }, function (response, status) {
        if (status === 'OK') {
          vm.directionsDisplay.setDirections(response) // draws the polygon to the map
        } else {
          console.log('Directions request failed due to ' + status)
        }
      })
    }
},mounted(){
  this.getRoute();
}

}
</script>