<!-- Add Task Modal Form HTML -->
<div class="modal fade" id="addUserModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="frmAddUser">
                {{csrf_field()}}
                <div class="modal-header">
                    <h4 class="modal-title">
                        Add New User
                    </h4>
                    <button aria-hidden="true" class="close" data-dismiss="modal" type="button">
                        ×
                    </button>
                </div>
                <div class="modal-body">
{{--                    <div class="notification success center"></div>--}}
                    <span id="notification"></span>
                    <div class="form-group">
                        <label>
                            Name
                        </label>
                        <select name="employee_id" id="employee_id" class="form-control form-control-sm select2" required>
                            <option value="">Select</option>
                            @foreach($employees as $employee)
                                <option value="{{$employee->id}}">{{$employee->name}}</option>
                            @endforeach
                        </select>
{{--                        <input class="form-control" id="name" name="name" required=""  type="text">--}}
{{--                        </input>--}}
                    </div>
                    <div class="form-group">
                        <label>
                            Username
                        </label>
                        <input class="form-control" id="username" name="username"  type="text" required>
                        </input>
                    </div>
                </div>
                <div class="modal-footer">
                    <input class="btn btn-default" data-dismiss="modal" type="button" value="Cancel">
                    <button class="btn btn-info" id="btn-add" type="submit" value="add">
                        Add New User
                    </button>
                    </input>
                </div>
            </form>
        </div>
    </div>
</div>
