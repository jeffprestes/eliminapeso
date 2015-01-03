<?php
include "./includes/conexao.php";
include "./includes/montacombo.php";

$sql = "SELECT \n"
    . "b.descricao as tipoAlimento, a.cod_alimento, concat_ws(' ', a.alimento, concat_ws(' ', c.descricao, d.descricao)) as alimento, a.pontos, \n"
    . "IFNULL(\n"
    . " (select count(e.cod_alimento) from pontos as e where e.cod_alimento=a.cod_alimento group by e.cod_alimento)\n"
    . " ,0) as nroUso \n"
    . "FROM \n"
    . "alimentos a, tipo_alimentos b, quantidades c, medidas d WHERE a.cod_tipo_alimento = b.cod_tipo_alimento and a.cod_quant = c.cod_quant and a.cod_medida = d.cod_medida ORDER BY a.alimento, b.descricao";

//echo $sql;
$res = mysql_query($sql, $link);
//exit;
?>
<html lang="pt-br">
    <head>
        <link rel="stylesheet" href="listagemalimentos.css" type="text/css"/>
        <link href="estilos.css" rel="stylesheet" type="text/css" />
        <meta charset="ISO-8859-1" />
        <meta name="viewport" content="width=device-width, initial-scale=1" /> 
        <title>Tabela Elimina Peso - Alimentos - Inclus&atilde;o</title>
        <style>
            body {
                background-color: #C0DCC0;
                font-family: Tahoma, Arial Narrow, MS Outlook, Verdana;
            }
        </style>
    </head>
    <body>
        <h1>Listagem de alimentos</h1>
        <div style="left:50%;width: 300px; margin: 0 auto;">
            <input name="btnIncluir" type="button" class="botoes" id="btnIncluir" value="Incluir Alimento" onclick="document.location='alimentos-insere.php'"/>
            <span style="width: 25px"></span>
            <input name="btnNova" type="button" class="botoes" id="btnNovaRefeicao" value="Nova Refeição" onclick="document.location='pontos-insere.php'"/>
        </div>
        <div style='height: 30px'></div>
        <div class="ListagemAlimentos" style="width:99%">
                <table >
                        <tr> 
                                <td>
                                        Categoria
                                </td>
                                <td >
                                        Alimento
                                </td>
                                <td>
                                        Pontos
                                </td>
                                <td>
                                        Vezes Consumidas
                                </td>
                                <td>
                                        Excluir?
                                </td>
                        </tr>
<?
    $codigoAlimentoAnterior = 0;
    while ($lin = mysql_fetch_array($res, MYSQL_ASSOC))   {
?>
        <tr>
            <td>
                <?=$lin["tipoAlimento"]?>
            </td>
            <td>
                <a name="<?=$lin["cod_alimento"]?>" href="alimentos-edita.php?cod_alimento=<?=$lin["cod_alimento"]?>"><?=$lin["alimento"]?></a>
            </td>
            <td style="text-align: center">
                <?=$lin["pontos"]?>
            </td>
            <td style="text-align: center">
                <?=$lin["nroUso"]?>
            </td>
            <td style="text-align: center">
                <a href='acoes.php?cod_alimento=<?=$lin["cod_alimento"]?>&acao=D&codigoAlimentoAnterior=<?=$codigoAlimentoAnterior?>&origem=alimento&destino=alimentos-lista.php'>Excluir</a>
            </td>
        </tr>
<?      $codigoAlimentoAnterior=$lin["cod_alimento"];
    }
?>
                </table>
        </div>
        <br />
        <br />
        <div style="margin-top: 100px; left:50%;width: 300px; margin: 0 auto;">
            <input name="btnIncluir" type="button" class="botoes" id="btnIncluir" value="Incluir Alimento" onclick="document.location='alimentos-insere.php'"/>
            <span style="width: 25px"></span>
            <input name="btnNova" type="button" class="botoes" id="btnNovaRefeicao" value="Nova Refeição" onclick="document.location='pontos-insere.php'"/>
        </div>
    </body>
    <script>
        //Chama a ancora do ultimo alimento inserido ou alterado
        this.location = "#" + <?=$_GET["cod_alimento"]?>;
    </script>
</html>
<?
mysql_close($link);
?>