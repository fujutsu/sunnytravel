(function($){
	$.fn.extend({
		stLocation : function(options){
			var defaults = {

			};

			var options = $.extend(defaults, options);

			return this.each(function(index, el) {
				var last_val = '';
				var parent = $(this).parents('.st-select-wrapper');
				var $select_location = $(this).selectize({
					create: false,
					createOnBlur: true,
					allowEmptyOption: true,
					persist: true,
					openOnFocus: false,
					valueField: 'value',
				    labelField: 'text',
				    searchField: ['text', 'value'],
				    onInitialize: function(){
				    	var location_name = parent.data('location-name');
				    	if(typeof location_name != 'undefined' && location_name != ''){
				    		$('.selectize-input input', parent).val(location_name);
				    	}
				    },
					onType: function(str){
						last_val = str;
						$control = $select_location[0].selectize;
						if(typeof str == 'undefined' || str.length == 0){
							$('.selectize-dropdown', parent).addClass('st-hidden');
						}else{
							$('.selectize-dropdown', parent).removeClass('st-hidden');
						}
					},
					onChange: function(value){
						if(value){
							$('.selectize-dropdown', parent).addClass('st-hidden');
						}

					},
					onDropdownClose: function(){
						$('.selectize-dropdown', parent).addClass('st-hidden');
					},
					onBlur: function(){
						$('.selectize-dropdown', parent).addClass('st-hidden');
						$control = $select_location[0].selectize;
						$('.selectize-input input', parent).val(last_val);
						$('input.location_name', parent).val(last_val);
					},
					render: {
						item: function(item) {
							var label = item.text;
							label = label.split("||");
				            return '<div class="option">' + label[0]+ '</div>';
				        },
						option: function(item) {
							var label = item.text;
							label = label.split("||");
							zip = '';
							if(typeof label[1] != 'undefined') zip = '<span class="zipcode">'+label[1]+'</span>';
				            return '<div class="option"><span class="label">' + label[0] + zip +'</span>' +
				                '<i class="fa fa-map-marker"></i></div>';
				            
				        }
					}
				});
				
				$('.selectize-input', parent).on('blur', function(){
					var value = $select_location[0].selectize.getValue();
					console.log(value);
				});
			});
		}
	});
})(jQuery);
jQuery(document).ready(function($) {
	$('.st-location-id').stLocation();
});