<div class="modal" :class="modalActive?'is-active':'fade'" role="dialog" v-if="showConfirm" v-cloak>
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
                <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Upload Profile Picture</h4>
        </div>
        
            <!-- Form -->
            <form method='' action='' @submit.prevent="submitForm">
                <div class="modal-body">
                Select file : <input class="input" type="file" ref="file" name="file" @change="addFile()" onchange="readURL(this);"><br>
                    </div>
                <!-- <input class="hidden" type="text" name="id" placeholder="File name" v-model="fileName" required>  --> 
                <div class="modal-footer">             
                <button  class="button" type="submit" >
                    Add new file
                </button>
                <button class="button" @click="cancelUpdating()">
                        Cancel
                    </button>
                <span class="file-name" v-if="attachment.name" v-html="attachment.name"></span>
                </div>
            </form>

            <!-- Preview-->
            <div id='preview' v-if="message!=''">@{{message}}</div>
        
    </div>

  </div>
</div>