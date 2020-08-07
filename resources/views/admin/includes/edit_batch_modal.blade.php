<!-- Add Task Modal Form HTML -->
<div class="modal fade" id="editBatchModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="frmEditBatch">
                {{csrf_field()}}
                <div class="modal-header">
                    <h4 class="modal-title">
                        Edit Batch
                    </h4>
                    <button aria-hidden="true" class="close" data-dismiss="modal" type="button">
                        ×
                    </button>
                </div>
                <div class="modal-body">
                    <div id="notification"></div>
                    <input type="hidden" name="id" id="id" class="id">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>
                                    Company
                                </label>
                                <input class="form-control" id="company" name="company" required  type="text">
                                </input>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>
                                    Preform Weight (g)
                                </label>
                                <input class="form-control" id="preform_weight_id" name="preform_weight" required  type="number">

                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>
                                    Weight of Bag (kg)
                                </label>
                                <input class="form-control" id="kg_bags_id" name="kg_bags"  required type="text">
                                </input>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>
                                    Number of Bag
                                </label>
                                <input class="form-control" id="no_bags_id" name="no_bags" required  type="number">

                            </div>
                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <input class="btn btn-default" data-dismiss="modal" type="button" value="Cancel">
                    <button class="btn btn-info" id="btn-add" type="submit" value="add">
                        Update Batch
                    </button>

                </div>
            </form>
        </div>
    </div>
</div>
