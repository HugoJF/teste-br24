require('bootstrap');
const $ = require('jquery');
const InputMask = require('inputmask');

$(document).ready(function () {
    Inputmask({
        mask: ['(99) 9999-9999', '(99) 99999-9999', ],
    }).mask(document.querySelectorAll('[data-mask=phone]'));

    Inputmask({
        mask: '999.999.999-99',
    }).mask(document.querySelectorAll('[data-mask=cpf]'));

    Inputmask({
        mask: '99.999.999/9999-99',
    }).mask(document.querySelectorAll('[data-mask=cnpj]'));
});
