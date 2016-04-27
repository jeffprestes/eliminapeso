<?php
include "includes/conexao.php";
include "includes/montacombo.php";
include 'includes/sessionhandle.php';

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
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1" /> 
    <title>Tabela Elimina Peso - Pontos - Inclusão</title>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">
    <script src="//code.jquery.com/jquery-1.10.2.js"></script>
    <script src="//code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
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
        .custom-combobox {
		position: relative;
		display: inline-block;
	}
	.custom-combobox-toggle {
		position: absolute;
		top: 0;
		bottom: 0;
		margin-left: -1px;
		padding: 0;
	}
	.custom-combobox-input {
		margin: 0;
		padding: 5px 10px;
	}
        -->
    </style>
    <link href="estilos.css" rel="stylesheet" type="text/css" />
    <script>
	(function( $ ) {
		$.widget( "custom.combobox", {
			_create: function() {
				this.wrapper = $( "<span>" )
					.addClass( "custom-combobox" )
					.insertAfter( this.element );

				this.element.hide();
				this._createAutocomplete();
				this._createShowAllButton();
			},

			_createAutocomplete: function() {
				var selected = this.element.children( ":selected" ),
					value = selected.val() ? selected.text() : "";

				this.input = $( "<input>" )
					.appendTo( this.wrapper )
					.val( value )
					.attr( "title", "" )
					.addClass( "custom-combobox-input ui-widget ui-widget-content ui-state-default ui-corner-left" )
					.autocomplete({
						delay: 0,
						minLength: 0,
						source: $.proxy( this, "_source" )
					})
					.tooltip({
						tooltipClass: "ui-state-highlight"
					});

				this._on( this.input, {
					autocompleteselect: function( event, ui ) {
						ui.item.option.selected = true;
						this._trigger( "select", event, {
							item: ui.item.option
						});
					},

					autocompletechange: "_removeIfInvalid"
				});
			},

			_createShowAllButton: function() {
				var input = this.input,
					wasOpen = false;

				$( "<a>" )
					.attr( "tabIndex", -1 )
					.attr( "title", "Show All Items" )
					.tooltip()
					.appendTo( this.wrapper )
					.button({
						icons: {
							primary: "ui-icon-triangle-1-s"
						},
						text: false
					})
					.removeClass( "ui-corner-all" )
					.addClass( "custom-combobox-toggle ui-corner-right" )
					.mousedown(function() {
						wasOpen = input.autocomplete( "widget" ).is( ":visible" );
					})
					.click(function() {
						input.focus();

						// Close if already visible
						if ( wasOpen ) {
							return;
						}

						// Pass empty string as value to search for, displaying all results
						input.autocomplete( "search", "" );
					});
			},

			_source: function( request, response ) {
				var matcher = new RegExp( $.ui.autocomplete.escapeRegex(request.term), "i" );
				response( this.element.children( "option" ).map(function() {
					var text = $( this ).text();
					if ( this.value && ( !request.term || matcher.test(text) ) )
						return {
							label: text,
							value: text,
							option: this
						};
				}) );
			},

			_removeIfInvalid: function( event, ui ) {

				// Selected an item, nothing to do
				if ( ui.item ) {
					return;
				}

				// Search for a match (case-insensitive)
				var value = this.input.val(),
					valueLowerCase = value.toLowerCase(),
					valid = false;
				this.element.children( "option" ).each(function() {
					if ( $( this ).text().toLowerCase() === valueLowerCase ) {
						this.selected = valid = true;
						return false;
					}
				});

				// Found a match, nothing to do
				if ( valid ) {
					return;
				}

				// Remove invalid value
				this.input
					.val( "" )
					.attr( "title", value + " didn't match any item" )
					.tooltip( "open" );
				this.element.val( "" );
				this._delay(function() {
					this.input.tooltip( "close" ).attr( "title", "" );
				}, 2500 );
				this.input.autocomplete( "instance" ).term = "";
			},

			_destroy: function() {
				this.wrapper.remove();
				this.element.show();
			}
		});
	})( jQuery );

	</script>
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
                  $res = mysqli_query($link, $sql);
                  if (mysqli_errno($link)<1 && mysqli_num_rows($res)>0)	{
                        $row = mysqli_fetch_assoc($res);
                        $nome = $row["nome"];
                        $metaPontos =  $row["metaPontos"];
                  }	else	{
                        $nome = "Usuário";
                        $metaPontos = 0;
                  }
                  ?>
                <th colspan="2" align="center" scope="row">Olá, <?=$nome?>! </th>
              </tr>
              <tr>
                  <?
                  $sql = "SELECT IFNULL(sum(valor), 0) total from pontos where cod_usuario = " . $cod_usuario . " and data = '" . $dataSql . "'";
                  //echo $sql;
                  $res = mysqli_query($link, $sql);
                  if (mysqli_errno($link)<1 && mysqli_num_rows($res)>0)	{
                    $row = mysqli_fetch_assoc($res);
                                $totalPontos = $row["total"];
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
                    <div class="ui-widget">
                    <? $sql = "SELECT cod_tprefeicao as objCodigo, desc_tprefeicao as objDescricao FROM tipo_refeicao ORDER BY ordem";
                           $res = mysqli_query($link, $sql);
                           montaComboComFuncaoComTabIndex($res, "cod_tprefeicao", $tprefeicao, "", "4");
                           mysqli_free_result($res);
                         ?>
                    </div>
                </td>
              </tr>
              <tr>
                <th scope="row"><div align="right" class="labelCampo">Alim:</div></th>
                <td align="left"><div class="ui-widget">
                        <? 	$sql = "SELECT ";
                                $sql .= "concat_ws(', ', a.alimento, concat_ws(' ', c.descricao, d.descricao)) as objDescricao, a.cod_alimento as objCodigo ";
                                $sql .= "FROM  alimentos a  , tipo_alimentos b  , quantidades c  , medidas d ";
                                $sql .= "WHERE a.cod_tipo_alimento = b.cod_tipo_alimento and a.cod_quant = c.cod_quant and a.cod_medida = d.cod_medida ";
                                $sql .= "ORDER BY a.alimento ";
                           $res = mysqli_query($link, $sql);
                           montaComboComFuncaoComTabIndexVazio($res, "cod_alimento", "", "", "5");
                           mysqli_free_result($res);
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
                                <input name="btnListaAlimentos" type="button" class="botoes" id="btnListaAlimentos" value="Lista Alimentos" onclick="listaAlimentos()" tabindex="10" />
                                &nbsp;&nbsp;
                                <input name="btnRelatorioSemanal" type="button" class="botoes" id="btnRelatorioSemanal" value="Jornal Semanal" onclick="relatorioSemanal()" tabindex="11" />
                    &nbsp;&nbsp;
                    <input name="btnTrocaSenha" type="button" class="botoes" id="btnTrocaSenha" value="Troca Senha" onclick="trocaSenha()" tabindex="12" />
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
        $res = mysqli_query($link, $sql);
        $i = 0;
        $tpRefeicao = "";
        if (mysqli_num_rows($res)>0)	{
                while($lin = mysqli_fetch_object($res))	{
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
        mysqli_free_result($res);
        ?>          

                </table></th>
              </tr>
            </table></th>
          </tr>
        </table>
        <script language="javascript">
                function novoAlimento()	{
                        document.location='alimentos-insere.php?destino=pontos-insere.php';
                }
                
                function listaAlimentos()	{
                        document.location='alimentos-lista.php';
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
                                alert("Você deve preencher o campo quantidade.");
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
                
                
                $(function() {
                    $( "#cod_alimento" ).combobox();
                    $( "#toggle" ).click(function() {
			$( "#combobox" ).toggle();
                    });
                });
        </script>
    <!-- </div> -->
</body>
</html>
<?
mysqli_close($link);
?>