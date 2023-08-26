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
    <link rel="stylesheet" href="./css/style.css">
    <link rel="icon" href="./imagens/icone_index.png" type="image/png">
    <title>R-E-P</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center">Registro Eletrônico de Ponto</h1>
        
        <div class="row mt-4">
            <div class="col-md-6">
                <h2>Registrar entrada</h2>
                <form method="post">
                    <div class="mb-3">
                        <label for="entradaNome" class="form-label">ID do Funcionário</label>
                        <input type="text" name="id_funcionario_entrada" class="form-control" id="entradaNome" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Registrar horário de entrada</button>
                </form>
                <?php
                    if (isset($_POST['id_funcionario_entrada'])) {
                        $funcionario = new FuncionarioModel();
                        $funcionario->__set('id', $_POST['id_funcionario_entrada']);
                        $entrada = new PontoController();
                        $entrada = $entrada->entrada($funcionario);
                ?>
                        <?= $entrada ?>
                <?php
                    }
                ?>
            </div>
            
            <div class="col-md-6">
                <h2>Registrar saída</h2>
                <form method="post">
                    <div class="mb-3">
                        <label for="saidaNome" class="form-label">ID do Funcionário</label>
                        <input type="text" name="id_funcionario_saida" class="form-control" id="saidaNome" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Registrar horário de saída</button>
                </form>
                <div class="mt-5"> 
                    <a href="criarFuncionario.php" class="btn btn-primary">Novas inscrições</a>
                </div>
                <div class="mt-4">
                    <a href="horarioTrabalhado.php" class="btn btn-primary">Acessar banco de horas</a>
                </div>
                <?php
                    if (isset($_POST['id_funcionario_saida'])) {
                        $funcionario = new FuncionarioModel();
                        $funcionario->__set('id', $_POST['id_funcionario_saida']);
                        $saida = new PontoController();
                        $saida = $saida->saida($funcionario);
                ?>
                        <?= $saida ?>
                <?php
                    }
                ?>
            </div>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
