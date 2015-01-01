<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Tabela Elimina Peso - Usu&aacute;rios - Inclus&atilde;o</title>
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
<table width="99%" border="1" cellpadding="0" cellspacing="0" bordercolor="#2A1F00">
<form name="frm" id="frm" method="post" action="acoes.php">
  <input type="hidden" name="acao" id="acao" value="I" />
  <input type="hidden" name="origem" id="origem" value="usuario" />
  <input type="hidden" name="destino" id="destino" value="pontos-insere.php" />
  <tr>
    <th scope="row"><table width="99%" cellpadding="0" cellspacing="2" id="tabElementos">
      <tr>
          <th colspan="2" class="tabelaTitulo" scope="row"><div style="align:center">Insira seus dados pessoais abaixo <br /> para ter acesso ao sistema</div></th>
      </tr>
      <tr>
        <th width="25%" scope="row"><div align="right" class="labelCampo">Nome: * </div></th>
        <td width="75%" align="left"><input name="nome" type="text" class="caixaTexto" id="nome" value="" size="30" maxlength="45" tabindex="1" /></td>
      </tr>
      <tr>
        <th scope="row"><div align="right" class="labelCampo">Email: * </div></th>
        <td align="left"><input name="email" type="text" class="caixaTexto" id="email" size="30" maxlength="45" tabindex="2" /></td>
      </tr>
      <tr>
        <th scope="row"><div align="right" class="labelCampo">Senha: * </div></th>
        <td align="left"><input name="senha" type="password" class="caixaTexto" id="senha" value="" size="8" maxlength="8" tabindex="3" /></td>
      </tr>
      <tr>
        <th scope="row"><div align="right" class="labelCampo">Sexo: * </div></th>
        <td align="left"><select name="sexo" class="caixaTexto" id="sexo" tabindex="4">
          <option selected="selected"> -- </option>
<option value="M">Masculino</option>
          <option value="F">Feminino</option>
        </select></td>
      </tr>
      <tr>
        <th scope="row"><div align="right" class="labelCampo">Data Nasc: * </div></th>
        <td align="left"><input name="dia" type="text" class="caixaTexto" id="dia" tabindex="1" value="" onkeypress="mascara(this,soNumeros)" size="2" maxlength="2" tabindex="5"
                                     /
                                     <input name="mes" type="text" class="caixaTexto" id="mes" tabindex="2" value="" size="2" maxlength="2" tabindex="6" onkeypress="mascara(this,soNumeros)" />
                                     /
                                     <input name="ano" type="text" class="caixaTexto" id="ano" tabindex="3" value="" size="4" maxlength="4" tabindex="7" onkeypress="mascara(this,soNumeros)" /></td>
      </tr>
      <tr>
        <th scope="row"><div align="right" class="labelCampo">Nro Programa:</div></th>
        <td align="left"><input name="nroVigilantes" type="text" class="caixaTexto" id="nroVigilantes" onkeypress="mascara(this,soNumeros)" size="8" maxlength="8" tabindex="8" /></td>
      </tr>
      <tr>
        <th scope="row"><div align="right" class="labelCampo">Peso Meta:</div></th>
        <td align="left"><input name="pesoMeta" type="text" class="caixaTexto" id="pesoMeta" size="6" maxlength="6" tabindex="9" onkeypress="mascara(this,soNumeroDecimais)" /></td>
      </tr>
      <tr>
        <th scope="row"><div align="right" class="labelCampo">Peso Atual:</div></th>
        <td align="left"><input name="pesoAtual" type="text" class="caixaTexto" id="pesoAtual" size="6" maxlength="6" tabindex="10" onkeypress="mascara(this,soNumeroDecimais)" /></td>
      </tr>
      <tr>
        <th scope="row"><div align="right" class="labelCampo">Pontos atual:</div></th>
        <td align="left"><input name="metaPontos" type="text" class="caixaTexto" id="metaPontos" size="2" maxlength="2" tabindex="11" onkeypress="mascara(this,soNumeros)" /></td>
      </tr>
      <tr>
        <th scope="row"><div align="right" class="labelCampo">Altura:</div></th>
        <td align="left"><input name="altura" type="text" class="caixaTexto" id="altura" size="4" maxlength="4" tabindex="12" onkeypress="mascara(this,soNumeroDecimais)" /></td>
      </tr>
      <tr>
        <th scope="row"><div align="right"></div></th>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <th colspan="2" align="center" scope="row">* Campos obrigatórios</th>
      </tr>
      <tr>
        <th colspan="2" align="center" scope="row">
          <div align="center">
            <input name="btnSalvar" type="button" class="botoes" id="btnSalvar" value="Salvar" onclick="valida()" tabindex="13" />
			&nbsp;&nbsp;&nbsp;</div></th>
        </tr>
    </table></th>
  </tr>
  </form>
</table>
<script language="javascript">
    function valida()   {
        var frm = document.frm;

        if (frm.nome.value.length<3) {
            alert("Você deve informar o seu nome.");
            frm.nome.focus();
            return false;
        }

        if (!checkMail(frm.email.value)) {
            alert("Você deve informar um email válido.");
            frm.email.focus();
            return false;
        }

        if (frm.senha.value.length<6)   {
            alert("Você deve informar uma senha de ao menos 6 digitos.");
            frm.senha.focus();
            return false;
        }

        if (frm.sexo.value=="")     {
            alert("Você deve informar seu sexo.");
            frm.sexo.focus();
            return false;
        }

        if (frm.nroVigilantes.value.length>0 && checkNumeroInteiro(frm.nroVigilantes.value))    {
            alert("Você deve informar um numero de associado dos vigilantes válido ou deixar em branco.");
            frm.nroVigilantes.focus();
            return false;
        }

        if (frm.pesoMeta.value.length>0 && checkNumeroInteiro(frm.pesoMeta.value))    {
            alert("Você deve informar o peso a ser atingido através de um numero válido ou deixar em branco.");
            frm.pesoMeta.focus();
            return false;
        }

        if (frm.pesoAtual.value.length>0 && checkNumeroInteiro(frm.pesoAtual.value))    {
            alert("Você deve informar um numero de associado dos vigilantes válido ou deixar em branco.");
            frm.pesoAtual.focus();
            return false;
        }

        if (frm.metaPontos.value.length>0 && checkNumeroInteiro(frm.metaPontos.value))    {
            alert("Você deve informar um numero válido para seus pontos atuais ou deixar em branco.");
            frm.metaPontos.focus();
            return false;
        }

        if (frm.altura.value.length>0 && checkNumeroInteiro(frm.altura.value))    {
            alert("Você deve informar um numero para sua altura válido ou deixar em branco.");
            frm.altura.focus();
            return false;
        }

        frm.submit();
    }

    function checkMail(mail){
        var er = new RegExp(/^[A-Za-z0-9_\-\.]+@[A-Za-z0-9_\-\.]{2,}\.[A-Za-z0-9]{2,}(\.[A-Za-z0-9])?/);
        if(typeof(mail) == "string"){
                if(er.test(mail)){ return true; }
        }else if(typeof(mail) == "object"){
                if(er.test(mail.value)){
                                        return true;
                                }
        }else{
           return false;
        }
    }

    function mascara(o,f)   {
        v_obj=o
        v_fun=f
        setTimeout("execmascara()",1)
    }

    function execmascara(){
        v_obj.value=v_fun(v_obj.value)
    }

    function soNumeros(v){
        return v.replace(/\D/g,"")
    }

    function soNumeroDecimais(v)    {
        v=v.replace(/\D/g,"") // permite digitar apenas numero
        v=v.replace(/(\d{1})(\d{14})$/,"$1.$2") // coloca ponto antes dos ultimos digitos
        v=v.replace(/(\d{1})(\d{11})$/,"$1.$2") // coloca ponto antes dos ultimos 11 digitos
        v=v.replace(/(\d{1})(\d{8})$/,"$1.$2") // coloca ponto antes dos ultimos 8 digitos
        v=v.replace(/(\d{1})(\d{5})$/,"$1.$2") // coloca ponto antes dos ultimos 5 digitos
        v=v.replace(/(\d{1})(\d{1,2})$/,"$1,$2") // coloca virgula antes dos ultimos 2 digitos
        return v;
    }

    function checkNumeroDecimal(valor)     {
        reDecimalPt = /^[+-]?((\d+|\d{1,3}(\.\d{3})+)(\,\d*)?|\,\d+)$/;
        return reDecimalPt.test(valor);
    }

    function checkNumeroInteiro(valor)  {
        reDigits = /^\D+$/;
        return reDigits.test(valor);
    }

</script>
</body>
</html>