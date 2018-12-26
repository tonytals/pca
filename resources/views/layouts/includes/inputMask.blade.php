<script src="{{ asset('plugins/jquery-inputmask/jquery.inputmask.bundle.js') }}"></script>
<script>
$(function () {

    var $maskedInput = $('form');
    $maskedInput.find('.date').inputmask('dd/mm/yyyy', { placeholder: '__/__/____', showMaskOnHover: false });
    $maskedInput.find('.time12').inputmask('hh:mm t', { placeholder: '__:__ _m', alias: 'time12', hourFormat: '12' });
    $maskedInput.find('.time24').inputmask('hh:mm', { placeholder: '__:__ _m', alias: 'time24', hourFormat: '24' });
    $maskedInput.find('.datetime').inputmask('d/m/y h:s', { placeholder: '__/__/____ __:__', alias: "datetime", hourFormat: '24' });
    $maskedInput.find('.telefone').inputmask('(99) 9.9999-9999', { placeholder: '_', showMaskOnHover: false });
    $maskedInput.find('.celular').inputmask('(99) 9.9999-9999', { placeholder: '_', showMaskOnHover: false });
    $maskedInput.find('.cpf').inputmask('999.999.999-99', { placeholder: '___.___.___-__' , showMaskOnHover: false});
    $maskedInput.find('.email').inputmask({ alias: "email" , showMaskOnHover: false});
    $maskedInput.find('.cnpj').inputmask('99.999.999/9999-99', { placeholder: '_', showMaskOnHover: false });
    $maskedInput.find('.cep').inputmask('99999-999', { placeholder: '_', showMaskOnHover: false });
    $maskedInput.find('.dinheiro').inputmask('decimal', {
                'alias': 'numeric',
                'groupSeparator': ',',
                'autoGroup': true,
                'digits': 2,
                'radixPoint': ".",
                'digitsOptional': false,
                'allowMinus': false,
                'prefix': 'R$ ',
                'placeholder': ''
    });
});
</script>
