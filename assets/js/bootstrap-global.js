(function ($, document, window, undefined) {
    
    'use strict';
    
    var $document = $(document), $window = $(window), eventNames = {
        ready: 'ise:ready',
        load: 'ise:load'
    }, selectors = {
        time: '.timeago',
        modal: '.modal',
        title: '[title]'
    };
    
    /**
     * Initialise
     */
    function initialise() {
        $document.ready(documentReady).on(eventNames.ready, iseReady);
        $window.load(windowLoad);
    }
    
    /**
     * Register document ready event
     */
    function documentReady() {
        // Wrap it to unsure it fires last
        $document.ready(function() {
            $document.trigger(eventNames.ready);
        });
    }
    
    /**
     * Register window load event
     */
    function windowLoad() {
        $window.trigger(eventNames.load);
    }
    
    /**
     * Custom ready event
     */
    function iseReady() {
        $(selectors.time).timeago();
        $(selectors.modal).modal().on('shown.bs.modal', modalShown);
        $(selectors.title).tooltip({
            container: 'body',
            placement: 'auto'
        });
    }
    
    /**
     * Modal is shown
     */
    function modalShown() {
        $(this).focus();
    }
    
    // Initialise
    initialise();
    
})(jQuery, document, window);