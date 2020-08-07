<div class="row">

    @if(!empty($errors))

        <div class="alert alert-block alert-danger">
            <button type="button" class="close" data-dismiss="alert">
                <i class="ace-icon fa fa-times"></i>
            </button>

            @foreach($errors as $error_arr)
                @foreach($error_arr as $error_item)
                    {{ $error_item  }}<br>
                @endforeach
            @endforeach

        </div>

    @endif

    @if(isset($success))
        <div class="alert alert-block alert-success">
            <button type="button" class="close" data-dismiss="alert">
                <i class="ace-icon fa fa-times"></i>
            </button>
            {{$success}}
        </div>
    @endif

</div>
