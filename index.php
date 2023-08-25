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
    <title>Sistema de Bater Ponto</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center">Sistema de Bater Ponto</h1>
        <div class="mt-4">
            <a href="horarioTrabalhado.php" class="btn btn-primary">Ver Horas Trabalhadas</a>
        </div>
        <div class="row mt-4">
            <div class="col-md-6">
                <h2>Registrar Entrada</h2>
                <form method="post">
                    <div class="mb-3">
                        <label for="entradaNome" class="form-label">ID do Funcionário</label>
                        <input type="text" name="id_funcionario_entrada" class="form-control" id="entradaNome" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Registrar Entrada</button>
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
                <h2>Registrar Saída</h2>
                <form method="post">
                    <div class="mb-3">
                        <label for="saidaNome" class="form-label">Id do Funcionário</label>
                        <input type="text" name="id_funcionario_saida" class="form-control" id="saidaNome" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Registrar Saída</button>
                </form>
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
