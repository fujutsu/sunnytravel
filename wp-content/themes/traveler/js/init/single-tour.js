jQuery(document).ready(function($) {
    if($('input.tour_book_date').length > 0){
        booking_period = $('input.tour_book_date').data('booking-period');
        if(typeof booking_period != 'undefined' && parseInt(booking_period) > 0){
            var data = {
                booking_period : booking_period,
                action: 'st_getBookingPeriod'
            };
            $.post(st_params.ajax_url, data, function(respon) {
                if(respon != ''){
                    $('input.tour_book_date').datepicker('setRefresh',true);
                    $('input.tour_book_date').datepicker('setDatesDisabled',respon); 
                }    
            },'json');

            $( document ).ajaxStop(function() {
                $('.overlay-form').fadeOut(500); 
            });
        }else{
            $('.overlay-form').fadeOut(500);
        }
    }else{
        $('.overlay-form').fadeOut(500);
    }   
});