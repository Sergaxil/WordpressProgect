$(function(){
	$('.see-more').click(function(){
		$(this).parent().prev().toggle(700);
	});
});