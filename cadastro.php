<?php

$erro = '';

if (isset($_POST['submit'])) {


    if ($_POST['email'] != $_POST['email_confirma']) {
        // Os campos de email não correspondem, definir a mensagem de erro
        $erro = "Os campos de email não correspondem. Por favor, verifique novamente.";
    } elseif ($_POST['senha'] != $_POST['senha_confirma']) {
        // Os campos de senha não correspondem, definir a mensagem de erro
        $erro = "Os campos de senha não correspondem. Por favor, verifique novamente.";
    } else {
        // Campos de email correspondem, continuar com o restante do código

    include_once('conexao.php');

    $nome = $_POST['nome'];
    $sobrenome = $_POST['sobrenome'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];
   

    $result = mysqli_query($con, "INSERT INTO usuarios(nome,sobrenome,email,senha) 
        VALUES ('$nome','$sobrenome','$email','$senha')");

    header('Location: perfil.php');
    }
}
?>

<?php if (!empty($erro)): ?>
    <div class="alert alert-danger"><?php echo $erro; ?></div>
<?php endif; ?>



<!DOCTYPE html>
<html lang="pt-br">
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
    <link rel="stylesheet" href="Assets/Css/cadastro.css">

    <title>Cadastro</title>
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
                        href="file:///C:/Users/vitor.moscardi/Downloads/Projeto%20Integrador/Home.html?#">Inicio
                        <span class="sr-only">(página atual)</span></a>
                </li>
            </ul>
        </div>

    </nav>


    <div class="container-fluid">
        <div class="row justify-content-center align-items-center vh-100">
            <div class="col-12 col-sm-10 col-md-8 col-lg-6 mx-auto">
                <h1 class="text-center mb-4">Cadastro</h1>
                <form class="form-container" method="POST">

                    <div class="form-group d-flex flex-column justify-content-center mb-3">
                        <label for="nome">Primeiro nome:</label>
                        <input type="text" class="form-control" name="nome" id="nome" required>
                    </div>

                    <div class="form-group d-flex flex-column justify-content-center mb-3">
                        <label for="sobrenome">Segundo nome:</label>
                        <input type="text" class="form-control" name="sobrenome" id="sobrenome" required>
                    </div>

                    <div class="form-group d-flex flex-column justify-content-center mb-3 mt-3">
                        <label for="email">E-mail:</label>
                        <input type="email" class="form-control" name="email" id="email" required>
                    </div>

                    <div class="form-group d-flex flex-column justify-content-center mb-3 mt-3">
                        <label for="email">Confirme seu email:</label>
                        <input type="email" class="form-control" name="email_confirma" id="email_confirma" required>
                    </div>

                    <div class="form-group d-flex flex-column justify-content-center mb-3">
                        <label for="senha">Senha:</label>
                        <input type="password" class="form-control" name="senha" id="senha" required>
                    </div>

                    <div class="form-group d-flex flex-column justify-content-center mb-3">
                        <label for="senha">Confirme sua senha:</label>
                        <input type="password" class="form-control" name="senha_confirma" id="senha_confirma" required>
                    </div>


                    <div class="form-group text-center">
                        <a href="http://localhost/Projeto Integrador/perfil.php"><button
                                type="submit" class="btn btn-primary btn-block btn-lg" id = "submit" name="submit"
                                style="background-color: #ffd863; border-color: black;">Continuar</button>
                        </a>
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