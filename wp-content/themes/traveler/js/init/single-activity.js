jQuery(document).ready(function($) {
	if($('.activity_booking_form').data('activity-type') == 'daily_activity'){
        booking_period = $('.input-daterange').data('booking-period');
        if(typeof booking_period != 'undefined' && parseInt(booking_period) > 0){
            var data = {
                booking_period : booking_period,
                action: 'st_getBookingPeriod'
            };
            $.post(st_params.ajax_url, data, function(respon) {
                if(respon != ''){
                    $('input.check_in,input.check_out').datepicker('setRefresh',true);
                    $('input.check_in, input.check_out').datepicker('setDatesDisabled',respon); 
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