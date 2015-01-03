<?php
session_start();

include 'includes/conexao.php';
include './includes/montacombo.php';

//Para onde a página será redirecionada
$varDestino = $_POST["destino"];

if ($_POST["acao"] == "I")   {
	if ($_POST["origem"] == "alimento")     {

		$sql = " INSERT INTO alimentos (alimento, pontos, cod_tipo_alimento, cod_medida, cod_quant)";
		$sql .= " values ('" . tiraAcentos(trim($_POST['alimento'])) . "', " . $_POST['pontos'] . ", " . $_POST['cod_tipo_alimento'] . ", ";
		$sql .= $_POST['cod_medida'] . ", " . $_POST['cod_quant'] . ")";
		
		if (!executaIDU($sql, $link))	{
			exit;
		}
		
	}
	if ($_POST["origem"] == "ponto")	{
	
		if ($_POST["cod_alimento"]==146)	{
			$alimentos = "120,24,63,3,26,4";
		}	elseif ($_POST["cod_alimento"]==147)	{
			$alimentos = "29,32,31,39";
		}	else	{
			$alimentos = $_POST["cod_alimento"];
		}
		
		$alimento = explode(",", $alimentos);
		
		for ($i=0; $i<count($alimento); $i++)		{
			
			//Verifica os pontos do alimento selecionado
			$sql = "select pontos from alimentos where cod_alimento = " . $alimento[$i];
			$res = mysql_query($sql, $link);
			$pontoAlimento = mysql_result($res, 0, 0);
			$pontoAlimento = ($pontoAlimento*$_POST["qtde"]);
			
			$sql = "INSERT INTO pontos (cod_usuario, cod_alimento, data, cod_tprefeicao, qtde, valor) values (" . $_POST["cod_usuario"] . ", " . $alimento[$i] . ", '" . $_POST["ano"] . "-" . $_POST["mes"] . "-" . $_POST["dia"] . "', " . $_POST["cod_tprefeicao"] . ", " . $_POST["qtde"] . ", " . $pontoAlimento . ")";
			
			if (!executaIDU($sql, $link))	{
				exit;
			}
		}
				
		$varDestino .= "?dataLanc=" . $_POST["ano"] . "-" . $_POST["mes"] . "-" . $_POST["dia"] . "&cod_tprefeicao=" . $_POST["cod_tprefeicao"];	
		//echo $varDestino;	
	}

	if ($_POST["origem"] == "usuario")	{
             $sql = "INSERT INTO ";
             $sql .= "usuarios ( ";
             $sql .= "nome , ";
             $sql .= "email , ";
             $sql .= "senha , ";
             $sql .= "sexo , ";
             $sql .= "dataNasc , ";
             $sql .= "nroVigilantes , ";
             $sql .= "pesoMeta , ";
             $sql .= "pesoInicial , ";
             $sql .= "metaPontos , ";
             $sql .= "altura ";
             $sql .= ") ";
             $sql .= "VALUES ( ";
             $sql .= "'" . $_POST["nome"] . "' ";
             $sql .= ", '" . $_POST["email"] . "' ";
             $sql .= ", SHA1( '" . $_POST["senha"] . "')  ";
             $sql .= ", '" . $_POST["sexo"] . "' ";
             $sql .= ", '" . $_POST["ano"] . "-" . $_POST["mes"] . "-" . $_POST["dia"] . "'";
             $sql .= ", " . verificaNuloNumerico($_POST["nroVigilantes"]);
             $sql .= ", " . str_replace(",", ".", verificaNuloNumerico($_POST["pesoMeta"]));
             $sql .= ", " . str_replace(",", ".", verificaNuloNumerico($_POST["pesoAtual"]));
             $sql .= ", " . verificaNuloNumerico($_POST["metaPontos"]);
             $sql .= ", " . str_replace(",", ".", verificaNuloNumerico($_POST["altura"]));
             $sql .= ") ";

             if (!executaIDU($sql, $link))    {
                     exit;
             }

             $_SESSION["cod_usuario"] = mysql_insert_id($link);

            $varDestino = $_POST["destino"];
	}
}

//Acao de exclusão
if ($_GET["acao"] == "D")      {
    
    if ($_GET["origem"] == "ponto")    {
        $sql = "DELETE FROM pontos WHERE cod_ponto = " . $_GET["cod_ponto"];
        if (!executaIDU($sql, $link))	{
			exit;
		}
        $varDestino = $_GET["destino"];
        
    } else if ($_GET["origem"] == "alimento")    {
        $sql = "DELETE FROM alimentos WHERE cod_alimento = " . $_GET["cod_alimento"];
        if (!executaIDU($sql, $link))	{
            exit;
        }
        $varDestino = $_GET["destino"] . "?cod_alimento=" . $_GET["codigoAlimentoAnterior"];
    }
}

if ($_POST["acao"]=="A")     {
    
    if ($_POST["origem"]=="alimento")   {
        
        $sql = "update alimentos set ";
        $sql .= "alimento = '" . tiraAcentos(trim($_POST["alimento"])) . "', ";
        $sql .= "pontos = " . $_POST["pontos"] . ", ";
        $sql .= "cod_tipo_alimento = " . $_POST["cod_tipo_alimento"] . ", ";
        $sql .= "cod_medida = " . $_POST["cod_medida"] . ", ";
        $sql .= "cod_quant = " . $_POST["cod_quant"] . ", ";
        $sql .= "ehAlimPleno = " . $_POST["ehAlimPleno"] . " ";
        $sql .= "where ";
        $sql .= "cod_alimento = " . $_POST["cod_alimento"] . " ";
        $res = mysql_query($sql, $link);
        
        $retorno = mysql_query($sql, $link);
        
        if ($retorno)   {
            $varDestino .= "?cod_alimento=" . $_POST["cod_alimento"];
        }   else    {
            $varDestino = "alimentos-edita.php?cod_alimento=" . $_POST["cod_alimento"];
        }
        
    } else if ($_POST["origem"]=="login")   {
        $sql = "SELECT cod_usuario FROM usuarios where email='" . $_POST["email"] . "' and senha=SHA1('" . $_POST["senha"] . "')";
        //echo $sql . "<br />";
        $res = mysql_query($sql, $link);
        if (mysql_num_rows($res)>0)	{
            $lin = mysql_fetch_object($res);
            $_SESSION["cod_usuario"] = $lin->cod_usuario;
            $varDestino = "pontos-insere.php";
        }   else    {
            $varDestino = "login-invalido.php";
        }
        
    } else if ($_POST["origem"]=="esquecisenha")   {
        
        //echo $_POST["email"]; exit;
        
        if (strpos($_POST["email"], "@")<3)     {
            echo "O email informado é inválido.";
            exit;
        }
        
        //Verifica se existe este usuario
        $sql = "SELECT cod_usuario FROM usuarios where email='" . $_POST["email"] . "'";
        //echo $sql . "<br />"; exit;
        $res = mysql_query($sql, $link);
        if (mysql_num_rows($res)>0)	{
            
            $novaSenha = substr($_POST["email"], (strpos($_POST["email"], "@")-3), 2) . substr(time(), 5, 5);
            //echo $novaSenha. "<br />"; exit;
            
            $sql = "update usuarios set senha=SHA1('" . $novaSenha . "') where email='" . $_POST["email"] . "'";
            //echo $sql . "<br />"; exit;
            
            if (!executaIDU($sql, $link))	{
                exit;
            }
            
            $Name = "Site Elimina Peso"; //senders name 
            $email = "vg@novatrix.com.br"; //senders e-mail adress 
            $recipient = $_POST["email"]; //recipient 
            $mail_body = "A sua nova senha é: " . $novaSenha . "\n\rNão se esqueça de trocá-la após o primeiro acesso."; //mail body 
            $subject = "Elimina Peso - Esqueci minha senha"; //subject 
            $header = "From: ". $Name . " <" . $email . ">\r\n"; //optional headerfields 

            mail($recipient, $subject, $mail_body, $header); //mail command :) 

        }
    }
    
    if ($origem == "trocasenha")    {
            $novaSenha = $_POST["novaSenha"];
            
            if (strlen($novaSenha)<4)   {
                echo "Sua senha deve ter no mínimo 4 caracteres.";
                exit;
            }
            
            $sql = "update usuarios set senha=SHA1('" . trim($novaSenha) . "') where cod_usuario='" . $_SESSION["cod_usuario"] . "'";
            //echo $sql . "<br />"; exit;
            
            if (!executaIDU($sql, $link))	{
                exit;
            }
    }
}

if ($_POST["acao"]=="P")     {
    
    if ($origem == "listaalimentos")    {
        
        if (strlen(trim($_POST["nome"]))>3)     {
            $nome = trim($_POST["nome"]);
            
            $sql = "SELECT cod_alimento, alimento FROM alimentos WHERE alimento like '" . $nome . "%'";
            //echo $sql . "<br />"; exit;
            $res = mysql_query($sql, $link);
            if (mysql_num_rows($res)>0)	{
                //Caso nao tenha retornado nenhum registro ou algum erro no banco
                if (mysql_errno($link)>0 || mysql_num_rows($res)<1)     {
                    $retorno = array('nroReg' => 0, 'registros' => null);
                    echo json_encode($retorno);
                    exit;

                }   else    {

                    $arr = array();

                    while ($linha = mysql_fetch_object($res))   {
                        $arr[] = $linha;
                    }

                    $retorno = array('nroReg' => mysql_num_rows($res), 'registros' => $arr);

                    echo json_encode($retorno);
                    exit;
                }
            }
        }
    }
}

//Executa os comandos SQL de Insert , Delete, Update
function executaIDU($sql, $link)	{
	if (isset($sql) && strlen($sql)>6)	{
		$varChecaExecucao = mysql_query($sql, $link);
		if (!$varChecaExecucao)		{
			echo "Houve um problema na comunicação com o banco de dados.<br/>";
			echo "Por favor copie e cole este erro e envie por email a jeffprestes@gmail.com. Obrigado.<br/>";
			echo mysql_errno($link) . " - " . mysql_error($link) . "<br />" . $sql;
		}
		return $varChecaExecucao;
	}	else	{
		return false;
	}
}

mysql_close($link);
header("Location: " . $varDestino);
//echo $varDestino;


function verificaNuloNumerico($valor)   {
    if ($valor=="" || $valor==null)     {
        return 0;
    } else  {
        return $valor;
    }
}
?>
