define(['jquery', 'core/str'], function($, Str) {
    return {
        init: function () {
            Str.get_strings([
                {key: 'placeholder', component: 'mod_iconactivatecontent'},
                {key: 'defaulttext', component: 'mod_iconactivatecontent'},
            ]).done(function(strings) {
                $('#id_intro').on('change', function() {
                    let selectedValue = $(this).val();
                    var platforms = {
                        'youtube.com': 'YouTube',
                        'youtu.be': 'YouTube',
                        'instagram.com': 'Instagram',
                        'twitter.com' : 'Twitter',
                        'maps.google.com' : 'Google Maps',
                        'goo.gl/maps' : 'Google Maps',
                        'www.google.com/maps' : 'Google Maps',
                        'facebook.com': 'Facebook'
                    };
                    let targetPlatform = Object.keys(platforms).reduce(
                        (a,b) => {
                            return selectedValue.indexOf(b) > -1?b:a;
                        },
                        ''
                    );
                    if (targetPlatform !== '') {
                        let textValue = strings[1].replace(strings[0], platforms[targetPlatform]);
                        $('#id_body').text(textValue).val(textValue);
                        $('#id_icon').val(platforms[targetPlatform]);
                    } else {
                        $('#id_body').text(strings[1]);
                        $('#id_icon').val('custom');
                    }
                    $('#id_icon')[0].dispatchEvent(new Event('change'));
                });
            })

        }
    }
});