/**
 * Created by Janko on 28. 08. 2016.
 */
$(document).ready(function () {
    $("#post_code").on('change', '', function (element) {
        var postalCode = $('option:selected', this).val();
        // for development only
        console.log(postalCode);

        $.get('/files/get-postal-codes', function (postalCodes) {
            var codes = postalCodes;
            var result = $.grep(codes, function (item) {
                return item.postal_code == postalCode
            });
            // for development only
            console.log(result);
            $('#city_input').val(result[0].city);
            $('#country').val('Slovenija');

        });

    });

});