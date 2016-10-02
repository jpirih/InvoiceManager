$(document).ready(function () {
    var newForeignCompany = $('#newForeignCompany');
    var editForeignCompany = $('#editForeignCompany');

    editForeignCompany.hide();

    // edit foreign company data
    $('.edit').on('click', function () {
        var id = $(this).attr('id');
        console.log(typeof(id));

        newForeignCompany.hide();
        editForeignCompany.show();
        var url = '/companies/foreign-companies/'+ id + '/edit';

        // set form action for submiting the form
        $('#editForm').attr('action', url);
        // get the current fc data from database and fill the form with them
        $.ajax({
            type: 'GET',
            url: url,
            dataType: 'JSON',
            success: function (response) {
                var company = response;
                console.log(company);

                // fill the form with current data
                $('#fc_edit_name').val(company.name);
                $('#fc_edit_url').val(company.url);
                $('#fc_edit_logo_url'). val(company.logo);
            }
        });

    });

    $('#cancel').click(function () {
        editForeignCompany.hide();
        newForeignCompany.show();
    });
});