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
    <h1>Adiciona novo alimento</h1>
    <table width="90%" border="1" cellpadding="0" cellspacing="0" bordercolor="#2A1F00" align="center">
<form name="frm" id="frm" method="post" action="acoes.php">
  <input type="hidden" name="acao" id="acao" value="I" />
  <input type="hidden" name="origem" id="origem" value="alimento" />
  <input type="hidden" name="destino" id="destino" value="alimentos-insere.php" />  
  <tr>
    <th scope="row"><table width="100%" cellpadding="0" cellspacing="2" id="tabElementos">
      <tr>
        <th width="15%" scope="row"><div align="right" class="labelCampo">Tipo: </div></th>
        <td width="85%" align="left">
		<? $sql = "select cod_tipo_alimento as objCodigo, descricao as objDescricao from tipo_alimentos order by descricao";
		   $res = mysql_query($sql, $link);
		   montaComboComFuncaoComTabIndex($res, "cod_tipo_alimento", "", "", "1");
		   mysql_free_result($res);
		 ?>
        </td>
      </tr>
      <tr>
        <th scope="row"><div align="right" class="labelCampo">Nome:</div></th>
        <td align="left"><input name="alimento" type="text" class="caixaTexto" id="alimento" value="" size="30" maxlength="45" tabindex="4" /></td>
      </tr>      
      <tr>
        <th scope="row"><div align="right" class="labelCampo">Quantidade:</div></th>
        <td align="left">
		<? $sql = "select cod_quant as objCodigo, descricao as objDescricao from quantidades order by descricao";
		   $res = mysql_query($sql, $link);
		   montaComboComFuncaoComTabIndex($res, "cod_quant", "", "", "2");
		   mysql_free_result($res);
		 ?>
        </td>
      </tr>
      <tr>
        <th scope="row"><div align="right" class="labelCampo">Medida:</div></th>
        <td align="left">
	    <? $sql = "select cod_medida as objCodigo, descricao as objDescricao from medidas order by descricao";
		   $res = mysql_query($sql, $link);
		   montaComboComFuncaoComTabIndex($res, "cod_medida", "", "", "3");
		   mysql_free_result($res);
		 ?>
        </td>
      </tr>
      
     
      <tr>
        <th scope="row"><div align="right" class="labelCampo">Nro Pontos </div></th>
        <td align="left"><input name="pontos" type="text" class="caixaTexto" id="pontos" size="5" maxlength="2" tabindex="5" /></td>
      </tr>
      <tr>
        <th scope="row"><div align="right" class="labelCampo">É Alim. Pleno? </div></th>
        <td align="left"><select name="ehAlimPleno" id="ehAlimPleno">
                            <option value="0" selected>Não</option>
                            <option value="1">Sim</option>
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