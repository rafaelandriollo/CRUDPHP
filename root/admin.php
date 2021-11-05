<html>
<head>
	<title> Cadastro de Minhas Imagens Favoritas </title>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>
<body>
	<h3> Cadastro de Minhas Imagens Favoritas </h3>
<?php
require_once('conexao.php');
session_start();

if ($_SESSION['log'] != "ativo")
   {
	session_destroy();
	header("location:index.php");
	}
	echo "Olá, <b>".$_SESSION['nome']."</b>, bem vindo ao sistema</b>";		
?>

<br><br>
<p>As imagens precisam ser no formato png ou jpg</p>


<div>
		<form action="upload.php" method="post" enctype="multipart/form-data">
			<label>Descrição:</label><input type="text" name="descricao" id ="descricao" />	<br>
			<label for="arquivo">Arquivo:</label> <input type="file" name="arquivo" id="arquivo" />
			
			<br />
			<br />
			
			<input type="submit" value="Enviar" />
			
		</form>
	</div>
	
<br><br><br>	
<p>Minhas imagens:</p>
<?php
//criando o objeto mysql e conectando ao banco de dados
	
	$mysql = new BancodeDados();
	$mysql->conecta();
	
	$sqlstring = 'select * from tabelaimg order by arquivo';
	$query = @mysqli_query($mysql->con, $sqlstring);
	echo "
		<table border=\"width:100%\">
		  <tr>
			<th>Descrição</th>
			<th>Imagem</th> 
			<th>Excluir?</th>
			<th>Visualizar?</th>
		  </tr>";
	while ($dados = @mysqli_fetch_array($query)){
		echo "<tr>
			<td>".$dados['descricao']."</td>
			<td><img src='arquivos/".$dados['arquivo']."' width='100px' heigth='100px'></td> 
			<td><a href='apagar.php?id=".$dados['id']."'><img src='delete.png'></a></td>
			<td><a href='visualizar.php?id=".$dados['id']."'><img src='visualizar.png'></a></td>
		  </tr>
		";
		echo "";
		echo "";
		
	}
echo "</table>";
	
?>
</body>
</html>
