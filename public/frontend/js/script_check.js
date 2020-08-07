Stripe.setPublishableKey('pk_test_51Gz0HoGKhf8mevfRVOCoGoYHMjgPuXafGWyQEUfuSmIdEdrmqjOqteSZiYFEzVKHcvrhNqKMfG1MGPoPbDsuDX3300R0MGhJu5');

var form = $('#form_checkout');

$from.submit(function (event) {
    $('#charge-error').addClass('hidden');
    $form.find('button').prop('disabled', true);
    Stripe.card.createToken({
        name: $('#card-name').val(),
        number: $('#card-number').val(),
        cvc: $('#card-cvc').val(),
        exp_month: $('#card-expiry-month').val(),
        exp_year: $('#card-expiry-year').val()
    }, stripeResponseHandler);
    return false;
});

function stripeResponseHandler(status, response) {
    if(response.error){
        $('#charge-error').removeClass('hidden');
        $('#charge-error').text(response.error.message);
        alert(response.error.message);
        $form.find('button').prop('disabled', false);
    }else
    {
        var token = response.id;
        // Insert the token into the form so it gets submitted to the server:
        $form.append($('<input type="hidden" name="stripeToken" />').val(token));

        // Submit the form:
        $form.get(0).submit();
    }

}

