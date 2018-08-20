<?php
    class Connect{
	private $linkar;
        public $json;
        public function __construct(){
            $host = 'localhost';
            $user = 'root';
            $pass = '';
            $bd = 'avaliacao';
            $this->linkar = mysqli_connect($host, $user, $pass, $bd);
            if (!$this->linkar) {
                echo "Error: Unable to connect to MySQL." . PHP_EOL;
                echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
                echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
                exit();
            }
        }
        function searchcat($nome){
            $searchnome = "SELECT * FROM tbl_clientes WHERE cli_nome='$nome'";
            $query = mysqli_query($this->linkar, $searchnome);
            mysqli_num_rows($query);
            while($row = mysqli_fetch_assoc($query)){
                $codcat = $row['cli_codigocat'];
            }
            $searchcat = "SELECT * FROM tbl_categorias WHERE cat_codigo='$codcat'";
            $query = mysqli_query($this->linkar, $searchcat);
            //$row = mysqli_fetch_array($query);
            mysqli_num_rows($query);
            $data = array();
            while($row = mysqli_fetch_assoc($query)){
                $data = $row;
            }
            $data = array_map('utf8_encode', $data);
            echo json_encode($data);
        }
	function close(){
            mysqli_close($this->linkar);
	}
    }
    $nome = $_POST['nome'];
    $request = new Connect;
    $request->searchcat($nome);
    $request->close();
?>