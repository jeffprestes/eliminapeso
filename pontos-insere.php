<?
session_start();

include "includes/conexao.php";
include "includes/montacombo.php";

header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); // Date in the past

$cod_usuario = $_SESSION["cod_usuario"];

//Vari�veis da p�gina 

//Define a data do dia do lan�amento
if (isset($dataLanc))	{
	$dataSql = $dataLanc;
} else	{
	$dataSql = date("Y") . "-" . date("m") . "-" . date("d");
}
list($ano, $mes, $dia) = explode("-", $dataSql);
$data = date("d/m/Y");

//Define a refei��o que provavelmente o cliente vai ter
//Caso uma refeicao nao tenha sido cadastrada nessa sessao, tenta advinhar baseando-se no horario
if ($_GET["cod_tprefeicao"]==null)   {
    $tprefeicao = 0;
    if (date("H")<10)	{
            $tprefeicao = 1;
    } else if (date("H")>=10 && date("H")<12)	{
            $tprefeicao = 4;
    } else if (date("H")>=12 && date("H")<15)	{
            $tprefeicao = 2;	
    } else if (date("H")>=15 && date("H")<18)	{
            $tprefeicao = 5;	
    } else if (date("H")>=18 && date("H")<=23)	{
            $tprefeicao = 3;
    }
//Caso contrario repete a refeicao definida anteriormente
}   else    {
    $tprefeicao = $_GET["cod_tprefeicao"];
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    <meta name="viewport" content="width=device-width, initial-scale=1" /> 
    <title>Tabela Elimina Peso - Pontos - Inclus&atilde;o</title>
    <link rel="stylesheet" href="http://vg.novatrix.com.br/jquery/themes/base/jquery.ui.all.css"></link>
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
        
        .ui-combobox {
		position: relative;
		display: inline-block;
	}
	.ui-button {
		position: absolute;
		top: 0;
		bottom: 0;
		margin-left: -1px;
		padding: 0;
		/* adjust styles for IE 6/7 */
		*height: 1.7em;
		*top: 0.1em;
	}
	.ui-autocomplete-input {
		margin: 0;
		padding: 0.3em;
	}
        -->
    </style>
    <link href="estilos.css" rel="stylesheet" type="text/css" />
</head>
<body>
    <!-- <div data-role="page" class="type-interior"> -->
        <table width="320" border="1" cellpadding="0" cellspacing="0" bordercolor="#2A1F00">
        <form name="frm" id="frm" method="post" action="acoes.php">
          <input type="hidden" name="acao" id="acao" value="I" />
          <input type="hidden" name="origem" id="origem" value="ponto" />
          <input type="hidden" name="destino" id="destino" value="pontos-insere.php" />  
          <input type="hidden" name="cod_usuario" id="cod_usuario" value="<?=$cod_usuario?>" />
          <tr>
            <th scope="row"><table width="100%" cellpadding="0" cellspacing="2" id="tabElementos">
              <tr>
                  <?
                  $sql = "SELECT nome, metaPontos FROM usuarios u where cod_usuario = " . $cod_usuario;
                  $res = mysql_query($sql, $link);
                  if (mysql_errno($link)<1 && mysql_num_rows($res)>0)	{
                                $nome = mysql_result($res, 0, 0);
                                $metaPontos = mysql_result($res, 0, 1);
                  }	else	{
                                $nome = "Usu�rio";
                                $metaPontos = 0;
                  }
                  ?>
                <th colspan="2" align="center" scope="row">Ol&aacute; <?=$nome?>! </th>
              </tr>
              <tr>
                  <?
                  $sql = "SELECT IFNULL(sum(valor), 0) total from pontos where cod_usuario = " . $cod_usuario . " and data = '" . $dataSql . "'";
                  //echo $sql;
                  $res = mysql_query($sql, $link);
                  if (mysql_errno($link)<1 && mysql_num_rows($res)>0)	{
                                $totalPontos = mysql_result($res, 0, 0);
                  }	else	{
                                $totalPontos = 0;
                  }
                  ?>
                <th colspan="2" align="center" scope="row">Total de pontos de hoje <?=$totalPontos?> de <?=$metaPontos?></th>
              </tr>
              <tr>
                <th width="60" scope="row">&nbsp;</th>
                <td width="240" align="left">&nbsp;</td>
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
                <th scope="row"><div align="right" class="labelCampo">Ref.:</div></th>
                <td align="left">
                    <? $sql = "SELECT cod_tprefeicao as objCodigo, desc_tprefeicao as objDescricao FROM tipo_refeicao ORDER BY ordem";
                           $res = mysql_query($sql, $link);
                           montaComboComFuncaoComTabIndex($res, "cod_tprefeicao", $tprefeicao, "", "4");
                           mysql_free_result($res);
                         ?>        </td>
              </tr>
              <tr>
                <th scope="row"><div align="right" class="labelCampo">Alim:</div></th>
                <td align="left"><div class="ui-widget">
                        <? 	$sql = "SELECT ";
                                $sql .= "concat_ws(', ', a.alimento, concat_ws(' ', c.descricao, d.descricao)) as objDescricao, a.cod_alimento as objCodigo ";
                                $sql .= "FROM  alimentos a  , tipo_alimentos b  , quantidades c  , medidas d ";
                                $sql .= "WHERE a.cod_tipo_alimento = b.cod_tipo_alimento and a.cod_quant = c.cod_quant and a.cod_medida = d.cod_medida ";
                                $sql .= "ORDER BY a.alimento ";
                           $res = mysql_query($sql, $link);
                           montaComboComFuncaoComTabIndexVazio($res, "cod_alimento", "", "", "5");
                           mysql_free_result($res);
                         ?></div></td>
              </tr>
              <tr>
                <th scope="row"><div align="right" class="labelCampo">Qtde:</div></th>
                <td align="left"><input name="qtde" type="text" class="caixaTexto" id="qtde" tabindex="6" size="25" maxlength="3" /></td>
              </tr>
                  </form>
              <tr>
                <th scope="row"><div align="right"></div></th>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <th colspan="2" align="center" scope="row">
                  <div align="center">
                            <input name="btnSalvar" type="button" class="botoes" id="btnSalvar" value="Salvar" onclick="validaForm()" tabindex="8" />
                                <br />
                                <br />
                                &nbsp;&nbsp;
                            <input name="btnMudarData" type="button" class="botoes" id="btnMudarData" value="Mudar data" onclick="mudarData();" tabindex="7" />
                                &nbsp;&nbsp;            
                                <input name="btnNovoAlimento" type="button" class="botoes" id="btnNovoAlimento" value="Novo Alimento" onclick="novoAlimento()" tabindex="9" />
                                &nbsp;&nbsp;
                                <input name="btnRelatorioSemanal" type="button" class="botoes" id="btnRelatorioSemanal" value="Jornal Semanal" onclick="relatorioSemanal()" tabindex="10" />
                    &nbsp;&nbsp;
                    <input name="btnTrocaSenha" type="button" class="botoes" id="btnTrocaSenha" value="Troca Senha" onclick="trocaSenha()" tabindex="10" />
                  </div></th>
                </tr>
              <tr>
                <th colspan="2" align="center" scope="row">&nbsp;</th>
              </tr>
              <tr>
                <th colspan="2" align="center" scope="row"><table width="90%" border="0" cellspacing="0" cellpadding="0">
                  <tr class="tabelaTitulo">
                    <th width="75%" scope="col">Alimento</th>
                    <th width="13%" scope="col">Qt</th>
                    <th width="12%" scope="col">Pts</th>
                  </tr>
        <?		  
        $sql = "SELECT  b.cod_ponto, c.desc_tprefeicao, a.alimento , b.qtde  , b.valor ";
        $sql .= " FROM  alimentos a  , pontos b, tipo_refeicao c ";
        $sql .= " WHERE  a.cod_alimento = b.cod_alimento and b.cod_tprefeicao = c.cod_tprefeicao and b.cod_usuario =" . $cod_usuario . " and b.data = '" . $dataSql . "'";
        $sql .= " ORDER BY c.ordem";
        //echo $sql;
        $res = mysql_query($sql, $link);
        $i = 0;
        $tpRefeicao = "";
        if (mysql_num_rows($res)>0)	{
                while($lin = mysql_fetch_object($res))	{
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
                        echo "    <td class='celulaEsquerda'>&nbsp;&nbsp;<a class='linkDelecao' href='acoes.php?acao=D&origem=ponto&destino=pontos-insere.php?dataLanc=" . $dataSql . "&cod_ponto=" . $lin->cod_ponto . "'>" . $lin->alimento . "</a></td>\n";
                        echo "    <td class='celulaCentro'>" . $lin->qtde . "</td>\n";
                        echo "    <td class='celulaCentro'>" . $lin->valor . "</td>\n";
                        echo "</tr>\n";		
                        $i=1;
                    }	else	{
                                echo "<tr class='tabelaLinhaAmarelo'>\n";
                        echo "    <td class='celulaEsquerda'>&nbsp;&nbsp;<a class='linkDelecao' href='acoes.php?acao=D&origem=ponto&destino=pontos-insere.php?dataLanc=" . $dataSql . "&cod_ponto=" . $lin->cod_ponto . "'>" . $lin->alimento . "</a></td>\n";
                        echo "    <td class='celulaCentro'>" . $lin->qtde . "</td>\n";
                        echo "    <td class='celulaCentro'>" . $lin->valor . "</td>\n";
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

                </table></th>
              </tr>
            </table></th>
          </tr>
        </table>
        <script type="text/javascript" src="http://code.jquery.com/jquery-1.7.2.min.js"></script>
	<script src="http://view.jqueryui.com/master/ui/jquery.ui.core.js"></script>
	<script src="http://view.jqueryui.com/master/ui/jquery.ui.widget.js"></script>
	<script src="http://view.jqueryui.com/master/ui/jquery.ui.button.js"></script>
	<script src="http://view.jqueryui.com/master/ui/jquery.ui.position.js"></script>
	<script src="http://view.jqueryui.com/master/ui/jquery.ui.menu.js"></script>
	<script src="http://view.jqueryui.com/master/ui/jquery.ui.autocomplete.js"></script>
	<script src="http://view.jqueryui.com/master/ui/jquery.ui.tooltip.js"></script>
        <script language="javascript">
                function novoAlimento()	{
                        document.location='alimentos-insere.php?destino=pontos-insere.php';
                }

                function relatorioSemanal()		{
                        document.location='pontos-relatorio-semanal.php';	
                }
                
                function trataRetorno(data) {
                    //alert(data.nroReg);
                    if ((data.nroReg*1)>0)  {
                        $.each(data.registros, function (i, reg)   {
                            if (reg.respNome != null)   {
                                $("#cboDisponiveis").append(new Option(reg.respNome, reg.respCodigo));
                            }
                        });
                        $("#cxMsg").html("");
                    }   else    {
                        $("#cxMsg").html("N�o foi encontrado ninguem com essas letras.");
                    }
                }
                

                function mudarData()	{
                        document.location = 'pontos-insere.php?dataLanc=' + document.frm.ano.value + "-" + document.frm.mes.value + "-" + document.frm.dia.value;
                }

                function validaForm()		{
                        if (document.frm.qtde.value == "")	{
                                alert("Voc� deve preencher o campo quantidade.");
                                return false;
                        }	else	{
                                document.frm.qtde.value = document.frm.qtde.value.replace("r", "1");
                                document.frm.qtde.value = document.frm.qtde.value.replace("R", "1");
                                document.frm.qtde.value = document.frm.qtde.value.replace("t", "2");
                                document.frm.qtde.value = document.frm.qtde.value.replace("T", "2");
                                document.frm.qtde.value = document.frm.qtde.value.replace("y", "3");
                                document.frm.qtde.value = document.frm.qtde.value.replace("Y", "3");
                                document.frm.qtde.value = document.frm.qtde.value.replace("f", "4");
                                document.frm.qtde.value = document.frm.qtde.value.replace("g", "5");
                                document.frm.qtde.value = document.frm.qtde.value.replace("h", "6");
                                document.frm.qtde.value = document.frm.qtde.value.replace("v", "7");
                                document.frm.qtde.value = document.frm.qtde.value.replace("b", "8");
                                document.frm.qtde.value = document.frm.qtde.value.replace("n", "9");
                                document.frm.qtde.value = document.frm.qtde.value.replace("m", "0");			
                        }

                        document.frm.submit();
                }

                function trocaSenha()	{
                        document.location = 'trocasenha.php';
                }
                
                
                //codigo para autocomplete
                (function( $ ) {
                $.widget( "ui.combobox", {
                        _create: function() {
                                var input,
                                        that = this,
                                        select = this.element.hide(),
                                        selected = select.children( ":selected" ),
                                        value = selected.val() ? selected.text() : "",
                                        wrapper = $( "<span>" )
                                                .addClass( "ui-combobox" )
                                                .insertAfter( select );

                                function removeIfInvalid(element) {
                                        var value = $( element ).val(),
                                                matcher = new RegExp( "^" + $.ui.autocomplete.escapeRegex( value ) + "$", "i" ),
                                                valid = false;
                                        select.children( "option" ).each(function() {
                                                if ( $( this ).text().match( matcher ) ) {
                                                        this.selected = valid = true;
                                                        return false;
                                                }
                                        });
                                        if ( !valid ) {
                                                // remove invalid value, as it didn't match anything
                                                $( element )
                                                        .val( "" )
                                                        .attr( "title", value + " didn't match any item" )
                                                        .tooltip( "open" );
                                                select.val( "" );
                                                setTimeout(function() {
                                                        input.tooltip( "close" ).attr( "title", "" );
                                                }, 2500 );
                                                input.data( "autocomplete" ).term = "";
                                                return false;
                                        }
                                }

                                input = $( "<input>" )
                                        .appendTo( wrapper )
                                        .val( value )
                                        .attr( "title", "" )
                                        .addClass( "ui-state-default" )
                                        .autocomplete({
                                                delay: 0,
                                                minLength: 0,
                                                source: function( request, response ) {
                                                        var matcher = new RegExp( $.ui.autocomplete.escapeRegex(request.term), "i" );
                                                        response( select.children( "option" ).map(function() {
                                                                var text = $( this ).text();
                                                                if ( this.value && ( !request.term || matcher.test(text) ) )
                                                                        return {
                                                                                label: text.replace(
                                                                                        new RegExp(
                                                                                                "(?![^&;]+;)(?!<[^<>]*)(" +
                                                                                                $.ui.autocomplete.escapeRegex(request.term) +
                                                                                                ")(?![^<>]*>)(?![^&;]+;)", "gi"
                                                                                        ), "<strong>$1</strong>" ),
                                                                                value: text,
                                                                                option: this
                                                                        };
                                                        }) );
                                                },
                                                select: function( event, ui ) {
                                                        ui.item.option.selected = true;
                                                        that._trigger( "selected", event, {
                                                                item: ui.item.option
                                                        });
                                                },
                                                change: function( event, ui ) {
                                                        if ( !ui.item )
                                                                return removeIfInvalid( this );
                                                }
                                        })
                                        .addClass( "ui-widget ui-widget-content ui-corner-left" );

                                input.data( "autocomplete" )._renderItem = function( ul, item ) {
                                        return $( "<li>" )
                                                .data( "item.autocomplete", item )
                                                .append( "<a>" + item.label + "</a>" )
                                                .appendTo( ul );
                                };

                                $( "<a>" )
                                        .attr( "tabIndex", -1 )
                                        .attr( "title", "Show All Items" )
                                        .tooltip()
                                        .appendTo( wrapper )
                                        .button({
                                                icons: {
                                                        primary: "ui-icon-triangle-1-s"
                                                },
                                                text: false
                                        })
                                        .removeClass( "ui-corner-all" )
                                        .addClass( "ui-corner-right ui-button-icon" )
                                        .click(function() {
                                                // close if already visible
                                                if ( input.autocomplete( "widget" ).is( ":visible" ) ) {
                                                        input.autocomplete( "close" );
                                                        removeIfInvalid( input );
                                                        return;
                                                }

                                                // work around a bug (likely same cause as #5265)
                                                $( this ).blur();

                                                // pass empty string as value to search for, displaying all results
                                                input.autocomplete( "search", "" );
                                                input.focus();
                                        });

                                        input
                                                .tooltip({
                                                        position: {
                                                                of: this.button
                                                        },
                                                        tooltipClass: "ui-state-highlight"
                                                });
                        },

                        destroy: function() {
                                this.wrapper.remove();
                                this.element.show();
                                $.Widget.prototype.destroy.call( this );
                        }
                });
        })( jQuery );

        $(function() {
                $( "#cod_alimento" ).combobox();
                document.frm.cod_alimento.focus();
                
        });
        </script>
    <!-- </div> -->
</body>
</html>
<?
mysql_close($link);
?>