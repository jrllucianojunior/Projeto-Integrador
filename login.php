


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
        integrity="sha512-5LTi9lBRH5vVHvC+HVT8fNnsjyHsSgGqivZmRifdEIbh9C8rdNSpOWldqPQ8tuJXeUypRJ9BZw21grW8yjzJjw=="
        crossorigin="anonymous" />

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="Assets/Css/login.css">

    <link rel="icon" href="Assets/Img/Icone.png" type="image/png">

    <title>Login</title>
</head>

<body style="background-image: url(Assets/Img/fundo_login.jpg)">

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#"></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#conteudoNavbarSuportado"
            aria-controls="conteudoNavbarSuportado" aria-expanded="false" aria-label="Alterna navegação">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="conteudoNavbarSuportado">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link "
                        href="http://localhost/Projeto Integrador/index.php">Inicio
                        <span class="sr-only">(página atual)</span></a>
                </li>
            </ul>

            <div class="form-inline my-2 my-lg-0" style="width: auto; display: flex; position: absolute; right: 2%;">
                <a href="http://localhost/Projeto Integrador/cadastro.php"> <button
                        class="btn btn-outline-dark" type="submit">Cadastre-se </button>
                </a>
            </div>
        </div>

    </nav>


    <div class="container-fluid">
        <div class="row justify-content-center align-items-center vh-100">
          <div class="col-12 col-sm-10 col-md-8 col-lg-6 mx-auto">
            <h1 class="text-center mb-4">Entrada</h1>
            <form class="form-container" action="testeLogin.php" method="POST">
              <div class="form-group d-flex flex-column justify-content-center mb-3 mt-4">
                <label for="email">E-mail</label>
                <input type="email" class="form-control" name="email" id="email" required>
              </div>
              <div class="form-group d-flex flex-column justify-content-center mb-5">
                <label for="senha">Senha</label>
                <input type="password" class="form-control" name="senha" id="senha" required>
              </div>
              <div class="form-group text-center">
                <button type="submit" class="btn btn-primary btn-block btn-lg" name= "entrar" style="background-color: #ffd863; border-color: black;">Entrar</button>
              </div>
              <div class="form-group text-center">
                <button type="submit" class="btn btn-secondary btn-block btn-lg" style="background-color:black; border-color: black; opacity: 0.95;">Esqueceu sua senha?</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    
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