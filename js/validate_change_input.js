$(function() {
    $('#formulario').on('submit', function(e) {

      name_input = $("input[name='name']");
      cpf_input = $("input[name='cpf']");
      email_input = $("input[name='email']");
      password_input = $("input[name='password']");
      confirm_password_input = $("input[name='confirm_password']");

      if (name_input.val() == '' || name_input.val() == null) {
        $('#erro-nome').html('O nome é obrigatório');
        return false;
      }
  
      if (cpf_input.val() == '' || cpf_input.val() == null) {
        $('#erro-cpf').html('O cpf é obrigatório');
        return false;
      }

      if (email_input.val() == '' || email_input.val() == null) {
        $('#erro-email').html('O e-mail é obrigatório');
        return false;
      }

      if (password_input.val() == '' || password_input.val() == null) {
        $('#erro-password').html('A senha é obrigatória');
        return false;
      }

      if (confirm_password_input.val() == '' || confirm_password_input.val() == null) {
        $('#erro-confirm_password').html('A confirmação da senha é obrigatória, insira a senha atual caso não queira alterá-la');
        return false;
      }

      return true;
    });
  });
  