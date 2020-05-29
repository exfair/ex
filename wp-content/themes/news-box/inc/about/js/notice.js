;(function($){
	$(document).ready(function(){
		$('.eyehide').on('click',function(){
			var url = new URL(location.href);
			url.searchParams.append('hnotice',1);
			location.href= url;
		});
	});
})(jQuery);