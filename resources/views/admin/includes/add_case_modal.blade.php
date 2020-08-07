<!-- Add Task Modal Form HTML -->
<div class="modal fade" id="addCaseModal" style="font-size: .8rem">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="frmAddCase">
                {{csrf_field()}}

                <div class="modal-header bg-info" >
                    <h4 class="modal-title" style="font-size: 1.2rem">
                        Add New Case
                    </h4>
                    <button aria-hidden="true" class="close" data-dismiss="modal" type="button">
                        ×
                    </button>
                </div>
                <div class="modal-body">
                    <div id="notification"></div>
                   <div class="row">
                       <div class="col-sm-3">
                           <div class="form-group">
                               <label>
                                   Name
                               </label>
                               <input class="form-control" id="material_name" name="name" required="" type="text">
                           </div>
                       </div>
                       <div class="col-sm-3">
                           <div class="form-group">
                               <label>
                                   preform (g)
                               </label>
                               <input class="form-control" id="preform_g" name="preform_g" required="" type="text">
                           </div>
                       </div>
                       <div class="col-sm-3">
                           <div class="form-group">
                               <label>
                                   Cap (g)
                               </label>
                               <input class="form-control" id="cap_g" name="cap_g" required="" type="text">
                           </div>
                       </div>
                       <div class="col-sm-3">
                           <div class="form-group">
                               <label>
                                   Label (g)
                               </label>
                               <input class="form-control" id="label_g" name="label_g" required="" type="text">
                           </div>
                       </div>
                   </div>

                </div>
                <div class="modal-footer">
                    <input class="btn btn-default" data-dismiss="modal" type="button" value="Cancel">
                    <button class="btn btn-outline-info" id="btn-add-case" type="submit" value="add">
                        Add Case
                    </button>
                    </input>
                </div>
            </form>
        </div>
    </div>
</div>
