@extends('frontend.layouts.master')
{{--@section('klass','active')--}}

@section('styles')

@endsection

@section('page-header')

@endsection

@section('content')

    <!-- ================ start banner area ================= -->
{{--    <section class="blog-banner-area" id="category">--}}
{{--        <div class="container h-100">--}}
{{--            <div class="blog-banner">--}}
{{--                <div class="text-center">--}}
{{--                    <h1>Register</h1>--}}
{{--                    <nav aria-label="breadcrumb" class="banner-breadcrumb">--}}
{{--                        <ol class="breadcrumb">--}}
{{--                            <li class="breadcrumb-item"><a href="#">Home</a></li>--}}
{{--                            <li class="breadcrumb-item active" aria-current="page">Register</li>--}}
{{--                        </ol>--}}
{{--                    </nav>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </section>--}}
    <!-- ================ end banner area ================= -->

    <!--================Login Box Area =================-->
    <section class="login_box_area section-margin" style="margin-top: 1rem">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="login_box_img">
                        <div class="hover">
                            <h4>Already have an account?</h4>
                            <p>There are advances being made in science and technology everyday, and a good example of this is the</p>
                            <a class="button button-account" href="{{route('user.login')}}">Login Now</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="login_form_inner register_form_inner">
                        <h3>Create an account</h3>
                        <form class="row login_form" action="{{route('user.register')}}" method="post" id="register_form" novalidate>
                            @csrf
                            <div class="col-md-12 form-group">
                                <input type="text" class="form-control" id="name" name="name" placeholder="Full Name" required onfocus="this.placeholder = ''" onblur="this.placeholder = 'Username'">
                            </div>
                            <div class="col-md-12 form-group">
                                <input type="email" class="form-control" id="email" name="email" placeholder="Email Address" required onfocus="this.placeholder = ''" onblur="this.placeholder = 'Email Address'">
                            </div>
                            <div class="col-md-12 form-group">
                                <input type="password" class="form-control" id="password" name="password" placeholder="Password" required onfocus="this.placeholder = ''" onblur="this.placeholder = 'Password'">
                            </div>
                            <div class="col-md-12 form-group">
                                <input type="password" class="form-control" id="confirmPassword" name="confirmPassword" required placeholder="Confirm Password" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Confirm Password'">
                            </div>
                            <div class="col-md-12 form-group">
                                <div class="creat_account">
                                    <input type="checkbox" id="f-option2" name="selector">
                                    <label for="f-option2">Keep me logged in</label>
                                </div>
                            </div>
                            <div class="col-md-12 form-group">
                                <button type="submit" value="submit" class="button button-register w-100">Register</button>
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
        $('#register_form').validate({
            rules:{
                name:{
                    required: true,
                    minlength: 3,
                    maxlength: 20
                },
                email:{
                    required: true,
                },
                password:{
                    required: true,
                    minlength: 6,
                    maxlength: 20
                },
                confirmPassword:{
                    required: true,
                    minlength: 6,
                    maxlength: 20,
                    equalTo: '#password'
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
