# Webfit- Um site para academia
## Sobre o site

O WebFit foi pensado inicialmente para a matéria de Análise e Projeto de Sistemas, e consiste em um site que é utilizado pelos clientes de uma academia fictícia. É possível se cadastrar/fazer login e então acessar a funcionalidade de realizar check-in na academia e com isso agendar as atividades que serão realizadas no dia. A academia não limita a quantidade de atividades que o usuário faz por dia, nem quantas vezes essa atividade é repetida durante a semana.

## O site possui as seguintes pastas:

| Pastas        | Descrição           |
| ------------- |:-------------:|
| CSS   | Contém todos os arquivos css do site |
| Img      | Contém todas as imagens     |  
| Js | Contén todos os arquivos JavaScript    |   
| Php | Possui alguns arquivos php que não são os principais, apenas conexões com o banco e arquivos auxiliares  | 
| Arquivos soltos | Principais arquivos do site  | 

## Como o banco de dados funciona

* Antes de tudo, é necessário fazer um cadastro com nome, CPF, endereço, email e senha.

* Após o cadastro é deve-se fazer o login.

* Somente assim é possível ter acesso a pagina de usuário, que é onde pode-se adicionar as atividades da semana.

* As atividades são armazenadas no banco, e é possível removê-las.

* Na tela de perfil é possível visualizar as informações de nome, cpf, email e endereço cadastradas e alterar a senha.

* Não é possivel fazer login sem antes ter feito um cadastro, e não é possível acessar o agendamento de atividades sem estar logado.

* Se deslogar, o usuário retorna a página de boas vindas aos visitantes.

### Informações adicionais

* É conferido o CPF para ser válido

* As senhas não podem ser visualizadas por segurança

* O relacionamento do banco de dados está entre usuários e atividades semanais

### Imagem que mostra as atividades semanais de um usuário
![image](https://user-images.githubusercontent.com/49680911/166856015-9ff2c19b-f179-4e9d-af5b-e0be064634ef.png)

## O CSS

* Foi utilizado bootstrap 3 para realização do CSS.

* Alguns arquivos possuem a tag <style>, pois não estavam diretamente ligados a um arquivo próprio de CSS, mas o layout geral das páginas foi feito em um arquivo separado.

## O Java Script

* Os arquivos JS são destinados a validação dos dados de cadastro e login, afim de assegurar a integridade do banco e a inserção de todos os campos obrigatóriamente.

### Para acessar o site
  Só é necessário alterar o arquivo 'database_credentials.php' e alterar a senha do banco de dados para a do seu próprio
  ```php
  <?php
  $database_password = ""; (sua senha)
?>
  ```
  
  ## Equipe:
  ### Geovanna Alberti Correia de Freitas GRR20210548
  ### Guilherme Penna Moro GRR20211633
  ### Gianluca Notari Magnabosco GRR20211621
