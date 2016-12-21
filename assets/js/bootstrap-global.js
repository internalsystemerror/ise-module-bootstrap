(function ($)
{
    var
    constants = {
    },
    properties = {
    },
    methods = {
        init: function ()
        {
            $('time.timeago').timeago();
            $('.modal').modal().on('shown.bs.modal', methods.modalShown);
        },
        modalShown: function ()
        {
            $(this).focus();
        }
    };

    $(document).ready(methods.init);
})(jQuery);