<?php
include './includes/conexao.php';
include './includes/montacombo.php';


$sql = "select cod_alimento, alimento from alimentos order by cod_alimento";
$res = mysql_query($sql, $link);
$i = 0;
if (mysql_num_rows($res)>0)	{
    while($lin = mysql_fetch_array($res, MYSQL_ASSOC))	{
        $update = "update alimentos set alimento = '" . tiraAcentos($lin["alimento"]) . "' where cod_alimento=" . $lin["cod_alimento"];
        $resUpdate = mysql_query($update, $link);
        if (!$resUpdate)    {
            echo "Erro nesse update " . $update;
            exit();
        }   else    {
            echo "<div>Registro atualizado com sucesso " . $update . "</div>";
        }
        unset($resUpdate);
    }
}
mysql_close($link);
?>