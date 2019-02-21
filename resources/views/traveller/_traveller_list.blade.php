
<div class="container">
    <div class="row">
        <div v-for="(tra,index) in travellers" v-cloak>
        <div class="col-md-3 col-sm-4">
            <!-- Event Thumb Start -->
            <div class="traveller-list thinn-blog-thumb  thinn-blog-grid mb-30">
                <figure>
                    <img :src="'{{asset('users')}}'+'/profile/'+tra.profile_image.src" height="100px">              
                </figure>
                <div class="text">
                <ul>
                    <li> 
                        <a class="social" title="Facebook" href="#"><i class="icon-facebook3"></i></a>
                    </li>
                    <li>
                        <a class="social" title="Twitter" href="#"> <i class="icon-twitter3"></i> </a> 
                    </li>
                    <li> 
                        <a class="social" title="Google Bookmark" href="#"> <i class="icon-googleplus"></i> </a> 
                    </li> 
                    <li>
                        <a class="social" href="#"> <i class="icon-linkedin3"></i> </a>
                    </li>
                </ul>
                    <h5 class="title font-18">@{{tra.name}}</h5>
                </div>
                <a class="btn btn-2" :href="'{{route('user-profile')}}'+'/'+tra.id">View detail</a>
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
</div>
