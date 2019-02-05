<div class="modal" :class="modalActive.uploadImages?'is-active':'fade'" role="dialog" v-if="showConfirm.uploadImages" v-cloak>
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
                <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">File upload form</h4>
        </div>
        <div class="modal-body">
            <img id="blah" src="#" alt="selected image" height="150" width="150"/>
            <!-- Form -->
            <form method='' action='' @submit.prevent="submitForm">
                Select file : <input class="file-input" type="file[]" ref="file" name="file" @change="addFile()" onchange="readURL(this);"><br>
                <!-- <input class="hidden" type="text" name="id" placeholder="File name" v-model="fileName" required>  -->              
                <button type="submit" class='btn btn-info'>
                    Add new file
                </button>
                <span class="file-name" v-if="attachment.name" v-html="attachment.name"></span>
            </form>

            <!-- Preview-->
            <div id='preview' v-if="message!=''">@{{message}}</div>
        </div>
    </div>

  </div>
</div>