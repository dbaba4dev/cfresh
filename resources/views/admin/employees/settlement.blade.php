@extends('admin.layouts.master')
{{--@section('klass','active')--}}

@section('styles')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{asset('css/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/responsive.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/bootstrap4_toggle.css')}}">
    <link rel="stylesheet" href="{{asset('css/buttons.dataTables.min.css')}}">
@endsection

@section('page-header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1><i class="fa fa-shopping-bag"></i> Employee's Settlements  </h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#"><i class="fa fa-tachometer-alt"></i> Home </a> - </li>
                    <li><a href="#">Make Payment </i> </a> - </li>
                    <li class="active">  Employee's Settlements</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->

    <hr style="border: solid 0.5px #a3a3a3">
@endsection


@section('content')
    <section class="content">

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    @include('frontend.includes.msgs')
                    <div class="card-header p-2 bg-gradient-gray-dark">
                        <strong><i class="fa fa-shopping-bag"></i> Commission's</strong> -Earners
                    </div><!-- /.card-header -->
                    <div class="card card-info">

                        <div class="card-body">
                            <div class="table-responsive" style="font-size: 0.8rem">
                                <table id="orders_list" class="table table-striped table-bordered table-sm">
                                    <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Time</th>
                                        <th>Name</th>
                                        <th>&#8358 Balance</th>
                                        <th>Amount Paid</th>
                                        <th>Cash Type</th>
                                        <th>Status</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($pays as $pay)
                                        <tr>
                                            <td>{{\Carbon\Carbon::parse($pay->created_at)->toDateString()}}</td>
                                            <td>{{\Carbon\Carbon::parse($pay->updated_at)->format('H:i A')}}</td>
                                            <td>{{$pay->employee->name}}</td>
                                            <td hidden>{{$pay->employee->id}}</td>
                                            <td>{{$pay->amount}}</td>
                                            <td width="100px">
                                                @if($pay->status == 0)
                                                    <div class="input-group input-group-sm">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">&#8358</span>
                                                        </div>
                                                        <input type="text" name="paid_amount" class="form-control form-control-sm fix-rounded-right paid_amount_{{$pay->id}}">
                                                    </div>
                                                @endif
                                            </td>
                                            <td width="2px">
                                                @if($pay->status == 0)
                                                    <input type="checkbox" name="cash_type_{{$pay->id}}" id="cash_type_{{$pay->id}}" data-toggle="toggle"  class="cash_type" data-on="Cash" data-off="Wired" data-onstyle="success" data-offstyle="warning" data-size="sm">
                                                @endif
                                            </td>
                                            <td class="text-center" >
                                                @if($pay->status==0)
                                                    <button rel="{{$pay->id}}" class="btn btn-sm btn-success pay btn-block" style="color: white;  ">Pay</button>
{{--                                                    <a href="{{route('pay', ['id'=>$pay->employee->id])}}" rel="{{$pay->id}}" class="btn btn-xs btn-success pay" style="color: white; width: 10rem; ">Pay</a>--}}
                                                @else
                                                    <a href="" class="btn btn-sm btn-default btn-block" style="">Paid</a>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>

            </div>
        </div>

        {{--        @include('admin.includes.add_inventory_modal')--}}
        @include('admin.includes.errors')
        @include('admin.includes.move_material_modal')

    </section>
@endsection

@section('scripts')
    <!-- DataTables -->
    <script src="{{asset('js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('js/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{asset('js/dataTables.responsive.min.js')}}"></script>
    <script src="{{asset('js/responsive.bootstrap4.min.js')}}"></script>

    <script src="{{asset('js/bootstrap4-toggle.min.js')}}"></script>
    <script src="{{asset('backend/js/jquery.steps.js')}}"></script>
    <script src="{{asset('backend/js/main.js')}}"></script>

    <script src="{{asset('js/dataTables.buttons.min.js')}}"></script>
    <script src="{{asset('js/buttons.flash.min.js')}}"></script>
    <script src="{{asset('js/jszip.min.js')}}"></script>
    <script src="{{asset('js/pdfmake.min.js')}}"></script>
    <script src="{{asset('js/vfs_fonts.js')}}"></script>
    <script src="{{asset('js/buttons.html5.min.js')}}"></script>
    <script src="{{asset('js/buttons.print.min.js')}}"></script>
    <script>
        $(function () {
            $("#orders_list").DataTable({
                "responsive": true,
                "autoWidth": false,
                "aaSorting": [ [0,'desc'], [1,'desc'] ],
                dom: 'Bfrtip',
                lengthMenu: [[10,25,50,100, -1], [10, 25, 50,100, "All"]],
                buttons: [
                    'excel',
                    {
                        extend: "pdfHtml5",

                        customize: function(doc) {
                            doc['footer'] = (function(page, pages) {
                                return {
                                    columns: [
                                        {
                                            alignment: 'center',
                                            text: [
                                                { text: page.toString(), italics: true },
                                                ' of ',
                                                { text: pages.toString(), italics: true }
                                            ]
                                        }],
                                    margin: [10, 0]
                                }
                            });
                        }
                    },
                    'print',
                    'pageLength'
                ]
            });
        });

        cash = $('.cash_type').val('Wired');
        $('.cash_type').on('change', function () {
            var type = $(this).prop('checked');
            var cash = '';
            if(type)
            {
                cash = $('.cash_type').val('Cash');
                // cash_type = $('.cash_type').val();
            }else
            {
                cash = $('.cash_type').val('Wired');
                // cash_type = $('.cash_type').val();
            }
        });

        $(function () {
            $('.pay').on('click',function (e) {
                e.preventDefault();
                var id = $(this).attr('rel');
                var paid = $('.paid_amount_'+id).val();
                if(paid == ''){
                    alert('Please enter amount Paid for this commission.');
                    return false;
                }
                cash_type = $('.cash_type').val();

                $tr = $(this).closest('tr');

                var data = $tr.children("td").map(function () {
                    return $(this).text();
                }).get();

                old_balance = data[4];
                employee_id = data[3];
                // cash_type = $('.cash_type_'+id).val();
                // alert(paid);
                new_balance = old_balance - paid;

                window.location.href = '/admin/paid/employee/'+id+'/'+new_balance+'/'+cash_type+'/'+employee_id;

                console.log(data);

               // // alert(id);
               //  $.ajax({
               //      url: "admin/paid/employee/"+id+"/"+amt_paid,
               //      method: 'get',
               //      // dataType: 'json',
               //      data: { id:id, amt_paid:amt_paid},
               //      success: function (data) {
               //          console.log('Dee '+data);
               //          // $('#new_batch').val(data);
               //          // calculate(discount,0);
               //      }
               //  });
            });
        })
    </script>

    <script>
        (function($, undefined) {

            "use strict";

            // When ready.
            $(function() {

                var $form = $( "#orders_list" );
                var $input = $form.find( "input[name='paid_amount']" );

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
@endsection
