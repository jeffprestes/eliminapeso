<?php

if ($_SESSION["cod_usuario"]==null)     {
    header("Location: login.php");
} else {
   $cod_usuario = $_SESSION["cod_usuario"]; 
   if ($cod_usuario<1)  {
       header("Location: login.php");
   }    else    {
        header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
        header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); // Date in the past
   }
}

