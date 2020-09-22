$(document).ready(function () {
// ***

    $('.check, select').styler();

// ***

    $(function () {
        $('.top-catalog').on("click", function () {
            $(".nav-box").slideToggle("slow");
        });
    });
    $(function () {
        $('.my-account span').on("click", function () {
            $(this).siblings('ul').slideToggle("slow");
        });
    });

// ***

    $(function () {
        $('.head-nav .toggle').on("click", function () {
            $(this).siblings('ul').fadeToggle();
        });
    });

// ***
    $(function () {
        $('.head-right .md-hidden').on("click", function (e) {
            e.preventDefault();
            $('.search-box').addClass('active');
        });
    });


    $('.close').click(function () {
        $(this).parents('.search-box').removeClass('active');
    });

// ***

    $('body').on('click', '.show', function () {
        if ($(this).siblings('.password').attr('type') == 'password') {
            $(this).addClass('view');
            $(this).siblings('.password').attr('type', 'text');
        } else {
            $(this).removeClass('view');
            $(this).siblings('.password').attr('type', 'password');
        }
        return false;
    });

    $(".user-detail input, .user-detail select").change(function () {
        $('.user-detail .button').removeAttr('disabled');
    });

// ***

    let itemsBig = $('.list_all');
    hideBig(itemsBig);

    let $itemMore = $('.itemMore');
    $itemMore.on('click', function () {
        let list = $(this).parent();

        if ($(this).hasClass('active')) {
            $(this).removeClass('active');
            $(this).html('Read more');
            closeBig(list);
        } else {
            $(this).addClass('active');
            $(this).html('Less items');
            openBig(list);
        }
    });

    function hideBig($itemBig) {
        $itemBig.each(function (indx, list) {
            let $liArray = $(list).find("span");
            let liQnt = $liArray.length;
            if (liQnt > 3) {
                $(list).append("<div class='itemMore'>Read more </div>");
                closeBig(list);
            }
        });
    }

    function closeBig(list) {
        let $liArray = $(list).find("span");
        $liArray.each(function (indx, items) {
            if (indx > 3) {
                $(items).parent("li").hide();
            }
        });
    }

    function openBig(list) {
        let $liArray = $(list).find("span");
        $liArray.each(function (indx, items) {
            $(items).parent("li").show();
        });
    }

// ***


    $('#popular').owlCarousel({
        loop: false,
        nav: true,
        navText: ['<img src="front/images/down.svg" alt="">', '<img src="front/images/down.svg" alt="">'],
        dots: false,
        items: 3,
        autoplay: false,
        autoplayTimeout: 5000,
        responsiveClass: true,
        responsive: {
            0: {
                margin: 20,
                items: 1
            },
            380: {
                margin: 20,
                items: 2
            },
            640: {
                margin: 30,
                items: 3
            },
            1000: {
                margin: 30,
                items: 4
            }
        }
    });

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

});
