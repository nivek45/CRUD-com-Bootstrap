<?php 
  require_once('functions.php'); 

  if (!isset($_SESSION['user']) || empty($_SESSION['user'])) {
    header("Location: ../inc/login.php");
    exit(); 
}

  $id = $_GET['id']; // Obtém o ID a partir dos parâmetros da URL
  $table = 'cars'; // Nome da tabela
  $column = 'id'; // Nome da coluna
  
  delete($table, $column, $id);
  
  header('location: index.php');
?>
