jQuery(document).ready(function() {
    $(".workSearch .search").on('click', ".fa-search", function () {
        $(this).siblings('.displayNone').animate({"margin-left": "0%"});
        $(this).removeClass('fa-search');
        $(this).addClass('fa-2x');
        $(this).addClass('fa-angle-left');
    });
    $(".workSearch .search").on('click', "a.fa-angle-left", function () {
        $(this).siblings('.displayNone').animate({"margin-left": "120%"});
        $(this).removeClass('fa-angle-left');
        $(this).removeClass('fa-2x');
        $(this).addClass('fa-search');
    });

    /*CArusel menu */

    var owl = $('.carusels .carusel');
    owl.owlCarousel({
        loop: true,
        responsive: {
            0: {
                items: 1
            },
            600: {
                items: 3
            },
            1000: {
                items: 5
            },
            1200: {
                items: 7
            }
        }
    });
    $('.owlprev').click(function (e) {
        e.preventDefault();
        owl.trigger('next.owl.carousel');
    });
    $('.owlnext').click(function (e) {
        e.preventDefault();
        owl.trigger('prev.owl.carousel');
    });

    /*Slider Index*/

    var owlslider = $('.owlslider');
    owlslider.owlCarousel({
        loop: 3,
        items: 1
    });
    $('.slider .prev').click(function (e) {
        e.preventDefault();
        owlslider.trigger('next.owl.carousel');
    });
    $('.slider .next').click(function (e) {
        e.preventDefault();
        owlslider.trigger('prev.owl.carousel');
    });

    /*carusel blog index*/

    var owlsliderblog = $('.blogs .blogcarusel');
    owlsliderblog.owlCarousel({
        loop: 3,
        responsive: {
            0: {
                items: 1
            },
            1000: {
                items: 2
            },
            1200:{
                items:3
            }
        }
    });
    $('.blogs .blogprev').click(function (e) {
        e.preventDefault();
        owlsliderblog.trigger('next.owl.carousel');
    });
    $('.blogs .blognext').click(function (e) {
        e.preventDefault();
        owlsliderblog.trigger('prev.owl.carousel');
    });

    /*reviews index*/

    var owlsliderrew = $('.revcarusels .rewcarusel');
    owlsliderrew.owlCarousel({
        loop: 3,
        items: 1
    });
    $('.revcarusels .revprev').click(function (e) {
        e.preventDefault();
        owlsliderrew.trigger('next.owl.carousel');
    });
    $('.revcarusels .revnext').click(function (e) {
        e.preventDefault();
        owlsliderrew.trigger('prev.owl.carousel');
    });
    /* one gods carusel*/

    var owlslideronegods = $('.onegods .onegodscarusel');
    owlslideronegods.owlCarousel({
        loop: true,
        items: 1,
        URLhashListener: true,
        startPosition: 'URLHash'
    });
    $('.onegods .onegodscorusels .prev').click(function (e) {
        e.preventDefault();
        owlslideronegods.trigger('next.owl.carousel');
    });
    $('.onegods .onegodscorusels .next').click(function (e) {
        e.preventDefault();
        owlslideronegods.trigger('prev.owl.carousel');
    });
    /* one gods carusel*/

    var owlsliderrecomented = $('.onegods .recomented');
    owlsliderrecomented.owlCarousel({
        loop: true,
        responsive: {
            0: {
                items: 1
            },
            950: {
                items: 3
            },
            1000: {
                items: 5
            }
        },
        URLhashListener: true,
        startPosition: 'URLHash'
    });
    $('.onegods .recomenteds .prev').click(function (e) {
        e.preventDefault();
        owlsliderrecomented.trigger('next.owl.carousel');
    });
    $('.onegods .recomenteds .next').click(function (e) {
        e.preventDefault();
        owlsliderrecomented.trigger('prev.owl.carousel');
    });

    /*-=gods carusel=-*/
    /*-=gods news carusel=-*/

    var owlgodsnews = $('.godscarusels .godscarusels.news')
    owlgodsnews.owlCarousel({
        loop: true,
        magin: 10,
        responsive: {
            0: {
                items: 1
            },
            950: {
                items: 2
            },
            1000: {
                items: 3
            }
        }
    });
    $('.godscarusels .godsprev.news').click(function (e) {
        e.preventDefault();
        owlgodsnews.trigger('next.owl.carousel');
    });
    $('.godscarusels .godsnext.news').click(function (e) {
        e.preventDefault();
        owlgodsnews.trigger('prev.owl.carousel');
    });

    /*-=sales carusel=-*/

    var owlgodssales = $('.godscarusels .godscarusels.sales')
    owlgodssales.owlCarousel({
        loop: true,
        magin: 10,
        responsive: {
            0: {
                items: 1
            },
            950: {
                items: 2
            },
            1000: {
                items: 3
            }
        }
    });
    $('.godscarusels .godsprev.sales').click(function (e) {
        e.preventDefault();
        owlgodssales.trigger('next.owl.carousel');
    });
    $('.godscarusels .godsnext.sales').click(function (e) {
        e.preventDefault();
        owlgodssales.trigger('prev.owl.carousel');
    });

    /*-=hit carusel=-*/
    var owlgodshit = $('.godscarusels .godscarusels.hit')
    owlgodshit.owlCarousel({
        loop: true,
        magin: 10,
        responsive: {
            0: {
                items: 1
            },
            950: {
                items: 2
            },
            1000: {
                items: 3
            }
        }
    });
    $('.godscarusels .godsprev.hit').click(function (e) {
        e.preventDefault();
        owlgodshit.trigger('next.owl.carousel');
    });
    $('.godscarusels .godsnext.hit').click(function (e) {
        e.preventDefault();
        owlgodshit.trigger('prev.owl.carousel');
    });

    /*gods hover index*/
    /*$('.godscarusels .item').hover(function () {
     $(this).find('.hovertext .top').show().animate({'top': '-130px'},500);;
     $(this).find('.text').hide();
     $(this).find('.hovertext .bottom').show().animate({'top': '0px'},500);
     },function () {
     $(this).find('.hovertext .top').animate({'top': '0px'},500).hide();
     $(this).find('.hovertext .bottom').animate({'top': '0px'},500).hide();
     $(this).find('.text').show();
     });*/

    $('.godscarusels .godscarusels .item').hover(function () {
        $(this).find('.hovertext .top').show().animate({'top': '-190px'}, 500);
        $(this).find('.text').hide();
        $(this).find('.hovertext .bottom').show().animate({'top': '316px'}, 500);

    }, function () {
        $(this).find('.hovertext .top').animate({'top': '0px'}, 500).hide();
        $(this).find('.hovertext .bottom').animate({'top': '316px'}, 500).hide();
        $(this).find('.text').show();
    });
    /*gods recomented hover index*/
    $('.godscarusels .recomented .item').hover(function () {
        $(this).find('.hovertext .top').show().animate({'top': '69px'}, 500);
        $(this).find('.text').hide();
        $(this).find('.hovertext .bottom').show().animate({'top': '316px'}, 500);
    }, function () {
        $(this).find('.hovertext .top').animate({'top': '215px'}, 500).hide();
        $(this).find('.hovertext .bottom').animate({'top': '377px'}, 500).hide();
        $(this).find('.text').show();
    });

    $('body footer .description a.opentext').click(function (e) {
        e.preventDefault();
        $(this).siblings('.displayNone').slideDown();
        $(this).hide();
        $(this).siblings('.closetext').show();
    });
    $('body footer .description a.closetext').click(function (e) {
        e.preventDefault();
        $(this).siblings('.displayNone').slideUp();
        $(this).hide();
        $(this).siblings('.opentext').show();
    });


    /*gods hover category*/
    $('.lines .item').hover(function () {
        $(this).find('.hovertext .top').show().animate({'top': '-215px'}, 500);
        ;
        $(this).find('.text').hide();
        $(this).find('.hovertext .bottom').show().animate({'top': '315px'}, 500);
    }, function () {
        $(this).find('.hovertext .top').animate({'top': '0px'}, 500).hide();
        $(this).find('.hovertext .bottom').animate({'top': '315px'}, 500).hide();
        $(this).find('.text').show();
    });

    /*slider index paralax*/

    $(".owlslider ").on('mousemove', ".item ", function (e) {
        var offsit = $(this).offset();
        var widh = $(this).width();
        var heiht = $(this).height();
        var xMouse = e.pageX;
        var yMouse = e.pageY;
        var centerTop = offsit.top + (heiht / 2);
        var centerLeft = offsit.left + (widh / 2);
        var data = $(this).find('img').offset();
        var transformX = (centerLeft - xMouse) / (data.left / 10);
        var transformY = (centerTop - yMouse) / (data.top / 10);
        $(this).find('.one').css({
            "-webkit-transform": "translate(" + transformX / 2 + "px," + transformY / 2 + "px)",
            "-ms-transform": "translate(" + transformX / 2 + "px," + transformY / 2 + "px)",
            "transform": "translate(" + transformX / 2 + "px," + transformY / 2 + "px)"
        });
        $(this).find('.two').css({
            "-webkit-transform": "translate(" + transformX * 2 + "px," + transformY * 2 + "px)",
            "-ms-transform": "translate(" + transformX * 2 + "px," + transformY * 2 + "px)",
            "transform": "translate(" + transformX * 2 + "px," + transformY * 2 + "px)"
        });
        $(this).find('.three').css({
            "-webkit-transform": "translate(" + transformX + "px," + transformY + "px)",
            "-ms-transform": "translate(" + transformX + "px," + transformY + "px)",
            "transform": "translate(" + transformX + "px," + transformY + "px)"
        });

    });


    /*menu fixed*/
    enquire
        .register("screen and (max-width:1900px)", function () {
            $('#direction-waypoint').waypoint({
                handler: function (direction) {
                    $('header .pink').toggleClass('sticky', direction == 'down');
                    // $('.sticky').animate({"height":"auto"},1000);
                }
            });
        })
        .register("screen and (max-width:1050px)", function () {
            $('#direction-waypoint').waypoint({
                handler: function (direction) {
                    $('header .pink').toggleClass('mobail', direction == 'down');
                    // $('.sticky').animate({"height":"auto"},1000);
                }
            });
        });


    $(window).scroll(function () {
        if ($(this).scrollTop() != 0) {
            $('#toTop').fadeIn();
        } else {
            $('#toTop').fadeOut();
        }
    });
    $('#toTop').click(function () {
        $('body,html').animate({scrollTop: 0}, 800);
    });


    /*price ranger*/
    var slider= $("#slider-range");
    var minSlider=slider.data('min');
    var maxSlider=slider.data('max');
    slider.slider({
        range: true,
        min: minSlider,
        max: maxSlider,
        step: 100,
        values: [minSlider, maxSlider],
        slide: function (event, ui) {
            $("#amountmin").val($("#slider-range").slider("values", 0) + ' грн');
            $("#amountmax").val($("#slider-range").slider("values", 1) + ' грн');
        }
    });


    /*checkbox*/
    $('.checkbox input').styler();

    /*togle form*/

    $('aside').on('click', '.drop', function (e) {
        e.preventDefault();
        $(this).toggleClass('closes');
        if ($(this).hasClass('closes')) {
            $('.filters').slideUp();
        } else {
            $('.filters').slideDown();
        }
    });
    $("table td .plus").click(function (e) {
        e.preventDefault()
        var quantity = $(this).siblings('input').val();
        var summ = parseInt(quantity) + 1
        $(this).siblings('input').val(summ);
        var prise = $(this).parents('tr').find(".prise").attr('data-prise');

        var finality = $("#finality").html();
        var sum = prise * quantity;
        var allsumm = parseInt(finality) + sum;
        $("#finality").html(allsumm);
        var value = $('#orders-bascet_id').val();
        var godsId = $(this).parents('tr').find('.id').attr('data-id');
        console.log(godsId);
        var string = ',%%,' + godsId + ':' + quantity;
        var str;
        if (value.indexOf(string) + 1) {
            str = value.replace(string, ',%%,' + godsId + ':' + summ);
        } else {
            str = value.replace(godsId + ':' + quantity, godsId + ':' + summ);

        }
        $('#orders-bascet_id').val(str);
    });
    $("table td .minus").click(function (e) {
        e.preventDefault();
        var quantity = $(this).siblings('input').val();
        if (quantity >= 2) {
            var summ = parseInt(quantity) - 1;
            $(this).siblings('input').val(summ);
            $(this).parent('tr');
            var prise = $(this).parents('tr').find(".prise").attr('data-prise');
            var finality = $("#finality").html();
            var sum = prise * quantity;
            var allsumm = parseInt(finality) - sum;
            $("#finality").html(allsumm);
            var value = $('#orders-bascet_id').val();
            var godsId = $(this).parents('tr').find('.id').attr('data-id');

            var string = ',%%,' + godsId + ':' + quantity;
            var str;
            if (value.indexOf(string) + 1) {
                str = value.replace(string, ',%%,' + godsId + ':' + summ);
            } else {
                str = value.replace(godsId + ':' + quantity, godsId + ':' + summ);
            }
            console.log(str);
            $('#orders-bascet_id').val(str);
        }
    });

    $("table .yesterday ").on('click', '.del', function (e) {
        e.preventDefault();
        $(this).parents('tr').remove();
        var value = $('#orders-bascet_id').val();
        var prise = $(this).parents('tr').find(".prise").attr('data-prise');
        var quantity = $(this).parents('tr').find('.quantity').val();
        var godsId = $(this).parents('tr').find('.id').attr('data-id');
        var finality = $("#finality").html();
        var sum = prise * quantity;
        var allsumm = parseInt(finality) - sum;
        $("#finality").html(allsumm);
        var string = ',%%,' + godsId + ':' + quantity;
        var str;
        if (value.indexOf(string) + 1) {
            str = value.replace(string, '');
        } else {
            str = value.replace(godsId + ':' + quantity, '');
        }
        $.post("/cart/cart/delpervgoods",
            {id: godsId})
            .success(function(){$('#orders-bascet_id').val(str);})

    });

    /*fancybox*/
    $(".fancybox-thumb").fancybox({
        autoSize: false,
        autoHeight: false,
        autoWidth: false,
        autoResize: false,
        fitToView: false,
        helpers: {
            thumbs: {
                width: 50,
                height: 50
            }
        }
    });
    $('.color').on('click', '.colorinput', function () {
        var colorId = $(this).attr('data-color-id');
        var color = $(this).attr('data-color');
        $(this).addClass('have');
        var addIcon = '<strong class="fa fa-times-circle colorinputremove" style="color:' + color + ';"></strong>';
        $(this).html(addIcon);
        $(this).siblings('.have').find('strong.colorinputremove').remove();
        $(this).siblings('.have').removeClass('have');
        $('#basket-color').val(colorId);
    });

    $('.colorSect').on('click', '.colorinput', function () {
        var colorId = $(this).attr('data-color-id');
        var color = $(this).attr('data-color');
        $(this).addClass('have');
        $(this).toggleClass("fa-square").toggleClass("fa-times-circle");
        $(this).toggleClass("colorinput").toggleClass("colorinputremove");
        $(this).toggleClass("have").toggleClass("notvave");
        console.log('kpss');
        $('#basket-color').val(colorId);
    });
    $(".colorSect").on('click', '.colorinputremove', function (e) {
        console.log('yes');
         $(this).toggleClass("fa-times-circle").toggleClass("fa-square");
        $(this).toggleClass("colorinputremove").toggleClass("colorinput");
        $(this).toggleClass("notvave").toggleClass("have");
        $('#basket-color').val(0);
        e.stopPropagation();
    });

    $('.quantity .pluss').click(function () {
        var quantity = $('#quantity').val();
        var summ = parseInt(quantity) + 1;
        $('#quantity').val(summ);
        $('#basket-quantity').val(summ);

    });
    $('.quantity .minus').click(function () {
        var quantity = $('#quantity').val();
        if (quantity > 1) {
            var summ = parseInt(quantity) - 1;
            $('#quantity').val(summ);
            $('#basket-quantity').val(summ);
        }
    })
    $('table .addorder').click(function (e) {
        e.preventDefault();
        var rep = $(this).parents('.replase').html();
        var html = $(this).parents('tr').html();
        $('.yesterday').append("<tr>" + html.replace(rep, '<p><a href="#" class="del" ><span class="fa fa-times"></span></a></p>') + "</tr>");
        $(this).parents('tr').remove();
        var value = $('#orders-bascet_id').val();
        var prise = $(this).parents('tr').find(".prise").attr('data-prise');
        var quantyty = $(this).parents('tr').find('.quantity').val();
        var godsId = $(this).parents('tr').find('.id').attr('data-id');
        var finality = $("#finality").html();
        var sum = prise * quantyty;
        if (parseInt(finality)) {
            var allsum = parseInt(finality) + sum;
        } else {
            var allsum = sum;
        }
        if (value == undefined) {
            var name = godsId+":1";
        } else {
            var name = value + ',%%,' + godsId+":1";
        }
        $('#orders-bascet_id').val(name);
        $("#finality").html(allsum);
    });

    $('.jcarousel').jcarousel({
        vertical: true,
        wrap: 'circular',
    }).jcarouselAutoscroll({
        interval: 3000,
        target: '+=1',
        autostart: true
    });
    $('.jcarousel-prev').jcarouselControl({
        target: '-=1'
    });

    $('.jcarousel-next').jcarouselControl({
        target: '+=1'
    });
    $('#delete .delete').click(function (e) {
        e.preventDefault();
        var loge = $(this).parents('tr');
        var id = $(this).parents('td').siblings('#id').find('.id').data('id');
        $.post("/cart/cart/delpervgoods",
            {id: id})
            .success(function(){loge.remove()})
    });
    $('#reset').click(function () {
        var checkedDiv=$("form .block .form-group .jq-checkbox");
        if(checkedDiv.hasClass('checked')){
            checkedDiv.removeClass('checked');
        }
    });
});

$(window).load(function () {
    var sumCart = 0;
    $('.yesterday tr').each(function () {
        var prise= $(this).find(".prise").attr('data-prise');
        var quantyty=$(this).find('.quantity').val();
        if(quantyty==0){
            quantyty=1;
        }
        var sum= prise*quantyty;
        sumCart +=sum;
    });
    $("#finality").html(sumCart);
    var sliderItem = $('.owl-stage-outer .background');
    console.log(sliderItem.attr('data-background'));
    sliderItem.parent('.item').css('background-image',''+sliderItem.attr('data-background')+'');
});