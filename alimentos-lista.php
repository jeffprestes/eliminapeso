<?
include "includes/conexao.php";
include "includes/montacombo.php";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<meta name="viewport" content="width=device-width, initial-scale=1" /> 
<title>Tabela Elimina Peso - Alimentos - Inclus&atilde;o</title>
<style type="text/css">
<!--
body,td,th {
	font-family: Tahoma, Arial Narrow, MS Outlook, Verdana;
	font-size: 12px;
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
</head>
<body>
<table width="90%" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#2A1F00">
<form name="frm" id="frm" method="post" action="acoes.php">
  <input type="hidden" name="acao" id="acao" value="I" />
  <input type="hidden" name="origem" id="origem" value="alimento" />
  <input type="hidden" name="destino" id="destino" value="alimentos-insere.php" />  
  <tr>
    <th scope="row"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td><table width="100%"  border="0" cellspacing="0" cellpadding="0">
          <tr class="tabelaTitulo">
            <td width="21%">Tipo</td>
            <td width="65%">Alimento</td>
            <td width="14%">Pontos</td>
          </tr>
<?
$sql = "SELECT b.descricao as tipoAlimento, concat_ws(', ', a.alimento, concat_ws(' ', c.descricao, d.descricao)) as alimento, a.pontos";
$sql .= " FROM alimentos a, tipo_alimentos b, quantidades c, medidas d";
$sql .= " WHERE a.cod_tipo_alimento = b.cod_tipo_alimento and a.cod_quant = c.cod_quant and a.cod_medida = d.cod_medida";
$sql .= " ORDER BY a.alimento, b.descricao ";
//echo $sql;
$res = mysql_query($sql, $link);
$i = 0;
if (mysql_num_rows($res)>0)	{
	while($lin = mysql_fetch_object($res))	{
	 	if ($i==0)	{
			echo "<tr class='tabelaLinha'>\n";
	        echo "    <td class='celulaEsquerda'>" . $lin->tipoAlimento . "</td>\n";
	        echo "    <td class='celulaEsquerda'>" . $lin->alimento . "</td>\n";
	        echo "    <td class='celulaCentro'>" . $lin->pontos . "</td>\n";
	        echo "</tr>\n";		
	        $i=1;
	    }	else	{
			echo "<tr class='tabelaLinhaAmarelo'>\n";
	        echo "    <td class='celulaEsquerda'>" . $lin->tipoAlimento . "</td>\n";
	        echo "    <td class='celulaEsquerda'>" . $lin->alimento . "</td>\n";
	        echo "    <td class='celulaCentro'>" . $lin->pontos . "</td>\n";
	        echo "</tr>\n";		
	        $i=0;
		}
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
        </table></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td align="center">
        	<table width="100%"  border="0" cellspacing="0" cellpadding="0">
          		<tr class="tabelaTitulo">
           		  <td width="45%" align="center"><input name="btnIncluir" type="button" class="botoes" id="btnIncluir" value="Incluir" onclick="document.location='alimentos-insere.php'"/></td>
            		<td width="55%" align="center"><input name="btnNova" type="button" class="botoes" id="btnNovaRefeicao" value="Nova Refeição" onclick="document.location='pontos-insere.php'"/></td>
				</tr>
			</table>
		</td>
      </tr>
    </table></th>
  </tr>
  </form>
</table>
</body>
</html>
<?
mysql_close($link);
?>