<?php
include "includes/conexao.php";
include "includes/montacombo.php";

$sql = "SELECT alimento,\n"
    . "cod_tipo_alimento,\n"
    . "cod_quant,\n"
    . "cod_medida,\n"
    . "pontos,\n"
    . "ehAlimPleno FROM alimentos WHERE cod_alimento=" . $_GET['cod_alimento'];

$res = mysql_query($sql, $link);
$lin = mysql_fetch_array($res, MYSQL_ASSOC);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset=iso-8859-1" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Tabela Elimina Peso - Alimentos - Edi&ccedil;&atilde;o</title>
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
</head>
<body>
    <h2>Editar dados do alimento:</h2>
    <h1><?=$lin["alimento"]?></h1>
    <table width="90%" border="1" cellpadding="0" cellspacing="0" bordercolor="#2A1F00" align="center">
    <form name="frm" id="frm" method="post" action="acoes.php">
    <input type="hidden" name="acao" id="acao" value="A" />
    <input type="hidden" name="origem" id="origem" value="alimento" />
    <input type="hidden" name="cod_alimento" id="cod_alimento" value="<?=$_GET['cod_alimento']?>" />
    <input type="hidden" name="destino" id="destino" value="alimentos-lista.php" />  
  <tr>
    <th scope="row"><table width="100%" cellpadding="0" cellspacing="2" id="tabElementos">
      <tr>
        <th width="15%" scope="row"><div align="right" class="labelCampo">Tipo: </div></th>
        <td width="85%" align="left">
		<? $sql = "select cod_tipo_alimento as objCodigo, descricao as objDescricao from tipo_alimentos order by descricao";
		   $res = mysql_query($sql, $link);
		   montaComboComFuncaoComTabIndex($res, "cod_tipo_alimento", $lin["cod_tipo_alimento"], "", "1");
		   mysql_free_result($res);
		 ?>
        </td>
      </tr>
      <tr>
        <th scope="row"><div align="right" class="labelCampo">Nome:</div></th>
        <td align="left"><input name="alimento" type="text" class="caixaTexto" id="alimento" value="<?=$lin["alimento"]?>" size="30" maxlength="50" tabindex="2" /></td>
      </tr>      
      <tr>
        <th scope="row"><div align="right" class="labelCampo">Quantidade:</div></th>
        <td align="left">
		<? $sql = "select cod_quant as objCodigo, descricao as objDescricao from quantidades order by descricao";
		   $res = mysql_query($sql, $link);
		   montaComboComFuncaoComTabIndex($res, "cod_quant", $lin["cod_quant"], "", "3");
		   mysql_free_result($res);
		 ?>
        </td>
      </tr>
      <tr>
        <th scope="row"><div align="right" class="labelCampo">Medida:</div></th>
        <td align="left">
	    <? $sql = "select cod_medida as objCodigo, descricao as objDescricao from medidas order by descricao";
		   $res = mysql_query($sql, $link);
		   montaComboComFuncaoComTabIndex($res, "cod_medida", $lin["cod_medida"], "", "4");
		   mysql_free_result($res);
		 ?>
        </td>
      </tr>
      
     
      <tr>
        <th scope="row"><div align="right" class="labelCampo">Nro Pontos </div></th>
    <td align="left"><input name="pontos" type="text" class="caixaTexto" value="<?=$lin["pontos"]?>" id="pontos" size="5" maxlength="2" tabindex="5" /></td>
      </tr>
      <tr>
        <th scope="row"><div align="right" class="labelCampo">É Alim. Pleno? </div></th>
    <td align="left"><select name="ehAlimPleno" id="ehAlimPleno" tabindex="6">
                            <option value="0" <? if ($lin["ehAlimPleno"]==0) { echo "selected"; } ?>>Não</option>
                            <option value="1" <? if ($lin["ehAlimPleno"]==1) { echo "selected"; } ?>>Sim</option>
                        </select>
      </tr>
      <tr>
        <th scope="row"><div align="right"></div></th>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <th colspan="2" align="center" scope="row">
          <div align="center">
            <input name="btnSalvar" type="button" class="botoes" id="btnSalvar" value="Salvar" onclick="document.frm.submit()" tabindex="6" />
			&nbsp;&nbsp;
			<input name="btnListar" type="button" class="botoes" id="btnListar" value="Listar" onclick="document.location='alimentos-lista.php'" tabindex="7" />
            &nbsp;
            <input name="btnNova" type="button" class="botoes" id="btnNovaRefeicao" value="Nova Refei&ccedil;&atilde;o" onclick="document.location='pontos-insere.php'"/>
          </div></th>
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