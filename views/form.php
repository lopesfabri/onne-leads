<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulário de Inscrição</title>
    <link rel="stylesheet" href="../assets/style/form.css">
</head>
<body>

<?php
  if (isset($_POST['submit'])) {
    include_once('database.php');

    $email = htmlspecialchars($_POST['email']);
    $nome = htmlspecialchars($_POST['nome']);

    // Use prepared statement to avoid SQL injection
    $stmt = mysqli_prepare($conexao, "SELECT 1 FROM leads WHERE email = ?");
    mysqli_stmt_bind_param($stmt, 's', $email);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_store_result($stmt);

    $rowCount = mysqli_stmt_num_rows($stmt);

    if ($rowCount > 0) {
        $errorMessage = " ";
    } else {
        $stmt = mysqli_prepare($conexao, "INSERT INTO leads(nome, email) VALUES (?, ?)");
        mysqli_stmt_bind_param($stmt, 'ss', $nome, $email);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);

        // Display success message below the header
        echo "<header><h1>Obrigado!</h1></header>";
        echo "<section>";
        echo "<h1>Recebemos os seus dados, <strong>$nome</strong>!</h1>";
        echo "<p>Fique atento(a) à sua caixa de email que entraremos em contacto!</p>";
        echo "<p><a href='javascript:history.go(-1)'>Voltar</a></p>";
        echo "</section>";
        exit(); // Stop execution after displaying the success message
    }
  }
?>
    <?php
      if (isset($errorMessage)) {
        echo "<header><h1>Email já cadastrado!</h1></header>";
        echo "<section>";
        echo "<p>Por favor, use um email diferente.</p>";
        echo "<p><a href='javascript:history.go(-1)'>Voltar</a></p>";
        echo "</section>";
      }
    ?>

</body>
</html>
