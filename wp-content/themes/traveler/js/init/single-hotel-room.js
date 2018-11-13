jQuery(document).ready(function($) {
    var time;
    $(window).resize(function(event) {
        clearTimeout(time);
        time = setTimeout(function(){
                $(window).scroll(function(event) {
                    if($(window).width() >= 992){
                        var t = $('#single-room').offset().top;
                        if($('#single-room .thumb').length > 0){
                            t = t + $('#single-room .thumb').height();
                        }
                        if($(window).scrollTop() >= t-50){
                            w = $('.hotel-room-form').width();
                            $('.hotel-room-form').addClass('sidebar-fixed').css('width', w);
                            if($('#wpadminbar').length > 0){
                                $('.hotel-room-form').css('top', 80);
                            }
                        }else{
                            $('.hotel-room-form').removeClass('sidebar-fixed').css('width', 'auto');
                        }
                    }
                });
        }, 500);
    }).resize();
    
});

jQuery(document).ready(function($) {
    var listDate = [];
    $('input.checkin_hotel, input.checkout_hotel').each(function() {
        $(this).datepicker({
            format: $('[data-date-format]').data('date-format'),
            todayHighlight: true,
            autoclose: true,
            startDate: 'today',
        });
        date_start = $(this).datepicker('getDate');
        $(this).datepicker('addNewClass','booked');
        var $this = $(this);
        if(date_start == null)
            date_start = new Date();

        year_start = date_start.getFullYear();
        post_id = $(this).data('post-id');
        ajaxGetRentalOrder(year_start, $this, post_id);
    });
    

    $('input.checkin_hotel').on('changeYear', function(e) {
        var $this = $(this);
        year =  new Date(e.date).getFullYear();
        post_id = $(this).data('post-id');
        ajaxGetRentalOrder(year, $this, post_id);
    });

    $('input.checkin_hotel').on('changeDate',function(e){
        $('input.checkout_hotel').datepicker('setDates', '');
    });
    
    $('input.checkout_hotel').on('changeYear', function(e) {
        var $this = $(this);
        year =  new Date(e.date).getFullYear();
        post_id = $(this).data('post-id');
        ajaxGetRentalOrder(year, $this, post_id);
    });

    function ajaxGetRentalOrder(year, me, post_id){
        var data = {
            post_id: post_id,
            item_post_type: 'hotel_room',
            _st_st_booking_post_type: 'st_hotel',
            year: year,
            security:st_params.st_search_nonce,
            action:'st_getOrderByYear',
        };

        $.post(st_params.ajax_url, data, function(respon) {
            if(respon!= ''){
                listDate = respon;
            }
            if($('.input-daterange').length > 0){
                booking_period = $('.input-daterange').data('booking-period');
                if(typeof booking_period != 'undefined' && parseInt(booking_period) > 0){
                    var data = {
                        booking_period : booking_period,
                        action: 'st_getBookingPeriod'
                    };
                    $.post(st_params.ajax_url, data, function(respon1) {
                        if(respon1 != ''){
                            listDate = listDate.concat(respon1);
                            me.datepicker('setRefresh',true);
                            me.datepicker('setDatesDisabled',listDate);    
                        } 
                    },'json');
                }else{
                    me.datepicker('setRefresh',true);
                    me.datepicker('setDatesDisabled',listDate);
                }
            }  
        },'json');
    }

    $( document ).ajaxStop(function() {
        $('.overlay-form').fadeOut(500); 
    });
});