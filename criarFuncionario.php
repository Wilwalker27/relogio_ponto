<?php
    require './App/Database/Connection.php';
    require './App/Model/FuncionarioModel.php';
    require "./App/Services/PontoService.php";
    require './App/Controller/FuncionarioController.php';
    require './App/Controller/PontoController.php';
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="./imagens/icone_configs.png" type="image/png">
    <link rel="stylesheet" href="./css/style.css">
    <title>Cadastro</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <a href="index.php" class="btn">
            <img src=".\imagens\botao-voltar.png" alt="Home">
        </a>
        <h1 class="text-center">Cadastrar novo funcionário</h1>
        <div class="row justify-content-center mt-4">
            <div class="col-md-6">
                <form method="post">
                    <div class="mb-3">
                        <label for="nomeFuncionario" class="form-label">Nome do Funcionário</label>
                        <input type="text" name="nome_funcionario" class="form-control" id="nomeFuncionario" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Registrar</button>
                </form>
                <?php
                    if (isset($_POST['nome_funcionario'])) {
                        $nomeFuncionario = $_POST['nome_funcionario'];
                        $funcionario = new FuncionarioModel();
                        $funcionario->__set('name', $nomeFuncionario);
                        $createFuncionario = new FuncionarioController();
                        $createFuncionario = $createFuncionario->create($funcionario);
                        echo $createFuncionario;
                    }
                ?>
            </div>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
