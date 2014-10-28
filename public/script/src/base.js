$(function(){
	//搜索清空
	(function($){
		var searchTxt = $('#search');

		if(searchTxt.length === 0) return;
		searchTxt.focus(function() {
			var val = $(this).val();
			if(val === '请输入关键字搜索'){
				$(this).val('');
				$(this).attr('style', 'color:#333');
			}
		});
		searchTxt.blur(function() {
			var val = $(this).val();
			if(val.length === 0 ){
				$(this).val('请输入关键字搜索');
				$(this).attr('style', 'color:#999');
			}
		});
	})($); 

	//百度分享代码;
	(function(){
		$('#baidu-share').append('<div class="bdsharebuttonbox"><a href="#" class="bds_more" data-cmd="more"></a><a href="#" class="bds_qzone" data-cmd="qzone" title="分享到QQ空间"></a><a href="#" class="bds_tsina" data-cmd="tsina" title="分享到新浪微博"></a><a href="#" class="bds_tqq" data-cmd="tqq" title="分享到腾讯微博"></a><a href="#" class="bds_renren" data-cmd="renren" title="分享到人人网"></a><a href="#" class="bds_weixin" data-cmd="weixin" title="分享到微信"></a></div>');
		window._bd_share_config={"common":{"bdSnsKey":{},"bdText":"","bdMini":"2","bdMiniList":false,"bdPic":"","bdStyle":"0","bdSize":"16"},"share":{}};with(document)0[(getElementsByTagName('head')[0]||body).appendChild(createElement('script')).src='http://bdimg.share.baidu.com/static/api/js/share.js?cdnversion='+~(-new Date()/36e5)];
	})();
});

