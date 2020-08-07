@extends('admin.layouts.master')
{{--@section('klass','active')--}}

@section('styles')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{asset('css/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/responsive.bootstrap4.min.css')}}">
@endsection

@section('page-header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1><i class="fa fa-boxes"></i> Cases </h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#"><i class="fa fa-tachometer-alt"></i> Home </a> - </li>
                    <li><a href="#">Cases </i> </a> - </li>
                    <li class="active">Edit Case Type</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->

    <hr style="border: solid 0.5px #a3a3a3">
@endsection


@section('content')
    <section class="content">

        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                @include('admin.includes.errors')
                <form action="{{route('admin.editProduct',['id'=>$product->id])}}" id="edit_product" name="edit_product" method="post" novalidate enctype="multipart/form-data">
                    {{csrf_field()}}

                    <div class="card card-info">

                        <div class="card-header">
                            <h3 class="card-title"><i class="fa fa-boxes"></i> Edit Product Case</h3>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                                <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-remove"></i></button>
                            </div>
                        </div>
                        <!-- /.card-header -->

                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="text-xs">
                                            Case Name
                                        </label>
                                        <input class="form-control form-control-sm" id="case" name="case" required  type="text" value="{{$product->case}}">
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="text-xs">
                                            Price (&#8358) per Case
                                        </label>
                                        <input class="form-control form-control-sm" id="price" name="price" required  type="number" value="{{$product->price}}">
                                    </div>
                                </div>
                                <!-- /.col -->
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="text-xs">
                                            <span  id="material">Preform Weight (g) </span> <span style="color: cadetblue"><em >(average)</em></span>
                                        </label>
                                        <input class="form-control form-control-sm" id="preform_g" name="preform_g" required  type="text" value="{{$product->preform_g}}">
                                    </div>

                                </div>


                            </div>
                            <div class="row">
                                <div class="col-sm-6 ">
                                    <div class="form-group">

                                        @if($product->cap_g == 0)
                                            <label class="text-xs" id="lbl_cap">
                                                No. of Caps per Bag
                                            </label>
                                            <input class="form-control form-control-sm" id="cap_no" name="cap_no" required  type="number" value="{{$product->cap_no}}">
                                            <div class="form-group">
                                                <label for="lblcap_pieces" class="text-xs"><input type="radio" name="cap_chk" id="lblcap_pieces" value="pieces" checked> Pieces</label> &nbsp;
                                                <label for="lblcap_kg" class="text-xs"><input type="radio"  name="cap_chk" id="lblcap_kg" value="kg"> Weight (g)</label>
                                            </div>
                                        @else
                                            <label class="text-xs" id="lbl_cap">
                                                Cap Weight (g)
                                            </label>
                                            <input class="form-control form-control-sm" id="cap_g" name="cap_g" required  type="number" value="{{$product->cap_g}}">
                                            <div class="form-group">&nbsp;
                                                <label for="lblcap_pieces" class="text-xs"><input type="radio" name="cap_chk" id="lblcap_pieces" value="pieces"> Pieces</label>
                                                <label for="lblcap_kg" class="text-xs"><input type="radio" checked name="cap_chk" id="lblcap_kg" value="kg"> Weight (g)</label>
                                            </div>
                                        @endif



                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">

                                        @if($product->label_g == 0)
                                            <label class="text-xs" id="lbl_label">
                                                No. of Labels per Bag
                                            </label>
                                            <input class="form-control form-control-sm" id="label_no" name="label_no" required  type="number" value="{{$product->label_no}}">
                                            <div class="form-group">
                                                <label for="lblLabel_pieces" class="text-xs"><input type="radio" name="label_chk" id="lblLabel_pieces" value="pieces" checked> Pieces</label> &nbsp;
                                                <label for="lblLabel_kg" class="text-xs"><input type="radio"  name="label_chk" id="lblLabel_kg" value="kg"> Weight (g)</label>
                                            </div>
                                        @else
                                            <label class="text-xs" id="lbl_label">
                                                Label Weight (g)
                                            </label>
                                            <input class="form-control form-control-sm" id="label_g" name="label_g" required  type="number" value="{{$product->label_g}}">
                                            <div class="form-group">&nbsp;
                                                <label for="lblLabel_pieces" class="text-xs"><input type="radio" name="label_chk" id="lblLabel_pieces" value="pieces"> Pieces</label> &nbsp;
                                                <label for="lblLabel_kg" class="text-xs"><input type="radio" checked  name="label_chk" id="lblLabel_kg" value="kg"> Weight (g)</label>
                                            </div>
                                        @endif

                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="text-xs">
                                    Description
                                </label>
                                <textarea name="description" id="description" class="form-control" rows="2" placeholder="Description . . .">{{$product->description}}</textarea>

                            </div>
                            <div class="form-group row">
                                <label for="action" class="col-sm-3 col-form-label text-left text-xs">File upload input</label>
                                <div class="col-sm-5 uploader text-left" id="uniform-undefined">
                                    <input type="file"  id="image" name="image" class="form-control-file">
                                </div>
                                @if(!empty($product->image))
                                    <div class="col-sm-3 text-left">
                                        <input type="hidden" name="current_image" value="{{$product->image}}">
                                        <img src="{{asset('images/backends_images/products/'.$product->image)}}" style="width: 40px" alt="product image"> |
                                        <a href="{{route('admin.deleteProductImage',['id'=>$product->id])}}">Delete</a>
                                    </div>
                                @endif

                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer text-center">
                                <button class="btn btn-outline-info btn-sm" id="btn-add" type="submit" value="add">
                                    Update Case
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-md-3"></div>
        </div>

    </section>
@endsection

@section('scripts')
    <!-- DataTables -->
    <script src="{{asset('js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('js/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{asset('js/dataTables.responsive.min.js')}}"></script>
    <script src="{{asset('js/responsive.bootstrap4.min.js')}}"></script>

    <script>
        $(function () {
            $("#users_list").DataTable({
                "responsive": true,
                "autoWidth": false,
            });

        })
    </script>

    <script src="{{asset('js/scripts.js')}}"></script>
    <script>
        // $(function () {
        //     $('#cap_no').hide();
        //     $('#label_no').hide();
        // });
        $(function () {
            $('input:radio[name="cap_chk"]').change(function(){

                if($(this).val() == 'pieces')
                {
                    // alert('No. of Caps');
                    $('#lbl_cap').text('No. of Caps per Bag');
                    $('#cap_g').attr('name','cap_no').val('');
                }else
                {
                    $('#lbl_cap').text('Cap Weight (g)');
                    $('#cap_no').attr('name','cap_g').val('');
                }

            });

            $('input:radio[name="label_chk"]').change(function(){

                if($(this).val() == 'pieces')
                {
                    // alert('No. of Caps');
                    $('#lbl_label').text('No. of Labels per Bag');
                    $('#label_g').attr('name','label_no').val('');

                }else
                {
                    $('#lbl_label').text('Label Weight (g)');
                    $('#label_no').attr('name','label_g').val('');
                }

            });
        });
    </script>
@endsection
