$(function() {
    $('#cadastro').on('submit', function(e) {

      name_input = $("input[name='name']");
      cpf_input = $("input[name='cpf']");
      endereco_input = $("input[name='endereco']");
      email_input = $("input[name='email']");
      confirm_email_input = $("input[name='confirm_email']");
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
  
      if (endereco_input.val() == '' || endereco_input.val() == null) {
        $('#erro-endereco').html('O endereço é obrigatório');
        return false;
      }

      if (email_input.val() == '' || email_input.val() == null) {
        $('#erro-email').html('O e-mail é obrigatório');
        return false;
      }

      if (confirm_email_input.val() == '' || confirm_email_input.val() == null) {
        $('#erro-confirm_email').html('A confirmação de e-mail é obrigatória');
        return false;
      }

      if (password_input.val() == '' || password_input.val() == null) {
        $('#erro-password').html('A senha é obrigatória');
        return false;
      }

      if (confirm_password_input.val() == '' || confirm_password_input.val() == null) {
        $('#erro-confirm_password').html('A confirmação da senha é obrigatória');
        return false;
      }

      if (email_input.val() != confirm_email_input.val()) {
        $('#erro-confirm_email').html('Os e-mails não coincidem!');
        return false;
      }

      if (password_input.val() != confirm_password_input.val()) {
        $('#erro-confirm_password').html('As senhas não coincidem!');
        return false;
      }

      return true;
    });
  });
  