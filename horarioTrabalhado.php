<?php
    require './App/Database/Connection.php';
    require './App/Model/FuncionarioModel.php';
    require "./App/Services/PontoService.php";
    require './App/Controller/FuncionarioController.php';
    require './App/Controller/PontoController.php';

    $funcionarios = new FuncionarioController();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/style.css">
    <link rel="icon" href="./imagens/icone_configs.png" type="image/png">
    <title>Lista de Funcionários</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center">Lista de Funcionários e Banco de horas</h1>
        <div class="mt-4">
        <a href="index.php" class="btn">
        <img src=".\imagens\botao-voltar.png" alt="Home">
        </a>
        </div>
        <table class="table mt-4">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome do Funcionário</th>
                    <th>Horas Trabalhadas</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    foreach ($funcionarios->getAllFuncionarios() as $key => $funcionario) {
                        $tempoTrabalhado = new FuncionarioController($funcionario->id);
                        $tempoTrabalhado = $tempoTrabalhado->workTime();
                        $minutosTrabalhado = $tempoTrabalhado['minutos'];
                        $horasTrabalhada = $tempoTrabalhado['horas'];
                ?>
                <tr>
                    <th><?= $funcionario->id ?></th>
                    <td><?= $funcionario->name ?></td>
                    <td><?= "$horasTrabalhada horas e $minutosTrabalhado minutos" ?></td>
                </tr>
                <?php } ?>
                
            
            </tbody>
        </table>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
