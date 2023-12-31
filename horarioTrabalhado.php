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
                    <th>Data de entrada</th>
                    <th>Horario de entrada</th>
                    <th>Horio de saida</th>
                    <th>Deletar o funcionario</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    foreach ($funcionarios->getAllFuncionarios() as $key => $funcionario) {
                        $tempoTrabalhado = new FuncionarioController($funcionario->id);
                        $tempoTrabalhado = $tempoTrabalhado->workTime();
                        foreach ($tempoTrabalhado  as $key => $funcionarioTempo) {
                            # Separa a data e as horas e transforma em um array
                            $partsEntrada = explode(" ", $funcionarioTempo->horario_entrada);
                            $partsSaida = explode(" ", $funcionarioTempo->horario_saida);
                            # Coloca cada parte do array em seu lugar
                            $dataEntrada = $partsEntrada[0];
                            $dataEntrada = date("d-m-Y", strtotime($dataEntrada));
                            $horarioEntrada = $partsEntrada[1];
                            $horarioSaida = $partsSaida[1];
                ?>
                <tr>
                    <th><?= $funcionario->id ?></th>
                    <td><?= $funcionario->name ?></td>
                    <td><?= "$dataEntrada" ?></td>
                    <td><?= "$horarioEntrada" ?></td>
                    <td><?= "$horarioSaida" ?></td>
                    <td><a href="delete.php?id=<?= $funcionario->id ?>" class="btn btn-sm btn-danger">Deleter o funcionário <?= $funcionario->name ?> </a></td>
                </tr>
                <?php }} ?>
                
            
            </tbody>
        </table>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
