jQuery(document).ready(function($) {
	booking_period = $('.booking-item-dates-change').data('booking-period');
	if(typeof booking_period != 'undefined' && parseInt(booking_period) > 0){
		var data = {
            booking_period : booking_period,
            action: 'st_getBookingPeriod'
        };
        $.post(st_params.ajax_url, data, function(respon) {
            if(respon != ''){
                $('input.checkin_hotel, input.checkout_hotel').datepicker('setRefresh',true);
                $('input.checkin_hotel, input.checkout_hotel').datepicker('setDatesDisabled',respon); 
            }    
        },'json');


        $( document ).ajaxStop(function() {
            $('.overlay-form').fadeOut(500); 
        });
	}else{
        $('.overlay-form').fadeOut(500);
    }
});