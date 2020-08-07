
<div class="modal fade" id="addCategoryModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="frmAddCategory">
                {{csrf_field()}}
                <div class="modal-header bg-gradient-info">
                    <h4 class="modal-title">
                        Add New Category
                    </h4>
                    <button aria-hidden="true" class="close" data-dismiss="modal" type="button">
                        ×
                    </button>
                </div>
                <div class="modal-body">
                    <div id="notification"></div>
                   <div class="row">
                       <div class="col-sm-12">
                           <div class="input-group mb-3">
                               <div class="input-group-prepend">
                                   <span class="input-group-text bg-info">Category Name</span>
                               </div>
                               <input type="text" class="form-control" id="name" required name="name" >
                           </div>
                       </div>

                   </div>
                    <div class="row">
                        <div class="col-sm-8">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-info">Payment Type</span>
                                </div>
                                <select name="payment_id" id="payment_id" required class="form-control">
                                    <option value="" selected disabled>Select Payment </option>
                                    @foreach($pay_types as $pay_type)
                                        <option value="{{$pay_type->id}}">{{$pay_type->type}}</option>
                                    @endforeach
                                </select>
{{--                                <input type="text" class="form-control" id="payment_id" name="payment_id" >--}}
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="input-group mb-3" id="amount_box">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-info">&#8358</span>
                                </div>
                                <input type="text" class="form-control" required id="amount" name="amount" value="0">
                            </div>
                        </div>
                    </div>
{{--                    <div class="form-group">--}}
{{--                        <label>--}}
{{--                            Name--}}
{{--                        </label>--}}
{{--                        <input class="form-control" id="name" name="name" required="" type="text">--}}
{{--                        </input>--}}
{{--                    </div>--}}

                </div>
                <div class="modal-footer">
                    <input class="btn btn-default" data-dismiss="modal" type="button" value="Cancel">
                    <button class="btn btn-outline-info" id="btn-add" type="submit" value="add">
                        Add Category
                    </button>
                    </input>
                </div>
            </form>
        </div>
    </div>
</div>
