/**
 * Created by Janko on 10. 08. 2016.
 */

$(document).ready(function () {

var name = $('#category_name').val();
$('#categoryForm').on('submit', function (e) {
    e.preventDefault();

    $.ajax({
        type: 'POST',
        url: '/categories/new',
        dataType: 'JSON',
        data: {
            _token: $('input[name=_token]').val(),
            category_name: $('input[name=category_name]').val()
        },
        success: function (response) {
            $('#category_msg').addClass('alert').addClass('alert-success').append(response['msg']);
            $('#categories').append(
                '<tr>'
                +'<td>' + response['category_id'] +'</td>'
                +'<td>'+ $('input[name=category_name]').val() + '</td>'
                +'</tr>'
            )
        }
    });
});


});