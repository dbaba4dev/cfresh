@extends('frontend.layouts.master')
{{--@section('klass','active')--}}

@section('styles')

@endsection

@section('page-header')

@endsection

@section('content')
    <section class="checkout_area section-margin--small">
        <div class="container">
            <div class="returning_customer">
                <div class="check_title">
                    <h2>Update Password</h2>
                </div>
                <br>
                <form action="{{route('user.update.password' )}}" method="post" name="passwordFrom" id="passwordFrom" novalidate>
                    @csrf
                    <div class="row">
                        <div class="col-md-4 form-group p_star">
                            <input type="password"  class="form-control" placeholder="Current Password" onfocus="this.placeholder=''" onblur="this.placeholder = 'Current Password'" id="current_password" name="current_password">
                            <span id="chkPwd"></span>
                        </div>
                        <div class="col-md-4 form-group p_star">
                            <input type="password" class="form-control" placeholder="New Password" onfocus="this.placeholder=''" onblur="this.placeholder = 'New Password'" id="new_password" name="new_password">
                            <span class="placeholder" data-placeholder="Password"></span>
                        </div>
                        <div class="col-md-4 form-group p_star">
                            <input type="password" class="form-control" placeholder="Confirm Password" onfocus="this.placeholder=''" onblur="this.placeholder = 'Confirm Password'" id="confirm_password" name="confirm_password">
                            <span class="placeholder" data-placeholder="Password"></span>
                        </div>
                    </div>

                    <div class="col-md-12 form-group">
                        <button type="submit" value="submit" class="button button-login">login</button>
                        <div class="creat_account">
                            <input type="checkbox" id="f-option" name="selector">
                            <label for="f-option">Remember me</label>
                        </div>
                        <a class="lost_pass" href="#">Lost your password?</a>
                    </div>
                </form>
            </div>
            <div class="cupon_area">
                <div class="check_title">
                    <h2>Update Account</h2>
                </div>
{{--                <input type="text" placeholder="Enter coupon code">--}}
{{--                <a class="button button-coupon" href="#">Apply Coupon</a>--}}
            </div>
            <div class="billing_details">
                <div class="row">
                    <div class="col-lg-2">
                    </div>
                    <div class="col-lg-8">
{{--                        <h3>Billing Details</h3>--}}
                        @include('admin.includes.errors')
                        <form action="{{route('user.account' )}}" method="post" name="accountForm" id="accountForm">
                            @csrf
                            <div class="col-md-12 form-group">
                                <input type="text" class="form-control form-control-sm" id="name" name="name" value="{{$user->name}}" placeholder="Full Name" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Full Name'">
                            </div>
                            <div class="row mx-0" >
                                <div class="col-md-6 form-group p_star">
                                    <select class="chosen form-control" name="state_id" id="state" data-placeholder="Select a State...">
                                        <option value=""></option>
                                        @foreach($states as $state)
                                            <option value="{{$state->id}}"
                                                @if($user->state_id == $state->id)
                                                    selected
                                                @endif
                                            >{{$state->name}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-6 form-group" style="margin-top: 0rem">
                                    <select name="lga_id" id="lga" class=" form-control form-control-sm" >
                                        <option id="opt">  - - - - - - - - - -  Local Government Area - - - - - - - - - -  </option>
                                        @if(!empty(\App\State::where('id',$user->state_id)->first()->lgas))
                                            @foreach(\App\State::where('id',$user->state_id)->first()->lgas as $lga)
                                                    <option value="{{$lga->id}}"
                                                        @if($user->lga_id == $lga->id)
                                                         selected
                                                        @endif
                                                    >{{$lga->name}}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12 form-group">
                                <input type="text" class="form-control form-control-sm" id="address" name="address" value="{{$user->address}}" placeholder="Address" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Address'">
                            </div>

                            <div class="col-md-12 form-group">
                                <input type="text" class="form-control form-control-sm" id="pincode" name="pincode" value="{{$user->pincode}}" placeholder="Pincode" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Pincode'">
                            </div>

                            <div class="col-md-12 form-group">
                                <input type="text" class="form-control form-control-sm" id="mobile" name="mobile" value="{{$user->mobile}}" placeholder="Mobile" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Mobile'">
                            </div>
                            <div class="col-md-12 form-group">
                                <button type="submit" class="button button-tracking">Update</button>
                            </div>
                        </form>
                    </div>
                    <div class="col-lg-2">
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('script')
    <script>
        // jQuery(document).ready(function(){
            jQuery(".chosen").chosen();
        // });
    </script>
    <script>

        //Check Current Password
        $('#current_password').keyup(function () {
            var current_pwd = $(this).val();
            // alert(current_pwd);
            $.ajax({
                headers:{
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type:'post',
                url: '/check-password',
                data: {current_password:current_pwd},
                success: function (resp) {
                    if(resp == 'false')
                    {
                        $('#chkPwd').html("<font color='#8b0000'>Current Password is incorrect</font>");
                    }else if(resp == 'true')
                    {
                        $('#chkPwd').html("<font color='#006400'> Current Password is correct</font>");
                    }
                },
                error: function (resp) {
                    alert('Error');
                }
            })
        });
    </script>

    <script>
            jQuery(document).ready(function ()
            {
                jQuery('select[name="state_id"]').on('change',function(){
                    var stateID = jQuery(this).val();
                    if(stateID)
                    {
                        jQuery.ajax({
                            url : 'state/' +stateID,
                            type : "GET",
                            dataType : "json",
                            success:function(data)
                            {

                                jQuery('select[name="lga_id"]').empty();

                                var res='';

                                jQuery.each(data, function(key,value){
                                    // $('p').empty();
                                    res += '<option value="'+ key +'">'+ value +'</option>';
                                    $('select[name="lga_id"]').append('<option value="'+ key +'">'+ value +'</option>');
                                    // $('p').append(res);
                                });
                                console.log(res);

                            }
                        });
                    }
                    else
                    {
                        $('select[name="lga_id"]').empty();
                    }
                });
            });


            $('#passwordFrom').validate({
                rules:{
                    current_password:{
                        required: true,
                        minlength: 6,
                        maxlength: 20
                    },
                    new_password:{
                        required: true,
                        minlength: 6,
                        maxlength: 20
                    },
                    confirm_password:{
                        required: true,
                        minlength: 6,
                        maxlength: 20,
                        equalTo: '#new_password'
                    },
                    email:{
                        required: true,
                    }
                },

                errorClass: 'help-inline',
                errorElement: 'span',
                highlight:function (element, errorClass, validClass) {
                    $(element).parents('.form-control').addClass('error');
                },
                unhighlight:function (element, errorClass, validClass) {
                    $(element).parents('.form-control').removeClass('error');
                    $(element).parents('.form-control').addClass('success');
                }
            });
    </script>
@endpush
