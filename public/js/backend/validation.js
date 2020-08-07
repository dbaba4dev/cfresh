$(function () {
    // $.validator.setDefaults({
    //     highlight: function (element) {
    //         $(element)
    //             .closest('.form-group')
    //             .addClass('has-error');
    //     },
    //     unhighlight: function (element) {
    //         $(element)
    //             .closest('.form-group')
    //             .removeClass('has-error');
    //     }
    // });
    $.validator.setDefaults({
        highlight: function(element) {

            $(element).closest('.form-group').addClass('has-error');
            $(element).addClass('is-invalid');

        },
        unhighlight: function(element) {

            $(element).closest('.form-group').removeClass('has-error');
            $(element).removeClass('is-invalid');

        },
        errorElement: 'span',
        errorClass: 'text-danger',
        errorPlacement: function(error, element) {
            if(element.parent('.input-group').length) {
                error.insertAfter(element.parent());
            } else {
                error.insertAfter(element);
            }
        }
    });
    $('#income_add').validate({
        rules:{
            type_income:{
                required: true
            },
            amount_income:{
                required: true,
            },
            collector_income:{
                required: true
            },
            description_income:{
                required: true
            },

        },
        messages: {
            type: {
                required: "Please select Income type from the list",
            },
            amount_income: {
                required: "Enter Income amount",
            },
            collector: {
                required: "Please select a collector from the list",
            },
            description: {
                required: "Please Enter Income descriptions",
            }
        }
    });

    $('#expense_add').validate({
        rules:{
            type:{
                required: true
            },
            amount:{
                required: true,
            },
            collector:{
                required: true
            },
            description:{
                required: true
            },

        },
        messages: {
            type: {
                required: "Please select Expensive type from the list",
            },
            amount: {
                required: "Enter Income amount",
            },
            collector: {
                required: "Please select a collector from the list",
            },
            description: {
                required: "Please Enter Income descriptions",
            }
        }
    });
});
