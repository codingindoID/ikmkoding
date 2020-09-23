var ikut = document.getElementById('ikut');
var base = document.getElementById('base').value;
var noreg = document.getElementById('noreg').value;

ikut.addEventListener('click', function(){
$.ajax({
	url: base+'survey/pertanyaan',
	type: 'post',
	dataType: 'json',
	data: {noreg: 'noreg'},
})
.done(function(data) {
	location.href="survey/index";
})
.fail(function() {
	console.log("error");
});

}, false);