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
                <h1><i class="fa fa-user-clock"></i> Employees </h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#"> Home </a> - </li>
                    <li><a href="#">Employees </i> </a> - </li>
                    <li class="active"> Employees Categories</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->

    <hr style="border: solid 0.5px #a3a3a3">
@endsection


@section('content')
    <section class="content">
        <div class="row">
            <div class="col-sm-1"></div>
            <div class="col-sm-10">
                <div class="card card-info">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-sm-6">
                                <h3 class="card-title"><i class="fa fa-user-clock"></i> Employees  <b>Categories</b> </h3>
                            </div>
                            <div class="col-sm-6 ">
                                <a role="button" data-toggle="modal" data-target="#addCategoryModal" class="float-right">
                                    <span class="btn btn-info"><i class="fa fa-plus-circle"></i> New Category</span>
                                </a>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="users_list" class="table table-striped table-bordered table-sm">
                                <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Payment Type</th>
                                    <th>Amount</th>
                                    <th>Created At</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if(count($categories)>0)
                                    @foreach($categories as $category)
                                        <tr>
                                            <td>{{$category->name}}</td>
                                            <td>{{$category->payment->type}}</td>
                                            <td>{{$category->amount}}</td>
                                            <td>{{\Carbon\Carbon::parse($category->created_at)->format('jS  F Y h:i:s A')}}</td>
{{--                                            <td>{{\Carbon\Carbon::parse($category->updated_at)->format('jS  F Y h:i:s A')}}</td>--}}
                                            <td align="center"><a role="button"  class="editbtn fa fa-edit text-success" id="{{$category->id}}"></a></td>
                                            <td align="center"><a href="{{route('category.delete',['id'=>$category->id])}}" class="fa fa-trash text-danger"></a></td>

                                        </tr>
                                    @endforeach
                                @else
                                    <td>
                                        No users added yet!
                                    </td>


                                @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
            <div class="col-sm-1"></div>
        </div>



    </section>

@endsection
@include('admin.includes.add_category_modal')
@include('admin.includes.edit_category_modal')
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

        });

        (function($, undefined) {

            "use strict";

            // When ready.
            $(function() {

                var $form = $( "#frmAddCategory" );
                var $input = $form.find( "input[name='amount']" );

                $input.on( "keyup", function( event ) {

                    // When user select text in the document, also abort.
                    var selection = window.getSelection().toString();
                    if ( selection !== '' ) {
                        return;
                    }

                    // When the arrow keys are pressed, abort.
                    if ( $.inArray( event.keyCode, [38,40,37,39] ) !== -1 ) {
                        return;
                    }

                    var $this = $( this );

                    // Get the value.
                    var input = $this.val();

                    var input = input.replace(/[\D\s\._\-]+/g, "");
                    input = input ? parseInt( input, 10 ) : 0;

                    $this.val( function() {
                        return ( input === 0 ) ? "" : input.toLocaleString( "en-US" );
                    } );
                } );

            });
        })(jQuery);

        (function($, undefined) {

            "use strict";

            // When ready.
            $(function() {

                var $form = $( "#frmEditCategoryID" );
                var $input = $form.find( "input[name='amount']" );

                $input.on( "keyup", function( event ) {

                    // When user select text in the document, also abort.
                    var selection = window.getSelection().toString();
                    if ( selection !== '' ) {
                        return;
                    }

                    // When the arrow keys are pressed, abort.
                    if ( $.inArray( event.keyCode, [38,40,37,39] ) !== -1 ) {
                        return;
                    }

                    var $this = $( this );

                    // Get the value.
                    var input = $this.val();

                    var input = input.replace(/[\D\s\._\-]+/g, "");
                    input = input ? parseInt( input, 10 ) : 0;

                    $this.val( function() {
                        return ( input === 0 ) ? "" : input.toLocaleString( "en-US" );
                    } );
                } );

            });
        })(jQuery);
    </script>

    <script src="{{asset('js/scripts.js')}}"></script>



{{--    <script>--}}
{{--        $('#amount_box').hide();--}}
{{--        $("select[name='payment_id']").change(function(){--}}
{{--            // console.log('I have Changed');--}}
{{--            var $type = $(this).val();--}}
{{--            console.log($type);--}}
{{--            if($type !=1)--}}
{{--            {--}}
{{--                $('#amount_box').show();--}}
{{--                // $('#amount').attr('required',true);--}}
{{--            }else--}}
{{--            {--}}
{{--                $('#amount_box').hide();--}}
{{--                // $('#amount_box').attr('required',false);--}}
{{--                // $('#amount').hide()--}}
{{--            }--}}

{{--            // $('#selected_material_val').val($material);--}}

{{--        });--}}
{{--    </script>--}}

@endsection
