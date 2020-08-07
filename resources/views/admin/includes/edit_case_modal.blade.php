<!-- Add Task Modal Form HTML -->
<div class="modal fade" id="editCaseModal" style="font-size: .8rem">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="frmEditCaseID">
                {{csrf_field()}}
{{--                {{ method_field('PUT') }}--}}

                <div class="modal-header bg-info">
                    <h4 class="modal-title" style="font-size: 1.2rem">
                        Edit Case
                    </h4>
                    <button aria-hidden="true" class="close" data-dismiss="modal" type="button">
                        ×
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id" id="id" class="id">
                    <div class="notification success center"></div>
                    <div class="row">
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label>
                                    Name
                                </label>
                                <input class="form-control" id="name" name="name" required="" type="text">
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label>
                                    preform (g)
                                </label>
                                <input class="form-control" id="preformg" name="preform_g" required="" type="text">
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label>
                                    Cap (g)
                                </label>
                                <input class="form-control" id="capg" name="cap_g" required="" type="text">
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label>
                                    Label (g)
                                </label>
                                <input class="form-control" id="labelg" name="label_g" required="" type="text">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <textarea name="description" id="description" rows="2" class="form-control"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="action" class="col-sm-3 col-form-label text-right">File upload input</label>
                        <div class="col-sm-5 uploader" id="uniform-undefined" style="margin-right: 0">
                            <input type="file"  id="image" name="image" class="form-control-file">
                        </div>
                        @if(!empty($case->image))
                            <div class="col-sm-4 text-left">
                                <input type="hidden" name="current_image" value="{{$case->image}}">
                                <img src="{{asset('images/backends_images/products/'.$case->image)}}" style="width: 30px" alt="product image"> |
                                <a href="{{route('admin.deleteProductImage',['id'=>$case->id])}}">Delete</a>
                            </div>
                        @endif
                    </div>

                </div>
                <div class="modal-footer">
                    <input class="btn btn-default" data-dismiss="modal" type="button" value="Cancel">
                    <button class="btn btn-outline-info" id="btn-edit-case" type="submit" value="add">
                        Update Case
                    </button>
                    </input>
                </div>
            </form>
        </div>
    </div>
</div>
