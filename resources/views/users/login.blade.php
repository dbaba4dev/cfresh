@extends('frontend.layouts.master')
{{--@section('klass','active')--}}

@section('styles')

@endsection

@section('page-header')

@endsection

@section('content')

    <!--================Login Box Area =================-->
    <section class="login_box_area section-margin">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="login_box_img">
                        <div class="hover">
                            <h4>New to our website?</h4>
                            <p>There are advances being made in science and technology everyday, and a good example of this is the</p>
                            <a class="button button-account" href="{{route('user.LoginRegisterForm')}}">Create an Account</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">

                    <div class="login_form_inner">
                        <h3>Log in to enter</h3>
                        <div class="mx-5">@include('admin.includes.alert-msg')</div>
                        <form class="row login_form" action="{{route('user.login')}}" method="post" id="login_form" name="login_form" >
                            @csrf

                            <div class="col-md-12 form-group">
                                <input type="email" class="form-control" id="email" name="email" placeholder="Email Address" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Email Address'">
                            </div>
                            <div class="col-md-12 form-group">
                                <input type="password" class="form-control" id="password" name="password" placeholder="Password" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Password'">
                            </div>
{{--                            <div class="col-md-12 form-group">--}}
{{--                                <div class="creat_account">--}}
{{--                                    <input type="checkbox" id="f-option2" name="selector">--}}
{{--                                    <label for="f-option2">Keep me logged in</label>--}}
{{--                                </div>--}}
{{--                            </div>--}}
                            <div class="col-md-12 form-group">
{{--                                <input type="submit" value="Log In" class="btn btn-primary">--}}
                                <button type="submit" value="submit" class="button button-login w-100">Log In</button>
                                <a href="{{route('user.forgotPassword')}}">Forgot Password?</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--================End Login Box Area =================-->


@endsection

@push('script')
    <script>
        $('#login_form').validate({
            rules:{
                email:{
                    required: true,
                },
                password:{
                    required: true
                }
            },
            errorClass: 'help-inline',
            errorElement: 'span',
            highlight:function (element, errorClass, validClass) {
                $(element).parents('.form-group').addClass('error');
            },
            unhighlight:function (element, errorClass, validClass) {
                $(element).parents('.form-group').removeClass('error');
                $(element).parents('.form-group').addClass('success');
            }
        });
    </script>
@endpush
