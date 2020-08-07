@if(count($errors)>0)
    <ul class="list-group">
        @foreach($errors->all() as $error)
            <li class="alert alert-danger alert-block">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                {{$error}}
            </li>
{{--            <li class="list-group-item text-danger">--}}
{{--                {{$error}}--}}
{{--            </li>--}}
        @endforeach
    </ul>
@endif

{{--@if (count($errors)>0)--}}
{{--    <div class="alert alert-danger">--}}
{{--        <ul>--}}
{{--            @foreach ($errors->all() as $error)--}}
{{--                <li>{{ $error }}</li>--}}
{{--            @endforeach--}}
{{--        </ul>--}}
{{--    </div>--}}
{{--@endif--}}
