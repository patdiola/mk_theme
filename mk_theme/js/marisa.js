/**
 * jQuery.browser.mobile (http://detectmobilebrowser.com/)
 *
 * jQuery.browser.mobile will be true if the browser is a mobile device
 *
 **/
(function(a){(jQuery.browser=jQuery.browser||{}).mobile=/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i.test(a)||/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(a.substr(0,4))})(navigator.userAgent||navigator.vendor||window.opera);

if (!Array.prototype.indexOf) {
  Array.prototype.indexOf = function (searchElement , fromIndex) {
    var i,
        pivot = (fromIndex) ? fromIndex : 0,
        length;

    if (!this) {
      throw new TypeError();
    }

    length = this.length;

    if (length === 0 || pivot >= length) {
      return -1;
    }

    if (pivot < 0) {
      pivot = length - Math.abs(pivot);
    }

    for (i = pivot; i < length; i++) {
      if (this[i] === searchElement) {
        return i;
      }
    }
    return -1;
  };
}

(function ($) {

    var $win = $(window);

    if(jQuery.browser.mobile){
        $('html').addClass('device-mobile');
        $('body').append('..md..');
    }
    if(!jQuery.browser.mobile){
        $('html').addClass('device-regular');
    }


    //See if Flexbox is supported
    var detector = document.createElement("detect");
    detector.style.display = "flex";
    if (detector.style.display === "flex") {
        $('html').addClass('flexbox-supported');
    }
    else {
        $('html').addClass('flexbox-not-supported');
    }

    var $n = $('.nav-title');
    $('.nav-container .icons-a a').on('mouseover', function () {
        var t = $(this).attr('data-title-truncated'),
            tId = $(this).attr('data-id');
        $n.removeClass('visible');
        $('.nav-title-text').html(t);
        $n.addClass('visible');
        $('.portfolio-thumbs a[data-id=' + tId + ']').addClass('hover');
    }).on('mouseout', function () {
        $n.removeClass('visible');
        $('.portfolio-thumbs a').removeClass('hover');
    });

    var $mToggle = $('.mobile-toggle');

    $('.menu-toggle').on('click', function () {

        if ($mToggle.first().hasClass('expanded')) {
            $mToggle.removeClass('expanded').slideUp('slow');
            $('.nav-container').removeClass('expanded');
        }
        else {
            $mToggle.addClass('expanded').slideDown('slow');
            $('.nav-container').addClass('expanded');
        }

    });

    //Image size hack
    $('.entry-content img').each(function () {

        var $t = $(this),
            thisImageWidth = $t.attr('width'),
            $thisImageHasAnchorWrapper = $t.parents('a');

        if (thisImageWidth != '' && $thisImageHasAnchorWrapper && !$t.hasClass('attachment-full')) {
            var imageSrc = $thisImageHasAnchorWrapper.attr('href');
            $t.attr('src', imageSrc).removeAttr('width height').parents('div[style]').css({
                width: '',
                height: ''
            });
        }

    });

    function projectPagination() {

        var allProjects = [],
            thisPageId = $('#page').attr('data-id');

        $('.icons-a a').each(function () {
            var thisId = $(this).attr('data-id');
            allProjects.push(thisId);
        });

        if (allProjects.indexOf(thisPageId) != -1) {

            var current = allProjects.indexOf(thisPageId); //allProjects.indexOf(thisPageId),
                $prev = (current != 0) ? $('.icons-a a').eq(current - 1) : $('.icons-a a').eq(allProjects.length - 1),
                $next = ((current + 1) < allProjects.length) ? $('.icons-a a').eq(current + 1) : $('.icons-a a').eq(0);

            $('.project-prev').attr('href', $prev.attr('href')).attr('title', $prev.attr('title'));
            $('.project-next').attr('href', $next.attr('href')).attr('title', $next.attr('title'));

            //$('.project-prev div').text($prev.attr('title'));
            //$('.project-next div').text($next.attr('title'));

            $('.project-prev').css({
                background: 'url(' + $prev.find('img').attr('src') + ') no-repeat left center transparent',
                backgroundSize: '50px 50px'
            });

            $('.project-next').css({
                background: 'url(' + $next.find('img').attr('src') + ') no-repeat right center transparent',
                backgroundSize: '50px 50px'
            });

            $('.project-pagination').show(0);

        }

    }

    projectPagination();

    var layout = 'mobile';

    function resizer() {

        var winWidth = $(window).width();

        if (winWidth >= 600) {

            if (layout != 'desktop') {
                $('html').removeClass('layout-mobile');
                $mToggle.addClass('expanded').show(0);
                $('.nav-container').addClass('expanded');
                layout = 'desktop';
            }

        }
        else {

            if (layout != 'mobile') {
                $('html').addClass('layout-mobile');
                $mToggle.removeClass('expanded').hide(0);
                $('.nav-container').removeClass('expanded');
                layout = 'mobile';
            }

        }

    }

    $(window).on('resize', function () {
        resizer();
    });

    resizer();

    //Set up Swipebox gallery
    //http://brutaldesign.github.io/swipebox/con
    $('.gallery img').each(function () {
        var $that = $(this),
            thatSrc = $that.attr('src'),
            thatAlt = $that.attr('alt');
        $that.wrap('<a href="' + thatSrc + '" class="swipebox" title="' + thatAlt + '" />');
    });
    $('.wp-caption a').addClass('swipebox');

    $('.entry-content img').each(function () {
        var thisImgClass = $(this).attr('class');
        //if (thisImgClass.indexOf('wp-image') >= 0) {
        if(thisImgClass.indexOf('wp-image')){
            $(this).wrap('<a href="' + $(this).attr('src') + '" class="swipebox" />');
        }
    });

    $(".swipebox").swipebox();

})(jQuery);