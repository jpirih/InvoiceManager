/**
 * Created by Janko on 14. 08. 2016.
 */
 function search () {

    var keywords = $('#search_input').val();
    var token = $('input[name=_token]').val();
    console.log(keywords.length);


    if(keywords.length !== 0) {
        $.get('/search-items/get-items',{
                keywords: keywords,
                _token: token
            },function (keywords) {
                $("#search_results").html(keywords)
                window.location.replace('/search-items/get-items')
            }
        )
    }else{
        alert('Vpiši naziv izdelka oz storitve');
    }

};



