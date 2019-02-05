<div class="search-bar-outer">
                    <div class="profile-bar">
                        <div class="row">
                            <div class="col-md-3 col-xs-6 col-sm-3">
                                    <div class="gallery-thumb th-bg">
                                    <figure>
                                            <div id="pro_image">
                                                <img v-if="img==''" id="pro_image_src" src="{{asset('/users').'/profile/'.$user->profileImage->src}}" alt="Profile Pic" widht="150" height="150"/>
                                                <img v-else id="pro_image_src" v-bind:src="img" alt="profile Pic" widht="150" height="150"/>
                                                @if($public==0)
                                                <figcaption  id="pro_fig">
                                                    <a >Upload a Photo <i class="icon-camera" @click="prepareToUpload()"></i></a>
                                                </figcaption>
                                                @endif
                                            </div>
                                        </figure>
                                    </div>
                            </div>
                            <div class="col-md-6 col-md-offset-1 col-xs-6 col-sm-9 traveller-list">
                                <div class="row">     
                                    <h1 style="font-size:40px;">{{$user->name}}</h1>
                                </div>
                                @if($complete==1)
                                <div class="row">
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
                                </div>
                                @endif
                            </div>
                            @if($complete==1)
                            <div class="row">
                            		<div class="col-md-3 col-xs-6 col-sm-3">
                               		 Number of Images: {{$public}}
                            		</div>
                            		<div class="col-md-3 col-xs-6 col-sm-3">
                               		 Check Ins: 25
                            		</div>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>