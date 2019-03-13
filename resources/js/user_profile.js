window.Vue = require('vue');
window.axios = require('axios');

import * as VueGoogleMaps from 'vue2-google-maps';
import {gmapApi} from 'vue2-google-maps';
window.Bus=new Vue;
Vue.use(VueGoogleMaps, {
    load: {
        key: 'AIzaSyAsjFzcx-X204JRaHMmyZQNss63H0XpaxI',
        libraries: 'directions', //// If you need to use place input
    }
});
var Googlemap =Vue.component('google-map', VueGoogleMaps.Map);
var Googlemarker=Vue.component('google-marker', VueGoogleMaps.Marker);
var TripMap=Vue.component('trip-map', require('./components/TripMap.vue'));

let token = document.head.querySelector('meta[name="csrf-token"]');

if (token) {
    window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
} else {
    console.error('CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token');
}


Vue.config.productionTip = false;
var MyComponent = Vue.component('my-profile', require('./components/Profile.vue'));

var Comment=Vue.component('comment', require('./components/Comment.vue'));

if (document.querySelector('#sl_sanchara')) {
const app = new Vue({
	el: '#sl_sanchara',
	components : {
		MyComponent
	},
	data: {
        files: {},
        file: {},

        pagination: {},
        offset: 5,

        activeTab: 'image',
        isVideo: false,
        loading: false,

        formData: {},
        fileName: '',
        attachment: '',
        user_id: 5,
        editingFile: {},
        deletingFile: {},

        notification: false,
        showConfirm: false,
        modalActive: false,
        message: '',
        route:"/dsadasd/fsaf",
        errors: {},
        img:''
    },
   methods: {
      mydetails : function() {
         return counter++;
      },
       submitForm() {
            this.formData = new FormData();
            this.formData.append('id', this.user_id);
            this.formData.append('pic', this.attachment);

            axios.post('/user/user-profile-pic', this.formData, {headers: {'Content-Type': 'multipart/form-data'}})
                .then(response => {
                	console.log(response);
                	this.message="Success";
                	this.img=response.data.src;
                    console.log(this.img);
                    // this.resetForm();
                    // this.showNotification('File successfully upload!', true);
                    // this.fetchFile(this.activeTab);
                })
                .catch(error => {
                	console.log("error");
                	this.message=error.response.data.message;
                    // this.errors = error.response.data.errors;
                    // this.showNotification(error.response.data.message, false);
                    // this.fetchFile(this.activeTab);
                });
        },

        addFile() {
            this.attachment = this.$refs.file.files[0];
        },
        fetchFile(type, page) {
  			this.loading = true;
  			axios.get('files/' + type + '?page=' + page).then(result => {
      			this.loading = false;
      			this.files = result.data.data.data;
      			this.pagination = result.data.pagination;
  			}).catch(error => {
      			console.log(error);
      			this.loading = false;
  		});
	},
            prepareToUpload:function(){
            this.showConfirm = true;
            this.modalActive=true;
        },

        cancelUpdating() {
            this.modalActive=false;
            this.showConfirm = false;
            console.log("works");
        },
}
});
}

if (document.querySelector('#article')) {
const article = new Vue({
    el: '#article',

    directives: {
            'autofocus': {
                inserted(el) {
                    el.focus();
                }
            }
    },

    data: {
        files: {},
        file: {},
        markerble:false,

        pagination: {},
        offset: 5,
        article_id:'',
        activeTab: 'image',
        isVideo: false,
        loading: false,

        formData: {},
        fileName: '',
        attachment: [],

        editingFile: {},
        deletingFile: {},

        notification: false,
        showConfirm:{
          uploadImages:false,
          deleteConfirm:false
        } ,
        modalActive:{
          uploadImages:false,
          deleteConfirm:false
        },
        message: '',
        errors: {},
        images:{},
        selectedList:[]
    },

    methods: {
        isCurrentPage(page) {
            return this.pagination.current_page === page;
        },

        fetchImages(article_id,page) {
            this.loading = true;
            axios.get('/user/article_images/' + article_id+ '?page=' + page).then(result => {
                this.loading = false;
                this.images = result.data.data.data;
                this.pagination = result.data.pagination;
                this.markerble=false;
                console.log("works");
            }).catch(error => {
                console.log(error);
                this.loading = false;
            });

        },

        submitForm() {
            this.formData = new FormData();
            this.formData.append('articleId',this.article_id);
            for( var i = 0; i < this.attachment.length; i++ ){
              let file = this.attachment[i];

              this.formData.append('files[' + i + ']', file);
            }

            axios.post('/user_article/user-article-pic',this.formData, {headers: {'Content-Type': 'multipart/form-data'}})
                .then(response => {
                    console.log(response);
                    this.fetchImages(this.article_id,this.pagination.current_page);
                })
                .catch(error => {
                    console.log(error);
                });
        },

        addFile() {
                this.attachment = this.$refs.pics.files;

        },

        prepareToDelete() {
            this.showConfirm.deleteConfirm = true;
            this.modalActive.deleteConfirm=true;
        },

        cancelDeleting() {
            this.modalActive.deleteConfirm=false;
            this.showConfirm.deleteConfirm = false;
            this.fetchImages(this.article_id,this.pagination.current_page);
            console.log("works");
        },
        deleteAsset() {
        	for(image in this.images.filter(image=> image.selected == true)){
        		this.selectedList.push(image.id);
        	}
        	console.log(this.selectedList);

            axios.post('/user/article/delete_images' ,{'images':this.images.filter(image=> image.selected == true),'article_id':this.article_id})
                .then(response => {
                    this.fetchImages(this.article_id, this.pagination.current_page);
                    this.markerble=false;
                })
                .catch(error => {
                    this.errors = error.response.data.errors();
                    this.showNotification('Something went wrong! Please try again later.', false);
                    this.fetchFile(this.activeTab, this.pagination.current_page);
                });

            this.cancelDeleting();
        },

        changePage(page) {
            if (page > this.pagination.last_page) {
                page = this.pagination.last_page;
            }
            this.pagination.current_page = page;
            this.fetchImages(this.article_id, page);
        },

        resetForm() {
            this.formData = {};
            this.fileName = '';
            this.attachment = '';
        },

        anyError() {
            return Object.keys(this.errors).length > 0;
        },

        clearErrors() {
            this.errors = {};
        },
        makeCover(id,page){
        	axios.get('/user/article/addorremovecover/'+id)
        	.then(response => {
                this.loading = false;
                this.fetchImages(this.article_id,page)
            }).catch(error => {
                console.log(error);
                this.loading = false;
            });
        },
        makeMarkerble(){
        		this.markerble=true;
        },
        mark(id,img_id){
        	if('selected' in this.images[id] && this.images[id].selected==true ){

        			this.images[id].selected=false;

        	}
        	else if('selected' in this.images[id] && this.images[id].selected==false ){
        			this.images[id].selected=true;
        	}
        	else{
        			this.$set(this.images[id], 'selected', true);
        			this.selectedList.push(img_id);
        	}
        	console.log(this.images.filter(image=> image.selected == true));
        },
        prepareToUpload() {
            this.showConfirm.uploadImages = true;
            this.modalActive.uploadImages=true;
        },

        cancelUpdating() {
            this.modalActive.uploadImages=false;
            this.showConfirm.uploadImages = false;
            console.log("works");
        },
    },

    mounted() {
        this.fetchImages(this.$refs.article_id.value, 1);
        this.article_id =this.$refs.article_id.value;

    },

    computed: {
        pages() {
            let pages = [];

            let from = this.pagination.current_page - Math.floor(this.offset / 2);

            if (from < 1) {
                from = 1;
            }

            let to = from + this.offset - 1;

            if (to > this.pagination.last_page) {
                to = this.pagination.last_page;
            }

            while (from <= to) {
                pages.push(from);
                from++;
            }

            return pages;
        }
    }
});
}
if (document.querySelector('#traveller')) {
const traveller = new Vue({
    el: '#traveller',

    directives: {
            'autofocus': {
                inserted(el) {
                    el.focus();
                }
            }
    },

    data: {

        pagination: {},
        travellers: {},
        offset: 5,
        errors: {},
        trip_id:'',
        url:'/travellerslist'
    },

    methods: {

        isCurrentPage(page) {
            return this.pagination.current_page === page;
        },

        fetchtraveller(page) {
            axios.get(this.url+'/'+ '?page=' + page).then(result => {
                console.log("dsad");
                this.travellers = result.data.data.data;
                this.pagination = result.data.pagination;
            }).catch(error => {
                console.log(error);
                this.loading = false;
            });

        },
        changePage(page) {
            if (page > this.pagination.last_page) {
                page = this.pagination.last_page;
            }
            this.pagination.current_page = page;
            this.fetchtraveller(page);
        },

        anyError() {
            return Object.keys(this.errors).length > 0;
        }
    },

    mounted() {
        if(this.trip_id!=''){
            this.url='/trip/travellerslist/'+this.trip_id;
        }
        this.fetchtraveller(this.pagination.current_page);
    },

    computed: {
        pages() {
            let pages = [];

            let from = this.pagination.current_page - Math.floor(this.offset / 2);

            if (from < 1) {
                from = 1;
            }

            let to = from + this.offset - 1;

            if (to > this.pagination.last_page) {
                to = this.pagination.last_page;
            }

            while (from <= to) {
                pages.push(from);
                from++;
            }

            return pages;
        }
    }
});
}

if (document.querySelector('#blogs')) {
const blogs = new Vue({
    el: '#blogs',

    directives: {
            'autofocus': {
                inserted(el) {
                    el.focus();
                }
            }
    },

    data: {
        user_id:'',
        pagination: {},
        blogs: [],
        offset: 5,
        errors: {},
        travellers:{},
        searchKey:'',
        url:'',
        url_string:'',
        blog_type:'place'
    },

    methods: {

        isCurrentPage(page) {
            return this.pagination.current_page === page;
        },

        fetchblogs(page) {

            if(this.searchKey.length>4){
                this.url=this.url_string+'/'+ this.blog_type+'/'+this.searchKey+'?page=' + 1;
            }
            else{
                this.url=this.url_string+'/'+ this.blog_type+'?page=' + page;
            }
            axios.get(this.url).then(result => {
                this.blogs = result.data.data.data;
                this.pagination = result.data.pagination;
            }).catch(error => {
                console.log(error);
            });

        },
        changePage(page) {
            if (page > this.pagination.last_page) {
                page = this.pagination.last_page;
            }
            this.pagination.current_page = page;
            this.fetchblogs(page);
        },

        anyError() {
            return Object.keys(this.errors).length > 0;
        },
        inputFun: function(event) {
                if (this.timer) {
                clearTimeout(this.timer);
                this.timer = null;
            }
            this.timer = setTimeout(() => {
                this.fetchblogs(this.pagination.current_page);
            }, 1000);

        },
        typeChange(){
            this.blogs=null;
            this.fetchblogs(1);
        }
    },

    mounted() {
        if(this.$el.getAttribute('user_id')!='0'){
           this.url_string = '/search/user-articles/'+this.$el.getAttribute('user_id');
        }
        else{
          this.url_string = '/search/articles';
        }
        this.fetchblogs(this.pagination.current_page);
    },

    computed: {
        pages() {
            let pages = [];

            let from = this.pagination.current_page - Math.floor(this.offset / 2);
            if (from < 1) {
                from = 1;
            }

            let to = from + this.offset - 1;

            if (to > this.pagination.last_page) {
                to = this.pagination.last_page;
            }

            while (from <= to) {
                pages.push(from);
                from++;
            }
            return pages;
        }
    }
});
}
if (document.querySelector('#trip')) {
    Vue.component('gmapmap', VueGoogleMaps.Map);
      Vue.component('gmapmarker', VueGoogleMaps.Marker);
const trip_activity = new Vue({
    el: '#trip',
    components:{TripMap},
    data: {
        activity_type:'transport',
        transport_type:1,
        location_list:{
            'first':[],
            'second':[]
        },
        pagination: {},
        travellers: {},
        offset: 5,
        optionShown:{
            'first':false,
            'second':false
        },
        errors: {},
        searchText:[],
        selectedLocationOne:{lat:null,lng:null},
        selectedLocationTwo:{lat:null,lng:null},
        url:'/travellerslist',
        type:'trip',
        asset_id:'',
        showConfirm:{
           uploadImages:false,
           deleteConfirm:false
        },
        modalActive:{
            uploadImages:false,
              deleteConfirm:false
        },
        selected:'dsada',
        place_url:'',
        selectedLocation: {
          name: '',
          place_id: ''
        },
        center: {
            lat: 7.2,
            lng: 80
          },
           markers: [],
           travel_directions:[],
      zoom:8,
      directionsService:null,
      directionsDisplay:[]
    },

    methods: {
        getPlaces(index){
            if(index==0 && this.searchText[0].length>3){
            if(this.activity_type=='transport' && this.transport_type==1){
                this.place_url='/api/places/bus_station';
            }
            else if(this.activity_type=='transport' && this.transport_type==3){
                this.place_url='/api/places/train_station';
            }
            else if(this.activity_type=='transport' && this.transport_type==2){
                this.place_url='/api/places/airport';
            }
            else{
                this.place_url='/api/places';
            }
            axios.get(this.place_url+'/'+this.searchText[0]).
               then(result=>{

                       this.location_list.first=result.data;
                       this.optionShown.first=true;
               }).catch(error =>{
                  console.log(error);

               });
               this.type=this.$el.getAttribute('type');
               this.asset_id=this.$el.getAttribute('asset_id');
        }
            if(index==1 && this.searchText[1].length>3){
            if(this.activity_type=='transport' && this.transport_type==1){
                this.place_url='/api/places/bus_station';
            }
            else if(this.activity_type=='transport' && this.transport_type==2){
                this.place_url='/api/places/airport';
            }
            else if(this.activity_type=='transport' && this.transport_type==3){
                this.place_url='/api/places/train_station';
            }
            else{
                this.place_url='/api/places';
            }
            axios.get(this.place_url+'/'+this.searchText[1]).
               then(result=>{

                       this.location_list.second=result.data;
                       this.optionShown.second=true;
               }).catch(error =>{
                  console.log(error);

               });
               this.type=this.$el.getAttribute('type');
               this.asset_id=this.$el.getAttribute('asset_id');
        }


    },
    getMarkers(){
            axios.get('/api/getTripLocations/'+this.asset_id).
               then(result=>{
                       this.markers=result.data.stay;
                       this.travel_directions=result.data.travel;
                       console.log(this.markers);
                       console.log(this.travel_directions+"1 time");
               }).catch(error =>{
                  console.log(error);

               });
    },
        prepareToDelete() {
            this.showConfirm.deleteConfirm = true;
            this.modalActive.deleteConfirm=true;
        },
        prepareToDeleteActivity(id) {
            this.type='activity';
            this.asset_id=id;
            this.showConfirm.deleteConfirm = true;
            this.modalActive.deleteConfirm=true;
        },
        cancelDeleting() {
            this.modalActive.deleteConfirm=false;
            this.showConfirm.deleteConfirm = false;
            this.type=this.$el.getAttribute('type');
            this.asset_id=this.$el.getAttribute('asset_id');
        },
           deleteAsset(){
               axios.post('/asset/delete'+'/'+this.type+'/'+this.asset_id).
               then(result=>{
                   this.showConfirm.deleteConfirm = true;
                   this.modalActive.deleteConfirm=true;
                   if(this.type!='activity'){
                       location.reload();
                   }
               }).catch(error =>{
                  console.log(error);

               });
               this.type=this.$el.getAttribute('type');
               this.asset_id=this.$el.getAttribute('asset_id');
           },
                   isCurrentPage(page) {
            return this.pagination.current_page === page;
        },
        fetchtraveller(page) {
            axios.get(this.url+'/'+ '?page=' + page).then(result => {
                this.travellers = result.data.data.data;
                this.pagination = result.data.pagination;
            }).catch(error => {
                console.log(error);
                this.loading = false;
            });

        },
        changePage(page) {
            if (page > this.pagination.last_page) {
                page = this.pagination.last_page;
            }
            this.pagination.current_page = page;
            this.fetchtraveller(page);
        },

        anyError() {
            return Object.keys(this.errors).length > 0;
        },
        validateSelection(selection) {
            this.selected = selection;
            console.log(selection.name+' has been selected');
          },
          getDropdownValues(keyword) {
            console.log('You could refresh options by querying the API with '+keyword);
          },
          selectOption(option,index) {
            this.searchText[index] = option.name;
            if(index==0){
              this.selectedLocationOne=option.location;
              console.log(this.selectedLocationOne.lat+" one selected"+this.selectedLocationOne.lat);
                this.optionShown.first=false;
                this.location_list.first=[];
            }
            else if(index==1){
              this.selectedLocationTwo=option.location;
              console.log(this.selectedLocationTwo.lat+" two selected"+this.selectedLocationTwo.lng);
                this.optionShown.second=false;
                this.location_list.second=[];
            }
            console.log(this.searchText[index]);
            console.log(this.optionShown);
          },
    },

    mounted() {
       this.asset_id=this.$el.getAttribute('asset_id');
        if(this.asset_id>0){
          this.getMarkers();
        this.url='/trip/travellerslist/'+this.asset_id;
        this.fetchtraveller(this.pagination.current_page);
        }

    },
    watch : {
               travel_directions:function(val) {
                 this.$refs.map.$mapCreated.then(() => {
               console.log('map created!')
               var vm = this;
               var map=this.$refs.map.$mapObject;
               this.directionsService = new google.maps.DirectionsService()
               this.travel_directions.forEach(function (value, key){
                 vm.directionsDisplay[key] =new google.maps.DirectionsRenderer({
                       preserveViewport: true,
                       map : map
                   });
                 vm.directionsService.route({
                   origin: value.origin, // Can be coord or also a search query 6.9271,79.8612
                   destination:value.destination ,//6.9934° N, 81.0550°
                   travelMode: 'DRIVING'
                 }, function (response, status) {
                   if (status === 'OK') {
                     vm.directionsDisplay[key].setDirections(response) // draws the polygon to the map
                   } else {
                     console.log('Directions request failed due to ' + status)
                   }
                 })
                 });
                 })
               }
    },
});
}
if(document.querySelector('#deleteAsset')){

    const deleteAsset= new Vue({
       el:'#deleteAsset',
       components:{
           TripMap
       },
       data: {
           pagination: {},
           travellers: {},
           offset: 5,
           errors: {},
           url:'/travellerslist',
           type:'',
           asset_id:'',
           showConfirm:{
              uploadImages:false,
              deleteConfirm:false
            },
            modalActive:{
                uploadImages:false,
                  deleteConfirm:false
            }
       },
       methods:{
        prepareToDelete() {
            this.showConfirm.deleteConfirm = true;
            this.modalActive.deleteConfirm=true;
        },
        prepareToDeleteActivity(id) {
            this.type='activity';
            this.asset_id=id;
            this.showConfirm.deleteConfirm = true;
            this.modalActive.deleteConfirm=true;
        },
        cancelDeleting() {
            this.modalActive.deleteConfirm=false;
            this.showConfirm.deleteConfirm = false;
            this.type=this.$el.getAttribute('type');
            this.asset_id=this.$el.getAttribute('asset_id');
        },
           deleteAsset(){
               axios.post('/asset/delete'+'/'+this.type+'/'+this.asset_id).
               then(result=>{
                   this.showConfirm.deleteConfirm = true;
                   this.modalActive.deleteConfirm=true;
                   if(this.type!='activity'){
                       location.reload();
                   }
               }).catch(error =>{
                  console.log(error);

               });
               this.type=this.$el.getAttribute('type');
               this.asset_id=this.$el.getAttribute('asset_id');
           },
                   isCurrentPage(page) {
            return this.pagination.current_page === page;
        },
        fetchtraveller(page) {
            axios.get(this.url+'/'+ '?page=' + page).then(result => {
                this.travellers = result.data.data.data;
                this.pagination = result.data.pagination;
            }).catch(error => {
                console.log(error);
                this.loading = false;
            });

        },
        changePage(page) {
            if (page > this.pagination.last_page) {
                page = this.pagination.last_page;
            }
            this.pagination.current_page = page;
            this.fetchtraveller(page);
        },

        anyError() {
            return Object.keys(this.errors).length > 0;
        }
       },
       mounted (){

           this.type=this.$el.getAttribute('type');
           this.asset_id=this.$el.getAttribute('asset_id');
           if(this.type=='trip'){
            this.url='/trip/travellerslist/'+this.asset_id;
            this.fetchtraveller(this.pagination.current_page);
            }
       }
    });
}

if (document.querySelector('#comment')) {
const comment = new Vue({
    el: '#comment',
    components : {
        Comment
    },
    data: {
        comments:[],
        asset_id:'',
        new_comment:'',
        comment_add_disable:true,
        asset_type:''

    },

    methods: {
        getComments() {
            axios.get('/get_comments/'+this.asset_id+'/'+this.asset_type).then(result => {
                this.comments = result.data;
            }).catch(error => {
                console.log(error);
            });

        },
        addComment(req){
            axios.post('/add_comment',req)
            .then(response => {
                    this.getComments();
                    this.new_comment='';
                })
                .catch(error => {
                    this.errors = error.response.data.errors();
                    this.showNotification('Something went wrong! Please try again later.', false);
                });
        },
        deleteComment:function(val){
            console.log('event emited');
            axios.post('/delete_comment',{'id':val.id,'asset_type':val.parent?this.asset_type:'comment'})
            .then(response => {
                    this.getComments();
                })
                .catch(error => {
                    this.errors = error.response.data.errors();
                    this.showNotification('Something went wrong! Please try again later.', false);
                });
        },
        editComment:function(val){
            axios.post('/update_comment',val)
            .then(response => {
                    this.getComments();
                })
                .catch(error => {
                    this.errors = error.response.data.errors();
                    this.showNotification('Something went wrong! Please try again later.', false);
                });
        },
        setComment(){
            this.addComment({'comment':this.new_comment,'id':this.asset_id,'asset':this.asset_type})
        },
        setReply:function(val){
            this.addComment(val);
        }
    },
    watch : {
               new_comment:function(val) {
                  if(val.length>0){
                      this.comment_add_disable=false;
                  }else{
                       this.comment_add_disable=true;
                  }
               }
    },

    mounted() {
        this.asset_id=this.$el.getAttribute('asset_id');
        this.parent_id=this.asset_id;
        this.asset_type=this.$el.getAttribute('asset_type');
        this.getComments();

    }
});
}
