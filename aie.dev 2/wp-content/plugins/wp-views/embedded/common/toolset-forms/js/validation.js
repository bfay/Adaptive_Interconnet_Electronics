/*
 * Validation JS
 *
 * - Initializes validation on selector (forms)
 * - Adds/removes rules on elements contained in var wptoolsetValidationData
 * - Checks if elements are hidden by conditionals
 *
 * @see class WPToolset_Validation
 *
 * $HeadURL: https://www.onthegosystems.com/misc_svn/common/trunk/toolset-forms/js/validation.js $
 * $LastChangedDate: 2014-08-26 20:34:10 +0800 (Tue, 26 Aug 2014) $
 * $LastChangedRevision: 26451 $
 * $LastChangedBy: francesco $
 *
 */
//var wptValidationData = {};

var wptValidationForms = [];
var wptValidation = (function($) {
    function init() {
        /**
         * add extension to validator method
         */
        $.validator.addMethod("extension", function(value, element, param) {
            param = typeof param === "string" ? param.replace(/,/g, "|") : param;
            return this.optional(element) || value.match(new RegExp(".(" + param + ")$", "i"));
        });
        /**
         * Add validation method for datepicker adodb_xxx format for date fields
         */
        $.validator.addMethod(
            "dateADODB_STAMP",
            function(a,b){
                return this.optional(b)||/^-?(?:\d+|\d{1,3}(?:,\d{3})+)(?:\.\d+)?$/.test(a) &&  -12219292800 < a && a < 32535215940
            },
            "Please enter a valid date"
        );
        _.each(wptValidationForms, function(formID) {
            _initValidation(formID);
            applyRules(formID);
        });
    }

    function _initValidation(formID) {
        var $form = $(formID);
        $form.validate({
            // :hidden is kept because it's default value.
            // All accepted by jQuery.not() can be added.
            ignore: 'input[type="hidden"]:not(.js-wpt-date-auxiliar),:not(.js-wpt-validate)',
            errorPlacement: function(error, element) {
                error.insertBefore(element);
            },
            highlight: function(element, errorClass, validClass) {
                // Expand container
                $(element).parents('.collapsible').slideDown();
                if (formID == '#post') {
                    var box = $(element).parents('.postbox');
                    if (box.hasClass('closed')) {
                        $('.handlediv', box).trigger('click');
                    }
                }
                // $.validator.defaults.highlight(element, errorClass, validClass); // Do not add class to element
            },
            unhighlight: function(element, errorClass, validClass) {
                $("input#publish, input#save-post").removeClass("button-primary-disabled").removeClass("button-disabled");
                // $.validator.defaults.unhighlight(element, errorClass, validClass);
            },
            invalidHandler: function(form, validator) {
                if (formID == '#post') {
                    $('#publishing-action .spinner').css('visibility', 'hidden');
                    $('#publish').bind('click', function() {
                        $('#publishing-action .spinner').css('visibility', 'visible');
                    });
                    $("input#publish").addClass("button-primary-disabled");
                    $("input#save-post").addClass("button-disabled");
                    $("#save-action .ajax-loading").css("visibility", "hidden");
                    $("#publishing-action #ajax-loading").css("visibility", "hidden");
                }
            },
//            submitHandler: function(form) {
//                // Remove failed conditionals
//                $('.js-wpt-remove-on-submit', $(form)).remove();
//                form.submit();
//            },
            errorClass: 'wpt-form-error'
        });
        $form.on('submit', function() {
            if ( $form.valid() ) {
                $('.js-wpt-remove-on-submit', $(this)).remove();
            }
        });
    }

    function isIgnored($el) {
        var ignore = $el.parents('.js-wpt-field').hasClass('js-wpt-validation-ignore') ||  // Individual fields
                        $el.parents('.js-wpt-remove-on-submit').hasClass('js-wpt-validation-ignore'); // Types group of fields
        return ignore;
    }

    function applyRules(container) {
        $('[data-wpt-validate]', $(container)).each(function() {
            _applyRules($(this).data('wpt-validate'), this, container);
        });
    }

    function _applyRules(rules, selector, container) {
        var element = $(selector, $(container));
        if (element.length > 0) {
            if (isIgnored(element)) {
                element.rules('remove');
                element.removeClass('js-wpt-validate');
            } else if (!element.hasClass('js-wpt-validate')) {
                _.each(rules, function(value, rule) {
                    var _rule = {messages: {}};
                    _rule[rule] = value.args;
                    if (value.message !== 'undefined') {
                        _rule.messages[rule] = value.message;                        
                    }
                    element.rules('add', _rule);
                    element.addClass('js-wpt-validate');
                });
            }
        }
    }

    return {
        init: init,
        applyRules: applyRules,
        isIgnored: isIgnored,
    };

})(jQuery);


jQuery(document).ready(function(){
    wptCallbacks.reset.add(function() {
        wptValidation.init();
    });
    wptCallbacks.addRepetitive.add(function(container) {
        wptValidation.applyRules(container);
    });
    wptCallbacks.removeRepetitive.add(function(container) {
        wptValidation.applyRules(container);
    });
    wptCallbacks.conditionalCheck.add(function(container) {
        wptValidation.applyRules(container);
    });
});
