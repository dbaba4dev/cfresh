<?php $admin = \App\Admin::with('employee')->where('username',Session::get('adminSession'))->first(); ?>

<aside class="main-sidebar sidebar-light-primary elevation-4">
    <!-- Brand Logo -->
    <a href="../../index3.html" class="brand-link text-center">
        <img src="{{asset('images/logo/Cfresh-label.png')}}"
             alt="AdminLTE Logo" height="80px" width="150px"
             class=" img-circle elevation-3"
             style="opacity: .8">

    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                @if(empty($admin->employee_id) )
                    <img src="{{asset('images/backends_images/admins_images/dbaba.png')}}" class="img-circle elevation-2" alt="User Image">
                @else
                    <img src="{{ asset(\App\Profile::where('employee_id', $admin->employee->id)->first()->avatar) }}" class="img-circle elevation-2" alt="User Image">
{{--                    <img src="{{ asset($admin->employee->profile->avatar) }}" class="img-circle elevation-2" alt="User Image">--}}
                @endif
            </div>
            <div class="info">
                @if(empty($admin->employee_id) )
                    <a href="#" class="d-block red">Master Admin</a>
                @else
                    <a href="#" class="d-block">{{ $admin->employee->name }}</a>
                @endif
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                     with font-awesome or a ny other icon font library -->
                <li class="nav-item">
                    <a href="{{route('admin.dashboard')}}" class="nav-link {{Request::is('home*') ? 'active' : ''}}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>

                </li>
                @if(Session::get('adminDetails')['type']=='Admin')
                    <li class="nav-item has-treeview {{Request::is('admin/admins*') ? 'menu-open' : ''}}">
                    <a href="" class="nav-link {{Request::is('admin/admins*') ? 'active' : ''}}" >
                        <i class="nav-icon fas fa-user-secret"></i>
                        <p>
                            Admins Management
                            <i class="fas fa-angle-left right"></i>
                            <span class="badge badge-info right">2</span>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('viewAdmins')}}" class="nav-link {{Request::is('admin/admins/view-admins') ? 'active' : ''}}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>View Admin</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('addAdmin')}}" class="nav-link {{Request::is('admin/admins/add-admin') ? 'active' : ''}}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Add Admin</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item has-treeview {{Request::is('admin/coupons*') ? 'menu-open' : ''}}">
                    <a href="" class="nav-link {{Request::is('admin/coupons*') ? 'active' : ''}}" >
                        <i class="nav-icon fa fa-gift"></i>
                        <p>
                            Coupons
                            <i class="fas fa-angle-left right"></i>
                            <span class="badge badge-info right">2</span>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('admin.addCoupon')}}" class="nav-link {{Request::is('admin/coupons/add') ? 'active' : ''}}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Add Coupon</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('admin.viewCoupons')}}" class="nav-link {{Request::is('admin/coupons/view') ? 'active' : ''}}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>View Coupons</p>
                            </a>
                        </li>
                    </ul>
                </li>
                @endif

                <!--@if(Session::get('adminDetails')['users_access']==1 || Session::get('adminDetails')['type']=='Admin')-->
                <!--    <li class="nav-item has-treeview {{Request::is('admin/users*') ? 'menu-open' : ''}}">-->
                <!--    <a href="" class="nav-link {{Request::is('admin/view-users*') ? 'active' : ''}}" >-->
                <!--        <i class="nav-icon fas fa-user-secret"></i>-->
                <!--        <p>-->
                <!--            Users-->
                <!--            <i class="fas fa-angle-left right"></i>-->
                <!--            <span class="badge badge-info right">1</span>-->
                <!--        </p>-->
                <!--    </a>-->
                <!--    <ul class="nav nav-treeview">-->
                <!--        <li class="nav-item">-->
                <!--            <a href="{{route('admin.viewUsers')}}" class="nav-link {{Request::is('admin/view-users') ? 'active' : ''}}">-->
                <!--                <i class="far fa-circle nav-icon"></i>-->
                <!--                <p>Registered Users</p>-->
                <!--            </a>-->
                <!--        </li>-->
                <!--       {{-- <li class="nav-item">-->
                <!--            <a href="{{route('users.trashed')}}" class="nav-link {{Request::is('admin/trashed*') ? 'active' : ''}}">-->
                <!--                <i class="far fa-circle nav-icon"></i>-->
                <!--                <p>Deactivated Users</p>-->
                <!--            </a>-->
                <!--        </li>--}}-->
                <!--    </ul>-->
                <!--</li>-->
                <!--@endif-->

                @if(Session::get('adminDetails')['type']=='Admin')
                    <li class="nav-item has-treeview {{Request::is('admin/pay*') ? 'menu-open' : ''}}">
                        <a href="" class="nav-link {{Request::is('admin/pay*') ? 'active' : ''}}" >
                            <i class="nav-icon fas fa-money-bill-wave"></i>
                            <p>
                                Make Payment
                                <i class="fas fa-angle-left right"></i>
                                <span class="badge badge-info right">1</span>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{route('settlement')}}" class="nav-link {{Request::is('admin/pay/employee') ? 'active' : ''}}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Employee Settlement</p>
                                </a>
                            </li>
                            {{-- <li class="nav-item">
                                 <a href="{{route('users.trashed')}}" class="nav-link {{Request::is('admin/trashed*') ? 'active' : ''}}">
                                     <i class="far fa-circle nav-icon"></i>
                                     <p>Deactivated Users</p>
                                 </a>
                             </li>--}}
                        </ul>
                    </li>
                @endif

                @if(Session::get('adminDetails')['employees_access']!=0 || Session::get('adminDetails')['type']=='Admin')
                    <li class="nav-item has-treeview {{Request::is('admin/employee*') ? 'menu-open' : ''}}">
                    <a href="#" class="nav-link {{Request::is('admin/employee*') ? 'active' : ''}}">
                        <i class="nav-icon fas fa-users"></i>
                        <p>
                            Employees
                            <i class="fas fa-angle-left right"></i>
                            <span class="badge badge-info right">5</span>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('employees')}}" class="nav-link {{Request::is('admin/employee/index') ? 'active' : ''}}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>All Employees</p>
                            </a>
                        </li>
                        @if(Session::get('adminDetails')['employees_access']== 3 || Session::get('adminDetails')['type']=='Admin')
                        <li class="nav-item">
                            <a href="{{route('employee.create')}}" class="nav-link {{Request::is('admin/employee/create') ? 'active' : ''}}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>New Employee</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('trashes')}}" class="nav-link {{Request::is('admin/employee/deactivated') ? 'active' : ''}}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Deactivated Employees</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('categories')}}" class="nav-link {{Request::is('admin/employee/categories') ? 'active' : ''}}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Employees Categories</p>
                            </a>
                        </li>
                        @endif
                        @if(Session::get('adminDetails')['type']=='Admin')
                        <li class="nav-item">
                            <a href="{{route('payments')}}" class="nav-link {{Request::is('admin/employee/payments') ? 'active' : ''}}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Payments Type</p>
                            </a>
                        </li>

                        @endif
                    </ul>
                </li>
                @endif

{{--                @if(Session::get('adminDetails')['customers_access']!=1)--}}
{{--                <li class="nav-item has-treeview">--}}
{{--                    <a href="#" class="nav-link">--}}
{{--                        <i class="nav-icon fas fa-users"></i>--}}
{{--                        <p>--}}
{{--                            Customers--}}
{{--                            <i class="fas fa-angle-left right"></i>--}}
{{--                            <span class="badge badge-info right">20</span>--}}
{{--                        </p>--}}
{{--                    </a>--}}
{{--                    <ul class="nav nav-treeview">--}}
{{--                        <li class="nav-item">--}}
{{--                            <a href="" class="nav-link">--}}
{{--                                <i class="far fa-circle nav-icon"></i>--}}
{{--                                <p>All Customers</p>--}}
{{--                            </a>--}}
{{--                        </li>--}}
{{--                        <li class="nav-item">--}}
{{--                            <a href="" class="nav-link">--}}
{{--                                <i class="far fa-circle nav-icon"></i>--}}
{{--                                <p>New Customers</p>--}}
{{--                            </a>--}}
{{--                        </li>--}}
{{--                        <li class="nav-item">--}}
{{--                            <a href="" class="nav-link">--}}
{{--                                <i class="far fa-circle nav-icon"></i>--}}
{{--                                <p>Deactivated Customers</p>--}}
{{--                            </a>--}}
{{--                        </li>--}}
{{--                        <li class="nav-item">--}}
{{--                            <a href="" class="nav-link">--}}
{{--                                <i class="far fa-circle nav-icon"></i>--}}
{{--                                <p>Customers Categories</p>--}}
{{--                            </a>--}}
{{--                        </li>--}}

{{--                        <li class="nav-item">--}}
{{--                            <a href="" class="nav-link">--}}
{{--                                <i class="far fa-circle nav-icon"></i>--}}
{{--                                <p>Customers Locations</p>--}}
{{--                            </a>--}}
{{--                        </li>--}}

{{--                    </ul>--}}
{{--                </li>--}}
{{--                @endif                // Customers Sections--}}

                @if(Session::get('adminDetails')['products_access']!=0 || Session::get('adminDetails')['type']=='Admin')
                    <li class="nav-item has-treeview {{Request::is('admin/cases*') ? 'menu-open' : ''}}">
                    <a href="" class="nav-link {{Request::is('admin/cases*') ? 'active' : ''}}" >
                        <i class="nav-icon fas fa-boxes"></i>
                        <p>
                            Products
                            <i class="fas fa-angle-left right"></i>
                            <span class="badge badge-info right">1</span>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        @if(Session::get('adminDetails')['products_access']== 2 || Session::get('adminDetails')['type']=='Admin')
                        <li class="nav-item">
                            <a href="{{route('cases')}}" class="nav-link {{Request::is('admin/cases') ? 'active' : ''}}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>View/Add Product Type</p>
                            </a>
                        </li>
                        @endif
                    </ul>
                </li>
                @endif

                @if(Session::get('adminDetails')['users_access']!=0 || Session::get('adminDetails')['type']=='Admin')
                <li class="nav-item has-treeview {{Request::is('admin/orders*') ? 'menu-open' : ''}}">
                    <a href="" class="nav-link {{Request::is('admin/orders*') ? 'active' : ''}}" >
                        <i class="nav-icon fa fa-users"></i>
                        <p>
                            Customers
                            <i class="fas fa-angle-left right"></i>
                            <span class="badge badge-info right">1</span>
                        </p>
                    </a>

                    <ul class="nav nav-treeview">
						@if(Session::get('adminDetails')['users_access']==1 || Session::get('adminDetails')['users_access']==3 || Session::get('adminDetails')['type']=='Admin')
                        <li class="nav-item">
                            <a href="{{route('customers')}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>View All Customers</p>
                            </a>
                        </li>
						<li class="nav-item">
                            <a href="{{route('admin.viewOrders')}}" class="nav-link {{Request::is('admin/orders/view') ? 'active' : ''}}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>View Customer's Orders</p>
                            </a>
                        </li>
						 @endif

						@if(Session::get('adminDetails')['users_access']==2 || Session::get('adminDetails')['users_access']==3 || Session::get('adminDetails')['type']=='Admin')
                        <li class="nav-item">
                            <a href="{{route('customers.create_step1')}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Add Customers</p>
                            </a>
                        </li>
						@endif

						@if(Session::get('adminDetails')['users_access']==3 || Session::get('adminDetails')['type']=='Admin')
                        <li class="nav-item">
                            <a href="{{route('customers.place_order')}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Place Order</p>
                            </a>
                        </li>
						@endif

                    </ul>
                </li>
                @endif

                @if(Session::get('adminDetails')['inventories_view_access']==1 || Session::get('adminDetails')['inventories_manage_access']== 1 || Session::get('adminDetails')['type']=='Admin')
                <li class="nav-item has-treeview {{Request::is('admin/stock*') ? 'menu-open' : ''}}">
                    <a href="" class="nav-link {{Request::is('admin/stock*') ? 'active' : ''}}" >
                        <i class="nav-icon fas fa-book-open"></i>
                        <p>
                            Inventory
                            <i class="fas fa-angle-left right"></i>
                            <span class="badge badge-info right">3</span>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        @if(Session::get('adminDetails')['inventories_view_access']== 1 || Session::get('adminDetails')['type']=='Admin')
                        <li class="nav-item">
                            <a href="{{route('stocks')}}" class="nav-link {{Request::is('admin/stock') ? 'active' : ''}}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Stock</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('stocks.history')}}" class="nav-link {{Request::is('admin/stock/history') ? 'active' : ''}}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Batch History</p>
                            </a>
                        </li>
                        @endif
                        @if(Session::get('adminDetails')['inventories_manage_access']== 1 || Session::get('adminDetails')['type']=='Admin')
                        <li class="nav-item">
                            <a href="{{route('materials')}}" class="nav-link {{Request::is('admin/stock/materials') ? 'active' : ''}}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Manage Raw Materials</p>
                            </a>
                        </li>
                        @endif
                    </ul>
                </li>
                @endif

                @if(Session::get('adminDetails')['finance_access']!=0 || Session::get('adminDetails')['type']=='Admin')
                    <li class="nav-item has-treeview {{Request::is('admin/finances*') ? 'menu-open' : ''}}">
                        <a href="" class="nav-link {{Request::is('admin/finances*') ? 'active' : ''}}" >
                            <i class="nav-icon fas fa-money-bill"></i>
                            <p>
                                Finance
                                <i class="fas fa-angle-left right"></i>
                                <span class="badge badge-info right">4</span>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @if(Session::get('adminDetails')['finance_access']== 2 || Session::get('adminDetails')['finance_access']== 3 || Session::get('adminDetails')['type']=='Admin')
                                <li class="nav-item">
                                    <a href="{{route('finance.income')}}" class="nav-link {{Request::is('admin/finances/income') ? 'active' : ''}}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Add Income/Expenses</p>
                                    </a>
                                </li>
                            @endif
                            @if(Session::get('adminDetails')['finance_access']== 1 || Session::get('adminDetails')['finance_access']== 2 || Session::get('adminDetails')['finance_access']== 3 || Session::get('adminDetails')['type']=='Admin')
                                <li class="nav-item">
                                    <a href="{{route('income.search')}}" class="nav-link {{Request::is('admin/finances/income/search') ? 'active' : ''}}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>View Income</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{route('expense.search')}}" class="nav-link {{Request::is('admin/finances/expense/search') ? 'active' : ''}}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>View Expenses</p>
                                    </a>
                                </li>
                            @endif
                            @if(Session::get('adminDetails')['finance_access']== 3 || Session::get('adminDetails')['type']=='Admin')
                                <li class="nav-item">
                                    <a href="{{route('check.balance')}}" class="nav-link {{Request::is('admin/finances/expense/search') ? 'active' : ''}}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Check & Balance</p>
                                    </a>
                                </li>

                                 <li class="nav-item">
                                        <a href="{{route('cash.bank')}}" class="nav-link {{Request::is('admin/finances/bank-cash') ? 'active' : ''}}">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Cash to Bank</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{route('cash.from.bank')}}" class="nav-link {{Request::is('admin/finances/cash-from-bank') ? 'active' : ''}}">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Cash from Bank</p>
                                        </a>
                                    </li>
                            @endif
                        </ul>
                    </li>
                @endif

                @if(Session::get('adminDetails')['store_move_access']==1 || Session::get('adminDetails')['damage_operation_access']==1 || Session::get('adminDetails')['store_move_access']==1 || Session::get('adminDetails')['type']=='Admin')
                <li class="nav-item has-treeview {{Request::is('admin/operation*') ? 'menu-open' : ''}}">
                    <a href="" class="nav-link {{Request::is('admin/operation*') ? 'active' : ''}}" >
                        <i class="nav-icon fa fa-user-injured"></i>
                        <p>
                            Operations
                            <i class="fas fa-angle-left right"></i>
                            <span class="badge badge-info right">2</span>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        @if(Session::get('adminDetails')['store_move_access']==1 || Session::get('adminDetails')['type']=='Admin')
                        <li class="nav-item">
                            <a href="{{route('products.finished')}}" class="nav-link {{Request::is('admin/operation/move/product') ? 'active' : ''}}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Move Products to Store</p>
                            </a>
                        </li>
                        @endif
                        @if(Session::get('adminDetails')['operation_access']==1 || Session::get('adminDetails')['type']=='Admin')
{{--                        <li class="nav-item">--}}
{{--                            <a href="{{route('damages')}}" class="nav-link {{Request::is('admin/operation/damages') ? 'active' : ''}}">--}}
{{--                                <i class="far fa-circle nav-icon"></i>--}}
{{--                                <p>--}}
{{--                                    Damages--}}
{{--                                </p>--}}
{{--                            </a>--}}

{{--                        </li>--}}
                                <li class="nav-item has-treeview">
                                    <a href="" class="nav-link">
                                        <i class="nav-icon fas fa-circle"></i>
                                        <p>
                                            Damages
                                            <i class="right fas fa-angle-left"></i>
                                        </p>
                                    </a>
                                    <ul class="nav nav-treeview">
                                        <li class="nav-item">
                                            <a href="{{route('damages')}}" class="nav-link {{Request::is('admin/operation/damages') ? 'active' : ''}}">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>Add Damages</p>
                                            </a>
                                        </li>
                                       {{-- <li class="nav-item has-treeview">
                                            <a href="#" class="nav-link">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>
                                                    Level 2
                                                    <i class="right fas fa-angle-left"></i>
                                                </p>
                                            </a>
                                            <ul class="nav nav-treeview">
                                                <li class="nav-item">
                                                    <a href="#" class="nav-link">
                                                        <i class="far fa-dot-circle nav-icon"></i>
                                                        <p>Level 3</p>
                                                    </a>
                                                </li>
                                                <li class="nav-item">
                                                    <a href="#" class="nav-link">
                                                        <i class="far fa-dot-circle nav-icon"></i>
                                                        <p>Level 3</p>
                                                    </a>
                                                </li>
                                                <li class="nav-item">
                                                    <a href="#" class="nav-link">
                                                        <i class="far fa-dot-circle nav-icon"></i>
                                                        <p>Level 3</p>
                                                    </a>
                                                </li>
                                            </ul>
                                        </li>--}}
                                        <li class="nav-item">
                                            <a href="{{route('damages.search')}}" class="nav-link {{Request::is('admin/operation/view-damages') ? 'active' : ''}}">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>View Damages</p>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                         @endif
                    </ul>
                </li>
                @endif

                @if(Session::get('adminDetails')['store_view_access']==1 || Session::get('adminDetails')['store_move_access']==1 || Session::get('adminDetails')['type']=='Admin')
                    <li class="nav-item has-treeview {{Request::is('admin/store*') ? 'menu-open' : ''}}">
                        <a href="" class="nav-link {{Request::is('admin/store*') ? 'active' : ''}}" >
                            <i class="nav-icon fa fa-store-alt"></i>
                            <p>
                                Store
                                <i class="fas fa-angle-left right"></i>
                                <span class="badge badge-info right">1</span>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
{{--                            @if(Session::get('adminDetails')['store_move_access']==1 || Session::get('adminDetails')['type']=='Admin')--}}
{{--                                <li class="nav-item">--}}
{{--                                    <a href="{{route('products.finished')}}" class="nav-link {{Request::is('admin/store/move/product') ? 'active' : ''}}">--}}
{{--                                        <i class="far fa-circle nav-icon"></i>--}}
{{--                                        <p>Move Products to Store</p>--}}
{{--                                    </a>--}}
{{--                                </li>--}}
{{--                            @endif--}}
                            @if(Session::get('adminDetails')['store_view_access']==1 || Session::get('adminDetails')['type']=='Admin')
                                <li class="nav-item">
                                    <a href="{{route('store')}}" class="nav-link {{Request::is('admin/store/view') ? 'active' : ''}}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>
                                            View Store
                                        </p>
                                    </a>

                                </li>
                            @endif
                        </ul>
                    </li>
                @endif

           {{--     @if(Session::get('adminDetails')['type']=='Admin')
                    <li class="nav-item has-treeview {{Request::is('admin/cms*') ? 'menu-open' : ''}}">
                        <a href="" class="nav-link {{Request::is('admin/cms*') ? 'active' : ''}}" >
                            <i class="nav-icon fa fa-clipboard-list"></i>
                            <p>
                                CMS Pages
                                <i class="fas fa-angle-left right"></i>
                                <span class="badge badge-info right">2</span>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{route('admin.addCmsPage')}}" class="nav-link {{Request::is('admin/cms/add') ? 'active' : ''}}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Add CMS Page</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('admin.viewCmsPages')}}" class="nav-link {{Request::is('admin/cms/view') ? 'active' : ''}}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>View CMS Pages</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                @endif--}}-


            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
