@extends('admin.layouts.master')
{{--@section('klass','active')--}}

@section('styles')
<!-- DataTables -->
<link rel="stylesheet" href="{{asset('css/dataTables.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{asset('css/responsive.bootstrap4.min.css')}}">
@endsection

@section('page-header')
<div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1><i class="fa fa-boxes"></i> Cases </h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#"><i class="fa fa-tachometer-alt"></i> Home </a> - </li>
                <li><a href="#">Products </i> </a> - </li>
                <li class="active"> New Case</li>
            </ol>
        </div>
    </div>
</div><!-- /.container-fluid -->

<hr style="border: solid 0.5px #a3a3a3">
@endsection


@section('content')
<section class="content">

   <div class="row">
       <div class="col-md-3"></div>
       <div class="col-md-6">
           @include('admin.includes.errors')
           <form action="{{route('case.store')}}" method="post" enctype="multipart/form-data">
               {{csrf_field()}}

               <div class="card card-info">

                   <div class="card-header">
                       <h3 class="card-title"><i class="fa fa-boxes"></i> New Case</h3>

                       <div class="card-tools">
                           <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                           <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-remove"></i></button>
                       </div>
                   </div>
                   <!-- /.card-header -->

                   <div class="card-body">
                       <div class="row">
                           <div class="col-sm-4">
                               <div class="form-group">
                                   <label class="text-xs">
                                       Case Name
                                   </label>
                                   <input class="form-control form-control-sm" id="case" name="case" required  type="text">
                               </div>
                           </div>
                           <div class="col-sm-4">
                               <div class="form-group">
                                   <label class="text-xs">
                                       Price (&#8358) per Case
                                   </label>
                                   <input class="form-control form-control-sm" id="price" name="price" required  type="number">
                               </div>
                           </div>
                           <!-- /.col -->
                           <div class="col-sm-4">
                               <div class="form-group">
                                   <label class="text-xs">
                                       <span  id="material">Preform Weight (g) </span>
{{--                                       <span style="color: cadetblue"><em >(average)</em></span>--}}
                                   </label>
                                   <input class="form-control form-control-sm" id="preform_g" name="preform_g" required  type="text">
                               </div>

                           </div>


                       </div>
                       <div class="row">
                           <div class="col-sm-6 ">
                               <div class="form-group">
                                   <label class="text-xs" id="lbl_cap">
                                       Cap Weight (g)
                                   </label>
                                   <input class="form-control form-control-sm" id="cap_g" name="cap_g" required  type="text">
{{--                                   <input class="form-control form-control-sm" id="cap_no" name="cap_no" required  type="number" >--}}
{{--                                   <div class="form-group">--}}
{{--                                       <label for="lblcap_pieces" class="text-xs"><input type="radio" name="cap_chk" id="lblcap_pieces" value="pieces"> Pieces</label> &nbsp;--}}
{{--                                       <label for="lblcap_kg" class="text-xs"><input type="radio" checked name="cap_chk" id="lblcap_kg" value="kg"> Weight (g)</label>--}}
{{--                                   </div>--}}
                               </div>
                           </div>
                           <div class="col-sm-6">
                               <div class="form-group">
                                   <label class="text-xs" id="lbl_label">
                                       Label Weight (g)
                                   </label>
                                   <input class="form-control form-control-sm" id="label_g" name="label_g" required  type="text">
{{--                                   <input class="form-control form-control-sm" id="label_no" name="label_no" required  type="number" >--}}
{{--                                   <div class="form-group">--}}
{{--                                       <label for="lblLabel_pieces" class="text-xs"><input type="radio" name="label_chk" id="lblLabel_pieces" value="pieces"> Pieces</label> &nbsp;--}}
{{--                                       <label for="lblLabel_kg" class="text-xs"><input type="radio" checked  name="label_chk" id="lblLabel_kg" value="kg"> Weight (g)</label>--}}
{{--                                   </div>--}}
                               </div>
                           </div>
                       </div>
                       <div class="form-group row">
                           <label class="text-xs">
                              Description
                           </label>
                           <textarea name="description" id="description" class="form-control" rows="2" placeholder="Description . . ."></textarea>

                       </div>
                       <div class="form-group row">
                           <label for="action" class="col-sm-3 col-form-label text-left text-xs">File upload input</label>
                           <div class="col-sm-9 uploader" id="uniform-undefined">
                               <input type="file"  id="image" name="image" class="form-control-file">
{{--                           <label for="action" class="text-xs">File upload input </label>--}}
{{--                           <div class="uploader" id="uniform-undefined">--}}
{{--                               <input type="file"  id="image" name="image" class="form-control-file">--}}
{{--                           </div>--}}
                       </div>
                       <!-- /.row -->

                   </div>
                   <!-- /.card-body -->
                   <div class="card-footer text-center">
                       <button class="btn btn-outline-info btn-sm" id="btn-add" type="submit" value="add">
                           Add Case
                       </button>
                   </div>
               </div>
           </form>
       </div>
       <div class="col-md-3"></div>
   </div>

</section>
@endsection

@section('scripts')
<!-- DataTables -->
<script src="{{asset('js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('js/responsive.bootstrap4.min.js')}}"></script>

<script>
    $(function () {
        $("#users_list").DataTable({
            "responsive": true,
            "autoWidth": false,
        });

    })
</script>

<script src="{{asset('js/scripts.js')}}"></script>
<script>
    // $(function () {
    //     $('#cap_no').hide();
    //     $('#label_no').hide();
    // });
    //
    // $('input:radio[name="cap_chk"]').change(function(){
    //
    //     if($(this).val() == 'pieces')
    //     {
    //         // alert('No. of Caps');
    //         $('#lbl_cap').text('No. of Caps per Bag');
    //         $('#cap_no').show();
    //         $('#cap_no').val(5000);
    //         $('#cap_g').hide().attr('disabled', 'disabled');
    //     }else
    //     {
    //         $('#lbl_cap').text('Cap Weight (g)');
    //         $('#cap_no').hide().attr('disabled', 'disabled');
    //         $('#cap_g').show().attr('disabled', false);
    //     }
    //
    // });

    // $('input:radio[name="label_chk"]').change(function(){
    //
    //     if($(this).val() == 'pieces')
    //     {
    //         // alert('No. of Caps');
    //         $('#lbl_label').text('No. of Labels per Bag');
    //         $('#label_no').show();
    //         $('#label_no').val(5000);
    //         $('#label_g').hide().attr('disabled', 'disabled');
    //     }else
    //     {
    //         $('#lbl_label').text('Label Weight (g)');
    //         $('#label_no').hide().attr('disabled', 'disabled');
    //         $('#label_g').show().removeAttr('disabled');
    //     }

    // });
</script>
@endsection
