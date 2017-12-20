/*
 * Get 60 photos
 */
var access_token = 'YOUR ACCESS TOKEN HERE',
    tag='wordcamp',
    count = 30; // number of photos per request (max 33)
 
$.ajax({
	url: 'https://api.instagram.com/v1/tags/' + tag + '/media/recent',
	dataType: 'jsonp',
	type: 'GET',
	data: {access_token: access_token, count: count},
	success: function(result){
		console.log(result);
		for(x in result.data){
			$('ul').append('<li><img src="'+result.data[x].images.standard_resolution.url+'"></li>');  
		}
		$.ajax({
			url: result.pagination.next_url, // we don't need to specify parameters for this request - everything is in URL already
			dataType: 'jsonp',
			type: 'GET',
			success: function(result2){
				console.log(result2);
				for(x in result2.data){
					$('ul').append('<li><img src="'+result2.data[x].images.standard_resolution.url+'"></li>');  
				}
			},
			error: function(result2){
				console.log(result2);
			}
		});
 
	},
	error: function(result){
		console.log(result);
	}
});
