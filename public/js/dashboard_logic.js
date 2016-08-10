/**
 * Created by Janko on 10. 08. 2016.
 */

$(document).ready(function () {
// add new category
$('#categoryForm').on('submit', function (e) {
    e.preventDefault();

    var data ={
            _token: $('input[name=_token]').val(),
            category_name: $('input[name=category_name]').val()
        };

    $.ajax({
        type: 'POST',
        url: '/categories/new',
        dataType: 'JSON',
        data: data,
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