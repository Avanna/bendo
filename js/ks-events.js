(function($){
	
	
	$(document).ready(function(){
		
		$.ajax({
			url: cal_obj.ajaxurl,
			type: "get",
			dataType: "json",
			data : { action : 'json_feed'},
			success : function(data) {
				
				$('#calendar').fullCalendar({
					events: data
			  	});
			}
		});

		
	});
	

	$('#next_posts').live('click', function(e){
		
		e.preventDefault();
		var next = cal_obj.nextLink;
		
		//$('#calendar-content').load(next + '.event');
		
		$.ajax({
			url: cal_obj.ajaxurl,
			type: "get",
			dataType: "json",
			data : { action : 'ks_events_ajax'},
			success : function(data) {
			
					$('#calendar-content').append(data);
					console.log(data);
			
			}
		});
	});

	
	
	
})(jQuery);