<template>    
    <div class="comment-holder gray-bg">
        <figure><img :src="'/users/profile/'+comment.user_img" alt=""/></figure>
        <div class="overflow-text">
            <div class="comment-header">
                <h4 class="title font-20">{{comment.user_name}}
                    <i v-if="comment.auth && !editable" class="icon-edit" @click.prevent="togleEditable()">Edit</i>
                    <i v-else-if="comment.auth && editable" class="icon-edit" @click.prevent="togleEditable()">Cancle</i>
                </h4>
                <div class="pull-right">
                    <time datetime="2018-02-27T04:59:01+00:00">{{comment.updated_at}}</time>
                </div>
            </div>
            <div v-if="editable && comment.auth" class="reply-form">
                <div class="row">
                    <div class="col-md-12">
                        <textarea class="form-control" style="height:100px" placeholder="Comment"
                        v-model="edited_comment"></textarea>
                    </div>
                    <input class="btn"  @click.prevent="editComment()" :disabled="but_dis===true" value="Update">
                </div>
            </div>
            <div v-else>
                <p >{{comment.comment}}</p>
                <div v-if="parent_comment" class="reply-form">
                    <div class="row">
                        <div class="col-md-12">
                            <textarea class="form-control" style="height:100px" placeholder="Comment"
                            v-model="new_reply"></textarea>
                        </div>
                        <input class="btn"  @click.prevent="addReply()" :disabled="but_dis===true" value="Add Reply">
                    </div>
                </div>
            </div>
            <div v-if="comment.auth || comment.asset_user" class="row">
                <div class="col-md-4 col-md-offset-8">
                    <input class="btn"  @click.prevent="deleteComment()" value="Delete">
                </div>
            </div>
        </div>
    </div>
</template>    

<script>
    export default {
        props: {
            comment: Object,
            parent_comment: Boolean
        },
        data(){
            return {
                but_dis:true,
                new_reply:'',
                editable:false,
                edited_comment:'',
                asset_type:''
            }
        },
        methods: {
            deleteComment(event){
                console.log('start deleting');
                this.$emit('delete_comment',{'id':this.comment.id,'parent':this.parent_comment});
             },
             addReply(event){
                 this.$emit('addreply',{'comment':this.new_reply,'id':this.comment.id,'asset':'comment'});
                 this.new_reply='';
             },
             editComment(event){
                 this.$emit('editcomment',{'comment':this.edited_comment,'id':this.comment.id});
                 this.editable=!this.editable;
                 this.edited_comment='';
             },
             togleEditable(){
                 this.editable=!this.editable;
                 this.edited_comment=this.comment.comment
             }
        },
        watch:{
            new_reply:function(val){
                if(val.length>0){
                    this.but_dis=false;
                }
                else{
                   this.but_dis=true; 
                }
            },
            edited_comment:function(val){
                if(val.length>0){
                    this.but_dis=false;
                }
                else{
                   this.but_dis=true; 
                }
            }
        }
        }
</script>  