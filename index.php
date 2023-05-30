<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <!-- Meta tags Obrigatórias -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <link rel="stylesheet" href="Assets/Css/index.css">

    <link rel="icon" href="Assets/Img/Icone.png" type="image/png">

    <title>Empregados.com</title>
  </head>
  <body>

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#"></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#conteudoNavbarSuportado" aria-controls="conteudoNavbarSuportado" aria-expanded="false" aria-label="Alterna navegação">
          <span class="navbar-toggler-icon"></span>
        </button>
      
        <div class="collapse navbar-collapse" id="conteudoNavbarSuportado">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
              <a class="nav-link " href="C:\xampp\htdocs\Projeto Integrador\index.php">Inicio <span class="sr-only">(página atual)</span></a>
            </li>
            
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Candidato
              </a>
              
              <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="file:///C:/Users/vitor.moscardi/Downloads/Projeto%20Integrador/Vagas.html">Vagas</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#">Empresas</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#">Anunciar Curriculo</a>
              </div>
            </li>

            <li class="nav-item ">
              <a class="nav-link" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Duvidas
              </a>
            </li>

          </ul>
          <div class="form-inline my-2 my-lg-0" id="cadastro" style="width: auto; display: flex;">
            <a href="http://localhost/Projeto Integrador/cadastro.php"> <button class="btn btn-outline-dark" type="submit" >Cadastre-se </button>
            </a>
          </div>

          <div class="form-inline my-2 my-lg-0" id="login" style="width: auto; margin: 0.5rem;">
            <a href="http://localhost/Projeto Integrador/login.php">
              <button class="btn btn-outline-dark" type="submit" >Login </button>
            </a>
          </div>
        </div> 
      </nav>

      <div class="container-fluid" style="background-image: url(Assets/Img/home.jpg)">

        <div class="card mb-3" >
          <div class="card-body">
            <h5 class="card-title" style="font-size: 28px;">Encontre as Melhores Vagas de Emprego</h5>
            <p class="card-text" style="align-items: center;">Digite um Cargo, Cidade ou Estado:</p>
            <div class="input-group mb-3">
              <input class="form-control" type="search" placeholder="Pesquisar Vagas" id="pesquisa" name="pesquisa" aria-label="Pesquisar" style="background-color: #F0F0F0;">
              <div class="input-group-append">
                <button class="btn btn-default" type="button" id = pesquise name="pesquise">Pesquise</button>
              </div>
            </div>
          </div>
        </div>
        
      </div>
      

      <div class="container-divider">
        <hr class="divider--dark" />
      </div>

      <section class="topicos">

        <div class="topicos_container">


            <ul class="topicos_list">

              <div class="container_topicos_item_1">
                <div class="icone-topicos_item_1">
                  <img src="Assets/Img/icone _topico_1_home.png" alt="">
                </div>
                  <li class="topicos_item"  id="topicos_item_1" >
                      <div>
                          <h3>Encontre Vaga de todos os lugares em Um só</h3>
                          <p class="hide--mobile">Facilitamos sua busca, trazemos oportunidades de varios sites e lugares em um só. Evitando eventuais perdas de vagas e otimizando seu tempo.</p>
                      </div>
                  </li>
              </div>

              
                <li class="topicos_item" id="topicos_item_2">
                    <div>
                        <h3>Vagas de emprego para todos os perfis</h3>
                        <p class="hide--mobile">Estamos em todo o Brasil, com oportunidades para diversas áreas. Além disso, não importa se é seu primeiro emprego ou se você já tem uma carreira sólida. Divulgamos vagas de trabalho para todos os níveis.</p>
                    </div>
                </li>

                
                <li class="topicos_item"  id="topicos_item_3">
                    <div>
                        <h3>Plataforma de emprego gratuita</h3>
                        <p class="hide--mobile">Funciona assim: as empresas contratam nossa plataforma de emprego para conduzir processos seletivos. Quem paga pelo serviço são elas, então você não precisa se preocupar.</p>
                    </div>
                </li>
            </ul>
        </div>
    </section>

      <div class="container-divider">
        <hr class="divider--dark" />
      </div>

      <footer>
        <div class="container">
          <div class="col">
            <h3>Sobre</h3>
            <p>Bem-vindo a Empregando!, somos uma inovadora empresa dedicada à captação de vagas de emprego. Em um mundo em constante evolução e com um mercado de trabalho cada vez mais competitivo, acreditamos que o acesso a oportunidades de emprego é fundamental para o desenvolvimento pessoal e profissional de indivíduos talentosos em todo o mundo. Nossa missão é conectar candidatos qualificados a empregadores em busca de talento, fornecendo um ambiente eficiente e confiável para a busca de emprego.</p>
          </div>
          
          <div class="col">
            <h3>Categorias populares</h3>
            <ul>
              <li><a href="#">Vgas</a></li>
              <li><a href="#">Empresas</a></li>
              <li><a href="#">Anunciar Curriculo</a></li>
              <li><a href="#">Dúvidas</a></li>
            </ul>
          </div>
          
          <div class="col">
            <h3>Contato</h3>
            <ul>
              <li><i class="fas fa-envelope"></i> empregando@empregos.com.br</li>
              <li><i class="fas fa-phone"></i> (19) 98138-7805</li>
              <li><i class="fas fa-map-marker-alt"></i> Av. de Cillos, 3500</li>
            </ul>
          </div>
        </div>
        
        <div class="bottom">
          <p>Direitos autorais © 2023 - Empregando</p>
        </div>
      </footer>
      

      <script>
        $(document).ready(function(){
            $("#pesquise").on("click", function(){
                $value = $("#pesquisa").val();
                $msg = '<div class="user-inbox inbox"><div class="msg-header"><p>'+ $value +'</p></div></div>';
                $(".form-control").append($msg);
                $("#pesquisa").val('');
                
                // start ajax code
                $.ajax({
                    url: `http://127.0.0.1:5000/get/${$value}`,
                    type: 'GET',
                    headers:{
                        'Content-Type':'application/json'
                    },
 //                   data: $value,
                    success: function(response){
                    var jsonData = JSON.parse(response);
                    console.log(jsonData);

                    localStorage.setItem('jsonData', JSON.stringify(jsonData));

                    window.location.href = "Vagas.html";                    
                    }
                });
            });
        });
    </script>

    <!-- JavaScript (Opcional) -->
    <!-- jQuery primeiro, depois Popper.js, depois Bootstrap JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  </body>
</html>