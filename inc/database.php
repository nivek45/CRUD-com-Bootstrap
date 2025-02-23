<?php
    
    $driver = new mysqli_driver();
    $driver->report_mode = MYSQLI_REPORT_STRICT & ~MYSQLI_REPORT_ERROR;

    function open_database() {
        try {
            $conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
            $conn->set_charset("utf8");
            return $conn;
        } catch (Exception $e) {
            throw $e; 
        }
    }
    
    function close_database($conn) {
        try {
           
           $conn = null;
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
    /**
	 *  Pesquisa um Registro pelo ID em uma Tabela
	 */
	function find( $table = null, $id = null ) {
		try {
			$database = open_database();
			$found = null;
 
			if ($id) {
				$sql = "SELECT * FROM " . $table . " WHERE id = " . $id;
				$result = $database->query($sql);
 
				if ($result->num_rows > 0) {
					$found = $result->fetch_assoc();
				}
 
			} else {
 
				$sql = "SELECT * FROM " . $table;
				$result = $database->query($sql);
 
				if ($result->num_rows > 0) {
					
 
				
					$found = array();
					while ($row = $result->fetch_assoc()) {
						array_push($found, $row);
					} 
				}
			}
		} catch (Exception $e) {
			$_SESSION['message'] = $e->GetMessage();
			$_SESSION['type'] = 'danger';
		}
		close_database($database);
		return $found;
	}
 
	
	
	 
	function find_all( $table ) {
		return find($table);
	}
    
	
	
	function formatadata( $data, $formato ) {
		$dt = new DateTime($data, new DateTimeZone("America/Sao_Paulo"));
        return $dt->format($formato);
	}

	
	
	function telefone( $telefone) {
		$tel = "(" . substr($telefone, 0, 2) . ") " . substr($telefone, 2, 5) . "-" . substr($telefone, 7);
        return $tel;
	}

	function cep($cep) {
        $cep = substr($cep, 0, 5) . "-" . substr($cep, 5);
        return $cep;
    }
    
    function formatacpf ($cpf){
        $cpf = substr($cpf, 0, 3) . '.' . substr($cpf, 3, 3) . '.' . substr($cpf, 6, 3) . '-' .substr($cpf, 9, 2);
        return $cpf;
    }
    
    function clear_messages() {
        $_SESSION['message'] = null;
        $_SESSION['type'] = null;
    }

    /**
    *  Insere um registro no BD
    */
    function save($table = null, $data = null) {

        $database = open_database();
    
        $columns = null;
        $values = null;
    
        
    
        foreach ($data as $key => $value) {
        $columns .= trim($key, "'") . ",";
        $values .= "'$value',";
        }
    
        
        $columns = rtrim($columns, ',');
        $values = rtrim($values, ',');
        
        $sql = "INSERT INTO " . $table . "($columns)" . " VALUES " . "($values);";
    
        try {
        $database->query($sql);
    
        $_SESSION['message'] = 'Registro cadastrado com sucesso.';
        $_SESSION['type'] = 'success';
        
        } catch (Exception $e) { 
        
        $_SESSION['message'] = 'Nao foi possivel realizar a operacao.';
        $_SESSION['type'] = 'danger';
        } 
    
        close_database($database);
    }


    function criptografia($senha) {
        // Chave para gerar o hash
        $custo = "06";
        $salt = "Cf1f11ePArKlBJomM0F6aJ";
    
        // Gera um hash baseado em bcrypt
        $hash = crypt($senha, "$2a$" . $custo . "$" . $salt . "$");
    
        return $hash; // Retorna a senha criptografada

    }

    
    /**
     *  Atualiza um registro em uma tabela, por ID
     */
    function update($table = null, $id = 0, $data = null) {

        $database = open_database();
    
        $items = null;
    
        foreach ($data as $key => $value) {
        $items .= trim($key, "'") . "='$value',";
        }
    
        
        $items = rtrim($items, ',');
    
        $sql  = "UPDATE " . $table;
        $sql .= " SET $items";
        $sql .= " WHERE id=" . $id . ";";
    
        try {
        $database->query($sql);
    
        $_SESSION['message'] = 'Registro atualizado com sucesso.';
        $_SESSION['type'] = 'success';
    
        } catch (Exception $e) { 
    
        $_SESSION['message'] = 'Nao foi possivel realizar a operacao.';
        $_SESSION['type'] = 'danger';
        } 
    
        close_database($database);
    }

    /**
 *  Remove uma linha de uma tabela pelo ID do registro
 */
function remove($table = null, $id = null) {
    $database = open_database();

    try {
        if ($id) {
            $sql = "DELETE FROM " . $table . " WHERE id = " . $id;

            $result = $database->query($sql);

            if ($result) {
                $_SESSION['message'] = "Registro Removido com Sucesso.";
                $_SESSION['type'] = 'success';
                close_database($database);
                return true; // Retorna true se a exclusão foi bem-sucedida
            }
        }
    } catch (Exception $e) {
        $_SESSION['message'] = $e->getMessage();
        $_SESSION['type'] = 'danger';
        close_database($database);
        return false; // Retorna false em caso de erro
    }

    close_database($database);
    return false; // Retorna false caso $id seja inválido ou vazio
}
?>