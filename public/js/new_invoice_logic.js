/**
 * Created by Janko on 12. 08. 2016.
 */

$(document).ready(function () {
    //foreign invoice hidden
    $('#foreign_invoice').hide();
    
    // invoice date datepicker
    $('#invoice_date').datepicker({
        dateFormat: 'dd.mm.yy',
        showOtherMonths: true,
        showOtherYears: true
    });
    
    // if foreign invoice show foreign invoice fields in form 
    $('#companies').on('change', function () {
        var company = $('#companies').val();
        if(company == 999999)
        {
            $('#foreign_invoice').show();
        }
        else{
            $('#foreign_invoice').hide();
        }
        console.log(company);
    });
    
    // must select foreign online store from drop down error checking
    $('#invoice_nr').on('focus', function () {
        var selectedFc = $('#foreign_company').val();
        var selectedCountry = $('#country').val();
        console.log(selectedFc);
        console.log(selectedCountry);
        if(selectedFc == 0 || selectedCountry == ""){
            $('#fcSelectErr').addClass('alert');
            $('#fcSelectErr').addClass('alert-danger');
            $('#fcSelectErr').html('Obvezno izberi tujo spletno trgovino in vpiši državo');
            $('#fcSelectErr').show();
            $('#addInvoice').attr('disabled', true);
        }else{
            $('#fcSelectErr').hide();
            $('#addInvoice').attr('disabled', false);
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



});