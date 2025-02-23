<?php
	include("../config.php");
	include(DBAPI);

	$customers = null;
	$customer = null;
 
    if (!isset($_SESSION))
    session_start();

	function index() {
        global $customers;
        if (!empty($_POST['custo'])) {
            $customers = filter("customers", $_POST['custo']);
        } else {
            $customers = find_all("customers");
        }
    }
    /**
     *  Visualização de um Cliente
     */
    function view($id = null) {
        global $customer;
        $customer = find('customers', $id);
    }

    /**
     *	Atualizacao/Edicao de Cliente
    */
    function edit() {
        if (!isset($_SESSION)) session_start();
        if (!isset($_SESSION['user'])) {
            echo "<script>
                    alert('Você precisa estar logado para realizar esta ação.');
                    window.location.href = 'index.php';
                  </script>";
            exit();
        }

        $now = date_create('now', new DateTimeZone('America/Sao_Paulo'));
    
        if (isset($_GET['id'])) {
    
        $id = $_GET['id'];
    
        if (isset($_POST['customer'])) {
    
            $customer = $_POST['customer'];
            $customer['modified'] = $now->format("Y-m-d H:i:s");
    
            update('customers', $id, $customer);
            header('location: index.php');
        } else {
    
            global $customer;
            $customer = find('customers', $id);
        } 
        } else {
        header('location: index.php');
        }
    }

    function add() {
        if (!empty($_POST['customer'])) {
            $now = date_create('now', new DateTimeZone('America/Sao_Paulo'));
            $customer = $_POST['customer'];
            $customer['created'] = $now->format("Y-m-d H:i:s");
            $customer['modified'] = $now->format("Y-m-d H:i:s");

            save('customers', $customer);
            header('location: index.php');
        }
    }

    /**
 *  Exclusão de um Cliente
 */
function delete($id = null) {
    if (empty($id) || !is_numeric($id)) {
        die("ERRO: ID inválido ou não fornecido.");
    }

    global $customer;
    $customer = remove('customers', $id);

    if ($customer) {
        header("location: index.php");
        exit();
    } else {
        die("Erro ao tentar excluir o registro.");
    }
}

function filter($table = null, $condition = null) {
    $database = open_database();
    $found = null;

    try {
        if ($table && $condition) {
            // Construção da consulta com parâmetro
            $sql = "SELECT * FROM $table WHERE name LIKE ?";
            $stmt = $database->prepare($sql);

            if ($stmt) {
                $param = '%' . $condition . '%'; // Adiciona os curingas para o LIKE
                $stmt->bind_param("s", $param); // "s" indica string no bind_param
                
                $stmt->execute();
                $result = $stmt->get_result();

                if ($result->num_rows > 0) {
                    $found = $result->fetch_all(MYSQLI_ASSOC);
                }

                $stmt->close();
            }
        }
    } catch (Exception $e) {
        $_SESSION['message'] = $e->getMessage();
        $_SESSION['type'] = 'danger';
    }

    close_database($database);
    return $found;
}
?>