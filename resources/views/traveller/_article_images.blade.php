<div id="article">
<input type="hidden" ref="article_id" value="{{$article->id}}" >    
@if($edit)     
<h4 class="section-title font-26">Upload Photos <i class="icon-camera" @click="prepareToUpload()"></i> </h4>
<button @click="makeMarkerble()">Select and Delete</button>
<button v-if="markerble" @click="prepareToDelete()">Delete selected</button>
<button v-if="markerble" @click="cancelDeleting()">Cancel</button> 
@endif
<div class="container">
    <div class="row">
        <div v-for="(image,index) in images" v-cloak>
        <div class="col-md-4 col-sm-6">
            <!-- Event Thumb Start -->
            <div class="thinn-event-thumb thinn-event-grid mb-30">
                <figure>
                    <img :src="'{{asset('users/'.$article->user->id.'/article')}}'+'/'+image.src" alt=""  @click="mark(image.id)">
                    @if($edit) 
                    <a :class="image.pivot.image_type=='cover'?'set-cover-icon':'set-cover-icon setted-cover'" href="#" @click="makeCover(image.id,pagination.current_page)" >
                    </a>
                    <a v-if="markerble" class="set-delete-icon" @click="mark(index,image.id)">
                        <i v-if="image.selected" class="icon-delete"></i>
                    </a>
                    @endif
                </figure>
            </div>
            <!-- /Event Thumb End -->
        </div>
        </div>
        <div class="col-md-12">
         <nav class="pagination is-centered" role="navigation" aria-label="pagination" v-if="pagination.last_page > 1" v-cloak>
            <a class="pagination-previous" @click.prevent="changePage(1)" :disabled="pagination.current_page <= 1">First page</a>
            <a class="pagination-previous" @click.prevent="changePage(pagination.current_page - 1)" :disabled="pagination.current_page <= 1">Previous</a>
            <a class="pagination-next" @click.prevent="changePage(pagination.current_page + 1)" :disabled="pagination.current_page >= pagination.last_page">Next page</a>
            <a class="pagination-next" @click.prevent="changePage(pagination.last_page)" :disabled="pagination.current_page >= pagination.last_page">Last page</a>
            <ul class="pagination-list">
                <li v-for="page in pages">
                    <a class="pagination-link" :class="isCurrentPage(page) ? 'is-current' : ''" @click.prevent="changePage(page)">
                        @{{ page }}
                    </a>
                </li>
            </ul>
        </nav>
        </div>
    </div>
</div><!-- / Container -->
@include('traveller._upload_images');
@include('traveller._delete_confirm');
</div>