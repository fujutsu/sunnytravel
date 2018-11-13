jQuery(document).ready(function($) {
    var listDate = [];
    $('input.checkin_rental, input.checkout_rental').each(function() {
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

        ajaxGetRentalOrder(year_start, $this);
    });
    

    $('input.checkin_rental').on('changeYear', function(e) {
        var $this = $(this);
        year =  new Date(e.date).getFullYear();

        ajaxGetRentalOrder(year, $this);
    });

    $('input.checkin_rental').on('changeDate',function(e){
        $('input.checkout_rental').datepicker('setDates', '');
    });

    $('input.checkout_rental').on('changeYear', function(e) {
        var $this = $(this);
        year =  new Date(e.date).getFullYear();

        ajaxGetRentalOrder(year, $this);
    });

    function ajaxGetRentalOrder(year, me){
        post_id = $('.booking-item-dates-change').data('post-id');
        if(!typeof post_id != 'undefined' || parseInt(post_id) > 0){
            var data = {
                post_id : post_id,
                item_post_type: 'st_rental',
                _st_st_booking_post_type: 'st_rental',
                year: year,
                security:st_params.st_search_nonce,
                action:'st_getOrderByYear',
            };

            $.post(st_params.ajax_url, data, function(respon) {
                if(respon != ''){
                    listDate = respon;
                }
                booking_period = $('.booking-item-dates-change').data('booking-period');
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
            },'json');

            $( document ).ajaxStop(function() {
                $('.overlay-form').fadeOut(500); 
            });

        }else{
            $('.overlay-form').fadeOut(500); 
        }
    } 
});