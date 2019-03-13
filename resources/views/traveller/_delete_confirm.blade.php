<div class="modal" :class="modalActive.deleteConfirm?'is-active':'fade'" role="dialog" v-if="showConfirm.deleteConfirm" v-cloak>
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Delete Confirmation</h4>
        </div>
        <div class="modal-body">
                    <h2>Are you sure?</h2>
                </div>

                <div class="modal-footer">
                    <button class="button" @click="deleteAsset()">
                        Confirm
                    </button>
                    <button class="button" @click="cancelDeleting()">
                        Cancel
                    </button>
                </div>
        
    </div>

  </div>
</div>