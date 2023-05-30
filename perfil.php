<?php
include('protect.php');
include_once('conexao.php');





if(isset($_POST['submits'])) {
  $id_usuario = $_POST['id_usuario'];
  $escolaridade = $_POST['escolaridade'];
  $curso = $_POST['curso'];
  $experiencias = $_POST['experiencias'];
  $email_usuario = $_POST['email_usuario'];
  $celular = $_POST['celular'];
  $endereco = $_POST['endereco'];
  $estado = $_POST['estado'];
  $cidade = $_POST['cidade'];
  $faixa_salario = $_POST['faixa_salario'];
  $cargo = $_POST['cargo'];

  $result = mysqli_query($con, "INSERT INTO perfil_usuario (id_usuario, escolaridade, curso, experiencias, email_usuario, celular, endereco, estado, cidade, faixa_salario, cargo) 
      VALUES ('$id_usuario', '$escolaridade', '$curso', '$experiencias', '$email_usuario', '$celular', '$endereco', '$estado', '$cidade', '$faixa_salario', '$cargo')");

  header('Location: usuario.php');
  exit();
}


if (!isset($_SESSION['email']) || !isset($_SESSION['senha'])) {
  header('Location: login.php');
  exit();
}

$logado = $_SESSION['email'];

if (!empty($_GET['search'])) {  
  $data = $_GET['search'];
  $sql = "SELECT * FROM usuarios WHERE id LIKE '%$data%' or nome LIKE '%$data%' or email LIKE '%$data%' ORDER BY id DESC";
} else {
  $sql = "SELECT * FROM usuarios ORDER BY id DESC";
}

$result = $con->query($sql);


?>

<!doctype html>
<html lang="pt-br">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <link rel="icon" href="../../../../favicon.ico">

  <title>CadastroPerfil</title>

  <!-- Principal CSS do Bootstrap -->
  <link href="Assets/Css/CadastroVaga.css" rel="stylesheet">

  <!-- Estilos customizados para esse template -->
  <link href="Assets/Css/CadastroVaga.css" rel="stylesheet">
</head>

<body class="bg-light">
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
            Consultar
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="http://localhost/Projeto Integrador/consultar_vaga.php">Vaga</a>
            <a class="dropdown-item" href="http://localhost/Projeto Integrador/consultar_curriculo.php">Currículo</a>
            <a class="dropdown-item" href="http://localhost/Projeto Integrador/consultar_usuario.php">Usuário</a>
          </div>
        </li>

        <li class="nav-item">
          <a class="nav-link " href="http://localhost/Projeto Integrador/sobre.php">Sobre</a>
        </li>
      </ul>
      Bem vindo(a), <?php echo $_SESSION['nome']; ?>.

    </div>
  </nav>

  <div class="form_perfil mr-auto " style="background-color: white;">


  <div class="container">
    <div class="py-5 text-center">
      <h2>Formulário para Perfil de Vaga</h2>
      <p class="lead">Preencha o formulário abaixo para cadastrar o perfil de usuário.</p>
    </div>

    <div class="row">
      <div class="col-md-8 order-md-1">
        <h4 class="mb-3">Dados do Perfil</h4>
        <form class="needs-validation" novalidate method="POST" action="">
          <div class="row">
            <div class="col-md-6 mb-3">
              
            <?php 
               while ($user_data = mysqli_fetch_assoc($result)) {
                 echo '<input type="hidden" name="id_usuario" value="' . $user_data['id'] . '">';
               }
            ?>
                      

              <div class="invalid-feedback">
                É obrigatório inserir o ID.
              </div>
            </div>
            <div class="col-md-6 mb-3">
              <label for="escolaridade">Escolaridade</label>
              <select class="form-control" id="escolaridade" name="escolaridade" required>
                <option value="ensino-medio-completo">Ensino médio completo</option>
                <option value="ensino-medio-incompleto">Ensino médio incompleto</option>
                <option value="ensino-superior">Ensino superior</option>
              </select>
              <div class="invalid-feedback">
                É obrigatório inserir a escolaridade.
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-6 mb-3">
              <label for="curso">Curso</label>
              <select class="form-control" id="curso" name="curso" required>
              <option value="ensino-superior"> Administração </option>
                <option value="ensino-superior"> Administração Pública </option>
                <option value="ensino-superior"> Agroecologia </option>
                <option value="ensino-superior"> Agronegócio </option>
                <option value="ensino-superior"> Agronomia </option>
                <option value="ensino-superior"> Análise de Sistemas </option>
                <option value="ensino-superior"> Antropologia </option>
                <option value="ensino-superior"> Arquitetura e Urbanismo </option>
                <option value="ensino-superior"> Arquivologia </option>
                <option value="ensino-superior"> Artes </option>
                <option value="ensino-superior"> Artes Cênicas </option>
                <option value="ensino-superior"> Astronomia </option>
                <option value="ensino-superior"> Biblioteconomia </option>
                <option value="ensino-superior"> Biologia </option>
                <option value="ensino-superior"> Biomedicina </option>
                <option value="ensino-superior"> Bioquímica </option>
                <option value="ensino-superior"> Canto </option>
                <option value="ensino-superior"> Cenografia </option>
                <option value="ensino-superior"> Ciência da Computação </option>
                <option value="ensino-superior"> Ciências Biológicas </option>
                <option value="ensino-superior"> Ciências Contábeis </option>
                <option value="ensino-superior"> Ciências Econômicas </option>
                <option value="ensino-superior"> Ciências Sociais </option>
                <option value="ensino-superior"> Cinema e Audiovisual </option>
                <option value="ensino-superior"> Composição e Regência </option>
                <option value="ensino-superior"> Computação </option>
                <option value="ensino-superior"> Comunicação e Marketing </option>
                <option value="ensino-superior"> Comunicação Social </option>
                <option value="ensino-superior"> Desenho Industrial </option>
                <option value="ensino-superior"> Design </option>
                <option value="ensino-superior"> Design de Ambientes </option>
                <option value="ensino-superior"> Design de Games </option>
                <option value="ensino-superior"> Design de Interiores </option>
                <option value="ensino-superior"> Design de Moda </option>
                <option value="ensino-superior"> Design de Produto </option>
                <option value="ensino-superior"> Design Digital </option>
                <option value="ensino-superior"> Design Gráfico </option>
                <option value="ensino-superior"> Direção </option>
                <option value="ensino-superior"> Direito </option>
                <option value="ensino-superior"> Educação Física </option>
                <option value="ensino-superior"> Enfermagem </option>
                <option value="ensino-superior"> Engenharia Acústica </option>
                <option value="ensino-superior"> Engenharia Aeroespacial </option>
                <option value="ensino-superior"> Engenharia Aeronáutica </option>
                <option value="ensino-superior"> Engenharia Agrícola </option>
                <option value="ensino-superior"> Engenharia Agroindustrial </option>
                <option value="ensino-superior"> Engenharia Agronômica </option>
                <option value="ensino-superior"> Engenharia Ambiental </option>
                <option value="ensino-superior"> Engenharia Automotiva </option>
                <option value="ensino-superior"> Engenharia Bioenergética </option>
                <option value="ensino-superior"> Engenharia Biomédica </option>
                <option value="ensino-superior"> Engenharia Bioquímica </option>
                <option value="ensino-superior"> Engenharia Biotecnológica </option>
                <option value="ensino-superior"> Engenharia Cartográfica </option>
                <option value="ensino-superior"> Engenharia Civil </option>
                <option value="ensino-superior"> Engenharia da Computação </option>
                <option value="ensino-superior"> Engenharia da Mobilidade </option>
                <option value="ensino-superior"> Engenharia de Agrimensura </option>
                <option value="ensino-superior"> Engenharia de Agronegócios </option>
                <option value="ensino-superior"> Engenharia de Alimentos </option>
                <option value="ensino-superior"> Engenharia de Aquicultura </option>
                <option value="ensino-superior"> Engenharia de Automação </option>
                <option value="ensino-superior"> Engenharia de Bioprocessos </option>
                <option value="ensino-superior"> Engenharia de Biossistemas </option>
                <option value="ensino-superior"> Engenharia de Biotecnologia </option>
                <option value="ensino-superior"> Engenharia de Energia </option>
                <option value="ensino-superior"> Engenharia de Gestão </option>
                <option value="ensino-superior"> Engenharia de Informação </option>
                <option value="ensino-superior"> Engenharia de Instrumentação, Automação e Robótica </option>
                <option value="ensino-superior"> Engenharia de Manufatura </option>
                <option value="ensino-superior"> Engenharia de Materiais </option>
                <option value="ensino-superior"> Engenharia de Minas </option>
                <option value="ensino-superior"> Engenharia de Pesca </option>
                <option value="ensino-superior"> Engenharia de Petróleo </option>
                <option value="ensino-superior"> Engenharia de Produção </option>
                <option value="ensino-superior"> Engenharia de Recursos Hídricos </option>
                <option value="ensino-superior"> Engenharia de Saúde e Segurança </option>
                <option value="ensino-superior"> Engenharia de Sistemas </option>
                <option value="ensino-superior"> Engenharia de Software </option>
                <option value="ensino-superior"> Engenharia de Telecomunicações </option>
                <option value="ensino-superior"> Engenharia de Transporte e Logística </option>
                <option value="ensino-superior"> Engenharia Elétrica </option>
                <option value="ensino-superior"> Engenharia Eletrônica </option>
                <option value="ensino-superior"> Engenharia em Sistemas Digitais </option>
                <option value="ensino-superior"> Engenharia Ferroviária e Metroviária </option>
                <option value="ensino-superior"> Engenharia Física </option>
                <option value="ensino-superior"> Engenharia Florestal </option>
                <option value="ensino-superior"> Engenharia Geológica </option>
                <option value="ensino-superior"> Engenharia Hídrica </option>
                <option value="ensino-superior"> Engenharia Industrial </option>
                <option value="ensino-superior"> Engenharia Mecânica </option>
                <option value="ensino-superior"> Engenharia Mecatrônica </option>
                <option value="ensino-superior"> Engenharia Metalúrgica </option>
                <option value="ensino-superior"> Engenharia Naval </option>
                <option value="ensino-superior"> Engenharia Química </option>
                <option value="ensino-superior"> Engenharia Têxtil </option>
                <option value="ensino-superior"> Estatística </option>
                <option value="ensino-superior"> Farmácia </option>
                <option value="ensino-superior"> Filosofia </option>
                <option value="ensino-superior"> Física </option>
                <option value="ensino-superior"> Fisioterapia </option>
                <option value="ensino-superior"> Fonoaudiologia </option>
                <option value="ensino-superior"> Geografia </option>
                <option value="ensino-superior"> Gestão Ambiental </option>
                <option value="ensino-superior"> Gestão da Informação </option>
                <option value="ensino-superior"> Gestão de Políticas Públicas </option>
                <option value="ensino-superior"> Gestão de Serviços de Saúde </option>
                <option value="ensino-superior"> Gestão do Agronegócio </option>
                <option value="ensino-superior"> Gestão Pública </option>
                <option value="ensino-superior"> História </option>
                <option value="ensino-superior"> Hotelaria </option>
                <option value="ensino-superior"> Jornalismo </option>
                <option value="ensino-superior"> Letras </option>
                <option value="ensino-superior"> Marketing </option>
                <option value="ensino-superior"> Matemática </option>
                <option value="ensino-superior"> Mecânica Industrial </option>
                <option value="ensino-superior"> Medicina </option>
                <option value="ensino-superior"> Medicina Veterinária </option>
                <option value="ensino-superior"> Moda </option>
                <option value="ensino-superior"> Música </option>
                <option value="ensino-superior"> Nutrição </option>
                <option value="ensino-superior"> Odontologia </option>
                <option value="ensino-superior"> Pedagogia </option>
                <option value="ensino-superior"> Políticas Públicas </option>
                <option value="ensino-superior"> Propaganda e Marketing </option>
                <option value="ensino-superior"> Psicologia </option>
                <option value="ensino-superior"> Publicidade e Propaganda </option>
                <option value="ensino-superior"> Química </option>
                <option value="ensino-superior"> Rádio, TV e Internet </option>
                <option value="ensino-superior"> Relações Internacionais </option>
                <option value="ensino-superior"> Relações Públicas </option>
                <option value="ensino-superior"> Secretariado Executivo </option>
                <option value="ensino-superior"> Serviço Social </option>
                <option value="ensino-superior"> Sistemas de Informação </option>
                <option value="ensino-superior"> Tecnologias Digitais </option>
                <option value="ensino-superior"> Teologia </option>
                <option value="ensino-superior"> Terapia Ocupacional </option>
                <option value="ensino-superior"> Tradutor e Intérprete </option>
                <option value="ensino-superior"> Turismo </option>
                <option value="ensino-superior"> Zootecnia </option>
              </select>
              <div class="invalid-feedback">
                É obrigatório inserir o curso.
              </div>
            </div>
            <div class="form-group mb-3">
          <label for="curriculo">Digite suas exeperiências e competências:</label>
          <textarea class="form-control" id="experiencias" rows="8" name="experiencias"></textarea>
        </div>

          </div>

          <div class="row">
            <div class="col-md-6 mb-3">
              <label for="email_usuario">E-mail</label>
              <input type="email" class="form-control" id="email_usuario" name="email_usuario" required>
              <div class="invalid-feedback">
                É obrigatório inserir um e-mail válido.
              </div>
            </div>
            <div class="col-md-6 mb-3">
              <label for="celular">Celular</label>
              <input type="text" class="form-control" id="celular" name="celular" required>
              <div class="invalid-feedback">
                É obrigatório inserir o número de celular.
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-6 mb-3">
              <label for="endereco">Endereço</label>
              <input type="text" class="form-control" id="endereco" name="endereco" required>
              <div class="invalid-feedback">
                É obrigatório inserir o endereço.
              </div>
            </div>
            
          <div class="row">
            <div class="col-md-6 mb-3">
              <label for="estado">Estado</label>
              <input type="text" class="form-control" id="estado" name="estado" required>
              <div class="invalid-feedback">
                É obrigatório inserir o estado.
              </div>
            </div>
            <div class="col-md-6 mb-3">
              <label for="cidade">Cidade</label>
              <input type="text" class="form-control" id="cidade" name="cidade" required>
              <div class="invalid-feedback">
                É obrigatório inserir a cidade.
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-6 mb-3">
              <label for="faixa_salario">Faixa Salarial</label>
              <select class="form-control" id="faixa_salario" name="faixa_salario" required>
              <option value="">Escolha...</option>
                <option value="1000-2000">1000 - 2000</option>
                <option value="2000-3000">2000 - 3000</option>
                <option value="3000-4000">3000 - 4000</option>
                <option value="4000-5000">4000 - 5000</option> 
                <option value="5000-6000">5000 - 6000</option>
                <option value="6000-7000">6000 - 7000</option>
                <option value="7000-8000">7000 - 8000</option> 
                <option value="8000-9000">8000 - 9000</option>
                <option value="9000-10000">9000 - 10000</option>
                <option value="10000-15000">10000 - 15000</option>
                <option value="A combinar">A combinar</option>
               </select>             
              <div class="invalid-feedback">
                É obrigatório inserir a faixa salarial.
              </div>
            </div>
            <div class="col-md-6 mb-3">
              <label for="cargo">Cargo</label>
              <input type="text" class="form-control" id="cargo" name="cargo" required>
              <div class="invalid-feedback">
                É obrigatório inserir o cargo.
              </div>
            </div>
          </div>

          <hr class="mb-4">
          <button class="btn btn-primary btn-lg btn-block" type="submit" name="submits">Cadastrar</button>
        </form>
      </div>
    </div>


  </div>

  <!-- JavaScript do Bootstrap e dependências -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
    integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"
    integrity="sha384-q7g8LEvGzWLAJg7eCfMz8A3sjgwRqRYHzs5hrVrxEISqm9B0ewMvmU7TfPO2rwAz"
    crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"
    integrity="sha384-pzjw8f+ua7qcal4ifwnaq5/Dy033/d8g0pa3DK+dLz5Lsl9E+TxCE1o2A2NpC" 
    crossorigin="anonymous"></script>
  <script src="Assets/Js/CadastroVaga.js"></script>
</body>
</html>
