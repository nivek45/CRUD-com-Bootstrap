<?php 
  require_once('functions.php'); 

  if (!isset($_SESSION))
  session_start();

  if (!isset($_SESSION['user']) || empty($_SESSION['user'])) {
    header("Location: ../inc/login.php");
    exit(); 
}

  if (isset($_GET['id'])) {
      delete($_GET['id']); // Agora a função delete aceita o argumento $id
  } else {
      die("ERRO: ID não definido.");
  }
?>