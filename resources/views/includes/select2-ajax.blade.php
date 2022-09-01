<script>
	$(function () {	
		$("{{ $id }}").select2({
			// theme: 'bootstrap4',
	    	// minimumInputLength: 2,
	    	placeholder: "{{ $placeholder }}",
	      
	      	ajax: {
	        	url: "{{ $url }}",
	        	dataType: 'json',
	        	delay: 250, 
	        	data: function (params) {
	            	return {
	                	q: params.term
	            	};
	        	},
	        	processResults: function (data) {
	          		return {
	            		results: $.map(data, function (item) {
		              		return {
		                		id: item.id,
		                		text: item.name
		              		}
		            	})
	          		};
	        	},
	        	cache: true
	      	}	
	    });
	})
</script>