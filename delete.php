<?php
require './App/Database/Connection.php';
require './App/Model/FuncionarioModel.php';
require "./App/Services/PontoService.php";
require './App/Controller/FuncionarioController.php';
require './App/Controller/PontoController.php';


if (isset( $_GET['id']) && !empty($_GET['id'])) {

    $pontoController = new PontoController();

    $pontoController->delete($id);

}else {
    header("Location:horarioTrabalhado.php");
}