@if(Session::has('flash_msg_error'))
    <div class="alert alert-danger alert-block">

        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <strong> {!! session('flash_msg_error') !!}</strong>
    </div>
@endif
@if(Session::has('flash_msg_success'))
    <div class="alert alert-success alert-block">

        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <strong> {!! session('flash_msg_success') !!}</strong>
    </div>
@endif
