define([
    'jquery',
    'Magento_Ui/js/modal/modal'
], function ($, modal) {
    'use strict';

    return function () {
        $(document).on('click', '.data-grid-thumbnail-cell img', function () {
            var imageUrl = $(this).attr('src');
            var popup = $('<div />').html('<img src="' + imageUrl + '" style="max-width:100%;"/>');

            modal({
                title: 'Image Preview',
                type: 'popup',
                modalClass: 'image-preview-popup',
                responsive: true,
                buttons: []
            }, popup);

            popup.modal('openModal');
        });
    };
});
