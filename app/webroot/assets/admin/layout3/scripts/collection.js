(function($) {

    "use strict";


    /* ================ Tabs. ================ */
    $.fn.tabs = function(options) {
        var defaults = {
            direction: ''
        };
        var options = $.extend({}, defaults, options);
        if(options.direction == "vertical"){
            $(this).addClass('tabs-vertical');
        }
        var tabsUl = $(this).find(' > ul'),
            activeTab = tabsUl.find('li.active').index(),
            tabsPane = $(this).find('.tabs-pane');
        tabsPane.find('.tab-panel').fadeOut();
        tabsPane.find('.tab-panel').eq(activeTab).fadeIn();
        tabsUl.find('li').find('a').click(function(e){
            if(!$(this).parent().hasClass('active')){
                e.preventDefault();
                var ind = $(this).parent().index();
                tabsUl.find('li').removeClass('active');
                $(this).parent().addClass('active');
                tabsPane.find('.tab-panel').fadeOut(0).removeClass('active');
                tabsPane.find('.tab-panel').eq(ind).fadeIn(350).addClass('active');
                return false;
            }else{
                return false;
            }
        });
    }

    /* ================ Accordions. ================ */
    $.fn.accordion = function(options) {
        var defaults = {
            direction: 'vertical'
        };
        var options = $.extend({}, defaults, options),
            accItem = $(this).find('li'),
            activeItem = accItem.eq(0),
            accLink	= accItem.find('h3'),
            accPane= accItem.find('.accordion-panel');
      /*  $(activeItem).addClass('active');
        if(options.direction == "vertical"){
            accPane.slideUp();
            accPane.eq(0).slideDown();
            accLink.prepend('<u/>');
        }else if(options.direction == "horizontal"){
            $(this).addClass('accordion-horizontal');
        }*/
        accItem.find('h3').click(function(e){
            if(!$(this).parent().hasClass('active')){
                e.preventDefault();
                accItem.removeClass('active');
                $(this).parent().addClass('active');
                if(options.direction == "vertical"){
                    accPane.slideUp(350);
                    $(this).next().slideDown(350);
                }else{
                    accItem.animate({width: "40px"}, {duration:350, queue:false});
                    $(this).parent().animate({width: "80%"}, {duration:350, queue:false});
                }
            }else{
                if(options.direction == "vertical"){
                    e.preventDefault();
                    accItem.removeClass('active');
                    if(options.direction == "vertical"){
                        accPane.slideUp(350);
                    }
                }
                return false;
            }
        });
    }



})(jQuery);