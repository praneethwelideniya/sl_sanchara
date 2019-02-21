            
            <div> 
                <div class="form-group">
                    <div class="content">
                            <div class="trip-edit-form">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input class="form-controll"  type="text" placeholder="Search" @keyUp="inputFun" v-model="searchKey">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <select class="form-controll" id="sel1" name="blog_type" v-model="blog_type" @change="typeChange()">
                                            <option value="place">Place</option>
                                            <option value="trip">Trip</option>
                                        </select> 
                                    </div>
                                </div>    
                            </div>
                        </div>
                    </div>
                </div>
                <div class="section">
                    <div class="container">
                        <div class="row">
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
                        <strong class="font-40">@{{blog_type=='place'?'Places':'Trips'}}</strong>                     
                        <div class="row" style="margin-top: 20px">
                            <div v-if="blogs==null">
                                <div class="col-md-12 col-sm-12">
                                    <strong class="font-50">Loading........</strong>
                                </div>
                            </div>
                            <div v-else-if="blogs.length==0">
                                <div class="col-md-12 col-sm-12">
                                    <strong class="font-50">No Result</strong>
                                </div>
                            </div>
                            <div v-else-if="blog_type=='place'" v-for="article in blogs">
                                <div class="col-md-4 col-sm-6">
                                    <!-- Blog Thumb Start -->
                                    <div class="thinn-blog-thumb thinn-blog-grid-blog mb-30">
                                        <figure>
                                            <img :src="'{{asset('')}}'+article.img_src" alt="profile Pic"/ height="220"> 
                                        </figure>
                                        <div class="text">
                                            <div class="date-box-holder">
                                                <div class="title-holder">
                                                    <h5 class="title font-18"><a :href="'{{route('articles')}}'+'/'+article.id">@{{article.heading}}</a></h5>
                                                </div>
                                                <div class="date-box">
                                                    <strong class="font-50">@{{article.d}}</strong>
                                                    <strong class="font-18">@{{article.M}}</strong>
                                                    <strong class="font-15">@{{article.Y}}</strong>
                                                </div>
                                            </div>
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>        
                            <div v-else-if="blog_type=='trip'" v-for="article in blogs">
                                <div class="col-md-4 col-sm-6">        
                                    <div class="thinn-tours-grid mb-30">
                                        <figure>
                                            <img :src="'{{asset('')}}'+article.img_src" alt="profile Pic"/ height="220">  
                                        </figure>
                                        <div class="text">
                                            <h5 class="title font-16"><a :href="'{{route('show-trip')}}'+'/'+article.id">@{{article.name}}</a></h5>
                                            <ul class="blog-meta tours-meta">
                                                <li>
                                                    <i class="icon-clock-1"></i>
                                                    <span>@{{article.start_time}} - @{{article.end_time}}</span>
                                                </li>
                                                <li>
                                                    <i class="icon-calendar3"></i>
                                                    <span>Availability : @{{article.start_time}} - @{{article.end_time}}</span>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
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
                </div><!-- /Blog Grid Section -->
            </div>
        