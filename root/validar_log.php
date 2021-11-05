<?php
	require_once('conexao.php');

	$login = $_POST['login'];
	$senha = $_POST['senha'];

	//$hash = password_hash($senha, PASSWORD_DEFAULT);
	//if(password_verify($senha, $hash))
	//{
	echo $senha;
	$hash=sha1($senha);
	echo $hash;
	$sqlstring = " select * from tbl_usuario01 where login = '$login' and senha='$hash'";
	

	
	$mysql = new BancodeDados();
	$mysql->conecta();
	
	$info = mysqli_query($mysql->con, $sqlstring);
	if (!$info) { die('<b>Query Inválida: </b>' . mysqli_error($con)); }

    $registro = mysqli_num_rows($info);	
	
	if($registro!=1){
		echo "Usuário não localizado!!!!!";
		echo "<br><a href='index.php'>Voltar</a>";
	}else{
		$dados = mysqli_fetch_array($info);	

		session_start();
		//$_SESSION['id'] = $dados['id'];
		$_SESSION['nome'] = $dados['login'];
		$_SESSION['log'] = 'ativo';		
		
		$mysql->fechar();
		
		header("location:admin.php");
	}

	
	//}
?>
