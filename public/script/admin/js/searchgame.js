//jquery搜索插件
(function($) {
    $.fn.searchGame = function(options) {
        var defaults = {
            url : '/admin/game/search/?name=__name__'
        };
        var opts = $.extend(defaults, options);
        var self = this;
        //界面显示
        $(this).after('&nbsp;<input type="button" id="search_data_submit2" name="search_data_submit2" value="搜索" class="submit" style="float:none;margin-top:5px;" />');
        $(this).after('<input id="search_keyword2" type="text" value="" class="form-control" style="width:150px; margin-left:10px; float:left;" />');
        $('body').append('<div id="search_tmp_div2" name="search_tmp_div" title="游戏ID&nbsp;搜索结果"></div>');
        
        //定义元素事件
        $('#search_keyword2').keydown(function(event){
            if (event.keyCode == 13) {
                $('#search_data_submit2').click();
                return false;
            }
        });
        
        $('#search_tmp_div2').dialog({
            autoOpen: false,            
            height:200,            
            show: "drop",            
            hide: "drop"
        });
        
        $('#search_data_submit2').click(function(){
            if ($('#search_keyword2').val() == ''){
                return;
            }

            var url = opts.url;
            url = url.replace('__name__', encodeURIComponent($('#search_keyword2').val()));
            if (!opts.searchType) {
                opts.searchType = '';
            }
            $.get(url, function(data){
                var obj = jQuery.parseJSON(data);
                var html = '';
                for(var i in obj) {
                    html += obj[i].id+' <a class="choose_search_result" id="'+obj[i].id+'" href="javascript:void(0);">'+obj[i].name+'</a><br />';
                }
                if (html == '') {
                    html = '没有搜索到记录'
                }
                $('#search_tmp_div2').html(html);
                var top = $('#search_keyword2').offset().top + parseInt($('#search_keyword2').css('height')) + 5;
                var left = $('#search_keyword2').offset().left;
                $('#search_tmp_div2').dialog({
                    position:[left,top]
                });
                $('#search_tmp_div2').dialog('open');
                $('#search_keyword2').focus();
                
                $('.choose_search_result').click(function(){
                    $('#search_tmp_div2').dialog('close');
                    if (opts.callback) {
                        var tmpData = {};
                        tmpData.id = $(this).attr('id');
                        tmpData.name = $(this).html();
                        opts.callback(tmpData);
                    }
                        
                });
            });
        });
    };
})(jQuery);