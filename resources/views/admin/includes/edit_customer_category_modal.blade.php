<!-- Add Task Modal Form HTML -->
<div class="modal fade" id="editCustomerCategoryModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="frmEditCustomerCategoryID">
                {{csrf_field()}}
{{--                {{ method_field('PUT') }}--}}

                <div class="modal-header">
                    <h4 class="modal-title">
                        Edit Category
                    </h4>
                    <button aria-hidden="true" class="close" data-dismiss="modal" type="button">
                        ×
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id" id="id" class="id">
                    <div class="notification success center"></div>
                    <div class="row justify-content-center" >
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>
                                    Customer Type
                                </label>
                                <input class="form-control" id="cname" name="name" required="" type="text">
                                </input>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label>
                                    Discount (&#8358)
                                </label>
                                <input class="form-control" id="edit_discount" name="edit_discount" required="" type="number">

                            </div>
                        </div>

                    </div>

                </div>
                <div class="modal-footer">
                    <input class="btn btn-default" data-dismiss="modal" type="button" value="Cancel">
                    <button class="btn btn-info" id="btn-add" type="submit" value="add">
                        Update Category
                    </button>
                    </input>
                </div>
            </form>
        </div>
    </div>
</div>
