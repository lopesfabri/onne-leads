<?php
    if (isset($_GET['submit'])) {
        include_once('database.php');
       
        $email = $_GET['email'];
        $nome = $_GET['nome'];

        // Use prepared statement to avoid SQL injection
        $stmt = mysqli_prepare($conexao, "SELECT * FROM leads WHERE email = ?");
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
            $successMessage = " ";
        }
    }
?>

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
        //Capturing the feedbacked form data.
        $nome = $_GET['nome'] ?? ''; //null coalescing operator
        $email = $_GET['email'] ?? '';
    ?>
    
    <header>
        <h1>Preencha o seu nome e email</h1>
    </header>

    <main>        
        <form action="<?=$_SERVER['PHP_SELF']?>" method="get"> 
            <label for="nome">Nome</label>
            <input type="text" name="nome" id="nome" required> 
            <label for="email">Email</label>
            <input type="text" name="email" id="email" required>
            <input type="submit" name="submit" value="Enviar">
        </form>
    </main>

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
                echo "<h2>Recebemos a sua inscrição, $nome!</h2>";   
                echo "<p>Fique atento(a) à sua caixa de email que entraremos em contacto!</p>";
                echo "<p><a href='javascript:history.go(-2)'>Voltar</a></p>";
                echo "</section>";
            }
        }
    ?>

</body>
</html>
