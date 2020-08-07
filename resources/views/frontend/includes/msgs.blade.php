{{--@if(Session::has('flash_msg_error'))--}}
{{--    <div class="alert alert-danger alert-block">--}}

{{--        <button type="button" class="close" data-dismiss="alert" aria-label="Close">--}}
{{--            <span aria-hidden="true">&times;</span>--}}
{{--        </button>--}}
{{--        <strong> {!! session('flash_msg_error') !!}</strong>--}}
{{--    </div>--}}
{{--@endif--}}
{{--@if(Session::has('flash_msg_success'))--}}
{{--    <div class="alert alert-success alert-block">--}}

{{--        <button type="button" class="close" data-dismiss="alert" aria-label="Close">--}}
{{--            <span aria-hidden="true">&times;</span>--}}
{{--        </button>--}}
{{--        <strong> {!! session('flash_msg_success') !!}</strong>--}}
{{--    </div>--}}
{{--@endif--}}
{{--<div class="row">--}}
    @if(Session::has('flash_msg_purple'))
        <div class="alert alert-purple alert-dismissable" style="max-height: 30px; margin-top: -2rem">
            <span class="glyphicon glyphicon-certificate"></span>
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            {!! session('flash_msg_purple') !!}
        </div>
    @endif
    @if(Session::has('flash_msg_info'))
        <div class="alert alert-info-alt alert-dismissable" style="max-height: 30px; margin-top: -2rem">
            <span class="glyphicon glyphicon-info-sign"></span>
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            {!! session('flash_msg_info') !!}
        </div>
    @endif
    @if(Session::has('flash_msg_error'))
        <div class="alert alert-danger-alt alert-dismissable" style="max-height: 30px; margin-top: -2rem">
            <span class="glyphicon glyphicon glyphicon-remove"></span>
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            {!! session('flash_msg_error') !!}
        </div>
    @endif
    @if(Session::has('flash_msg_warning'))
        <div class="alert alert-warning-alt alert-dismissable" style="max-height: 30px; margin-top: -2rem">
            <span class="glyphicon glyphicon-exclamation-sign"></span>
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            {!! session('flash_msg_warning') !!}
        </div>
    @endif
    @if(Session::has('flash_msg_success'))
        <div class="alert alert-success-alt alert-dismissable" style="max-height: 30px; margin-top: -2rem">
            <span class="glyphicon glyphicon glyphicon-ok"></span>
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            {!! session('flash_msg_success') !!}
        </div>
    @endif
{{--</div>--}}
