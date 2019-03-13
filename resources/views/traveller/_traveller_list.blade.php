
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
                        <a class="social" title="sl sanchara" :href="'/traveller/profile/'+tra.id">
                            <i  class="icon-mountains-with-moon"></i>
                        </a>
                    </li>
                    <li v-for="socil in tra.social_media"> 
                        <a class="social" :title="socil.name" :href="socil.pivot.public_profile">
                            <i v-if="socil.name=='fb'" class="icon-facebook3"></i>
                            <i v-if="socil.name=='instagram'" class="icon-instagram"></i>
                            <i v-if="socil.name=='youtube'" class="icon-youtube"></i>
                        </a>
                    </li>
                </ul>
                    <h5 class="title font-18">@{{tra.name}}</h5>
                </div>
                <!-- <a class="btn btn-2" :href="route('user-profile')'+'/'+tra.id">View detail</a>-->
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
