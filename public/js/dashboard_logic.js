/**
 * Created by Janko on 10. 08. 2016.
 */

$(document).ready(function () {
// add new category
$('#categoryForm').on('submit', function (e) {
    e.preventDefault();

    var name = $('input[name=category_name]').val();
    var token = $('input[name=_token]').val();
    var categoryMsg = $('#category_msg');
    var categories = $('#categories');
    var error = 'Obvezno vpiši naziv kategorije';

    if(name == '' || name == ' '){
        categoryMsg.empty();
        categoryMsg.addClass('alert').addClass('alert-danger').append(error);

    }else{
        categoryMsg.empty();
        categoryMsg.removeClass('alert');
        categoryMsg.removeClass('alert-danger');
        var data = {
            _token: token,
            category_name: name
        };

        $.ajax({
            type: 'POST',
            url: '/categories/new',
            dataType: 'JSON',
            data: data,
            success: function (response) {
                categoryMsg.empty();
                categoryMsg.addClass('alert').addClass('alert-success').append(response['msg']);
                categories.append(
                    '<tr>'
                    +'<td>' + response['category_id'] +'</td>'
                    +'<td>'+ name + '</td>'
                    +'</tr>'
                )
            }
        });
    }
});

// add payment instrument
    $('#payInstrumentForm').on('submit', function (element) {
        element.preventDefault();

        var instrumentName = $('input[name=instrument_name]').val();
        var token = $('input[name=_token]').val();
        var error = "Obvezno vnesi naziv Plačilnega sredstva";
        var payInstrumentMsg = $('#pay_instrument_msg');
        var instruments = $('#instruments');

        if(instrumentName == '' || instrumentName == ' '){
            payInstrumentMsg.empty();
            payInstrumentMsg.addClass('alert').addClass('alert-danger').append(error);
        }else{
            payInstrumentMsg.empty();
            payInstrumentMsg.removeClass('alert');
            payInstrumentMsg.removeClass('alert-danger');
            var data = {
                _token: token,
                instrument_name: instrumentName
            };

            $.ajax({
                type: 'POST',
                url: '/pay-instruments/new',
                dataType: 'JSON',
                data: data,
                success: function (response) {
                    payInstrumentMsg.empty();
                    payInstrumentMsg.addClass('alert').addClass('alert-success').append(response['msg']);
                    instruments.append(
                        '<tr>' +'<td>' + instrumentName +'</td>' +'</tr>'
                    );
                }
            });
        }
    });

    // add new packing unit
    $('#packingUnitForm').on('submit', function (element) {
        element.preventDefault();
        var token = $('input[name=_token]').val();
        var unitLabel = $('input[name=label]').val();
        var unitName = $('input[name=unit_name]').val();
        var error = 'Obvezno vnesi oznako in ime nove merske enote!';

        var packingUnitMsg = $('#packingUnitMsg');
        var packingUnits = $('#packing_units');

        if(unitLabel == '' || unitName == ''){
            packingUnitMsg.empty();
            packingUnitMsg.addClass('alert').addClass('alert-danger').append(error);
        }else{
            packingUnitMsg.empty();
            packingUnitMsg.removeClass('alert');
            packingUnitMsg.removeClass('alert-danger');

            var data = {
                _token: token,
                label: unitLabel,
                unit_name: unitName
            };

            $.ajax({
                type: 'POST',
                url: '/packing-unit/new',
                dataType: 'JSON',
                data: data,
                success: function (response) {
                    packingUnitMsg.empty();
                    packingUnitMsg.addClass('alert').addClass('alert-success').append(response['msg']);
                    packingUnits.append(
                        '<tr>'
                        +'<td>'+ unitLabel +'</td>'
                        +'<td>'+ unitName +'</td>'
                        +'</tr>'
                    );
                }
            });
        }
    });

    // add new attachment type
    $('#attachmentTypeForm').on('submit', function (element) {
        element.preventDefault();

        var token = $('input[name=_token]').val();
        var attachmentName = $('input[name=attachment_name]').val();
        var attachmentLabel = $('input[name=attachment_label]').val().toUpperCase();
        var error = "Obvezno vensi ime in oznako novega tipa dokumenta!";

        var attachmentMsg = $('#atachmentTypeMsg');
        var attachmentTypes = $('#attachmentTypes');

        if(attachmentName == '' || attachmentLabel == '')
        {
            attachmentMsg.empty();
            attachmentMsg.addClass('alert').addClass('alert-danger').append(error);
        }else{
            attachmentMsg.empty();
            attachmentMsg.removeClass('alert');
            attachmentMsg.removeClass('alert-danger');

            var data = {
                _token: token,
                attachment_name: attachmentName,
                attachment_label: attachmentLabel
            };

            $.ajax({
                type: 'POST',
                url: '/attachment-type/new',
                dataType: 'JSON',
                data: data,
                success: function (response) {
                    attachmentMsg.empty();
                    attachmentMsg.addClass('alert').addClass('alert-success').append(response['msg']);
                    attachmentTypes.append(
                        '<tr>'
                        +'<td>'+ attachmentLabel +'</td>'
                        +'<td>'+ attachmentName +'</td>'
                        +'</tr>'
                    );
                }
            });
        }
    });

});