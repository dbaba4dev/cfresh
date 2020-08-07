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
                        <h3>Forgot Password</h3>
                        <div class="mx-5">@include('admin.includes.alert-msg')</div>
                        <form class="row login_form" action="{{route('user.forgotPassword')}}" method="post" id="forgotPassword_form" name="forgotPassword_form" >
                            @csrf

                            <div class="col-md-12 form-group">
                                <input type="email" class="form-control" id="email" name="email" placeholder="Email Address" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Email Address'">
                            </div>

                            <div class="col-md-12 form-group">
                                <button type="submit" value="submit" class="button button-login w-100">Submit</button>
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
