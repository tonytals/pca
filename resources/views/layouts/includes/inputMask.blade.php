<script src="{{ asset('plugins/jquery-inputmask/jquery.inputmask.bundle.js') }}"></script>
<script>
$(function () {

    //Masked Input ============================================================================================================================
    var $maskedInput = $('form');


    $maskedInput.find('.date').inputmask('dd/mm/yyyy', { placeholder: '__/__/____', showMaskOnHover: false });


    $maskedInput.find('.time12').inputmask('hh:mm t', { placeholder: '__:__ _m', alias: 'time12', hourFormat: '12' });
    $maskedInput.find('.time24').inputmask('hh:mm', { placeholder: '__:__ _m', alias: 'time24', hourFormat: '24' });


    $maskedInput.find('.datetime').inputmask('d/m/y h:s', { placeholder: '__/__/____ __:__', alias: "datetime", hourFormat: '24' });


    $maskedInput.find('.telefone').inputmask('(99) 9.9999-9999', { placeholder: '_', showMaskOnHover: false });
    //Phone Number
    $maskedInput.find('.phone-number').inputmask('+99 (999) 999-99-99', { placeholder: '+__ (___) ___-__-__' });

    //Dollar Money
    $maskedInput.find('.money-dollar').inputmask('99,99 $', { placeholder: '__,__ $' });
    //Euro Money
    $maskedInput.find('.money-euro').inputmask('99,99 €', { placeholder: '__,__ €' });

    //IP Address
    $maskedInput.find('.cpf').inputmask('999.999.999-99', { placeholder: '___.___.___-__' , showMaskOnHover: false});

    //Credit Card
    $maskedInput.find('.credit-card').inputmask('9999 9999 9999 9999', { placeholder: '____ ____ ____ ____' });

    //Email
    $maskedInput.find('.email').inputmask({ alias: "email" , showMaskOnHover: false});

    //Serial Key
    $maskedInput.find('.key').inputmask('****-****-****-****', { placeholder: '____-____-____-____' });

    $maskedInput.find('.cnpj').inputmask('99.999.999/9999-99', { placeholder: '_', showMaskOnHover: false });
});
</script>
