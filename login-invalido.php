<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<meta name="viewport" content="width=320" />
<title>Tabela Elimina Peso - Usu&aacute;rios - Login</title>
<style type="text/css">
<!--
body,td,th {
	font-family: Tahoma, Arial Narrow, MS Outlook, Verdana;
	font-size: 11px;
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
	
</script>
</head>
<body>
<table width="260" border="1" cellpadding="0" cellspacing="0" bordercolor="#2A1F00">
<form name="frm" id="frm" method="post" action="acoes.php">
  <input type="hidden" name="acao" id="acao" value="A" />
  <input type="hidden" name="origem" id="origem" value="login" />
  <input type="hidden" name="destino" id="destino" value="pontos-insere.php" />  
  <tr>
    <th scope="row"><table width="100%" cellpadding="0" cellspacing="2" id="tabElementos">
      <tr>
	    <th colspan="2" align="center" scope="row">O usu&aacute;rio e/ou senha informados est&atilde;o inv&aacute;lidos. Tente novamente.<br /></th>
      </tr>
      <tr>	  
        <th colspan="2" align="center" scope="row">Informe seu email e senha para acessar</th>
      </tr>
      <tr>
        <th width="60" scope="row">&nbsp;</th>
        <td width="162" align="left">&nbsp;</td>
      </tr>
	  <tr>
        <th scope="row"><div align="right" class="labelCampo">Email:</div></th>
	    <td align="left"><input name="email" type="text" id="email" maxlength="100" /></td>
	    </tr>
	  <tr>
        <th scope="row"><div align="right" class="labelCampo">Senha:</div></th>
        <td align="left"><input name="senha" type="password" id="senha" size="10" maxlength="8" /></td>
      </tr>
      </form>
      <tr>
        <th scope="row"><div align="right"></div></th>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <th colspan="2" align="center" scope="row">
          <div align="center">
		    <input name="btnLogin" type="button" class="botoes" id="btnLogin" value=" Login " onclick="validaForm()" tabindex="8" />
			<br />
			<br />			
            </div></th>
        </tr>
      <tr>
        <th colspan="2" align="center" scope="row">&nbsp;</th>
      </tr>
</table>
<script language="javascript">
	document.frm.email.focus();
	
	
	function validaForm()		{
		if (document.frm.email.value == "")	{
			alert("Voc� deve preencher o campo email.");
			return false;
		}   else if (document.frm.senha.value == "")	{
			alert("Voc� deve preencher o campo senha.");
			return false;
		}	
		
		document.frm.submit();
	}
</script>
</body>
</html>