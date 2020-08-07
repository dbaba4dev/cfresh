<!-- Add Task Modal Form HTML -->
<div class="modal fade" id="addPayTypeModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="frmAddPayType">
                {{csrf_field()}}
                <div class="modal-header bg-gradient-info">
                    <h4 class="modal-title">
                        Add New Type
                    </h4>
                    <button aria-hidden="true" class="close" data-dismiss="modal" type="button">
                        ×
                    </button>
                </div>
                <div class="modal-body">
                    <div id="notification"></div>
                   <div class="row">
                       <div class="col-sm-12">
                           <div class="input-group mb-3">
                               <div class="input-group-prepend">
                                   <span class="input-group-text bg-info">Payment Type</span>
                               </div>
                               <input type="text" class="form-control" id="pay_type" required name="type" >
                           </div>
                       </div>

                   </div>
                </div>
                <div class="modal-footer">
                    <input class="btn btn-default" data-dismiss="modal" type="button" value="Cancel">
                    <button class="btn btn-outline-info" id="btn-add" type="submit" value="add">
                        Add Type
                    </button>
                    </input>
                </div>
            </form>
        </div>
    </div>
</div>
