@extends('admin.layouts.master')
{{--@section('klass','active')--}}

@section('styles')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{asset('css/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/responsive.bootstrap4.min.css')}}">
@endsection

@section('page-header')
    <div class="overlay"><div class="loader"></div></div>
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Products Orders </h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#"><i class="fa fa-tachometer-alt"></i> Home </a> - </li>
                    <li><a href="#">Products </i> </a> - </li>
                    <li class="active"> Orders</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->

    <hr style="border: solid 0.5px #a3a3a3">
@endsection


@section('content')
    <section class="content">
        @include('admin.includes.errors')
           <div class="row">
               <div class="col-md-10 mx-auto">
                   <div class="card card-info" style="box-shadow: 0 0 25px 0 lightgrey">

                       <div class="card-header">

                           <h3 class="card-title"><i class="fa fa-cart-plus"></i> New Order</h3>

                           <div class="card-tools">
                               <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                               <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-remove"></i></button>
                           </div>
                       </div>
                       <!-- /.card-header -->

                       <div class="card-body">
                           {{--                    <form action="{{route('order.store')}}" method="post">--}}
                           <form id="form_order_data" onsubmit="return false">

                              <div class="row">
                                  <div class="col-md-3">
                                      <!-- text input -->
                                      <div class="form-group">
                                          <label>Customer Name*</label>
                                          <select name="customer_id" id="customer_id" class="form-control form-control-sm" required>
                                              <option value="" disabled selected></option>
                                              @foreach($customers as $customer)
                                                  <option value="{{$customer->id}}">{{$customer->name}}</option>
                                              @endforeach
                                          </select>
                                      </div>
                                  </div>
                                  <div class="col-md-3">
                                      <div class="form-group">
                                          <label>Sales Rep*</label>
                                          <select name="employee_id" id="employee_id" class="form-control form-control-sm" required>
                                              <option value="" disabled selected></option>
                                              @foreach($employees as $employee)
                                                  <option value="{{$employee->id}}">{{$employee->name}}</option>
                                              @endforeach
                                          </select>

                                      </div>
                                  </div>
                                  <div class="col-md-4"></div>
                                  <div class="col-md-2">
                                      <div class="form-group">
                                          <label>Order Date</label>
                                          <input type="text" name="order_date", id="order_date" class="form-control form-control-sm" value="{{date("d-m-Y")}}" readonly>
                                      </div>
                                  </div>
                              </div>

                               <div class="card" style="box-shadow: 0 0 15px 0 lightgrey">
                                   <div class="card-body">
                                       <h3>Make a order list</h3>
                                       <div class="table-responsive">
                                           <table align="center" style="width: 800px;" id="dynamic_field" >
                                               <thead>
                                               <th> #item </th>
                                               <th style="text-align: center">Item Name</th>
                                               <th style="text-align: center">Total Quantity</th>
                                               <th style="text-align: center">Quantity</th>
                                               <th style="text-align: center">Price</th>
                                               <th style="text-align: center">Total</th>

                                               </thead>
                                               <tbody id="invoice_item">
                                               <tr>
                                                   <td style="text-align: center"><b class="number">1</b></td>
                                                   <td><select name="pro_id[]" class="form-control form-control-sm pro_id" id="product_id[]">
                                                           <option value="">Select Product Type</option>
                                                           @foreach($cases as $case)
                                                               <option value="{{$case->id}}">{{$case->case}}</option>
                                                           @endforeach
                                                       </select>
                                                   </td>
                                                   <td><input type="text" name="tqty[]" class="form-control form-control-sm tqty" readonly></td>
                                                   <td><input type="text" name="qty[]" class="form-control form-control-sm qty"></td>
                                                   <td><input type="text" name="price[]" class="form-control form-control-sm price" readonly></td>
                                                   <td> &#8358 <span class="amt">0</span></td>
                                               </tr>
                                               </tbody>
                                           </table>
                                       </div>

{{--                                       <br>--}}
                                       <center style="padding: 10px">
                                           <button id="add" name="add" role="button" class="btn btn-success" style="width: 150px;">Add</button>
                                           <button id="remove" name="remove" class="btn btn-warning " style="width: 150px;">Remove</button>
                                       </center>
                                   </div>
                               </div>

                               <div class="form-group row">
                                   <label class="col-sm-3" align="right">Sub Total</label>
                                   <div class="col-sm-3">
                                       <input type="text" name="sub_total" id="sub_total" class="form-control form-control-sm" readonly >
                                   </div>
                               </div>
                               <div class="form-group row">
                                   <label class="col-sm-3" align="right">Discount</label>
                                   <div class="col-sm-3">
                                       <input type="text" name="discount" id="discount" class="form-control form-control-sm"  value="0">
                                   </div>
                               </div>
                               <div class="form-group row">
                                   <label class="col-sm-3" align="right">Net Total</label>
                                   <div class="col-sm-3">
                                       <input type="text" name="net_total" id="net_total" class="form-control form-control-sm"  readonly>
                                   </div>
                               </div>
                               <div class="form-group row">
                                   <label class="col-sm-3" align="right">Paid</label>
                                   <div class="col-sm-3">
                                       <input type="text" name="paid" id="paid" class="form-control form-control-sm"  required>
                                   </div>
                               </div>
                               <div class="form-group row">
                                   <label class="col-sm-3" align="right">Balance</label>
                                   <div class="col-sm-3">
                                       <input type="text" name="balance" id="balance" class="form-control form-control-sm"  readonly>
                                   </div>
                               </div>
                               <div class="form-group row">
                                   <label class="col-sm-3" align="right">Payment Method</label>
                                   <div class="col-sm-3">
                                       <select name="payment_method" id="payment_method" class="form-control form-control-sm" required>
                                           <option value="1">Cash</option>
                                           <option value="2">Card</option>
                                           <option value="1">Draft</option>
                                           <option value="1">Cheque</option>
                                           <option value="1">Transfer</option>
                                       </select>
                                   </div>
                               </div>

                               <center>
                                   <input type="submit" id="order_form" style="width: 150px" class="btn btn-info" value="Order">
                                   <input type="submit" id="print_invoice" style="width: 150px" class="btn btn-success d-none" value="Print Invoice">
                               </center>

                           </form>
                       </div>
                       <!-- /.card-body -->

                   </div>
               </div>
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
       $(document).ready(function () {

           var postURL = "<?php echo url('admin/order/create'); ?>";
           var i=1;

           $('#add').click(function(){
               i++;
               $('#dynamic_field').append('' +
                   '<tr id="row'+i+'" class="dynamic-added">' +
                   '<td style="text-align: center"><b class="number">1</b></td>' +
                   '<td><select name="pro_id[]" class="form-control form-control-sm pro_id" id="product_id[]">' +
                   '   <option value="">Select Product Type</option>   ' +
                        <?php
                            foreach ($cases as $case)
                                {
                                    ?>
                                    '   <option value=" {{$case->id}} "> {{$case->case}}</option>   ' +
                        <?php
                                }

                        ?>

                   '    </select>\n' +
                   '</td>\n' +
                   '<td><input type="text" name="tqty[]" class="form-control form-control-sm tqty" readonly></td>' +
                   '<td><input type="text" name="qty[]" class="form-control form-control-sm qty"></td>' +
                   '<td><input type="text" name="price[]" class="form-control form-control-sm price" readonly></td>' +
                   '<td hidden><input type="hidden" name="pro_name[]" class="form-control form-control-sm pro_name" readonly></td>' +
                   '<td> &#8358 <span class="amt">0</span></td>' +
                   '</tr>');

               var n = 0;
               $('.number').each(function () {
                   $(this).html(++n);
               })


           });

           function addNewRow(){

           }

           $('#remove').click(function () {
               $('#invoice_item').children('tr:last').remove();
               calculate(0,0);
           });

           $('#invoice_item').delegate('.pro_id', 'change', function () {
               var pid = $(this).val();
               var tr  = $(this).parent().parent();
               $('.overlay').show();
               $.ajax({
                   type: "POST",
                   url: '/order/price',
                   dataType: 'json',
                   data: {getPriceAndQty:1,id:pid},
                   success: function (data) {
                       tr.find(".tqty").val(data['balance']);
                       // tr.find(".pro_name").val(data['pro_name']);
                       tr.find(".qty").val(1);
                       tr.find(".price").val(data['price']);
                       tr.find(".amt").html(tr.find('.qty').val()*tr.find('.price').val());
                       calculate(0,0);
                   }
               });
           });

           $('#invoice_item').delegate('.qty', 'keyup', function () {
                var qty = $(this);
                var tr = $(this).parent().parent();
                if(isNaN(qty.val()))
                {
                    alert('Please enter a valid quantity ');
                    qty.val(1);
                }else
                {
                    if((qty.val()-0) > (tr.find('.tqty').val() - 0))
                    {
                        alert('Sorry ! This much of quantity is not available.');
                        qty.val(1);
                    }else
                    {
                        tr.find('.amt').html(qty.val()*tr.find('.price').val());
                        calculate(0,0);
                    }
                }

           })

           function calculate(dis,paid) {
               var sub_total = 0;
               var net_total = 0;
               var discount = dis;
               var amt_paid = paid;
               var  balance = 0;
               $('.amt').each(function () {
                   sub_total = sub_total + ($(this).html()*1);
               });
               $('.qty').each(function () {
                   net_total = net_total + ($(this).val()*1);
               });
               $('#sub_total').val(sub_total);
               net_total = sub_total-discount*net_total;
               balance = net_total - amt_paid;
               $('#net_total').val(net_total);
               $('#discount').val(discount);
               $('#paid').val(amt_paid);
               $('#balance').val(balance);

           }

           $('#discount').keyup(function () {
               var discount = $(this).val();
               calculate(discount,0);
           });

           $('#paid').keyup(function () {
               var paid = $(this).val();
               var discount = $('#discount').val();
               calculate(discount,paid);
           });


     /*=============================== Order Accepting ==============================================*/
         $('#order_form').click(function () {
             var invoice = $('#form_order_data').serialize();
             if($('#customer_id').val() === null)
             {
                alert('Please select a customer')
             }else if($('#employee_id').val()===null)
             {
                 alert('Please select a Sale Rep.')
             }else if($('#paid').val()==='')
             {
                 alert('Please enter paid amount')
             }else
             {
                 $.ajax({
                     url : '/order/accepting',
                     method: 'POST',
                     data: $('#form_order_data').serialize(),
                     success: function (data) {
                         // $('#form_order_data').trigger('reset');
                         location.reload();
                         // alert("ORDER COMPLETED");
                         if (confirm('Do you want to print invoice?'))
                         {
                             window.location.href = '/order/invoice?'+invoice;
                         }
                     }
                 });
             }


         })

       })
    </script>
@endsection
