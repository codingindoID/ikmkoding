var base = $('#base_url').data('id')

$.ajax({
	url: base + 'survey/visitor',
	type: 'get',
	dataType: 'json',
})
.done(function(data) {
	$('#visitor_now').text(data.now)
	$('#visitor_all').text(data.all)
})
.fail(function() {
	console.log("error");
})