window.Vue = require('vue');
window.axios = require('axios');

let token = document.head.querySelector('meta[name="csrf-token"]');

if (token) {
    window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
} else {
    console.error('CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token');
}


Vue.config.productionTip = false

var MyComponent = Vue.component('my-profile', require('./components/Profile.vue')); 
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
        deleteFile() {
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
        errors: {}
    },

    methods: {

        isCurrentPage(page) {
            return this.pagination.current_page === page;
        },

        fetchtraveller(page) {
            axios.get('travellerslist/'+ '?page=' + page).then(result => {
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
        console.log("traveller");
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
        blogs: {},
        offset: 5,
        errors: {},
        travellers:{},
        searchKey:'',
        url:'',
        url_string:''
    },

    methods: {

        isCurrentPage(page) {
            return this.pagination.current_page === page;
        },

        fetchblogs(page) {
            
            if(this.searchKey.length>4){
                this.url=this.url_string+'/'+this.searchKey+'?page=' + 1;
            }
            else{
                this.url=this.url_string+'?page=' + page;
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