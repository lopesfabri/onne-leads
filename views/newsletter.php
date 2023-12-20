<?php
    if (isset($_GET['submit'])) {
        include_once('database.php');
       
        $email = $_GET['email'];

        // Use prepared statement to avoid SQL injection
        $stmt = mysqli_prepare($conexao, "SELECT * FROM newsletter WHERE email = ?");
        mysqli_stmt_bind_param($stmt, 's', $email);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);

        $rowCount = mysqli_stmt_num_rows($stmt);

        if ($rowCount > 0) {
            $errorMessage = " ";
        } else {
            $stmt = mysqli_prepare($conexao, "INSERT INTO newsletter(email) VALUES (?)");
            mysqli_stmt_bind_param($stmt, 's', $email);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);

            // Display success message below the header
            $successMessage = " ";
        }
    }
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro a Newsletter</title>
    <link rel="stylesheet" href="../assets/style/formulario.css">      
</head>
<body>

    <?php 
        // Capturing feedbacked newsletter data
        $nome = $_GET['email'] ?? ''; // Null coalescing operator
    ?>
  
    <?php
        // Display error message if email already exists
        if (isset($errorMessage)) {
            echo "<section>";
            echo "<h3>Email já cadastrado!</h3>"; 
            echo "<p>Por favor, use um email diferente.</p>"; 
            echo "<p><a href='javascript:history.go(-1)'>Voltar</a></p>";
            echo "</section>";
        } else {
            // Display success message only when the user submits the form
            if (isset($successMessage)) {
                echo "<section>";
                echo "<h2>Bem vindo (a) à nossa Newsletter!</h2>";  
                echo  "<p>Fique atento(a) à sua caixa de email que enviaremos novidades!</p>";
                echo "<p><a href='javascript:history.go(-1)'>Voltar</a></p>";
                echo "</section>";
            }
        }
    ?>  

</body>
</html>