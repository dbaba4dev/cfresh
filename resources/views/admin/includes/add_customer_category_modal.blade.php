<!-- Add Task Modal Form HTML -->
<div class="modal fade" id="addCustomerCategoryModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="frmAddCustomerCategory">
                {{csrf_field()}}
                <div class="modal-header">
                    <h4 class="modal-title">
                        Add New Category
                    </h4>
                    <button aria-hidden="true" class="close" data-dismiss="modal" type="button">
                        ×
                    </button>
                </div>
                <div class="modal-body">
                    <div id="notification"></div>
                    <div class="row justify-content-center">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>
                                    Customer Type
                                </label>
                                <input class="form-control" id="name" name="name" required="" type="text">
                                </input>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label>
                                    Discount (&#8358)
                                </label>
                                <input class="form-control" id="discount" name="discount" required="" type="number">

                            </div>
                        </div>
                    </div>


                </div>
                <div class="modal-footer">
                    <input class="btn btn-default" data-dismiss="modal" type="button" value="Cancel">
                    <button class="btn btn-info" id="btn-add" type="submit" value="add">
                        Add Category
                    </button>

                </div>
            </form>
        </div>
    </div>
</div>
