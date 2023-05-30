<?php 
include('protect.php');
include('conexao.php');
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <!-- Meta tags Obrigatórias -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
    integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
  <link rel="stylesheet" href="css/style.css">

  <link rel="stylesheet" href="Assets/Css/usuario.css">
  
  <link rel="icon" href="Assets/Img/Icone.png" type="image/png">

  <title>Usuário</title>
</head>

<body>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#"></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#conteudoNavbarSuportado"
      aria-controls="conteudoNavbarSuportado" aria-expanded="false" aria-label="Alterna navegação">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="conteudoNavbarSuportado">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
          <a class="nav-link " href="http://localhost/Projeto Integrador/perfil.php">Inicio <span
              class="sr-only">(página atual)</span></a>
        </li>

        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
            aria-haspopup="true" aria-expanded="false">
            Vagas
          </a>

          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="file:///D:/Projeto%20Cadastro/Tela%20Cdastro/index.php">Disponiveis</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="file:///D:/Projeto%20Cadastro/Tela%20Cdastro/index.php">Minhas vagas</a>
            <div class="dropdown-divider"></div>
          </div>
        </li>

        <li class="nav-item ">
          <a class="nav-link" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true"
            aria-expanded="false">
            Agendamentos
          </a>
        </li>

      </ul>
      
      Bem vindo(a), <?php echo $_SESSION['nome']; ?>.

    </div>
  </nav>


  <div class="container mt-5">
    <h1>Vagas para você:</h1>

  </div>


  <script>
    $(document).ready(function () {
      // Obter o JSON armazenado no localStorage
      var jsonData = JSON.parse(localStorage.getItem('jsonData'));

      console.log(jsonData);
      // Preencher as informações no HTML
      jsonData.forEach(function (vaga) {
        // Criar um novo card
        var card = $('<div class="card"></div>');

        // Criar o conteúdo do card
        var cardBody = $('<div class="card-body"></div>');
        cardBody.append('<h5 class="card-title">' + vaga.titulo + '</h5>');
        cardBody.append('<h5 class="card-subtitle mb-2" id="empresa">' + vaga.empresa + '</h5>');

        // Criar a descrição com limite de palavras
        var descricao = $('<p class="card-text" id="descricao">' + vaga.descricao + '</p>');
        var limitePalavras = 5;

        // Verificar se a descrição excede o limite de palavras
        var palavras = descricao.text().trim().split(' ');
        if (palavras.length > limitePalavras) {
          var descricaoResumida = palavras.slice(0, limitePalavras).join(' ');
          descricao.html(descricaoResumida + '... ');
          var lerMais = $('<button class="btn btn-link">Ler mais</button>');
          descricao.append(lerMais);

          lerMais.click(function () {
            descricao.html(vaga.descricao);
          });
        }

        cardBody.append(descricao);
        cardBody.append('<div class="subtitle-card"></div>');
        cardBody.append('<h6 class="card-subtitle mb-2 text-muted" id="salario" name="salario">' + vaga.salario + '</h6>');
        cardBody.append('<h6 class="card-subtitle mb-2 text-muted" id="tipo_trabalho">' + vaga.tipo_trabalho + '</h6>');
        cardBody.append('<h6 class="card-subtitle mb-2 text-muted" id="experiencia">' + vaga.experiencia_desejada + '</h6>');
        cardBody.append('<a href="https://www.infojobs.com.br/" class="card-text_redirecionar"><H5>+</H5></a>');

        card.append(cardBody);
        $('.container').append(card);
      });

      // Limpar o JSON armazenado no localStorage
      localStorage.removeItem('jsonData');
    });
  </script>

  <!-- JavaScript (Opcional) -->
  <!-- jQuery primeiro, depois Popper.js, depois Bootstrap JS -->

  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
    integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
    crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"
    integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy"
    crossorigin="anonymous"></script>
</body>







  <!-- JavaScript (Opcional) -->
  <!-- jQuery primeiro, depois Popper.js, depois Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
    integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
    crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
    integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
    crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"
    integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy"
    crossorigin="anonymous"></script>
</body>

</html>