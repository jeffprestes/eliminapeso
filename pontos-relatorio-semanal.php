<?
session_start();

include "includes/conexao.php";
include "includes/montacombo.php";

header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); // Date in the past

$cod_usuario = $_SESSION["cod_usuario"];

//Variáveis da página

if (isset($mes)) {
    $diaSemana = getdate(mktime(0, 0, 0, $mes, $dia, $ano));
	//echo getdate(strtotime($mes . "-" . $dia . "-" . $ano)) . " - " . strtotime($mes . "-" . $dia . "-" . $ano) . " - " . mktime(0, 0, 0, $mes, $dia, $ano) . " - " . $mes . "-" . $dia . "-" . $ano . "<br />";
    
}   else    {
    $diaSemana = getdate(mktime());
	$dia = $diaSemana['mday'];
	$mes = $diaSemana['mon'];
	$ano = $diaSemana['year'];
}

//echo $diaSemana['wday'] . "<br><br>";

if ($diaSemana['wday'] == 1)	{
	$dtInicial = mktime(0, 0, 0, $diaSemana['mon'], $diaSemana['mday']-2, $diaSemana['year']);
	$dtFinal = mktime(0, 0, 0, $diaSemana['mon'], $diaSemana['mday']+4, $diaSemana['year']);
	//echo date("d/m/Y", $dtInicial) . "<br>" . date("d/m/Y", $dtFinal) . "<br>";
}

if ($diaSemana['wday'] == 2)	{
	$dtInicial = mktime(0, 0, 0, $diaSemana['mon'], $diaSemana['mday']-3, $diaSemana['year']);
	$dtFinal = mktime(0, 0, 0, $diaSemana['mon'], $diaSemana['mday']+3, $diaSemana['year']);
	//echo date("d/m/Y", $dtInicial) . "<br>" . date("d/m/Y", $dtFinal) . "<br>";
}
	
if ($diaSemana['wday'] == 3)	{
	$dtInicial = mktime(0, 0, 0, $diaSemana['mon'], $diaSemana['mday']-4, $diaSemana['year']);
	$dtFinal = mktime(0, 0, 0, $diaSemana['mon'], $diaSemana['mday']+2, $diaSemana['year']);
	//echo date("d/m/Y", $dtInicial) . "<br>" . date("d/m/Y", $dtFinal) . "<br>";
}
	
if ($diaSemana['wday'] == 4)	{
	$dtInicial = mktime(0, 0, 0, $diaSemana['mon'], $diaSemana['mday']-5, $diaSemana['year']);
	$dtFinal = mktime(0, 0, 0, $diaSemana['mon'], $diaSemana['mday']+1, $diaSemana['year']);
	//echo date("d/m/Y", $dtInicial) . "<br>" . date("d/m/Y", $dtFinal) . "<br>";
}
	

if ($diaSemana['wday'] == 5)	{
	$dtInicial = mktime(0, 0, 0, $diaSemana['mon'], $diaSemana['mday']-6, $diaSemana['year']);
	$dtFinal = mktime(0, 0, 0, $diaSemana['mon'], $diaSemana['mday'], $diaSemana['year']);
	//echo date("d/m/Y", $dtInicial) . "<br>" . date("d/m/Y", $dtFinal) . "<br>";
}
	
if ($diaSemana['wday'] == 6)	{
	$dtInicial = mktime(0, 0, 0, $diaSemana['mon'], $diaSemana['mday'], $diaSemana['year']);
	$dtFinal = mktime(0, 0, 0, $diaSemana['mon'], $diaSemana['mday']+6, $diaSemana['year']);
	//echo date("d/m/Y", $dtInicial) . "<br>" . date("d/m/Y", $dtFinal) . "<br>";
}
	
if ($diaSemana['wday'] == 0)	{
	$dtInicial = mktime(0, 0, 0, $diaSemana['mon'], $diaSemana['mday']-1, $diaSemana['year']);
	$dtFinal = mktime(0, 0, 0, $diaSemana['mon'], $diaSemana['mday']+5, $diaSemana['year']);
	//echo date("d/m/Y", $dtInicial) . "<br>" . date("d/m/Y", $dtFinal) . "<br>";
}


/*
$diaHoje = mktime();    
if (($diaHoje<$dtInicial) && ($diaHoje>$dtFinal)) {
    $diaHoje = $diaSemana;        
}
//echo date("d/m/Y", $diaHoje);

$dtBase = getdate($dtInicial);

$dtSegunda = date("d/m/Y", $dtInicial);

$dtTerca = date("d/m/Y", mktime(0, 0, 0, $dtBase['mon'], $dtBase['mday']+1, $dtBase['year']));

$dtQuarta = date("d/m/Y", mktime(0, 0, 0, $dtBase['mon'], $dtBase['mday']+2, $dtBase['year']));

$dtQuinta = date("d/m/Y", mktime(0, 0, 0, $dtBase['mon'], $dtBase['mday']+3, $dtBase['year']));

$dtSexta = date("d/m/Y", mktime(0, 0, 0, $dtBase['mon'], $dtBase['mday']+4, $dtBase['year']));

$dtSabado = date("d/m/Y", mktime(0, 0, 0, $dtBase['mon'], $dtBase['mday']+5, $dtBase['year']));

$dtDomingo = date("d/m/Y", $dtFinal);
*/

//DEBITO TECNICO: Fazer uma página só de funções para usar como include
function diaSemana($dia)	{

	if ($dia == 1)	{
		return "Domingo";
	}
	if ($dia == 2)	{
		return "Segunda";
	}
	if ($dia == 3)	{
		return "Terça";
	}
	if ($dia == 4)	{
		return "Quarta";
	}
	if ($dia == 5)	{
		return "Quinta";
	}
	if ($dia == 6)	{
		return "Sexta";
	}
	if ($dia == 7)	{
		return "Sabado";
	}
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<meta name="viewport" content="width=340" />
<title>Tabela Elimina Peso - Pontos - Inclus&atilde;o</title>
<style type="text/css">
<!--
body,td,th {
	font-family: Tahoma, Arial Narrow, MS Outlook, Verdana;
	font-size: 9px;
	color: #2A0000;
}
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
	background-color: #C0DCC0;
}
-->
</style>
<link href="estilos.css" rel="stylesheet" type="text/css" />
<script language="javascript">
	function novoAlimento()	{
		document.location='alimentos-insere.php?destino=pontos-insere.php';
	}
</script>
</head>
<body>
<table width="232" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#2A1F00">
<form name="frm" id="frm" method="post" action="pontos-relatorio-semanal.php">
  <input type="hidden" name="cod_usuario" id="cod_usuario" value="<?=$cod_usuario?>" />
  <tr>
    <th scope="row"><table width="230" cellpadding="0" cellspacing="2" id="tabElementos">
      <tr>
	  <?
	  $sql = "SELECT nome, metaPontos FROM usuarios u where cod_usuario = " . $cod_usuario;
	  $res = mysql_query($sql, $link);
	  if (mysql_errno($link)<1 && mysql_num_rows($res)>0)	{
	  		$nome = mysql_result($res, 0, 0);
			$metaPontos = mysql_result($res, 0, 1);
	  }	else	{
	  		$nome = "Usuário";
			$metaPontos = 0;
	  }
	  $metaPontos = ($metaPontos*7)+35;
	  ?>
        <th colspan="2" align="center" scope="row">Ol&aacute; <?=$nome?>! </th>
      </tr>
      <tr>
	  <?
	  $sql = "SELECT IFNULL(sum(valor), 0) total from pontos where cod_usuario = " . $cod_usuario . " and data between '" . date("Ymd", $dtInicial) . "' and '" . date("Ymd", $dtFinal) . "'";
	  //echo $sql . "<br />";
	  $res = mysql_query($sql, $link);
	  if (mysql_errno($link)<1 && mysql_num_rows($res)>0)	{
	  		$totalPontos = mysql_result($res, 0, 0);
	  }	else	{
	  		$totalPontos = 0;
	  }
	  ?>
        <th colspan="2" align="center" scope="row">Total de pontos desta semana <?=$totalPontos?> de <?=$metaPontos?></th>
      </tr>
      <tr>
        <th width="60" scope="row">&nbsp;</th>
        <td width="162" align="left">&nbsp;</td>
      </tr>
	  <tr>
        <th scope="row"><div align="right" class="labelCampo">Data:</div></th>
	    <td align="left"><input name="dia" type="text" class="caixaTexto" id="dia" tabindex="1" value="<?=$dia?>" size="2" maxlength="2" />
		  /
		    <input name="mes" type="text" class="caixaTexto" id="mes" tabindex="2" value="<?=$mes?>" size="2" maxlength="2" />
		    /
		    <input name="ano" type="text" class="caixaTexto" id="ano" tabindex="3" value="<?=$ano?>" size="4" maxlength="4" /></td>
	    </tr>
      <tr>
        <th scope="row"><div align="right"></div></th>
        <td>&nbsp;</td>
      </tr>	  
      <tr>
        <th scope="row" colspan="2"><div align="center">
            <input name="btnPesquisar" type="button" class="botoes" id="btnPesquisar" value="Pesquisar" onclick="document.frm.submit();" tabindex="4" />			
            </div></th>
        <td>&nbsp;</td>
      </tr>  
	  </form>    
      <tr>
        <th colspan="2" align="center" scope="row">&nbsp;</th>
      </tr>
      <tr>
        <th colspan="2" align="center" scope="row">
		<table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr class="tabelaTitulo">
            <th width="75%" scope="col">Alimento</th>
            <th width="13%" scope="col">Qt</th>
            <th width="12%" scope="col">Pts</th>
          </tr>
<?		  
$sql = "SELECT  c.desc_tprefeicao, a.alimento , b.qtde , DATE_FORMAT(b.data, '%d/%m/%Y') data , DAYOFWEEK(b.data) diaSemana, b.valor ";
$sql .= " FROM  alimentos a  , pontos b, tipo_refeicao c ";
$sql .= " WHERE  a.cod_alimento = b.cod_alimento and b.cod_tprefeicao = c.cod_tprefeicao and b.cod_usuario =" . $cod_usuario . " and b.data between '" . date("Ymd", $dtInicial) . "' and '" . date("Ymd", $dtFinal) . "'";
$sql .= " ORDER BY b.data, c.ordem";
//echo $sql;
$res = mysql_query($sql, $link);
$i = 0;
$tpRefeicao = "";
$diaDaAlimentacao = "";
$totalPontosDia = 0;
if (mysql_num_rows($res)>0)	{
	while($lin = mysql_fetch_object($res))	{		
		if ($diaDaAlimentacao != $lin->data)	{
			//Imprime o total de pontos do dia anterior
			if ($totalPontosDia >0)	{
				if ($i==0)	{
					echo "<tr class='tabelaLinha'>\n";
					echo "    <td class='celulaEsquerdaData' colspan='3'>Total de pontos do dia: &nbsp;&nbsp;&nbsp;" . $totalPontosDia . "<br /><hr /></td>\n";
					echo "</tr>\n";		
					$i=1;
				}	else	{
					echo "<tr class='tabelaLinhaAmarelo'>\n";
					echo "    <td class='celulaEsquerdaData' colspan='3'>Total de pontos do dia: &nbsp;&nbsp;&nbsp;" . $totalPontosDia . "<br /><hr /></td>\n";
					echo "</tr>\n";		
					$i=0;
				}
				$totalPontosDia = 0;
			}
			
			//Imprime o dia
			$diaDaAlimentacao = $lin->data;
			if ($i==0)	{
				echo "<tr class='tabelaLinha'>\n";
				echo "    <td class='celulaEsquerdaData' colspan='3'>" . $lin->data . " - " . diaSemana($lin->diaSemana) . "</td>\n";
				echo "</tr>\n";		
				$i=1;
			}	else	{
				echo "<tr class='tabelaLinhaAmarelo'>\n";
				echo "    <td class='celulaEsquerdaData' colspan='3'>" . $lin->data . " - " . diaSemana($lin->diaSemana) . "</td>\n";
				echo "</tr>\n";		
				$i=0;
			}
		}
		//Imprime o tipo de refeição
		if ($tpRefeicao != $lin->desc_tprefeicao)	{
			$tpRefeicao = $lin->desc_tprefeicao;
			if ($i==0)	{
				echo "<tr class='tabelaLinha'>\n";
				echo "    <td class='celulaEsquerdaSubTitulo' colspan='3'>" . $lin->desc_tprefeicao . "</td>\n";
				echo "</tr>\n";		
				$i=1;
			}	else	{
				echo "<tr class='tabelaLinhaAmarelo'>\n";
				echo "    <td class='celulaEsquerdaSubTitulo' colspan='3'>" . $lin->desc_tprefeicao . "</td>\n";
				echo "</tr>\n";		
				$i=0;
			}
		}
	 	if ($i==0)	{
			echo "<tr class='tabelaLinha'>\n";
	        echo "    <td class='celulaEsquerda'>&nbsp;&nbsp;" . $lin->alimento . "</td>\n";
	        echo "    <td class='celulaCentro'>" . $lin->qtde . "</td>\n";
	        echo "    <td class='celulaCentro'>" . $lin->valor . "</td>\n";
	        echo "</tr>\n";		
	        $i=1;
	    }	else	{
			echo "<tr class='tabelaLinhaAmarelo'>\n";
	        echo "    <td class='celulaEsquerda'>&nbsp;&nbsp;" . $lin->alimento . "</td>\n";
	        echo "    <td class='celulaCentro'>" . $lin->qtde . "</td>\n";
	        echo "    <td class='celulaCentro'>" . $lin->valor . "</td>\n";
	        echo "</tr>\n";		
	        $i=0;
		}
		$totalPontosDia = $totalPontosDia + $lin->valor;
	}
	//Imprime o total de pontos do dia anterior
	if ($totalPontosDia >0)	{
		if ($i==0)	{
			echo "<tr class='tabelaLinha'>\n";
			echo "    <td class='celulaEsquerdaData' colspan='3'>Total de pontos do dia: &nbsp;&nbsp;&nbsp;" . $totalPontosDia . "<br /><hr /></td>\n";
			echo "</tr>\n";		
			$i=1;
		}	else	{
			echo "<tr class='tabelaLinhaAmarelo'>\n";
			echo "    <td class='celulaEsquerdaData' colspan='3'>Total de pontos do dia: &nbsp;&nbsp;&nbsp;" . $totalPontosDia . "<br /><hr /></td>\n";
			echo "</tr>\n";		
			$i=0;
		}
		$totalPontosDia = 0;
	}
}	else	{
?> 
		<tr class="tabelaLinha">
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>		
<? } 
mysql_free_result($res);
?>          
		<tr class="tabelaLinha">
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
        </table></th>
      </tr>
	  <tr>
        <th colspan="2" align="center" scope="row">
          <div align="center">
            <input name="btnNova" type="button" class="botoes" id="btnNovaRefeicao" value="Nova Refei&ccedil;&atilde;o" onclick="document.location='pontos-insere.php'"/>
			&nbsp;&nbsp;
			<input name="btnNovoAlimento" type="button" class="botoes" id="btnNovoAlimento" value="Novo Alimento" onclick="novoAlimento()" tabindex="8" />
          </div></th>
        </tr>
    </table>
	</th>
  </tr>
</table>
<script language="javascript">
	document.frm.cod_alimento.focus();
</script>
</body>
</html>
<?
mysql_close($link);
?>