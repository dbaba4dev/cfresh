<!-- Add Task Modal Form HTML -->
<div class="modal fade" id="addMaterialModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="frmAddMaterial">
                {{csrf_field()}}

                <div class="modal-header">
                    <h4 class="modal-title">
                        Add New Material
                    </h4>
                    <button aria-hidden="true" class="close" data-dismiss="modal" type="button">
                        ×
                    </button>
                </div>
                <div class="modal-body">
                    <div id="notification"></div>
                    <div class="form-group">
                        <label>
                            Name
                        </label>
                        <input class="form-control" id="material_name" name="name" required="" type="text">
                        </input>
                    </div>

                </div>
                <div class="modal-footer">
                    <input class="btn btn-default" data-dismiss="modal" type="button" value="Cancel">
                    <button class="btn btn-info" id="btn-add" type="submit" value="add">
                        Add Material
                    </button>
                    </input>
                </div>
            </form>
        </div>
    </div>
</div>
