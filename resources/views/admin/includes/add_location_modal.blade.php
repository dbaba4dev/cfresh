<!-- Add Task Modal Form HTML -->
<div class="modal fade" id="addLocationModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="frmAddLocation">
                {{csrf_field()}}
                <div class="modal-header">
                    <h4 class="modal-title">
                        Add New Location
                    </h4>
                    <button aria-hidden="true" class="close" data-dismiss="modal" type="button">
                        ×
                    </button>
                </div>
                <div id="notification" style="margin: 1rem"></div>
{{--                <div>@include('admin.includes.errors')</div>--}}
                <div class="modal-body">
                    <div class="form-group">
                        <label>
                            Name
                        </label>
                        <input class="form-control" id="name" name="name" required="" type="text">
                        </input>
                    </div>

                </div>
                <div class="modal-footer">
                    <input class="btn btn-default" data-dismiss="modal" type="button" value="Cancel">
                    <button class="btn btn-info" id="btn-add" type="submit" value="add">
                        Add Location
                    </button>
                    </input>
                </div>
            </form>
        </div>
    </div>
</div>
