<?php
session_start();

if (isset($_POST['entrar']) && !empty($_POST['email']) && !empty($_POST['senha'])) {
    include_once('conexao.php');
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    $sql = "SELECT * FROM usuarios WHERE email = '$email' and senha = '$senha'";
    $result = $con->query($sql) or die($con->error);

    if (mysqli_num_rows($result) < 1) {
        unset($_SESSION['nome']);
        echo "<script>alert('Credenciais Inválidas, tente novamente.'); location.href='login.php';</script>";
    } else {
        $row = mysqli_fetch_assoc($result);
        $_SESSION['nome'] = $row['nome'];
        $_SESSION['email'] = $email;
        $_SESSION['senha'] = $senha;
        $_SESSION['id'] = $row['id'];
        $id = $row['id']; 

        header('Location: usuario.php');
        exit();
    }
} else {
    echo "<script>alert('Ops, algo de errado aconteceu!'); location.href='login.php';</script>";
}
?>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    var $value = <?php echo $_SESSION['id']; ?>;
  
    $.ajax({
      url: 'http://127.0.0.1:5000/getperfil/' + $value,
      type: 'GET',
      headers: {
        'Content-Type': 'application/json'
      },
      success: function(response) {
        var jsonData = JSON.parse(response);
        console.log(jsonData);

        localStorage.setItem('jsonData', JSON.stringify(jsonData));
      },
      error: function(xhr, status, error) {
        // Lidar com erros
        console.log(error);
      }
    });
});
</script>
