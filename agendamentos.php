<?php
include('protect.php');
include('conexao.php');



if(isset($_POST['submit'])) {
    $id_usuario = $_POST['id_usuario'];
    $tarefa = $_POST['tarefa'];
    $data = $_POST['data'];
    $hora = $_POST['hora'];
  
    $result = mysqli_query($con, "INSERT INTO entrevistas(id_user,tarefa,data_entrevista, hora) 
        VALUES ('$id_usuario','$tarefa', '$data', '$hora')");
  
    header('Location: agendamentos.php');
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


<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
        integrity="sha512-5LTi9lBRH5vVHvC+HVT8fNnsjyHsSgGqivZmRifdEIbh9C8rdNSpOWldqPQ8tuJXeUypRJ9BZw21grW8yjzJjw=="
        crossorigin="anonymous" />

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <link rel="stylesheet" href="Assets/Css/agendamentos.css">
    
    <link rel="stylesheet" href="ag">

    <title>Agendamento de Tarefas</title>
    
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




  <div class="container">

    <h1>Agendamento de Tarefas</h1>
    
    <div id="calendar">
        <div class="calendar-navigation">
        <form action="/agendar" method="POST">
            
            <?php 
               while ($user_data = mysqli_fetch_assoc($result)) {
                 echo '<input type="hidden" name="id_usuario" value="' . $user_data['id'] . '">';
               }
            ?>

            <button onclick="previousMonth()">Mês Anterior</button>
            <button onclick="currentMonth()">Mês Atual: <span id="currentMonthTitle"></span></button>
        </div>
        
        <div class="form-group">
            <label for="taskInput">Agendamento:</label>
            <input type="text" id="taskInput" class="task-input" name="tarefa" placeholder="Digite uma tarefa...">
        </div>
        
        <div class="form-group">
            <label for="dateInput">Data:</label>
            <input type="date" id="dateInput" class="date-input" name="data">
        </div>
        
        <div class="form-group">
            <label for="timeInput">Hora:</label>
            <input type="time" id="timeInput" class="time-input" name="hora">
        </div>
        
        <button id="submit" class="task-button" name="submit">Agendar</button>
    
        <?php
            $id_usuario = $_POST['id_usuario'];
            $agendamentos = mysqli_query($con, "SELECT * FROM entrevistas WHERE id_user = '$id_usuario'");
  
             while ($agendamento = mysqli_fetch_assoc($agendamentos)) {
                    echo '<input type="hidden" name="agendamento_id[]" value="' . $agendamento['id'] . '">';
                    echo '<input type="hidden" name="agendamento_tarefa[]" value="' . $agendamento['tarefa'] . '">';
                    echo '<input type="hidden" name="agendamento_data[]" value="' . $agendamento['data_entrevista'] . '">';
                    echo '<input type="hidden" name="agendamento_hora[]" value="' . $agendamento['hora'] . '">';
             }
        ?>

    </form>

        <table id="taskTable" class="table-margin">
            <tr>
                <th>Tarefa</th>
                <th>Data</th>
                <th>Hora</th>
                <th>Ações</th>
            </tr>
            <?php
                while ($agendamento = mysqli_fetch_assoc($agendamentos)) {
                       echo '<tr>';
                       echo '<td>' . $agendamento['tarefa'] . '</td>';
                       echo '<td>' . $agendamento['data_entrevista'] . '</td>';
                       echo '<td>' . $agendamento['hora'] . '</td>';
                       echo '<td><button class="edit-button" onclick="editTask(this)">Editar</button></td>';
                       echo '</tr>';
                }
            ?>

        </table>
        
        <p class="note">Nota: Você receberá um aviso por e-mail um dia antes da tarefa agendada.</p>
    </div>
    
    <script>
        var currentDate = new Date();
        var currentMonthTitle = document.getElementById("currentMonthTitle");
        
        function addTask() {
            var taskInput = document.getElementById("taskInput");
            var dateInput = document.getElementById("dateInput");
            var timeInput = document.getElementById("timeInput");
            var taskTable = document.getElementById("taskTable");
            var newRow = taskTable.insertRow(-1);
            var taskCell = newRow.insertCell(0);
            var dateCell = newRow.insertCell(1);
            var timeCell = newRow.insertCell(2);
            var actionsCell = newRow.insertCell(3);
            
            taskCell.innerHTML = taskInput.value;
            dateCell.innerHTML = dateInput.value;
            timeCell.innerHTML = timeInput.value;
            actionsCell.innerHTML = '<button class="edit-button" onclick="editTask(this)">Editar</button>';
            
            taskInput.value = "";
            dateInput.value = "";
            timeInput.value = "";
        }
        
        function editTask(button) {
            var row = button.parentNode.parentNode;
            var taskCell = row.cells[0];
            var dateCell = row.cells[1];
            var timeCell = row.cells[2];
            
            var taskInput = document.createElement("input");
            taskInput.type = "text";
            taskInput.value = taskCell.innerHTML;
            taskInput.className = "task-input";
            
            var dateInput = document.createElement("input");
            dateInput.type = "date";
            dateInput.value = dateCell.innerHTML;
            dateInput.className = "date-input";
            
            var timeInput = document.createElement("input");
            timeInput.type = "time";
            timeInput.value = timeCell.innerHTML;
            timeInput.className = "time-input";
            
            taskCell.innerHTML = "";
            dateCell.innerHTML = "";
            timeCell.innerHTML = "";
            
            taskCell.appendChild(taskInput);
            dateCell.appendChild(dateInput);
            timeCell.appendChild(timeInput);
            
            button.innerHTML = "Salvar";
            button.onclick = function() {
                saveTask(button);
            };
        }
        
        function saveTask(button) {
            var row = button.parentNode.parentNode;
            var taskCell = row.cells[0];
            var dateCell = row.cells[1];
            var timeCell = row.cells[2];
            
            var taskInput = taskCell.querySelector(".task-input");
            var dateInput = dateCell.querySelector(".date-input");
            var timeInput = timeCell.querySelector(".time-input");
            
            taskCell.innerHTML = taskInput.value;
            dateCell.innerHTML = dateInput.value;
            timeCell.innerHTML = timeInput.value;
            
            button.innerHTML = "Editar";
            button.onclick = function() {
                editTask(button);
            };
        }
        
        function previousMonth() {
            currentDate.setMonth(currentDate.getMonth() - 1);
            renderCalendar();
        }
        
        function currentMonth() {
            currentDate = new Date();
            renderCalendar();
        }
        
        function renderCalendar() {
            var month = currentDate.getMonth();
            var year = currentDate.getFullYear();
            var firstDay = new Date(year, month, 1);
            var lastDay = new Date(year, month + 1, 0);

            var currentDate = new Date(firstDay);
            var currentRow;

            var calendarTable = document.createElement("table");
            calendarTable.id = "calendarTable";

            var weekdays = ["Domingo", "Segunda-feira", "Terça-feira", "Quarta-feira", "Quinta-feira", "Sexta-feira", "Sábado"];

           var headerRow = calendarTable.insertRow();

    for (var i = 0; i < weekdays.length; i++) {
        var cell = headerRow.insertCell();
        cell.innerHTML = weekdays[i];
    }

    while (currentDate <= lastDay) {
        if (currentDate.getDay() === 0) {
            currentRow = calendarTable.insertRow();
        }

        var cell = currentRow.insertCell();
        cell.innerHTML = currentDate.getDate();

        if (currentDate.getMonth() !== month) {
            cell.classList.add("inactive");
        }

        var tasks = <?php echo json_encode($agendamentos); ?>;
        for (var i = 0; i < tasks.length; i++) {
            var taskDate = new Date(tasks[i].data_entrevista);
            if (currentDate.toDateString() === taskDate.toDateString()) {
                cell.innerHTML += '<br>' + tasks[i].tarefa;
            }
        }

        currentDate.setDate(currentDate.getDate() + 1);
    }

    var oldCalendarTable = document.getElementById("calendarTable");
    var calendarContainer = oldCalendarTable.parentNode;
    calendarContainer.replaceChild(calendarTable, oldCalendarTable);

    currentMonthTitle.textContent = new Intl.DateTimeFormat('pt-BR', { month: 'long', year: 'numeric' }).format(currentDate);
}

// Renderiza o calendário inicialmente
renderCalendar();

    </script>
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