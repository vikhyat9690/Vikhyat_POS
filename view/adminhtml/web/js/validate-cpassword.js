define([
    'jquery',
    'mage/translate',
    'jquery/validate'
], function ($, $t) {
    'use strict';

    return function () {
        $.validator.addMethod(
            "validate-cpassword",
            function (value, element) {
                var password = $('[name="password"]').val();
                return value === password;
            },
            $t('Passwords do not match.')
        );
    };
});
