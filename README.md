# Webfit- Um site para academia
## Sobre o site

O WebFit foi pensado inicialmente para a matéria de Análise e Projeto de Sistemas, e consiste em um site que é utilizado pelos clientes de uma academia fictícia. É possível se cadastrar/fazer login e então acessar a funcionalidade de realizar check-in na academia e com isso agendar as atividades que serão realizadas no dia. A academia não limita a quantidade de atividades que o usuário faz por dia, nem quantas vezes essa atividade é repetida durante a semana.

## O site possui as seguintes pastas:

| Pastas        | Descrição           |
| ------------- |:-------------:|
| CSS   | Contém todos os arquivos css do site |
| Img      | Contém todas as imagens     |  
| Js | Contém todos os arquivos JavaScript    |   
| Php | Possui alguns arquivos php que não são os principais, apenas conexões com o banco e arquivos auxiliares  | 
| Arquivos soltos | Principais arquivos do site  | 

## Como o banco de dados funciona

* Antes de tudo, é necessário fazer um cadastro com nome, CPF, endereço, email e senha.

* Após o cadastro deve-se fazer o login.

* Somente assim é possível ter acesso ao painel de atividades, que é onde pode-se adicionar as atividades da semana.

* As atividades são armazenadas no banco, e é possível removê-las.

* Na tela de perfil é possível visualizar as informações de nome, cpf, email e endereço cadastradas e alterar a senha.

* Não é possivel fazer login sem antes ter feito um cadastro, e não é possível acessar o agendamento de atividades sem estar logado.

* Se deslogar, o usuário retorna a página de boas vindas aos visitantes.

### Informações adicionais

* É conferido o CPF para ser válido

* As senhas são armazenadas com criptografia md5 e não podem ser visualizadas por motivos de segurança

* Existem duas tabelas no banco de dados e elas se relacionam (Users, Atividades)

* Os arrays superglobais $_SERVER, $_COOKIE, $_SESSION, $_GET, $_POST foram todos utilizados na confecção do site

* No início de cada página é realizada uma verificação de login do usuário, contribuindo para a segurança do site

### Imagem que mostra as atividades semanais de um usuário
![image](https://user-images.githubusercontent.com/49680911/166856015-9ff2c19b-f179-4e9d-af5b-e0be064634ef.png)

## O CSS

* Foi utilizado bootstrap 3 para realização do CSS.

* Alguns arquivos possuem a tag <style>, pois não estavam diretamente ligados a um arquivo próprio de CSS, mas o layout geral das páginas foi feito em um arquivo separado.

## O JavaScript

* Os arquivos JS são destinados a validação dos dados de formulário de cadastro, login e alterações no perfil, afim de assegurar a integridade do banco e a inserção de todos os campos obrigatoriamente.

## O PHP

* Na pasta de arquivos php encontram-se tanto arquivos para validação de formulários, autenticação em banco de dados, autenticação de usuários, quanto alguns arquivos auxiliares para o funcionamento e apresentação de outras páginas. 

* O PHP foi utilizado para a "escapada" de conteúdo de acordo com o status de login do usuário, para a validação de campos de formulário e informações recebidas via GET e POST, para a validação e criptografia de dados de senha dos usuários com comunicação via banco de dados, para a atualização, remoção e inserção de dados em banco de dados e para a autenticação de sessão de usuário.

* Foram utilizados cookies no painel de atividades para a realização das inserções.

## O MySQL

* O MySQL foi utilizado em conjunto com o PHP por meio da biblioteca mysqli, foram criadas duas tabelas:

* A tabela Users contém informações do usuário, id, nome, cpf, endereço, e-mail, senha, data de registro, data da última modificação das informações e uma variável booleana que indica se o usuário é admin ou não.

* A tabela Atividades contém informações das atividades por usuário, visto que tem como chave estrangeira (Foreign Key) o campo id da tabela Users, a tabela contém o id da atividade, o nome da atividade, o dia da semana referente à atividade e a referência ao id do usuário.

### Para acessar o site
  Só é necessário alterar o arquivo 'database_credentials.php' inserindo suas informações de banco de dados
  ```php
  <?php
    $username = ""; (seu usuário)
    $database_password = ""; (sua senha)
?>
  ```
  
  ## Equipe:
  ### Geovanna Alberti Correia de Freitas GRR20210548
  ### Guilherme Penna Moro GRR20211633
  ### Gianluca Notari Magnabosco GRR20211621
