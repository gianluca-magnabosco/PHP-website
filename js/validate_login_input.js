$(function() {
    $('#login').on('submit', function() {

      email_input = $("input[name='email']");
      password_input = $("input[name='password']");

  
      if (email_input.val() == '' || email_input.val() == null) {
        $('#erro-email').html('O email é obrigatório');
        return false;
      }
  
      if (password_input.val() == '' || password_input.val() == null) {
        $('#erro-senha').html('A senha é obrigatória');
        return false;
      }
  
      return true;
    });
  });
  