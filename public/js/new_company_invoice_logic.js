/**
 * Created by Janko on 28. 09. 2016.
 */
$(document).ready(function () {
    // hide special fields and message boxes
    $('#foreign_invoice').hide();
    $('#fcSelectErr').hide();

    // datepicker
    $('#invoice_date').datepicker({
        dateFormat: 'dd.mm.yy',
        showOtherMonths: true,
        showOtherYears: true
    });
    // logic
    var company = $('#companyId').val();

    if(company == 999999) {
        $('#foreign_invoice').show();
        // preverjanje obveznih podatkov
        $('#invoice_nr').on('focus', function () {
            var selectedFc = $('#foreign_company').val();
            var selectedCountry = $('#country').val();
            if(selectedFc == 0 || selectedCountry == ""){
                $('#fcSelectErr').addClass('alert');
                $('#fcSelectErr').addClass('alert-danger');
                $('#fcSelectErr').html('Obvezno izberi tujo spletno trgovino in vpiši državo');
                $('#fcSelectErr').show();
                $('#addInvoiceBtn').attr('disabled', true);
            }else{
                $('#fcSelectErr').hide();
                $('#addInvoiceBtn').attr('disabled', false);
            }
        });




        // countries autocomplete - get json data from controller
        $.get('/files/get-world-countries', function (countries) {
            var countries = countries;
            worldCountries = [];
            // convert data to js object
            var c = JSON.parse(countries);
            var countr = $.map(c, function (el) {
                return el;
            });

            // list for autocomplete  source
            for (e = 0; e < countr.length; e++){
                worldCountries.push(countr[e].name);
            }

            // jquery autocomplete for enterig country
            $('#country').autocomplete({
                source: worldCountries
            });

            // aouto add country code when county is entered
            $('#country_code').on('focus', function (element) {
                var selectedcountry = $('#country').val();
                console.log(selectedcountry);

                // get the selected county forom all countries object
                var chosenCountry = $.grep(countr, function (el) {
                    return el.name == selectedcountry;
                });
                var selected = chosenCountry[0];

                var code = selected.code;
                // add the correct country code to the  form field
                $('#country_code').val(code);

            });




        });



    }else{
        $('#foreign_invoice').hide();
    }
});