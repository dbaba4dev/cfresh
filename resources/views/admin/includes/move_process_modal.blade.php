<!-- Add Task Modal Form HTML -->
<div class="modal fade" id="MoveProcessModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="frmMoveProcess">
                {{csrf_field()}}
                <div class="modal-header small-box bg-info">
                    <h4 class="modal-title">
                        New Batch
                    </h4>
                    <button aria-hidden="true" class="close" data-dismiss="modal" type="button" style="margin-top: -3rem">
                        ×
                    </button>
                </div>
                <div class="modal-body">
                    <div id="notification"></div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="text-xs">
                                    Company
                                </label>
                                <input class="form-control form-control-sm" id="name" name="company" required  type="text">
                                </input>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="text-xs">
                                    Preform Weight (g)
                                </label>
                                <input class="form-control form-control-sm" id="preform_weight" name="preform_weight" required  type="number">

                            </div>
                        </div>

                    </div>
                    <hr>
                    <label for="" class="text-info">Preforms</label>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="text-xs">
                                    Weight of Bag (kg)
                                </label>
                                <input class="form-control form-control-sm" id="kg_bags" name="kg_bags"  required type="text">
                                </input>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="text-xs">
                                    Number of Bag
                                </label>
                                <input class="form-control form-control-sm" id="no_bags" name="no_bags" required  type="number">

                            </div>
                        </div>

                    </div>

                    <hr>
                    <label for="" class="text-info">Labels</label>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="text-xs">
                                    Weight of Bag (kg)
                                </label>
                                <input class="form-control form-control-sm" id="kg_bags" name="kg_bags"  required type="text">
                                </input>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="text-xs">
                                    Number of Bag
                                </label>
                                <input class="form-control form-control-sm" id="no_bags" name="no_bags" required  type="number">

                            </div>
                        </div>

                    </div>

                    <hr>
                    <label for="" class="text-info">Caps</label>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="text-xs">
                                    Weight of Bag (kg)
                                </label>
                                <input class="form-control form-control-sm" id="kg_bags" name="kg_bags"  required type="text">
                                </input>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="text-xs">
                                    Number of Bag
                                </label>
                                <input class="form-control form-control-sm" id="no_bags" name="no_bags" required  type="number">

                            </div>
                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <input class="btn btn-outline-info" data-dismiss="modal" type="button" value="Cancel">
                    <button class="btn btn-info" id="btn-add" type="submit" value="add">
                        Add Batch
                    </button>

                </div>
            </form>
        </div>
    </div>
</div>
