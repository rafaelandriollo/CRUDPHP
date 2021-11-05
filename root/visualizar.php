<?php
	include_once('conexao.php');
	$id = $_GET['id'];
	$mysql = new BancodeDados();
	$mysql->conecta();
	
	// recuperando o nome do arquivo 
	$sqlstring = "select * from tabelaimg where id=$id";
	$query = @mysqli_query($mysql->con, $sqlstring);
	$dados = @mysqli_fetch_array($query);

	echo "<img src='arquivos/".$dados['arquivo']."'>";
	echo "<br><br>";
	echo "<a href='admin.php'>Voltar</a>";

?>