
@extends('admin.layouts.master')
@section('head')
    <!--Load the AJAX API-->
{{--    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>--}}
    <script type="text/javascript">


    </script>
@endsection

@section('styles')
    <!-- JQVMap -->
    <link rel="stylesheet" href="{{asset('plugins/jqvmap/jqvmap.min.css')}}">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{asset('plugins/overlayScrollbars/css/OverlayScrollbars.min.css')}}">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="{{asset('plugins/daterangepicker/daterangepicker.css')}}">
    <!-- summernote -->
    <link rel="stylesheet" href="{{asset('plugins/summernote/summernote-bs4.css')}}">
    <link rel="stylesheet" href="{{asset('css/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/responsive.bootstrap4.min.css')}}">
@endsection

@section('page-header')
    <div class="overlay"><div class="loader"></div></div>
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Dashboard </h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#"><i class="fa fa-tachometer-alt"></i> Home </a></li>
                    {{--                    <li><a href="#">Products </i> </a> - </li>--}}
                    {{--                    <li class="active"> Orders</li>--}}
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->

    <hr style="border: solid 0.5px #a3a3a3">
@endsection


@section('content')
    <section class="content">

        <div class="container-fluid">
            <!-- Info boxes -->
            <div class="row">
                <div class="col-12 col-sm-6 col-md-3">
                    @if(Session::get('adminDetails')['store_view_access']==1 || Session::get('adminDetails')['store_move_access']==1 || Session::get('adminDetails')['type']=='Admin')
                        <div class="info-box mb-3">
                            <span class="info-box-icon bg-info elevation-1"><i class="fas fa-store"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">Available Products</span>
                                <span class="info-box-number">
                            @foreach($products as $product)
                                        {{$product->case}} - ({{(\App\Store::where('box_id',$product->id)->where('flow','In flow')->sum('quantity'))-
                          (\App\Store::where('box_id',$product->id)->where('flow','Out flow')->sum('quantity'))}}) &nbsp;&nbsp;&nbsp;
                                    @endforeach
                            </span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                @endif
                <!-- /.info-box -->
                </div>
            {{--                <div class="col-12 col-sm-6 col-md-3">--}}
            {{--                    <div class="info-box">--}}
            {{--                        <span class="info-box-icon bg-info elevation-1"><i class="fas fa-cog"></i></span>--}}

            {{--                        <div class="info-box-content">--}}
            {{--                            <span class="info-box-text">Customers</span>--}}
            {{--                            <span class="info-box-number">--}}
            {{--                  10--}}
            {{--                  <small>%</small>--}}
            {{--                </span>--}}
            {{--                        </div>--}}
            {{--                        <!-- /.info-box-content -->--}}
            {{--                    </div>--}}
            {{--                    <!-- /.info-box -->--}}
            {{--                </div>--}}
            <!-- /.col -->
                <div class="col-12 col-sm-6 col-md-3">
                    @if(Session::get('adminDetails')['finance_access']!= 0 || Session::get('adminDetails')['type']=='Admin')
                        <div class="info-box mb-3">
                            <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-balance-scale-left"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">Expected Balances</span>
                                <span class="info-box-number">&#8358 {{number_format($sales->sum('balance'), 2)}}</span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                @endif
                <!-- /.info-box -->
                </div>
                <!-- /.col -->

                <!-- fix for small devices only -->
                <div class="clearfix hidden-md-up"></div>

                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box mb-3">
                        <span class="info-box-icon bg-success elevation-1"><i class="fas fa-shopping-cart"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Sales</span>
                            <?php $sum = 0;
                            foreach ($sales as $sale) {
                                foreach ($sale->orders as $order) {
                                    $sum = $sum + $order->product_qty;
                                }
                            }
                            ?>
                            <span class="info-box-number">{{$sum}}</span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box mb-3">
                        <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Customers</span>
                            <span class="info-box-number">{{count(\App\User::all())}}</span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
            </div>
            <div class="row">
                @if(Session::get('adminDetails')['finance_access']== 3 || Session::get('adminDetails')['type']=='Admin')
                    <div class="col-12 col-sm-6 col-md-3">
                        <div class="info-box mb-3">
                            <span class="info-box-icon bg-primary elevation-1"><i class="fas fa-money-bill-alt"></i></span>
                        <?php $balance = !empty($account) ? $account->balance : 0 ?>
                            <div class="info-box-content">
                                <span class="info-box-text">Total Daily Income</span>
                                <span class="info-box-number">
                               Cash:  <span class="text-primary">&#8358 {{number_format($income_total_cash_daily, 2)}}</span> <br>
                               Wired:  <span class="text-success">&#8358 {{number_format($income_total_wired_daily, 2)}}</span> <br>
                               Total:  <span><strong>&#8358 {{number_format($income_total_cash_daily+$income_total_wired_daily, 2)}}</strong></span>
                                </span>
                            </div>

                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                    <div class="col-12 col-sm-6 col-md-3">
                        <div class="info-box mb-3">
                            <span class="info-box-icon bg-gradient-warning elevation-1"><i class="fa fa-folder-minus"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">Total Daily Expenses</span>
                                Cash:  <span class="text-primary ">&#8358 {{number_format($expense_total_cash_daily, 2)}}</span> <br>
                                Wired:  <span class="text-success">&#8358 {{number_format($expense_total_wired_daily, 2)}}</span>
                                <br>
                                Total:  <span><strong>&#8358 {{number_format($expense_total_wired_daily+$expense_total_cash_daily, 2)}}</strong></span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                    <!-- /.col -->

                    <!-- fix for small devices only -->
                    <div class="clearfix hidden-md-up"></div>

                    <div class="col-12 col-sm-6 col-md-3">
                        <div class="info-box mb-3">
                            <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-balance-scale"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">Daily Balance</span>
                                Cash:  <span class="text-primary ">&#8358 {{number_format($income_total_cash_daily - $expense_total_cash_daily, 2)}}</span> <br>
                                Wired:  <span class="text-success">&#8358 {{number_format($income_total_wired_daily - $expense_total_wired_daily, 2)}}</span>
                                <br>
                                Total:  <span ><strong>&#8358 {{number_format($income_total_wired_daily+$income_total_cash_daily - $expense_total_wired_daily - $expense_total_cash_daily, 2)}}</strong></span>
{{--                                <span class="info-box-number">&#8358 {{number_format($total_incomes-$total_expense,2)}}</span>--}}
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                @endif
            <!-- /.col -->
                @if(Session::get('adminDetails')['operation_access']!= 0 || Session::get('adminDetails')['type']=='Admin')
                    <div class="col-12 col-sm-6 col-md-3">
                        <div class="info-box mb-3">
                            <span class="info-box-icon bg-light elevation-1"><i class="fas fa-house-damage"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">Daily Damages</span>
                                <span class="info-box-number">{{$damages}}</span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
            @endif
            <!-- /.col -->
            </div>
            <!-- /.row -->
            @if(Session::get('adminDetails')['type']=='Admin')
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title">Monthly Recap Report</h5>

                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-tool dropdown-toggle" data-toggle="dropdown">
                                            <i class="fas fa-wrench"></i>
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-right" role="menu">
                                            <a href="#" class="dropdown-item">Action</a>
                                            <a href="#" class="dropdown-item">Another action</a>
                                            <a href="#" class="dropdown-item">Something else here</a>
                                            <a class="dropdown-divider"></a>
                                            <a href="#" class="dropdown-item">Separated link</a>
                                        </div>
                                    </div>
                                    <button type="button" class="btn btn-tool" data-card-widget="remove">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="card container">
                                            <div class="card-body row d-flex justify-content-between">
                                                <p>Monthly Sales | 2020</p>
                                                <div class="">
                                                    <select name="year" id="year" class="form-control form-control-sm">
                                                        <option value="" disabled>Select Year</option>
                                                        @foreach($year_list as $row)
                                                            <option value="{{$row->year}}">{{$row->year}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <hr style="margin: 0">
                                            <div class="card-body">
                                                <canvas id="sales_Chart" ></canvas>
                                            </div>
                                        </div>
                                        <!-- /.chart-responsive -->
                                    </div>
                                    <!-- /.col -->
                                    <div class="col-md-4">

                                        <p class="text-center">
                                            <strong>Goal Completion</strong>
                                        </p>

                                        <div class="progress-group">
                                            @foreach($preforms as $preform)
                                                @if($preform->no_bags >0)
                                                    <?php $batch_id = \App\Batch::where('preform_id',$preform->id)->first()->id;  ?>
{{--                                                    @if(isset($preform->box->id))--}}
                                                        Preforms ({{$preform->preform_g}}gram, ({{$preform->box->case}}))
                                                        <span class="float-right"><b>{{$preform->no_bags}}</b>/ {{\App\Batch_history::where('unit_g',$preform->preform_g)->sum('no_bags')}}  </span>
                                                        <div class="progress progress-sm">
                                                            <div class="progress-bar bg-gradient-primary" style="width: {{100*($preform->no_bags)/(\App\Batch_history::where('batch_id',$batch_id)->first()->no_bags)}}%"></div>
                                                        </div>
{{--                                                     @endif--}}
                                                @endif
                                            @endforeach
                                        </div>
                                        <div class="progress-group">
                                            @foreach($caps as $cap)
                                                @if($cap->no_bags >0)
                                                    <?php $batch_id = \App\Batch::where('cap_id',$cap->id)->first()->id;  ?>
                                                    Caps ({{$cap->cap_g}}gram)
                                                    <span class="float-right"><b>{{$cap->no_bags}}</b>/ {{\App\Batch_history::where('material','Caps')->sum('no_bags')}}  </span>  </span>
                                                    <div class="progress progress-sm">
                                                        <div class="progress-bar bg-success" style="width: {{100*($cap->no_bags)/(\App\Batch_history::where('batch_id',$batch_id)->first()->no_bags)}}%"></div>
                                                    </div>
                                                @endif
                                            @endforeach
                                        </div>
                                        <div class="progress-group">
                                            @foreach($labels as $label)
                                                @if($label->no_bags >0)
                                                    <?php $batch_id = \App\Batch::where('label_id',$label->id)->first()->id;  ?>
                                                    Labels ({{$label->label_g}}gram, ({{$label->box->case}}))
                                                    <span class="float-right"><b>{{$label->no_bags}}</b>/ {{\App\Batch_history::where('unit_g',$label->label_g)->sum('no_bags')}}  </span>
                                                    <div class="progress progress-sm">
                                                        <div class="progress-bar bg-danger" style="width: {{100*($label->no_bags)/(\App\Batch_history::where('batch_id',$batch_id)->first()->no_bags)}}%"></div>
                                                    </div>
                                                @endif
                                            @endforeach
                                        </div>

                                        <!-- /.progress-group -->
                                    {{--                                <div class="progress-group">--}}
                                    {{--                                    Internal Account--}}
                                    {{--                                    <span class="float-right"><b>&#8358 {{!empty($account->balance) ? number_format($account->balance,2) : 0}}--}}
                                    {{--                                            </b>/ {{!empty($account->amount) ? number_format($account->amount, 2) : 0}}</span>--}}
                                    {{--                                        <div class="progress progress-sm">--}}
                                    {{--                                            <div class="progress-bar bg-warning" style="width: {{!empty($account->balance) ? $account->balance*100/$account->amount : 0}}%"></div>--}}
                                    {{--                                        </div>--}}
                                    {{--                                </div>--}}
                                    <!-- /.progress-group -->
                                    </div>
                                    <!-- /.col -->
                                </div>
                                <!-- /.row -->
                                <!-- ./card-body -->
                                <div class="card-footer">
                                    <div class="row">
                                        <div class="col-sm-3 col-6">
                                            <div class="description-block border-right">
                                                <span class="description-percentage text-success"><i class="fas fa-caret-up"></i> </span>
                                                 <h5 class="description-header text-primary">Cash: &#8358 {{number_format($total_cash_income, 2)}}</h5>
                                                 <h5 class="description-header text-success">Wired: &#8358 {{number_format($total_wired_income, 2)}}</h5>
                                                <span class="description-text">TOTAL REVENUE</span>
                                            </div>
                                            <!-- /.description-block -->
                                        </div>
                                        <!-- /.col -->
                                        <div class="col-sm-3 col-6">
                                            <div class="description-block border-right">
                                                <span class="description-percentage text-warning"><i class="fas fa-caret-left"></i></span>
                                                <h5 class="description-header text-primary">Cash: &#8358 {{number_format($total_cash_expense, 2)}}</h5>
                                                <h5 class="description-header text-success">Wired: &#8358 {{number_format($total_wired_expense, 2)}}</h5>
                                                <span class="description-text">TOTAL COST</span>
                                            </div>
                                            <!-- /.description-block -->
                                        </div>
                                        <!-- /.col -->
                                        <div class="col-sm-3 col-6">
                                            <div class="description-block border-right">
                                                <span class="description-percentage text-success"><i class="fas fa-caret-up"></i> </span>
                                                <h5 class="description-header text-primary">Cash: &#8358 {{number_format($total_cash_income - $total_cash_expense, 2)}}</h5>
                                                <h5 class="description-header text-success">Wired: &#8358 {{number_format($total_wired_income - $total_wired_expense, 2)}}</h5>
                                                <span class="description-text">TOTAL PROFIT</span>
                                            </div>
                                            <!-- /.description-block -->
                                        </div>
                                        <!-- /.col -->
                                        <div class="col-sm-3 col-6">
                                            <div class="description-block">
                                                <span class="description-percentage text-danger"><i class="fas fa-caret-down"></i> </span>
                                                <h5 class="description-header text-success">TOTAL REVENUE: &#8358 {{number_format($total_cash_income + $total_wired_income, 2)}}</h5>
                                                <h5 class="description-header text-danger">TOTAL COST: &#8358 {{number_format($total_cash_expense + $total_wired_expense, 2)}}</h5>
                                            </div>
                                            <!-- /.description-block -->
                                        </div>
                                    </div>
                                    <!-- /.row -->
                                </div>
                                <!-- /.card-footer -->
                            </div>
                            <!-- /.card -->
                        </div>
                        <!-- /.col -->
                    </div>
                </div>
        @endif
        <!-- /.row -->

            <!-- Main row -->
            <div class="row">

                <!-- Left col -->
                <div class="col-md-8">
                @if(Session::get('adminDetails')['orders_access']!=0 || Session::get('adminDetails')['type']=='Admin')
                    <!-- TABLE: LATEST ORDERS -->
                        <div class="card">
                            <div class="card-header border-transparent">
                                <h3 class="card-title">Latest Orders</h3>

                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                    <button type="button" class="btn btn-tool" data-card-widget="remove">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body p-0" style="font-size: 0.8rem">
                                <div class="table-responsive p-2" >
                                    <table id="latest_order" class="table m-0">
                                        <thead>
                                        <tr>
                                            <th>Order ID</th>
                                            <th>Item (Qty)</th>
                                            <th>Status</th>
                                            <th>Mobile</th>
                                            <th>Address</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($orders as $order)
                                            <tr>
                                                <td><a href="{{route('admin.viewOrderDetails',['id'=>$order->id])}}">{{$order->id}}</a></td>
                                                <td>
                                                    @foreach($order->orders as $item)
                                                        {{$item->product_name}} ({{$item->product_qty}}),
                                                    @endforeach
                                                </td>
                                                <td><span class="badge badge-success">{{$order->order_status}}</span></td>
                                                <td>
                                                    <div class="sparkbar" data-color="#00a65a" data-height="20">{{$order->mobile}}</div>
                                                </td>
                                                <td>
                                                    <div class="sparkbar" data-color="#00a65a" data-height="20">{{$order->address}}</div>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <!-- /.table-responsive -->
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer clearfix">
                                <a href="{{route('admin.viewOrders')}}" class="btn btn-sm btn-secondary float-right">View All Orders</a>
                            </div>
                            <!-- /.card-footer -->
                        </div>
                @endif
                <!-- /.card -->
                </div>
                <!-- /.col -->
                <div class="col-md-4 col-sm-6 col-12">
{{--                    <div class="info-box bg-warning">--}}
{{--                        <span class="info-box-icon"><i class="fas fa-comments"></i></span>--}}

{{--                        <div class="info-box-content">--}}
{{--                            <span class="info-box-text">Internal Account</span>--}}
{{--                            <span class="info-box-number">&#8358 {{!empty($account->balance) ? number_format($account->balance,2) : 0}}/{{!empty($account->amount) ? number_format($account->amount, 2) : 0}}</span>--}}

{{--                            <div class="progress">--}}
{{--                                <div class="progress-bar" style="width: {{!empty($account->balance) ? number_format($account->balance*100/$account->amount,0) : 0}}%"></div>--}}
{{--                            </div>--}}
{{--                            <span class="progress-description">--}}
{{--                  {{!empty($account->balance) ? number_format($account->balance*100/$account->amount,0) : 0}}% Remaining--}}
{{--                </span>--}}
{{--                        </div>--}}
{{--                        <!-- /.info-box-content -->--}}
{{--                    </div>--}}
                    <div class="info-box bg-success">
                        <span class="info-box-icon"><i class="fas fa-money-check"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Cash at hand</span>
                            <span class="info-box-number">&#8358 {{ number_format($cash_at_hand, 2) }}</span>
{{--                            <span class="info-box-number">&#8358 {{ number_format($total_cash_income - $expense_total_cash_daily, 2) }}</span>--}}
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>

                <!-- /.col -->
            </div>
            <div class="row">
                {{--                <div class="col-md-4">--}}
                {{--                    <div class="card">--}}
                {{--                        <div class="card-header">--}}
                {{--                            <h3 class="card-title">Browser Usage</h3>--}}

                {{--                            <div class="card-tools">--}}
                {{--                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>--}}
                {{--                                </button>--}}
                {{--                                <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i>--}}
                {{--                                </button>--}}
                {{--                            </div>--}}
                {{--                        </div>--}}
                {{--                        <!-- /.card-header -->--}}
                {{--                        <div class="card-body">--}}
                {{--                            <div class="row">--}}
                {{--                                <div class="col-md-8">--}}
                {{--                                    <div class="chart-responsive">--}}
                {{--                                        <canvas id="pieChart" height="150"></canvas>--}}
                {{--                                    </div>--}}
                {{--                                    <!-- ./chart-responsive -->--}}
                {{--                                </div>--}}
                {{--                                <!-- /.col -->--}}
                {{--                                <div class="col-md-4">--}}
                {{--                                    <ul class="chart-legend clearfix">--}}
                {{--                                        <li><i class="far fa-circle text-danger"></i> Chrome</li>--}}
                {{--                                        <li><i class="far fa-circle text-success"></i> IE</li>--}}
                {{--                                        <li><i class="far fa-circle text-warning"></i> FireFox</li>--}}
                {{--                                        <li><i class="far fa-circle text-info"></i> Safari</li>--}}
                {{--                                        <li><i class="far fa-circle text-primary"></i> Opera</li>--}}
                {{--                                        <li><i class="far fa-circle text-secondary"></i> Navigator</li>--}}
                {{--                                    </ul>--}}
                {{--                                </div>--}}
                {{--                                <!-- /.col -->--}}
                {{--                            </div>--}}
                {{--                            <!-- /.row -->--}}
                {{--                        </div>--}}
                {{--                        <!-- /.card-body -->--}}
                {{--                        <div class="card-footer bg-white p-0">--}}
                {{--                            <ul class="nav nav-pills flex-column">--}}
                {{--                                <li class="nav-item">--}}
                {{--                                    <a href="#" class="nav-link">--}}
                {{--                                        United States of America--}}
                {{--                                        <span class="float-right text-danger">--}}
                {{--                        <i class="fas fa-arrow-down text-sm"></i>--}}
                {{--                        12%</span>--}}
                {{--                                    </a>--}}
                {{--                                </li>--}}
                {{--                                <li class="nav-item">--}}
                {{--                                    <a href="#" class="nav-link">--}}
                {{--                                        India--}}
                {{--                                        <span class="float-right text-success">--}}
                {{--                        <i class="fas fa-arrow-up text-sm"></i> 4%--}}
                {{--                      </span>--}}
                {{--                                    </a>--}}
                {{--                                </li>--}}
                {{--                                <li class="nav-item">--}}
                {{--                                    <a href="#" class="nav-link">--}}
                {{--                                        China--}}
                {{--                                        <span class="float-right text-warning">--}}
                {{--                        <i class="fas fa-arrow-left text-sm"></i> 0%--}}
                {{--                      </span>--}}
                {{--                                    </a>--}}
                {{--                                </li>--}}
                {{--                            </ul>--}}
                {{--                        </div>--}}
                {{--                        <!-- /.footer -->--}}
                {{--                    </div>--}}
                {{--                </div>--}}
            </div>
            <!-- /.row -->
        </div><!--/. container-fluid -->

    </section>
@endsection

@section('scripts')
    <script src="{{asset('plugins/jquery-ui/jquery-ui.min.js')}}"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
        $.widget.bridge('uibutton', $.ui.button)
    </script>
    <!-- ChartJS -->
    <script src="{{asset('backend/js/chartjs.js')}}"></script>
    <!-- Sparkline -->
    <script src="{{asset('plugins/sparklines/sparkline.js')}}"></script>
    <!-- JQVMap -->
    <script src="{{asset('plugins/jqvmap/jquery.vmap.min.js')}}"></script>
    <script src="{{asset('plugins/jqvmap/maps/jquery.vmap.usa.js')}}"></script>
    <!-- jQuery Knob Chart -->
    <script src="{{asset('plugins/jquery-knob/jquery.knob.min.js')}}"></script>
    <script src="{{asset('plugins/raphael/raphael.min.js')}}"></script>
    <script src="{{asset('plugins/raphael/raphael.min.js')}}"></script>
    <!-- daterangepicker -->
    <script src="{{asset('plugins/moment/moment.min.js')}}"></script>
    <script src="{{asset('plugins/daterangepicker/daterangepicker.js')}}"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="{{asset('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')}}"></script>
    <!-- Summernote -->
    <script src="{{asset('plugins/summernote/summernote-bs4.min.js')}}"></script>
    <!-- overlayScrollbars -->
    <script src="{{asset('plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>
    <!-- AdminLTE App -->
    {{--    <script src="{{asset('dist/js/adminlte.js')}}"></script>--}}
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
{{--    <script src="{{asset('dist/js/pages/dashboard2.js')}}"></script>--}}
    <script src="{{asset('js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('js/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{asset('js/dataTables.responsive.min.js')}}"></script>
    <script src="{{asset('js/responsive.bootstrap4.min.js')}}"></script>

    <script>
        $(function () {
            //Initialize Select2 Elements
            $('.select2').select2();

            $("#latest_order").DataTable({
                "responsive": true,
                "autoWidth": false,
            });

        });

        $(document).ready(function () {
            $('#year').change(function () {
                const year = $(this).val();
                if (year !== ''){
                    load_monthly_data(year, 'Monthly Data for')
                }
            });
        });

        function drawMonthlyChart(chart_data, chart_main_title) {
            let jsonData = chart_data;
            // Create the data table.
            var data = new google.visualization.DataTable();
            data.addColumn('string', 'Month');
            data.addColumn('number', 'Profit');
            $.each(jsonData, (i, jsonData)=>{
                let month = jsonData.month;
                let profit = parseFloat($.trim(jsonData.profit));

                data.addRows([
                    [month, profit]
                ]);
            });


            // Set chart options
            var options = {
                title:'Monthly Data',
                hAxis: {
                    title : 'Months'
                },
                vAxis:{
                    title: 'Profit'
                },
                colors: ['black'],
                chartArea: {
                    width: '50%',
                    height: '80%'
                }

            };

        }
        function  load_monthly_data(year, title){
            const temp_title = title + ' ' +year;
            $.ajax({
                url: 'chart/fetch_data',
                method: 'POST',
                data: {
                    "_token": "{{csrf_token()}}",
                    year:year
                },
                dataType: 'JSON',
                success: function (data) {
                    console.log(data);
                    var sales = {
                        Product1: [],
                        Product2: []
                    };

                    var len = data.length;
                    for (var i = 0; i<len; i++){
                        if(data[i].product_name=="50 cl."){
                            sales.Product1.push(data[i].sales);
                        }
                        else if(data[i].product_name=="75 cl."){
                            sales.Product2.push(data[i].sales);
                        }
                    }

                    console.log(sales);

                    var ctx = document.getElementById('sales_Chart').getContext('2d');
                    var data1 = {
                        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                        datasets: [
                            {
                                label: '50 cl. Bottle water',
                                data: sales.Product1,
                                backgroundColor: 'rgb(0,99,132)',
                                borderColor: 'rgb(0,200,230)',
                            },
                            {
                                label: '75 cl. Bottle water',
                                data: sales.Product2,
                                backgroundColor: 'rgb(200,120,100)',
                                borderColor: 'rgb(240,200,230)',
                            }
                            ]
                    };
                    var chart = new Chart(ctx, {
                        type: 'bar',
                        data: data1,
                        options: {}

                    });
                    // var ctx = document.getElementById('sales_Chart').getContext('2d');
                    // var chart = new Chart(ctx, {
                    //     type: 'bar',
                    //     data: {
                    //         labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                    //         datasets: [{
                    //             label: 'Sales',
                    //             data: [10,20,30,42,50,60.70],
                    //             backgroundColor: 'rgb(0,99,132)',
                    //         },
                    //             {
                    //                 label: 'Expenses',
                    //                 data: [50, 20, 200, 30, 10, 80, 100],
                    //                 backgroundColor: 'rgb(200,120,100)',
                    //             }
                    //         ]
                    //     },
                    //     options: {
                    //         scales: {
                    //             xAxes: [{
                    //                 stacked: true
                    //             }],
                    //             yAxes: [{
                    //                 ticks: {
                    //                     beginAtZero: true
                    //                 },
                    //                 stacked: true
                    //             }]
                    //         },
                    //         stacked: true
                    //     }
                    // });
                    //
                    // function updateChart() {
                    //     chart.data.datasets[0].data = [10,20,30,42,50,60.70];
                    //     chart.update();
                    // }
                },
                error: function (data) {
                    console.log(data);
                }
            });
        }




    </script>
@endsection
