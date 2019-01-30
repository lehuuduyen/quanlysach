$(document).ready(function () {
    localStorage.setItem('url',window.location.href);
    var url=localStorage.getItem('url');
    var string =url.split('/');

    $("ul.nav-item li:first-child").addClass('active');
    $(".nav .nav-item ").each(function(){
        var urls=$(this).find('a').attr('href');


        var url_check=urls.split('/');
        if(url_check[4]==string[4])
        {
            $(this).parent('ul').parent('div').parent('li').addClass('active');
            $(".nav.nav-item li:first-child").removeClass('active');
            $(this).addClass('active');
        }
    });

});
