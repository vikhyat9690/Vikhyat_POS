var config = {
    map: {
        '*': {
            imagePreview: 'Vikhyat_BlogManager/js/image-preview'
        }
    },
    mixins: {
        'mage/validation': {
            'Vikhyat_BlogManager/js/validate-cpassword': true
        }
    },
    deps: [
        'imagePreview'
    ]
};
