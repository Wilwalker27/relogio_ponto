<?php
require './App/Database/Connection.php';
require './App/Model/FuncionarioModel.php';
require "./App/Services/PontoService.php";
require './App/Controller/FuncionarioController.php';
require './App/Controller/PontoController.php';


if (isset( $_GET['id']) && !empty($_GET['id'])) {

    $pontoController = new PontoController();

    echo $pontoController->delete($_GET['id']);
    #echo $_GET['id'];
    #header("Location:horarioTrabalhado.php");
}else {
    header("Location:horarioTrabalhado.php");
}