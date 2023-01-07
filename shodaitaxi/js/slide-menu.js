$(".openbtn").click(function(){
    $(this).toggleClass("active");

    $("#g-nav").toggleClass('panelopen');
    $("body").toggleClass('overflow-hidden');
});

$("#g-nav a").click(function (){
    $('openbtn').removeClass('active');
    $('#g-nav').removeClass('panelopen');
});