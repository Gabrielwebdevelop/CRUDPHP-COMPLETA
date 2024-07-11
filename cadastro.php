<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Usuário</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f8f9fa;
        }
        .container {
            max-width: 400px;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 8px;
            background-color: #fff;
            box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.1);
        }
        .form-group {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>

<div class="container">
    <h1 class="mt-4 mb-4 text-center">Cadastrar Usuário</h1>

    <?php
    // Inicia a sessão
    session_start();

    // Processamento do formulário
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Verifica se os campos estão preenchidos
        if (isset($_POST['nome']) && isset($_POST['email'])) {
            // Simula conexão com o banco de dados e inserção de dados
            // Aqui você pode substituir com sua lógica de inserção real
            // Inserção de dados fictícia
            $nome = $_POST['nome'];
            $email = $_POST['email'];

            // Exemplo de mensagem de sucesso
            $_SESSION['msg'] = "<div class='alert alert-success' role='alert'>Usuário cadastrado com sucesso!</div>";

            // Redirecionamento após o cadastro (opcional)
            // header('Location: listar.php');
            // exit;
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger' role='alert'>Por favor, preencha todos os campos.</div>";
        }
    }

    // Exibe a mensagem de sessão, se houver, e depois a remove
    if (isset($_SESSION['msg'])) {
        echo $_SESSION['msg'];
        unset($_SESSION['msg']);
    }
    ?>

    <!-- Formulário para cadastrar um novo usuário -->
    <form action="processa.php" method="post">
        <div class="form-group">
            <label for="nome">Nome:</label>
            <input type="text" class="form-control" id="nome" name="nome" placeholder="Digite o nome completo" required>
        </div>
        
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" class="form-control" id="email" name="email" placeholder="Digite o seu e-mail" required>
        </div>

        <button type="submit" class="btn btn-primary btn-block">Cadastrar</button>

        <!-- Botão para listar usuários -->
        <a href="listar.php" class="btn btn-secondary btn-block mt-3">Listar Usuários</a>
    </form>
<br><br>
    
</div>

<!-- Bootstrap JS e jQuery (opcional) -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>

</body>
</html>
