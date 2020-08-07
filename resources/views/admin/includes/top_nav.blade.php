<?php
 $newOrderCount = \App\Order::where('order_status','New')->count();
$cashBCount = \App\CashBalance::where('status',0)->count();
$getTime = \App\Order::where('order_status','New')->first();

?>

{{--    <nav class="main-header navbar navbar-expand navbar-blue navbar-dark">--}}
    <nav class="main-header navbar navbar-expand">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="{{route('home')}}" class="nav-link">Home</a>
        </li>

    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">

        <!-- Notifications Dropdown Menu -->
        @if($cashBCount > 0)
            <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                <i class="far fa-comment"></i>
                <span class="badge badge-danger navbar-badge">{{$cashBCount}}</span>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <span class="dropdown-item dropdown-header">{{$cashBCount}} Notifications</span>
                <div class="dropdown-divider"></div>
                <a href="{{route('check.balance')}}" class="dropdown-item" style="font	8px">
                    <i class="fas fa-envelope mr-2" ></i><p>{{$cashBCount > 0 ? $cashBCount . ' Check and Balance has not been submitted for '.$cashBCount . ' day(s)' : ''}}</p>
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
            </div>
        </li>
        @endif
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                <i class="far fa-bell"></i>
                <span class="badge badge-info navbar-badge">{{$newOrderCount}}</span>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <span class="dropdown-item dropdown-header">{{$newOrderCount}} Notifications</span>
                <div class="dropdown-divider"></div>
                <a href="{{route('admin.viewOrders')}}" class="dropdown-item">
                    <i class="fas fa-envelope mr-2"></i> {{$newOrderCount > 1 ? $newOrderCount . ' new orders' : $newOrderCount . ' new order'}}
{{--                    <span class="float-right text-muted text-sm">{{\Carbon\Carbon::}}</span>--}}
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
            </div>
        </li>
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                <i class="far fa-user"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <span class="dropdown-item dropdown-header">Shortcuts</span>
{{--                <div class="dropdown-divider"></div>--}}
{{--                <a href="#" class="dropdown-item">--}}
{{--                    <i class="fas fa-envelope mr-2"></i> 4 new messages--}}
{{--                    <span class="float-right text-muted text-sm">3 mins</span>--}}
{{--                </a>--}}
                <div class="dropdown-divider"></div>
                <a href="{{route('settings')}}" class="dropdown-item">
                    <i class="fas fa-cogs"></i> Settings
                </a>
                <div class="dropdown-divider"></div>
                <a href="{{route('admin.logout')}}" class="dropdown-item">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </a>
                <div class="dropdown-divider"></div>
{{--                <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>--}}
            </div>
        </li>
{{--        <li class="nav-item">--}}
{{--            <div>--}}
{{--                <a href="{{route('admin.logout')}}" class="btn nav-link"  >--}}
{{--                    <i class="fas fa-sign-out-alt"></i>--}}
{{--                </a>--}}
{{--            </div>--}}

{{--        </li>--}}
{{--        @if (Auth::check())--}}
{{--            @if(Auth::user()->admin)--}}

{{--                <li class="nav-item">--}}
{{--                    <a class="nav-link" href="{{route('settings')}}"><i class="fas fa-cogs"></i></a>--}}
{{--                </li>--}}
{{--            @endif--}}
{{--        @endif--}}
    </ul>
</nav>
