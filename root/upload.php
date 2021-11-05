<?php
	include_once('conexao.php');

 	function randString($size){
        //String com valor possíveis do resultado, os caracteres pode ser adicionado ou retirados conforme sua necessidade
        $basic = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
        $return= "";
        for($count= 0; $size > $count; $count++){
            //Gera um caracter aleatorio
            $return.= $basic[rand(0, strlen($basic) - 1)];
        }
         return $return;
    }
	if((substr($_FILES['arquivo']['name'], -3)=="png") || (substr($_FILES['arquivo']['name'], -3)=="PNG")){
		$nome_final = randString(20).".png";	
		$dir = './arquivos/'; 
		$tmpName = $_FILES['arquivo']['tmp_name']; 
		$name = $_FILES['arquivo']['name']; 
		$descricao = $_POST['descricao']; 
		
		// move_uploaded_file
		if( move_uploaded_file( $tmpName, $dir . $nome_final) ) { 	
				$mysql = new BancodeDados();
				$mysql->conecta();
				$sqlstring = "insert into tabelaimg (id, descricao, arquivo) values (null, '$descricao','$nome_final')";
				mysqli_query($mysql->con, $sqlstring);
				header('Location: admin.php'); 		
		} else {		
			echo "Erro ao gravar o arquivo";	
		}
	}else{
	
			if((substr($_FILES['arquivo']['name'], -3)=="jpg") || (substr($_FILES['arquivo']['name'], -3)=="JPG")){
				$nome_final = randString(20).".jpg";
				$dir = './arquivos/'; 
				$tmpName = $_FILES['arquivo']['tmp_name']; 
				$name = $_FILES['arquivo']['name']; 
				$descricao = $_POST['descricao']; 
				
				// move_uploaded_file
				if( move_uploaded_file( $tmpName, $dir . $nome_final) ) { 	
						$mysql = new BancodeDados();
						$mysql->conecta();
						$sqlstring = "insert into tabelaimg (id, descricao, arquivo) values (null, '$descricao','$nome_final')";
						mysqli_query($mysql->con, $sqlstring);
						header('Location: admin.php'); 		
						echo $descricao;
				} else {		
					echo "Erro ao gravar o arquivo";	
				}
			}else{
					echo "Não é documento jpg ou png";
			}
	}
?>


