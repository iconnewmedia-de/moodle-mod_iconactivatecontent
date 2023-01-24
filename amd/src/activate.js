var mod_iconactivatecontent_initialized = false;
define(['jquery'], function($){
    return {
        init: function() {
            // prevent this init function from being called multiple times
            // (can happen when there are multiple instances)
            // that would add too many event listeners
            if (mod_iconactivatecontent_initialized) {
                return;
            }
            mod_iconactivatecontent_initialized = true;
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
