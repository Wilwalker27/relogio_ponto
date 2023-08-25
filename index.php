<?php

require './App/Controller/PontoController.php';

$pontoController = new PontoController();
$funcionario = new FuncionarioModel;
$funcionario->__set('id',1);
#echo $pontoController->entrada($funcionario);

echo $pontoController->saida($funcionario);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    hello
</body>
</html>