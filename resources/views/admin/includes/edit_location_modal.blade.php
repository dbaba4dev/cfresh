<!-- Add Task Modal Form HTML -->
<div class="modal fade" id="editLocationModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="frmEditLocationID">
                {{csrf_field()}}
{{--                {{ method_field('PUT') }}--}}

                <div class="modal-header">
                    <h4 class="modal-title">
                        Edit Location
                    </h4>
                    <button aria-hidden="true" class="close" data-dismiss="modal" type="button">
                        ×
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id" id="id" class="id">
                    <div class="notification success center"></div>
                    <div class="form-group">
                        <label>
                            Name
                        </label>
                        <input class="form-control" id="catname" name="name" required="" type="text">
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
