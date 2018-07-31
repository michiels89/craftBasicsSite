window.app = window.app || {};

app.common = (function commonComponent($, undefined) {

    let $document = $(document);
    let $window = $(window);
    let $html = $('html');
    let $body = $('body');

    function initialize() {

        //  Set initial variables
        this.windowResize();

        $window.on('resize', app.helpers.debounce(this.windowResize, 250, false));

        colorbox();
        collapseSearch();

    }

    function windowResize() {

        var isFlyoutActive = app.helpers.isBreakpointActive('flyout');

        if (!isFlyoutActive) {
            $body.removeClass('flyout-active');
        }

        $.extend(app.variables, {
            windowWidth: $window.width(),
            windowHeight: $window.height(),
            isFlyoutActive: isFlyoutActive
        });

    }

    function colorbox() {

        if (typeof $.colorbox == 'undefined') return;

        var defaultOptions = {
            close: '&times;',
            next: '&rsaquo;',
            previous: '&lsaquo;',
            maxWidth: '90%',
            maxHeight: '90%'
        };

        $('.js-gallery-image').colorbox(defaultOptions);

        $('.js-gallery-video').colorbox($.extend({}, defaultOptions, {
            iframe: true,
            innerWidth: 640,
            innerHeight: 480
        }));
    }

     function collapseSearch() {

        var $collapseTrigger = $('.js-search-trigger');

        // register clicks and toggle classes
        $collapseTrigger.on('click', function (e) {

            e.preventDefault();

            var $container = $(this).closest('.js-search-container');

            var $inputEl = $container.find('.js-search-input');
            var $background = $container.find('.js-search-background');

            if ($inputEl.hasClass('focus')) {
                $inputEl.removeClass('focus');
                $collapseTrigger.removeClass('active');
                $background.removeClass('active');
                $(this).find('i').toggleClass('icon--clear icon--search');
            } else {
                $inputEl.addClass('focus');
                $collapseTrigger.addClass('active');
                $background.addClass('active');
                labelID = $(this).find('label').attr('for');
                $('#' + labelID).focus();
                $(this).find('i').toggleClass('icon--search icon--clear');
            }
        });

        $document.on('click',function (event) {

            var $clickElement = $(event.target);
            if ($clickElement.closest('.js-search-input').length || $clickElement.closest('.js-search-trigger').length) {
                return false;
            }

            var $collapseTriggerActive = $collapseTrigger.filter('.active');

            var $container = $collapseTriggerActive.closest('.js-search-container');

            $container.find('.js-search-input').removeClass('focus');
            $collapseTriggerActive.removeClass('active');
            $container.find('.js-search-background').removeClass('active');
            $collapseTriggerActive.find('i').removeClass('icon--clear').addClass('icon--search');

        });
    }

    function finalize() {

        function jsDone() {
            $html.addClass('js-done');
        }

        $window.on('load', jsDone);

        setTimeout(jsDone, 4000);

    }

    return {
        init: initialize,
        windowResize: windowResize,
        finalize: finalize
    };

})(jQuery);
