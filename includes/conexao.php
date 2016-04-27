<?php
session_start();

//Define a conexao ao banco de dados dependendo do servidor onde estiver hospedado
$local = explode("/", $_SERVER['DOCUMENT_ROOT']);
$nroDir = count($local);
//echo $_SERVER['DOCUMENT_ROOT'] . "-" . $local[$nroDir-2] . "-" . $nroDir . "<br>";
$dir = $local[$nroDir-2];

if ($dir == "novatrix")		{
	$serverBd = "mysql01.novatrix.com.br";
	$userBd = "novatrix2";
	$sepassBd = "jeff2308";
	$bdParaAcessar = "novatrix2";
	$pathArquivos = "/home/restricted/home/novatrix/public_html/";
	$pastaSistema = "/vig/";

}	else if ($dir == "public_html")		{
	$serverBd = "mysql01.novatrix.com.br";
	$userBd = "novatrix2";
	$sepassBd = "jeff2308";
	$bdParaAcessar = "novatrix2";
	$pathArquivos = "/home/restricted/home/novatrix/public_html/";
	$pastaSistema = "/vig/";

	
}

$link = mysqli_connect($serverBd, $userBd, $sepassBd, $bdParaAcessar) or die("Erro ao conectar ao Banco de Dados");
mysqli_set_charset($link, "utf8");
?>
