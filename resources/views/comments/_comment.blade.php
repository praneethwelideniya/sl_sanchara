<!-- RECENT COMMENTS START -->
<div id="comment" asset_id="{{$id}}" asset_type="{{$type}}" class="comments-list">
    <!-- RECENT COMMENTS END -->
    <div class="leave-reply gray-bg">
        <h2 class="section-title font-26">Leave comment</h2>
        <div class="reply-form">
            <div class="row">
                <div class="col-md-12">
                    <textarea class="form-control" style="height:100px" placeholder="Comment"
                    v-model="new_comment"></textarea>
                </div>
                <div class="col-md-12">
                    <input class="btn" type="submit" @click.prevent="setComment()" :disabled="comment_add_disable===true" value="Add Comment">
                </div>
            </div>
        </div>
    </div>    
    <h2 class="section-title font-26">Recent Comments</h2>
    <ul class="comments">
        <div v-for="comment in comments">
        <li >
            <comment  :comment="comment" @addreply="setReply" @delete_comment="deleteComment" :parent_comment="true"
            @editcomment="editComment" 
            ></comment>
            <ul v-if="comment.replies!='null'" class="children">
                <li v-for="reply in comment.replies">
                    <comment :comment="reply" :parent_comment="false" @delete_comment="deleteComment" @editcomment="editComment" 
                    ></comment>
                </li>
            </ul>
            
        </li>
        </div>
        <!-- Comemnts end -->
    </ul>
</div>