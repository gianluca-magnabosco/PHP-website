$(function() {
    $('#formulario').on('submit', function(e) {

      password_input = $("input[name='password']");
      confirm_password_input = $("input[name='confirm_password']");

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
  