jQuery(document).ready(function($) {
    $("#logo").fadeIn(4000);
    function mobileFix() {
        var mobileFix = $(".mobile-fix");
        if ((window.innerWidth <= 767) && (mobileFix.hasClass("nav-justified"))) {
            mobileFix.removeClass("nav-justified").addClass("navbar-nav");
        } else if ((window.innerWidth > 767) && (mobileFix.hasClass("navbar-nav"))) {
            mobileFix.removeClass("navbar-nav").addClass("nav-justified");
        }
    }
    mobileFix();
    scrollFunction()
    $(window).resize(function() {
        mobileFix();
    })

    $("#scroll_down_button, #scroll_up_button").on("click", function(e) {
        $("html, body").animate({
            scrollTop: $("#navbar").offset().top
        }, 1000);
    })
    window.onscroll = function() {
        scrollFunction()
    };

    function scrollFunction() {
        if (document.body.scrollTop > $("#navbar").offset().top || document.documentElement.scrollTop > $("#navbar").offset().top) {
            $("#scroll_up_button").fadeIn()
        } else {
            $("#scroll_up_button").fadeOut()
        }
    }
    $(".showHide").on("click", function(){

        $(this).parent().find('.answer').toggle()
        $(this).find('.toggleIcon').toggleClass("fa-caret-right fa-caret-up" )
        
    })

})