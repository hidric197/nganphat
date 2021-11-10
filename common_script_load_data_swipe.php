<script language="JavaScript" type="text/javascript">
$(document).ready(function () {
    //prod
    $('.spotlight-products label').click(function (e) {
        var $this = $(this);
        e.preventDefault();

        if ($this.data('clicked')) {
            return;
        }

        $this.data('clicked', true);

        var $box = $this.parents('.spotlight-products').first();
        var $ul = $('ul', $box);
        var wd = $box.width() + 1;
        var loadedPage = $box.data('pages').toString().split(",");

        var spotlight = $box.data('spotlight');
        var pagenum = $box.data('pagenum');
        var start = $box.data('start');
        var length = $box.data('length');
        var maxpage = $box.data('maxpage');
        var max = $box.data('max');
        var type = 1;
        
        console.log('spotlight : ' + spotlight);
        console.log('pagenum : ' + pagenum);
        console.log('start : ' + start);
        console.log('length : ' + length);
        console.log('maxpage : ' + maxpage);
        console.log('max : ' + max);
        
        wd = ($('li:nth-child(2)', $ul).outerWidth(true)) * length;

        if ($this.hasClass('next')) {
            start += length;
            start = start > max ? start % max : start;
            type = 1;
        }	
        if ($this.hasClass('prev')) {
            start -= length;
            start = start < 0 ? max + start : start;
            type = -1;
        }
        pagenum = pagenum + type;
        var currentPos = parseInt($ul.data('curpos'));

        if (loadedPage.indexOf(start.toString()) >= 0) {

            $box.data('start', start);
            $box.data('pagenum', pagenum);

            currentPos = type == 1 ? currentPos - wd : currentPos + wd;

            $ul.data('curpos', currentPos);
            if (currentPos == 0) {
                $('label.prev', $box).hide();
                $('label.next', $box).show();
            } else {
                $('label', $box).show();
            }
            if ($('li', $ul).length >= max && (pagenum == 1 || pagenum == maxpage)) {
                $this.hide();
            }
            $ul.stop().css('transform', 'translate3d(' + currentPos + 'px, 0px, 0px)');
            $this.data('clicked', false);
            return;
        } else {
            loading($box);
            loading($box, { done: true });
            var ctrl = $box.data('ctrl') || 'home.spotlightProductsv5';
            $.post('/ajx/loader.aspx', { request: ctrl, spotlight: spotlight, start: start, length: length, mod: "ajax", _loaded: $('li', $ul).length },
                function (result) {
               
                    $box.data('start', start);
                    loadedPage.push(start.toString());
                    $box.data('pages', loadedPage.join(","));
                    $box.data('pagenum', pagenum);

                    if (type == 1) {
                        $ul.append(result);
                        currentPos = currentPos - wd;
                        $('label.prev', $box).show();
                    } else {
                        $ul.addClass('no-transition');
                        $ul.prepend(result);
                        $ul.stop().css('transform', 'translate3d(-' + wd + 'px, 0px, 0px)');
                        currentPos = 0;
                        $box.data('pagenum', 1);
                    }
                    window._countDown($ul);
                    if ($('li', $ul).length >= max || pagenum == maxpage || $ul.data('pagecount') == loadedPage.length) {
                        $this.hide();
                    }

                    $('img[data-src]', $ul).each(function () {
                        $(this).prop('src', $(this).data('src'));
                    });

                    $ul.data('curpos', currentPos);
                    console.log("$.post", currentPos);
                    setTimeout(function () {
                        loading($box, { done: true });
                        $ul.stop().css('transform', 'translate3d(' + currentPos + 'px, 0px, 0px)');
                        $ul.removeClass('no-transition');
                        $this.data('clicked', false);
                    }, 150);
            	}
            ).error(function () { loading($box, { done: true }); $this.data('clicked', false); });
        }
    });
});
</script>