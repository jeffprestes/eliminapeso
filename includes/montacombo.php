<?php

function montaCombo($resCombo, $nomeobjeto, $valorpadrao)		{
	if (mysql_num_rows($resCombo) > 0 )		{
		if (mysql_errno()>0)       {
			echo mysql_errno() . "<br>";
			echo mysql_error() . "<br><br>";
			echo "Erro na operacao com o Banco de dados. <br>\n";
			echo "Verifique os dados preenchidos. Se persistir o erro copie o código acima, salve no bloco de notas e contate a Novatrix.<br>\n";
			echo "<a href=" . $destino . ">Voltar</a>\n";
			exit();
		}

		echo "<select name='" . $nomeobjeto . "' id='" . $nomeobjeto . "' class='" .  retornaCssClassCombo() . "'>";
		echo "<option value='null' selected>&nbsp;</option>";
		//É necessário que a query tenha dois campos objCodigo e outro objDescricao
		while ($lin = mysql_fetch_object($resCombo))	{

			$vDescricao = trim($lin->objDescricao);
			if (strlen($vDescricao)>80)		{
				$vDescricao = substr($vDescricao, 0, 80);
			}

			if ($valorpadrao == $lin->objCodigo)	{

				echo "<option value='" . $lin->objCodigo . "' selected>" . $vDescricao . "</option>";
			}	else	{
				echo "<option value='" . $lin->objCodigo . "'>" . $vDescricao . "</option>";
			}
		}
		echo "</select>";
	}	else	{
		echo "&nbsp;-<input type='hidden' value='" . $valorpadrao . "' name='" . $nomeobjeto . "'>&nbsp";
	}
}

function montaComboComFuncao($resCombo, $nomeobjeto, $valorpadrao, $funcao)		{
	if (mysql_num_rows($resCombo) > 0 )		{
		echo "<select name='" . $nomeobjeto . "' id='" . $nomeobjeto . "' class='" .  retornaCssClassCombo() . "' " . $funcao . ">";
		echo "<option value='null' selected>&nbsp;</option>";
		//É necessário que a query tenha dois campos objCodigo e outro objDescricao
		while ($lin = mysql_fetch_object($resCombo))	{
			if ($valorpadrao == $lin->objCodigo)	{
				echo "<option value='" . $lin->objCodigo . "' selected>" . $lin->objDescricao . "</option>";
			}	else	{
				echo "<option value='" . $lin->objCodigo . "'>" . $lin->objDescricao . "</option>";
			}
		}
		echo "</select>";
	}	else	{
		echo "&nbsp;-<input type='hidden' value='" . $valorpadrao . "' name='" . $nomeobjeto . "'>&nbsp";
	}
}

function montaComboComFuncaoComTabIndex($resCombo, $nomeobjeto, $valorpadrao, $funcao, $tabIndex)		{
	if (mysql_num_rows($resCombo) > 0 )		{
		echo "<select name='" . $nomeobjeto . "' id='" . $nomeobjeto . "' class='" .  retornaCssClassCombo() . "' " . $funcao . " tabIndex='" . $tabIndex . "'>";
		echo "<option value='null' selected>&nbsp;</option>";
		//É necessário que a query tenha dois campos objCodigo e outro objDescricao
		while ($lin = mysql_fetch_object($resCombo))	{
			if ($valorpadrao == $lin->objCodigo)	{
				echo "<option value='" . $lin->objCodigo . "' selected>" . $lin->objDescricao . "</option>";
			}	else	{
				echo "<option value='" . $lin->objCodigo . "'>" . $lin->objDescricao . "</option>";
			}
		}
		echo "</select>";
	}	else	{
		echo "&nbsp;-<input type='hidden' value='" . $valorpadrao . "' name='" . $nomeobjeto . "'>&nbsp";
	}
}

function montaComboComFuncaoComTabIndexVazio($resCombo, $nomeobjeto, $valorpadrao, $funcao, $tabIndex)		{
	if (mysql_num_rows($resCombo) > 0 )		{
		echo "<select name='" . $nomeobjeto . "' id='" . $nomeobjeto . "' class='" .  retornaCssClassCombo() . "' " . $funcao . " tabIndex='" . $tabIndex . "'>";
		echo "<option value='' selected></option>";
		//É necessário que a query tenha dois campos objCodigo e outro objDescricao
		while ($lin = mysql_fetch_object($resCombo))	{
			if ($valorpadrao == $lin->objCodigo)	{
				echo "<option value='" . $lin->objCodigo . "' selected>" . $lin->objDescricao . "</option>";
			}	else	{
				echo "<option value='" . $lin->objCodigo . "'>" . $lin->objDescricao . "</option>";
			}
		}
		echo "</select>";
	}	else	{
		echo "&nbsp;-<input type='hidden' value='" . $valorpadrao . "' name='" . $nomeobjeto . "'>&nbsp";
	}
}

function montaComboDiaSemana($nomeobjeto, $valorpadrao)		{
	echo "<select name='" . $nomeobjeto . "' id='" . $nomeobjeto . "' class='" .  retornaCssClassCombo() . "'>";
	echo "<option value='null' selected>&nbsp;</option>";
	//Dia da semana - 0 = segunda, 1 = terça, seguindo a função weekday do mysql
	$z = 0;
	$dt = new DT;

	while ($z < 7)		{
		if ($valorpadrao == $z)	{
			echo "<option value='" . $z . "' selected>" . $dt->diaSemana($z) . "</option>";
		}	else	{
			echo "<option value='" . $z . "'>" . $dt->diaSemana($z) . "</option>";
		}
		$z++;
	}
	echo "</select>";
	unset($dt);
}


function temValor($valor)		{
	if (strlen(trim($valor)) > 0)	{
		if ($valor != "null")	{
			return true;
		}	else	{
			return false;
		}
	}	else	{
		return false;
	}
}


function vazioParaNulo($campo)		{
	if (strlen(trim($campo)) > 0)	{
		return $campo;
	}	else	{
		return "null";
	}
}


function traduzParaUnicode($texto, $lnk)		{

	$retorno = "";
	$compr = strlen($texto);

	for ($i = 0; $i <$compr; $i++)		{

		$ch = substr($texto, $i, 1);

		if ($ch != "'")		{
			$sql = "SELECT ";
			$sql .= " tabucUnicode";
			$sql .= " FROM ";
			$sql .= " tabuc_tabelaunicode";
			$sql .= " WHERE ";
			$sql .= " tabucCaracter like binary '" . $ch . "'";

			$resUc = mysql_query($sql, $lnk);
			if (mysql_num_rows($resUc) > 0)		{
				if (strpos(mysql_result($resUc, 0, 0), ";")>0)		{
					$retorno .= "&" . mysql_result($resUc, 0, 0);
				}	else	{
					$retorno .= "\u" . mysql_result($resUc, 0, 0);
				}
			}	else	{
				$retorno .= $ch;
			}
		}	else 	{
			$retorno .= "&#39;";
		}

	}
	mysql_free_result($resUc);

	return $retorno;
}


function tiraAcentos($str)		{

	$varNovo = $str;
	$varNovo = str_replace("á", "a", $varNovo);
	$varNovo = str_replace("é", "e", $varNovo);
	$varNovo = str_replace("ç", "c", $varNovo);
	$varNovo = str_replace("í", "i", $varNovo);
	$varNovo = str_replace("ú", "u", $varNovo);
	$varNovo = str_replace("ó", "o", $varNovo);
	$varNovo = str_replace("ã", "a", $varNovo);
	$varNovo = str_replace("õ", "o", $varNovo);
	$varNovo = str_replace("ê", "e", $varNovo);
	$varNovo = str_replace("â", "a", $varNovo);
	$varNovo = str_replace("ô", "o", $varNovo);
	$varNovo = str_replace("À", "A", $varNovo);
        $varNovo = str_replace("Á", "A", $varNovo);
	$varNovo = str_replace("É", "E", $varNovo);
	$varNovo = str_replace("Ç", "C", $varNovo);
	$varNovo = str_replace("Í", "I", $varNovo);
	$varNovo = str_replace("Ú", "U", $varNovo);
	$varNovo = str_replace("Ó", "O", $varNovo);
	$varNovo = str_replace("Ã", "A", $varNovo);
	$varNovo = str_replace("Õ", "O", $varNovo);
	$varNovo = str_replace("Ê", "E", $varNovo);
	$varNovo = str_replace("Â", "A", $varNovo);
	$varNovo = str_replace("Ô", "O", $varNovo);
	$varNovo = str_replace("À", "A", $varNovo);

	//$varNovo = htmlentities($str);
	return $varNovo;
}


function geraLoginAcesso($usuario, $cliCodigo, $ip, $lnk)			{
	$sql = "INSERT INTO log_loginacessos ( ";
	$sql .= " cliCodigo, ";
	$sql .= " usuCodigo, ";
	$sql .= " logData, ";
	$sql .= " logHora, ";
	$sql .= " logIP )";
	$sql .= " VALUES (";
	$sql .= $cliCodigo . ", ";
	$sql .= $usuario . ", ";
	$sql .= "CURDATE(), ";
	$sql .= "CURTIME(), '";
	$sql .= $ip . "')";
	//echo $sql . "<br><br>";
	$varChecaExecucao = mysql_query($sql, $lnk);

	setcookie("ckkSessao",mysql_insert_id($lnk));
	setcookie("ckkUsuario",$usuario);
	setcookie("ckkCliente",$cliCodigo);

}


function checaPerformance($cliCodigo, $pagina, $tempo, $lnk)		{

	//Se o tempo de renderização for maior que 2 anotar no banco de dados
	//para futura análise.
	if ($tempo > 2)		{
		$sql = "INSERT INTO logper_logperformance ( ";
		$sql .= " cliCodigo, ";
		$sql .= " logperArquivo, ";
		$sql .= " logperData, ";
		$sql .= " logperTempoRend )";
		$sql .= " VALUES (";
		$sql .= "" . $cliCodigo . "" . ", ";
		$sql .= "'" . $pagina . "'" . ", ";
		$sql .= "CURDATE(), ";
		$sql .= "" . $tempo . ")";

		$varChecaExecucao = mysql_query($sql, $lnk);

		//Função de DEBUG de query
		if (mysql_errno($lnk)>0)       {
		}
	}
}


function pastaRaizParaGravacao()			{

	$local = explode("/", $_SERVER['DOCUMENT_ROOT']);
	$nroDir = count($local);
	$dir = $local[$nroDir-2];

	if ($dir == "ecomsys2")		{
		return "/home/restricted/home/ecomsys2/public_html/ecomsys";
	}

	if ($dir == "jeffpres")		{
		return "/home/jeffpres/public_html/ecomsys";
	}

	if ($dir == "swingjoy")		{
		return "/home/swingjoy/public_html/ecomsys";
	}

	if ($dir == "wm2")		{
		return "/home/restricted/home/wm2/public_html/ultra";
	}
}


function temCliCodigoNaTabela($tab, $lnk)			{
	$sql = "select * from " . $tab;
	$result = mysql_query($sql, $lnk);
	$fields = mysql_num_fields($result);
	for ($i=0; $i < $fields; $i++) {
		if (strtolower(mysql_field_name($result, $i)) == "clicodigo")		{
			return true;
		}
	}

	return false;
}

function retornaCssClassCombo()     {
    return "combobox custom-combobox-input ui-widget ui-widget-content ui-state-default ui-corner-left ui-autocomplete-input";
}
?>
