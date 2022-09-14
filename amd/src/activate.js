define(['jquery'], function($){
    return {
        init: function() {
            $('.iconactivatecontent:has(.isrestricted)').addClass('dimmed');
            $('.externalcontent button').on('click', function(){
                var id = $(this).data('id');
                var isdeactivated = $('#' + id).hasClass('dimmed')
                    || $('#' + id).parents('.iconactivatecontent ').hasClass('dimmed')
                    || $('#' + id).parents('.description').find('.isrestricted').length > 0;
                if (isdeactivated) {
                    return;
                }
                $('#' + id).toggleClass('content-activated');
                if ($('#' + id).hasClass('content-activated')) {
                    var template = $('#' + id + ' template')[0];
                    var clone = document.importNode(template.content, true);
                    document.querySelector('#' + id + ' .externalcontent-container').appendChild(clone);
                } else {
                    $('#' + id + ' .externalcontent-container').children().remove();
                }
            });
        }
    }
});
