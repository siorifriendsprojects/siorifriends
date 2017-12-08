//ドロワーメニュー
$(function($) {
	$(document).ready(function() {
		$('.ham-btn').click(function(){ //クリックしたら
			$('#drawrEvent').animate({width:'toggle'}); //animateで表示・非表示
			// $(this).toggleClass('peke'); //toggleでクラス追加・削除
			$(".glyphicon-align-justify").toggle();
			$(".glyphicon-remove").toggle();
		});
		$('[data-click]').click(function(){ //クリックしたら
			$('#drawrEvent').animate({width:'toggle'}); //animateで表示・非表示
			$(this).toggleClass('peke'); //toggleでクラス追加・削除
			$(".glyphicon-align-justify").toggle();
			$(".glyphicon-remove").toggle();
		});
	});
	// ページリサイズ時にも適用
	$(window).on('load resize', function(){
		windowHeight = $(window).height();
		$('#drawrEvent').css('height', windowHeight); //メニューをwindowの高さいっぱいにする
	});
	// ハンバーガーメニューをスクロールに追従
	$(window).on('scroll', function() {
		var $window = $(window),
		$drawr = $('#drawrEvent'),
		$remove = $(".glyphicon-remove"),
		defaultPositionLeft = $drawr.css('left'),
		setOffsetPosition   = $drawr.offset(),
		fixedClassName      = 'fixed';
		if ($(this).scrollTop() > setOffsetPosition.top) {
			$drawr.addClass(fixedClassName).css('left', setOffsetPosition.left);
			$remove.addClass(fixedClassName).css('left', setOffsetPosition.left);
		} else {
			if ($drawr.hasClass(fixedClassName)) {
				$drawr.removeClass(fixedClassName).css('left', defaultPositionLeft);
				$remove.removeClass(fixedClassName).css('left', defaultPositionLeft);
			}
		}
	}).trigger('scroll');
});