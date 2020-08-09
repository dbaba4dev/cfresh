@extends('admin.layouts.master')
{{--@section('klass','active')--}}

@section('styles')
    <link rel="stylesheet" href="{{asset('css/bootstrap4_toggle.css')}}">
    <link rel="stylesheet" href="{{asset('backend/css/opensans-font.css')}}">
    <link rel="stylesheet" href="{{asset('backend/css/montserrat-font.css')}}">
    <link rel="stylesheet" href="{{asset('backend/fonts/material-design-iconic-font/css/material-design-iconic-font.min.css')}}">
    <link rel="stylesheet" href="{{asset('backend/css/style.css')}}">
@endsection

@section('page-header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1><i class="fa fa-users"></i> Customers</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#"> Home </a> - </li>
                    <li><a href="#">Customers </i> </a> - </li>
                    <li class="active"> Place Order</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->

    <hr style="border: solid 0.5px #a3a3a3">
@endsection


@section('content')
    <div class="overlay"><div class="loader"></div></div>
    <div class="container">
        <div class="row">
            <div class="col-md-10 mx-auto">
                @include('admin.includes.alert-msg')
                <div class="card" style="box-shadow: 0 0 25px 0 lightgrey">
                    <div class="card-header"><h4>New Orders</h4></div>
                    <div class="card-body">
                        <form action="{{route('order.place')}}" method="post" id="orderForm">
                            @csrf
                            <div class="form-group row">
                                <label class="col-sm-2 float-right mr-0 pr-0" >Order Date</label>
                                <div class="col-sm-2" style="margin-left: -3rem">
                                    <input type="text" name="" id="" readonly class="form-control form-control-sm" value="{{date('d-m-Y')}}">
                                </div>
                                <div class="col-sm-5"></div>
                                <div class="col-sm-2 float-right" >
                                    <select name="user_id" id="customer_id" class="form-control form-control-sm select2" required>
                                        <option value="">Select Customer Name</option>
                                        @foreach($customers as $customer)
                                            <option value="{{$customer->id}}"
                                            >{{$customer->name}}</option>
                                        @endforeach
                                    </select>
                                    <input type="hidden" name="cust_id" id="cust_id">
                                </div>
                            </div>

                            <div class="card" style="box-shadow: 0 0 15px 0 lightgrey"  >
                                <div class="card-body" style="margin-bottom: -15px">
                                    <h3>Make Order List</h3>
                                    <div class="table-responsive" style="font-size: 0.8rem" >
                                        <table id="order_list" class="table table-striped table-bordered table-sm" style="width: 800px;" hidden>
                                            <thead>
                                            <tr>
                                                <th>#</th>
                                                <th style="text-align: center">Item Name</th>
                                                <th style="text-align: center">Total Quantity</th>
                                                <th style="text-align: center">Quantity</th>
                                                <th style="text-align: center">Price</th>
                                                <th>Total</th>
                                            </tr>
                                            </thead>
                                            <tbody id="invoice_item">
                                            <tr>
                                                <td><b class="number">1</b></td>
                                                <td>
                                                    <select name="pid[]" id="" class="form-control form-control-sm pid" required>
                                                        <option value="" selected disabled>Choose Product</option>
                                                        @foreach($rows as $row)
                                                            <option value="{{$row->id}}">{{$row->case}}</option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td><input type="text" name="tqty[]" class="form-control form-control-sm tqty" readonly></td>
                                                <td><input type="text" name="qty[]" class="form-control form-control-sm qty" required></td>
                                                <td><input type="text" name="price[]" class="form-control form-control-sm price" readonly></td>
                                                <td hidden><input type="hidden" name="pro_name[]" class="form-control form-control-sm pro_name" ></td>
                                                <td>&#8358 <span class="amt">0</span></td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="card-footer text-center" style="padding-top: -10px">
                                    <button style="width: 150px" class="btn btn-success" id="add">Add</button>
                                    <button style="width: 150px" class="btn btn-danger" id="remove">Remove</button>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="coupon_code" class="col-sm-3" style="text-align: right">Coupon Code</label>
                                <div class="col-sm-3">
                                    <input type="text" name="coupon_code" class="form-control form-control-sm " id="coupon_code" readonly>
                                </div>

                                <input type="hidden" id="amount">
                                <input type="hidden" id="amount_type">


                            </div>
                            <div class="form-group row">
                                <label for="sub_total" class="col-sm-3" style="text-align: right">Sub Total</label>
                                <div class="col-sm-3">
                                    <input type="text" name="sub_total" class="form-control form-control-sm digit" id="sub_total" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="discount" class="col-sm-3" style="text-align: right">Discount</label>
                                <div class="col-sm-3">
                                    <input type="text" name="discount" class="form-control form-control-sm digit" id="discount" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="net_total" class="col-sm-3" style="text-align: right">Net Total</label>
                                <div class="col-sm-3">
                                    <input type="text" name="net_total" class="form-control form-control-sm digit" id="net_total" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="paid" class="col-sm-3" style="text-align: right">Paid</label>
                                <div class="col-sm-3">
                                    <input type="text" name="paid" class="form-control form-control-sm digit" id="paid" value="0">
                                </div>
{{--                                <div class="col-sm-1"></div>--}}
{{--                                <div class="col-sm-6 float-right" id="emp_section">--}}
{{--                                    <select name="employee_id" id="employee_id" class="form-control form-control-sm select2" required>--}}
                                    <label for="employee_id" class="col-sm-2" style="text-align: right">Sales Rep.</label>
                                        <div class="col-sm-3">
                                            <input type="hidden" name="employee_id" class="form-control form-control-sm digit" id="employee_id" readonly>
                                            <input type="text" name="employee_name" class="form-control form-control-sm digit" id="employee_name" readonly>
                                        </div>
                                       {{-- <option value="">Select Sales Rep.</option>
                                        @foreach($employees as $employee)
                                            <option value="{{$employee->id}}"
                                            >{{$employee->name}}</option>
                                        @endforeach--}}
{{--                                    </select>--}}
{{--                                </div>--}}
                            </div>
                            <div class="form-group row">
                                <label for="balance" class="col-sm-3" style="text-align: right">Balance</label>
                                <div class="col-sm-3">
                                    <input type="text" name="balance" class="form-control form-control-sm digit" id="balance" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="payment_method" class="col-sm-3" style="text-align: right">Payment Method</label>
                                <div class="col-sm-3">
                                    <select name="payment_method" id="payment_method" class="form-control form-control-sm" required>
                                        <option value="Cash on Delivery">Cash on Delivery</option>
                                        <option value="Mobile Transfer">Mobile Transfer</option>
{{--                                        <option >Paypal</option>--}}
                                        <option value="Card">Card</option>
{{--                                        <option >Other</option>--}}
                                    </select>
                                </div>
                                <br>

                            </div>

                            <div class="card-footer text-center">
                                <input type="submit" id="order_form" style="width: 150px" class="btn btn-info" value="Order">
                                <input type="submit" id="print_invoice" style="width: 150px" class="btn btn-success d-none" value="Print Invoice">
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
{{--    <script src="{{asset('plugins/bootstrap-switch/js/bootstrap-switch.min.js')}}"></script>--}}
    <script src="{{asset('js/bootstrap4-toggle.min.js')}}"></script>
    <script src="{{asset('backend/js/jquery.steps.js')}}"></script>
    <script src="{{asset('backend/js/main.js')}}"></script>

    <script>
        $(function () {
            //Initialize Select2 Elements
            $('.select2').select2({
                width: 200
            });

        });
    </script>

    <script>
        // $('#emp_section').hide();
        // $('#employee_id').attr('required',false);
        $(document).ready(function () {
            $('#customer_id').change(function () {
                var customer_id = $(this).val();
                // alert(customer_id);
                $('#cust_id').val(customer_id);
                $('#order_list').attr('hidden', false);
                // var discount = 0;
                // var sub_tot =  $('#sub_total').val();

                $('.overlay').show();
                $.ajax({
                    url: 'get/coupon',
                    method: 'POST',
                    dataType: 'json',
                    data: {getPriceQty:1, id:customer_id},
                    success: function (data) {
                        $('#discount').val(data);
                        console.log(data);
                         var coupon_code = data[0];
                         $('#coupon_code').val(coupon_code);
                       /* var amount = data[1];
                        var amountType = data[2];*/
                        $('#amount').val(data[1]);
                        $('#amount_type').val(data[2]);
                        $('#employee_id').val(data[3]);
                        $('#employee_name').val(data[4]);

                        calculate(0,0);
                    }
                });

            });



           /* $('#coupon_code').change(function () {
                var code = $(this).val();
                $('#code').val(code);
                var discount = 0;
                var sub_tot =  $('#sub_total').val();
                var tot_qty = 0;
                $('.qty').each(function () {
                    tot_qty = tot_qty + ($(this).val()*1);
                });

                $('.overlay').show();
                $.ajax({
                    url: 'get/discount',
                    method: 'POST',
                    dataType: 'json',
                    data: {getPriceQty:1, code:code, qty:tot_qty, sub_tot:sub_tot},
                    success: function (data) {
                        // $('#discount').val(data);
                        discount = data;
                        calculate(discount,0);
                    }
                });

            });*/

            $('#add').click(function (e) {
                e.preventDefault();
                addNewRow();
            });

            function addNewRow() {
               $.ajax({
                   url: 'add/new_item',
                   method: 'post',
                   data: {getNewOrderItem:1},
                   success: function (data) {
                       $('#invoice_item').append(data);
                       var n = 0;
                       $('.number').each(function () {
                          $(this).html(++n);
                       });
                   }
               })
           }

           $('#remove').click(function () {
               $('#invoice_item').children("tr:last").remove();
               calculate(0,0);
           });

            $('#invoice_item').delegate('.pid', 'change', function () {
                var pid = $(this).val();
                var tr = $(this).parent().parent();
                var code = $('#coupon_code').val();
                var customer_id = $('#customer_id').val();
                $('.overlay').show();
                $.ajax({
                    url: 'order/price',
                    method: 'POST',
                    dataType: 'json',
                    data: {getPriceQty:1, id:pid, customer_id:customer_id},
                    success: function (data) {
                       tr.find('.tqty').val(data['balance']);
                       tr.find('.pro_name').val(data['box']['case']);
                       tr.find('.qty').val();
                       tr.find('.price').val(data['box']['price']);
                       tr.find('.amt').html(tr.find('.qty').val()*tr.find('.price').val());
                        calculate(0,0);
                    }
                })
            });

            $('#invoice_item').delegate('.qty', 'keyup', function () {
                var qty = $(this);
                var tr = $(this).parent().parent();
                if(isNaN(qty.val()))
                {
                    alert('Please enter a valid quantity');
                    qty.val(1)
                }else
                {
                    if (qty.val()-0 > tr.find('.tqty').val()-0)
                    {
                        alert('Sorry! This amount of quantity is not available');
                        qty.val(1)
                    }else
                    {
                        tr.find('.amt').html(qty.val()*tr.find('.price').val());

                        var couponAmount = 0;
                        var amount = $('#amount').val();
                        var amountType = $('#amount_type').val();
                        var sub_tot =  $('#sub_total').val();
                        var tot_qty = 0;
                        var discount = 0;
                        $('.qty').each(function () {
                            tot_qty = tot_qty + ($(this).val()*1);
                        });

                        if(amountType == 'Fixed')
                        {
                            couponAmount = amount*tot_qty;
                        }else
                        {
                            couponAmount =sub_tot * amount/100;
                        }
                        discount = couponAmount;

                        calculate(discount,0)
                    }

                }



            });

            $('#paid').keyup(function () {
                var paid = $(this).val();
                var discount=$('#discount').val();
                // if (paid>0)
                // {
                //     $('#emp_section').show();
                //     $('#employee_id').attr('required',true);
                // }else
                // {
                //     $('#emp_section').hide();
                //     $('#employee_id').attr('required',false);
                // }
                calculate(discount, paid);
            });

            function calculate(dis, paid) {
                // $('#coupon_code').val(0);
                var sub_total = 0;
                var net_total = 0;
                var discount = dis;
                var amt_paid = paid;
                var balance = 0;
                $('.amt').each(function () {
                    sub_total = sub_total + ($(this).html()*1);
                });

                net_total =sub_total + net_total - discount;
                balance = net_total - amt_paid;

                $('#sub_total').val(sub_total);
                $('#discount').val(discount);
                $('#net_total').val(net_total);
                // $('#paid')
                $('#balance').val(balance);
            }

        /*Placing Order*/
            // $('#order_form').click(function () {
            //    $.ajax({
            //        url: 'order/placing',
            //        method: 'POST',
            //        data: $('#orderForm').serialize(),
            //        success: function (data) {
            //            console.log(data)
            //        }
            //    });
            // });

        });

    </script>
<script>
    (function($, undefined) {

        "use strict";

        // When ready.
        $(function() {

            var $form = $( "#batch_form" );
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
@endsection
