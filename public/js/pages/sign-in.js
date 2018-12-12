$(function () {
    $('#sign_in').validate({
      rules : {
            email:{
                   required:true,
                   email: true
            },
            password:{
                   required:true
            }
      },
      messages:{
            email:{
                   required:"É necessário informar um e-mail",
                   email: "Endereço de e-mail inválido"
            },
            password:{
                   required:"Campo de preenchimento obrigatório"
            }
      },
      errorPlacement: function (error, element) {
          $(element).parents('.input-group').append(error);
      }
    });
});
