<template>
                <div class="search-bar-outer">
                    <div class="profile-bar">
                        <div class="row">
                            <div class="col-md-3 col-xs-6 col-sm-3">
                                    <div class="gallery-thumb th-bg">
                                    <figure>
                                            <div id="pro_image">
                                                <img v-if="img==''" id="pro_image_src" v-bind:src="image_src" alt="Profile Pic" widht="150" height="150"/>
                                                <img v-else id="pro_image_src" v-bind:src="img" alt="profile Pic" widht="150" height="150"/>
                                                <figcaption v-if="public==0" id="pro_fig">
                                                    <a href="#" data-toggle="modal" data-target="#uploadModal">Upload a Photo <i class="icon-camera" v-on:click="enableUpdate()"></i></a>
                                                </figcaption>
                                            </div>
                                        </figure>
                                    </div>
                            </div>
                            <div class="col-md-6 col-md-offset-1 col-xs-6 col-sm-9 traveller-list">
                                <div class="row">     
                                    <h1 style="font-size:40px;">{{user.name}}</h1>
                                </div>

                                <div v-if="complete==1" class="row">
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
                            </div>
                            <div v-if="complete==1"class="row">
                            <div class="col-md-3 col-xs-6 col-sm-3">
                                Number of Images: {{public}}
                            </div>
                            <div class="col-md-3 col-xs-6 col-sm-3">
                                Check Ins: 25
                            </div>
                            </div>
                        </div>
                    </div>
                </div> 
</template>    

<script>
    export default {
        props: {
            image_src: String,
            img :String,
            user: Object,
            public: Number,
            complete: Number
        },
        methods:{
        enableUpdate: function() {
            console.log("child");  
            this.$emit('enableUpdate');
        }
        }
        }
</script>                                   
 