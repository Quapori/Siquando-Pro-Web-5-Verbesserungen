(function($) {
    $.fn.ngBlogHeadPopup = function() {

        function openInPopup(e)
        {
            if ($(this).attr('target')==='_blank') {
                e.preventDefault();
                window.open($(this).attr('href'), '_blank', 'width=600,height=500');
            }
        }

        $(this).on('click', openInPopup);
    };
})(jQuery);

$(document).ready(function() {
    $('.sqpparabloghead>div>ul>li>a').ngBlogHeadPopup();
});