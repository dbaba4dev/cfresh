<!-- Add Task Modal Form HTML -->
<div class="modal fade" id="moveMaterialModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="frmmoveMaterial" method="POST">
                {{csrf_field()}}

                <div class="modal-header bg-gradient-info">
                    <h4 class="modal-title">
                        Stock to In-Process
                    </h4>
                    <button aria-hidden="true" class="close" data-dismiss="modal" type="button">
                        ×
                    </button>
                </div>
                <div class="modal-body">
{{--                    <div id="msg" class="hide">--}}
{{--                        <div class="alert alert-info alert-dismissible fade in" id="alert" role="alert">--}}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div  >--}}
                        <ul class="notification alert alert-danger" hidden>
                            <span id="notification"></span>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </ul>
{{--                    </div>--}}

                    <input type="hidden" name="id" id="id" class="id">
                    <div class="row">

                        <div class="col-sm-4">
                        </div>

                        <div class="col-sm-4">
                            <div class="form-group has-feedback">
                                <label id="lblcaps_no">
                                    Number of Bags
                                </label>
                                <input class="form-control" id="bags" name="bags_to_move" required  type="number" >
                                <input class="form-control" id="material_id" name="material_id" required  type="text" hidden>
                                <input class="form-control" id="total_kg" name="total_kg" required  type="text" hidden>
                                <input class="form-control" id="total_bags" name="no_bags" required  type="text" hidden>
                                <input class="form-control" id="no_material" name="no_materials" required  type="text" hidden>
                                <input class="form-control" id="unit_weight" name="unit_weight" required  type="text" hidden>
                                <input class="form-control" id="tot_material" name="tot_material" required  type="text" hidden>
                                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                                <span class="text-danger">
                                <strong id="bags-error"></strong>
                            </span>
{{--                                <input class="form-control" id="preform_kg_id" name="preform_kg_name" required  type="text">--}}
                                </input>
                            </div>
                        </div>

                        <div class="col-sm-4">

                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <input class="btn btn-default" data-dismiss="modal" type="button" value="Cancel">
                    <button class="btn btn-outline-info" id="btnMove" type="submit" >
                        Move Bag(s)
                    </button>

                </div>
            </form>
        </div>
    </div>
</div>
