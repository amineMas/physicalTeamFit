window.onload = function(){
    
    new WOW().init();
    var scrollTop = document.getElementById('scrollToTop');

    scrollTop.addEventListener("click", function(){
        window.scrollTo({
            top: 0,
            left: 0,
            behavior: "smooth"
        })
    });

    $("a.nav-link").hover(function() {
        $(this).toggleClass("border-b");
    });



    $('#navbarResponsive').on('show.bs.collapse', function () { // trigger click on burger
        $(this).css('backgroundColor', "gray"); // make background gray
        $('.navbar-toggler-icon').addClass('d-none'); // I hide burger icon on click
        $('.fa-times').removeClass('d-none'); // I show the cross
    });

    $('#navbarResponsive').on('hide.bs.collapse', function () {
        $('.navbar-toggler-icon').removeClass('d-none');
      $('.fa-times').addClass('d-none');
    })

    window.addEventListener('resize', function(){
        if(this.matchMedia("(min-width: 992px)").matches){ // if screen width is at least 992px (desktop device)
            $("#navbarResponsive").removeClass('show'); // I remove class show which display burger menu
            $("#navbarResponsive").css('backgroundColor', "transparent");
        }
    });

    // validate form
    

}