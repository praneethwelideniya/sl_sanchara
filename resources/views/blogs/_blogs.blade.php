            
            <div> 
                <div class="search-bar-outer">
                    <div class="profile-bar" style="width:500px; background-color: white;">
                        <div class="row">
                            <div class="col-md-3 col-xs-6 col-sm-3">
                                <div class="input-field">
                                    <input class="form-control" style="width: 400px" type="text" placeholder="Search" @keyUp="inputFun" v-model="searchKey">
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
                        <br><br><br>                        
                        <div class="row">
                            <div v-for="article in blogs">
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
                                <!-- /Blog Thumb End -->
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
        