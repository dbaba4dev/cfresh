
$(document).ready(function() {

    /*Add User Script*/
    $("#frmAddUser").on('submit', function (e) {
        e.preventDefault();

        $.ajax({
            method: "POST",
            url: 'user-admin/add',
            data: $(this).serialize(),
            dataType: 'json',
            success: function (data) {
                var html = '';
                if (data.errors) {
                    html = '<div class="alert alert-danger">';
                    for (var count = 0; count < data.errors.length; count++) {
                        html += '<p>' + data.errors[count] + '</p>';
                    }
                    html += '</div>';
                }
                if (data.success) {
                    html = '<div class="alert alert-success">' + data.success + '</div>';
                    $('#frmAddUser')[0].reset();
                    $('#users_list').DataTable().ajax.reload();
                    location.reload();
                }
                $('#notification').html(html);
            }

        });
        location.reload();
    });

    /*Add Employee Category Script*/
    $("#frmAddCategory").on('submit', function (e) {
        e.preventDefault();

        $.ajax({
            type: "POST",
            url: 'category/store',
            data: $('#frmAddCategory').serialize(),
            success: function (data) {
                $('#moveMaterialModal').modal('hide');
                // console.log(data)
                location.reload();
            },
            error:function (data) {
                // var errors = jQuery.parseJSON(request.responseText);
                html = '<div class="alert alert-danger">';
                for (var count = 0; count < data.errors.length; count++) {
                    html += '<p>' + data.errors[count] + '</p>';
                }
                html += '</div>';
            }
        });
    });

    /*Edit Employee Category Script*/
    $(".editbtn").on('click', function () {
       $('#editCategoryModal').modal('show');

       $tr = $(this).closest('tr');

        var data = $tr.children("td").map(function () {
            return $(this).text();
        }).get();

        var id = $(this).attr('id');
        $('#id').val(id);

       $('#cat_name').val(data[0]);
       $type = $('#payment_id').val(data[1]);
       $not_comm = $('#salary_amount').val(data[2]);
        if (data[2] == "")
        {
            $('#salary_amount').removeAttr('required');
            $('#amount_box2').attr('hidden',true);
        }else
        {
            $('#salary_amount').attr('required',true);
            $('#amount_box2').attr('hidden',false);
        }

    });

    $('#frmEditCategoryID').on('submit', function (e) {
        e.preventDefault();

       var id = $('.id').val();


        $.ajax({
            type: "POST",
            url: "category/update/"+id,
            data: $('#frmEditCategoryID').serialize(),
            success: function (response) {
                console.log(response);
                // var response = jQuery.parseJSON(data);
                $(".notification").css("display","block").addClass('alert alert-success').delay(4000).slideUp(300).html(response.success)
                console.log(response);
                $('#addCategoryModal').modal('hide');
                // alert("Data Saved")
                location.reload();
            },
            // error: function (request, error) {
            //     console.log(request);
                // var errors = jQuery.parseJSON(request.responseText);
                // var ul = document.createElement('ul');
                //
                // $.each(errors, function (key, value) {
                //     var li = document.createElement('li');
                //     li.appendChild(document.createTextNode(value));
                //     ul.appendChild(li)
                // });
                //
                // $(".notification").css("display","block").removeClass('success').addClass('alert alert-danger').delay(6000).slideUp(300).html(ul);
            // }

        });
    });

    /*Add Payments Category Script*/
    $("#frmAddPayType").on('submit', function (e) {
        e.preventDefault();

        $.ajax({
            type: "POST",
            url: 'payment/store',
            data: $('#frmAddPayType').serialize(),
            success: function (data) {
                $('#addPayTypeModal').modal('hide');
                location.reload();
            },
            error:function (data) {
                // var errors = jQuery.parseJSON(request.responseText);
                html = '<div class="alert alert-danger">';
                for (var count = 0; count < data.errors.length; count++) {
                    html += '<p>' + data.errors[count] + '</p>';
                }
                html += '</div>';
            }
        });
    });

    /*Edit Payment Category Script*/
    $(".editbtn").on('click', function () {
        $('#editPayTypeModal').modal('show');

        $tr = $(this).closest('tr');

        var data = $tr.children("td").map(function () {
            return $(this).text();
        }).get();

        var id = $(this).attr('id');
        $('#id').val(id);

        $('#epay_type').val(data[1]);

    });

    $('#frmEditPayTypeID').on('submit', function (e) {
        e.preventDefault();

        var id = $('.id').val();


        $.ajax({
            type: "POST",
            url: "payment/update/"+id,
            data: $('#frmEditPayTypeID').serialize(),
            success: function (response) {
                console.log(response);
                // var response = jQuery.parseJSON(data);
                $(".notification").css("display","block").addClass('alert alert-success').delay(4000).slideUp(300).html(response.success)
                console.log(response);
                $('#addCategoryModal').modal('hide');
                // alert("Data Saved")
                location.reload();
            },
            // error: function (request, error) {
            //     console.log(request);
            // var errors = jQuery.parseJSON(request.responseText);
            // var ul = document.createElement('ul');
            //
            // $.each(errors, function (key, value) {
            //     var li = document.createElement('li');
            //     li.appendChild(document.createTextNode(value));
            //     ul.appendChild(li)
            // });
            //
            // $(".notification").css("display","block").removeClass('success').addClass('alert alert-danger').delay(6000).slideUp(300).html(ul);
            // }

        });
    });



    /*Add Customer Category Script*/
    $("#frmAddCustomerCategory").on('submit', function (e) {
        e.preventDefault();

        $.ajax({
            type: "POST",
            url: '/customers/category/store',
            data: $('#frmAddCustomerCategory').serialize(),
            dataType: 'json',
            success: function (data) {
                var html = '';
                if (data.errors) {
                    html = '<div class="alert alert-danger">';
                    for (var count = 0; count < data.errors.length; count++) {
                        html += '<p>' + data.errors[count] + '</p>';
                    }
                    html += '</div>';
                }
                if (data.success) {
                    html = '<div class="alert alert-success">' + data.success + '</div>';
                    $('#frmAddCustomerCategory')[0].reset();
                    $('#users_list').DataTable().ajax.reload();
                }
                $('#notification').html(html);
            }

        });

        location.reload();

    });

    /*Edit Customer Category Script*/
    $(".editbtn").on('click', function () {
        $('#editCustomerCategoryModal').modal('show');

        $tr = $(this).closest('tr');

        var data = $tr.children("td").map(function () {
            return $(this).text();
        }).get();

        console.log(data);


        var id = $(this).attr('id');
        $('#id').val(id);

        $('#cname').val(data[0]);
        $('#edit_discount').val(data[1]);

    });

    $('#frmEditCustomerCategoryID').on('submit', function (e) {
        e.preventDefault();

        var id = $('.id').val();

        $.ajax({
            type: "POST",
            url: "category/update/"+id,
            data: $('#frmEditCustomerCategoryID').serialize(),
            success: function (response) {
                console.log(response);
                // var response = jQuery.parseJSON(data);
                $(".notification").css("display","block").addClass('alert alert-success').delay(4000).slideUp(300).html(response.success)
                console.log(response);
                $('#editCustomerCategoryModal').modal('hide');
                // alert("Data Saved")
                location.reload();
            },
            // error: function (request, error) {
            //     console.log(request);
            // var errors = jQuery.parseJSON(request.responseText);
            // var ul = document.createElement('ul');
            //
            // $.each(errors, function (key, value) {
            //     var li = document.createElement('li');
            //     li.appendChild(document.createTextNode(value));
            //     ul.appendChild(li)
            // });
            //
            // $(".notification").css("display","block").removeClass('success').addClass('alert alert-danger').delay(6000).slideUp(300).html(ul);
            // }

        });
    });


    /*Add Customer Location Script*/
    $("#frmAddLocation").on('submit', function (e) {
        e.preventDefault();

        $.ajax({
            type: "POST",
            url: '/customers/areas/store',
            data: $('#frmAddLocation').serialize(),
            dataType: 'json',
            success: function (data) {
                var html = '';
                if (data.errors) {
                    html = '<div class="alert alert-danger">';
                    for (var count = 0; count < data.errors.length; count++) {
                        html += '<p>' + data.errors[count] + '</p>';
                    }
                    html += '</div>';
                }
                if (data.success) {
                    html = '<div class="alert alert-success">' + data.success + '</div>';
                    $('#frmAddLocation')[0].reset();
                    $('#users_list').DataTable().ajax.reload();
                }
                $('#notification').html(html);
            }

        });






    });

    /*Edit Customer Location Script*/
    $(".editbtn").on('click', function () {
        $('#editLocationModal').modal('show');

        $tr = $(this).closest('tr');

        var data = $tr.children("td").map(function () {
            return $(this).text();
        }).get();

        var id = $(this).attr('id');
        $('#id').val(id);

        $('#name').val(data[0]);

    });

    $('#frmEditLocationID').on('submit', function (e) {
        e.preventDefault();

        var id = $('.id').val();

        $.ajax({
            type: "POST",
            url: "/customers/areas/update/"+id,
            data: $('#frmEditLocationID').serialize(),
            success: function (response) {
                console.log(response);
                // var response = jQuery.parseJSON(data);
                $(".notification").css("display","block").addClass('alert alert-success').delay(4000).slideUp(300).html(response.success)
                console.log(response);
                $('#editLocationModal').modal('hide');
                // alert("Data Saved")
                location.reload();
            },
            error: function (request, error) {
                console.log(request);
            var errors = jQuery.parseJSON(request.responseText);
            var ul = document.createElement('ul');

            $.each(errors, function (key, value) {
                var li = document.createElement('li');
                li.appendChild(document.createTextNode(value));
                ul.appendChild(li)
            });

            $(".notification").css("display","block").removeClass('success').addClass('alert alert-danger').delay(6000).slideUp(300).html(ul);
            }

        });
    });

    /*Edit Move Materia Script*/
    $(".moveMaterialbtn").on('click', function () {
        $('#moveMaterialModal').modal('show');

        $tr = $(this).closest('tr');

        var data = $tr.children("td").map(function () {
            return $(this).text();
        }).get();

        var id = $(this).attr('id');
        var $mat_id = $(this).data('mat');

        console.log(data);
        console.log($mat_id);

        // if ($mat_id==1)
        // {
        //     $('#lblcaps_no').text('Number of Bags');
        //     $('#bags').attr('hidden',false);
        //     $('#no_materials').attr('hidden',true)
        // }
        // if ($mat_id==2)
        // {
        //     $('#lblcaps_no').text('Number of Caps');
        //     $('#bags').attr('hidden',true);
        //     $('#no_material').removeAttr('hidden')
        // }
        // if ($mat_id==3)
        // {
        //     $('#lblcaps_no').text('Number of Labels');
        //     $('#bags').attr('hidden',true);
        //     $('#no_material').removeAttr('hidden')
        // }


        $('#id').val(id);

        $('#bags').val(data[1]);
        $('#total_bags').val(data[1]);
        $('#no_material').val(data[2]);
        $('#tot_material').val(data[3]);
        $('#total_kg').val(data[4]);
        $('#unit_weight').val(data[5]);
        $('#material_id').val($mat_id);
    });

    $('#frmmoveMaterial').on('submit', function (e) {
        e.preventDefault();
        // var token = $(this).data('token');
        var id = $('.id').val();
        console.log('id = ' + id);

        $.ajax({
            type: "POST",
            url: "stock/move/"+id,
            data: $('#frmmoveMaterial').serialize(),

            success: function (data) {
                // console.log(data);
                // var response = jQuery.parseJSON(data);
                // $(".notification").css("display","block").addClass('alert alert-success')
                //     .delay(4000).slideUp(300).html(response.success);
                // console.log(response);
                $('#moveMaterialModal').modal('hide');
                // alert("Data Saved")
                location.reload();
            },
            // error:function (request, error) {
            //     var errors = jQuery.parseJSON(request.responseText);
            //     var ul = document.createElement('ul');
            //
            //     $.each(errors, function (key, value) {
            //         var li = document.createElement('li');
            //         li.appendChild(document.createTextNode(value));
            //         ul.appendChild(li);
            //     });
            //
            //     $(".notification").css("display","block").removeClass('success').addClass('alert alert-danger').delay(6000).slideUp(300).html(ul);
            // }

        });
    });


/*-------------------------------Add Material Script-------------------------------*/
    $("#frmAddMaterial").on('submit', function (e) {
        e.preventDefault();

        $.ajax({
            type: "POST",
            url: 'material/store',
            data: $('#frmAddMaterial').serialize(),
            dataType: 'json',
            success: function (data) {
                var html = '';
                if (data.errors) {
                    html = '<div class="alert alert-danger">';
                    for (var count = 0; count < data.errors.length; count++) {
                        html += '<p>' + data.errors[count] + '</p>';
                    }
                    html += '</div>';
                }
                if (data.success) {
                    html = '<div class="alert alert-success">' + data.success + '</div>';
                    $('#frmAddMaterial')[0].reset();
                    $('#users_list').DataTable().ajax.reload();

                }
                // $('#notification').html(html);addBatchDetailModal1
            }


        });


        // location.reload();

    });

    /*Edit Material Script*/
    $(".editMaterialbtn").on('click', function () {
        $('#editMaterialModal').modal('show');

        $tr = $(this).closest('tr');

        var data = $tr.children("td").map(function () {
            return $(this).text();
        }).get();

        var id = $(this).attr('id');
        $('#id').val(id);

        $('#mat_name').val(data[0]);
console.log('name =  '+data[0]);
    });

    $('#frmEditMaterialID').on('submit', function (e) {
        e.preventDefault();

        var id = $('.id').val();

        $.ajax({
            type: "POST",
            url: "material/update/"+id,
            data: $('#frmEditMaterialID').serialize(),
            success: function (response) {
                console.log(response);
                // var response = jQuery.parseJSON(data);
                $(".notification").css("display","block").addClass('alert alert-success').delay(4000).slideUp(300).html(response.success)
                console.log(response);
                $('#addMaterialModal').modal('hide');
                // alert("Data Saved")
                location.reload();
            }

        });
    })

/*------------------------------END Material Script-------------------------------*/

/*-------------------------------Add Case Script-------------------------------*/
    $("#frmAddCase").on('submit', function (e) {
        e.preventDefault();

        $.ajax({
            type: "POST",
            url: 'case/store',
            data: $('#frmAddCase').serialize(),
            dataType: 'json',
            success: function (data) {
                var html = '';
                if (data.errors) {
                    html = '<div class="alert alert-danger">';
                    for (var count = 0; count < data.errors.length; count++) {
                        html += '<p>' + data.errors[count] + '</p>';
                    }
                    html += '</div>';
                }
                if (data.success) {
                    html = '<div class="alert alert-success">' + data.success + '</div>';
                    $('#frmAddMaterial')[0].reset();
                    $('#users_list').DataTable().ajax.reload();

                }
                // $('#notification').html(html);
            }


        });


        location.reload();

    });

    /*Edit Case Script*/
    $(".editCasebtn").on('click', function () {
        $('#editCaseModal').modal('show');

        $tr = $(this).closest('tr');

        var data = $tr.children("td").map(function () {
            return $(this).text();
        }).get();

        // console.log(data);

        var id = $(this).attr('id');
        $('#id').val(id);

        $('#name').val(data[0]);
        $('#preformg').val(data[1]);
        $('#capg').val(data[2]);
        $('#labelg').val(data[3]);
    });

    $('#frmEditCaseID').on('submit', function (e) {
        e.preventDefault();

        var id = $('.id').val();

        $.ajax({
            type: "POST",
            url: "case/update/"+id,
            data: $('#frmEditCaseID').serialize(),
            success: function (response) {
                console.log(response);
                // var response = jQuery.parseJSON(data);
                $(".notification").css("display","block").addClass('alert alert-success').delay(4000).slideUp(300).html(response.success);
                console.log(response);
                $('#addCaseModal').modal('hide');
                // alert("Data Saved")
                location.reload();
            }

        });
    });

/*------------------------------END Case Script-------------------------------*/

});

/*function addUserForm() {
    $(document).ready(function() {
        $("#add-error-bag").hide();
        $('#addUserModal').modal('show');
    });
}*/

