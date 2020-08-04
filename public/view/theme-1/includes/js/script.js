
//Adds Active class to the nav link of current page
$(function(){
    $('.nav-link').each(function(){
        if ($(this).prop('href') == window.location.href) {
            $(this).addClass('active');
            // $(this).parents('li').addClass('active');
        }
    });
});


//Auto Hide Alert Box
$(document).ready (function(){
    $('.alert-dismissible').delay(3000).fadeOut();
 });



 //Gallery Function (Opens modal)
 // MDB Lightbox Init
$(function () {
    $("#mdb-lightbox-ui").load("mdb-addons/mdb-lightbox-ui.html");
});

//Toggle Admin Sidebar
function toggleNav(){
    if(document.getElementById("sidebar-nav").style.left == "0px"){
        document.getElementById("sidebar-nav").style.left = "-280px";
    }
    else{
        document.getElementById("sidebar-nav").style.left = "0px";
    }
}
