<?php
/*
*******************************************************************************************************************************
*	Rotina para gerar códigos de barra padrão 2of5 .
*	Este script foi testado com o leitor de código de barras e esta OK.
*	Basta chamar a função fbarcode("01202") com o valor
**********************************************************************************************************************************
*/

if(isset($_POST['inicio']) && isset($_POST['fim'])){

	$inicio = $_POST['inicio'];
	$fim = $_POST['fim'];

	for ($ii=$inicio;$ii<=$fim;$ii++)
	{
		$digitos = str_pad($ii, 4, "0", STR_PAD_LEFT);
		//$valor = "867000000000000455634100000000000000007".$digitos; // Valor Inicial
		$valor = "867000000000000456782100000000000000008".$digitos; // Valor Inicial
		$vetor21 = "08".$digitos;
		
		$quarto_num = modulo10($valor);

		//$valor_com_mod10_quarto = "867".$var_mod10."00000000000045474020000000000000000006".$digitos; // Valor Inicial

		$primeiro_onze = "867".$quarto_num."0000000";

		$mod10_primeiroOnze = modulo10($primeiro_onze);

		//$novo_cod = "867".$quarto_num."0000000".$mod10_primeiroOnze."00000454740000000000000000000".$digitos;
		$novo_cod = "867".$quarto_num."0000000".$mod10_primeiroOnze."00000456782100000000000000008".$digitos;
	
		$ultimo_onze = "0000008".$digitos;
		
		$mod10_ultimo_onze = modulo10($ultimo_onze);
		
		//$novo_cod2 = "867".$quarto_num."000000000000454740000000000000000000".$digitos;
		$novo_cod2 = "867".$quarto_num."000000000000456782100000000000000008".$digitos;
	
		fbarcode($novo_cod2,$digitos,$quarto_num,$mod10_ultimo_onze,$mod10_primeiroOnze);
		
		fbarcode2($vetor21); 
	//echo $vetor[$ii];
	}

}

function modulo10($num)
    {
        /*
            Autor:
                    Pablo Costa <hide@address.com>
            Função:
                    Calculo do Modulo 10 para geracao do digito verificador 
                    de boletos bancarios conforme documentos obtidos 
                    da Febraban - www.febraban.org.br 
            Entrada:
                    $num: string numérica para a qual se deseja calcularo digito verificador;
            Saída:
                    Retorna o Digito verificador.
            Linguagem:
                    PHP.
            Observações:
                    - Script desenvolvido sem nenhum reaproveitamento de código pré existente.
                    - Assume-se que a verificação do formato das variáveis de entrada é feita antes da execução deste script.
        */                                        

        $numtotal10 = 0;
        $fator = 2;

        // Separacao dos numeros
        for ($i = strlen($num); $i > 0; $i--) {
            // pega cada numero isoladamente
            $numeros[$i] = substr($num,$i-1,1);
            // Efetua multiplicacao do numero pelo (falor 10)
            $parcial10[$i] = $numeros[$i] * $fator;
            // monta sequencia para soma dos digitos no (modulo 10)
            $numtotal10 .= $parcial10[$i];
            if ($fator == 2) {
                $fator = 1;
            } else {
                $fator = 2;		// intercala fator de multiplicacao (modulo 10)
            }
        }

        $soma = 0;
        // Calculo do modulo 10
        for ($i = strlen($numtotal10); $i > 0; $i--) {
            $numeros[$i] = substr($numtotal10,$i-1,1);
            $soma += $numeros[$i];				
        }

        $resto = $soma % 10;
        $digito = 10 - $resto;
        if ($resto == 0) {
            $digito = 0;
        }

        return $digito;
    }

/*function modulo11($num, $base=9, $r=0)
    {
        /**
         *   Autor:
         *           Pablo Costa <hide@address.com>
         *
         *   Função:
         *    Calculo do Modulo 10 para geracao do digito verificador 
         *    de boletos bancarios conforme documentos obtidos 
         *    da Febraban - www.febraban.org.br 
         *
         *   Entrada:
         *     $num: string numérica para a qual se deseja calcularo digito verificador;
         *     $base: valor maximo de multiplicacao [2-$base]
         *     $r: quando especificado um devolve somente o resto
         *
         *   Saída:
         *     Retorna o Digito verificador.
         *
         *   Observações:
         *     - Script desenvolvido sem nenhum reaproveitamento de código pré existente.
         *     - Assume-se que a verificação do formato das variáveis de entrada é feita antes da execução deste script.
                                                

        $soma = 0;
        $fator = 2;

        /* Separacao dos numeros 
        for ($i = strlen($num); $i > 0; $i--) {
            // pega cada numero isoladamente
            $numeros[$i] = substr($num,$i-1,1);
            // Efetua multiplicacao do numero pelo falor
            $parcial[$i] = $numeros[$i] * $fator;
            // Soma dos digitos
            $soma += $parcial[$i];
            if ($fator == $base) {
                // restaura fator de multiplicacao para 2 
                $fator = 1;
            }
            $fator++;
        }

        /* Calculo do modulo 11 
        if ($r == 0) {
            $soma *= 10;
            $digito = $soma % 11;
            if ($digito == 10) {
                $digito = 0;
            }
            return $digito;
        } elseif ($r == 1){
            $resto = $soma % 11;
            return $resto;
        }
    }
*/

      
//Guarda inicial
?>
<html>
<head>
<title>C&oacute;digo de Barras 2 of 5 em PHP</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<style type="text/css">
* { margin-top: 0; margin-right: 0; margin-left: 0;margin-bottom: 0; padding: 0;}
#imagem-boleto{
	width:1000px;
	height:650px;
	margin:0 0 35px 0;
	padding:0 0 30px 0;
	background-image:url(../FICHA%20CMEIE.jpg);
	background-repeat:no-repeat;
	background-size:100% 100%;
-webkit-background-size: 100% 100%;
-o-background-size: 100% 100%;
-khtml-background-size: 100% 100%;
-moz-background-size: 100% 100%;
}
#codigo-barras{
	position:relative;
	width:650px;
	height:auto;
	top:620px;
	left:100px;
}
#linha-digitavel{
	position:relative;
	width:480px;
	height:auto;
	top:518px;
	left:275px;
	font-family:Arial, Helvetica, sans-serif;
	font-weight:bold;
}
#inscricao-aluno{
	position:relative;
	width:200px;
	height:auto;
	top:390px;
	left:870px;
	font-family:Arial, Helvetica, sans-serif;
	font-weight:bold;
}
#cod-aluno3{
	position:relative;
	width:100px;
	height:50px;
	top:-680px;
	left:740px;
	font-family:Arial, Helvetica, sans-serif;
	font-weight:bold;
}
.cod_aluno_top {
	position:relative;
	font-size: 19px;
	margin-top:6px;
	margin-left:15px;
}
</style>
</head>

<body bgcolor="#FFFFFF" text="#000000">
   
    <?php
function fbarcode($valor,$digitos,$quarto_num,$mod10_ultimo_onze,$mod10_primeiroOnze){

	$fino = 1 ;
	$largo = 3 ;
	$altura = 50 ;
	
	  $barcodes[0] = "00110" ;
	  $barcodes[1] = "10001" ;
	  $barcodes[2] = "01001" ;
	  $barcodes[3] = "11000" ;
	  $barcodes[4] = "00101" ;
	  $barcodes[5] = "10100" ;
	  $barcodes[6] = "01100" ;
	  $barcodes[7] = "00011" ;
	  $barcodes[8] = "10010" ;
	  $barcodes[9] = "01010" ;
	  for($f1=9;$f1>=0;$f1--){
		for($f2=9;$f2>=0;$f2--){
		  $f = ($f1 * 10) + $f2 ;
		  $texto = "" ;
		  for($i=1;$i<6;$i++){
			$texto .=  substr($barcodes[$f1],($i-1),1) . substr($barcodes[$f2],($i-1),1);
		  }
		  $barcodes[$f] = $texto;
		}
	  }

?>  
<div id="imagem-boleto">
	<div id="codigo-barras">
<img src=p.gif width=<?php echo $fino*1.5?> height=<?php echo $altura*1.5?> border=0><img
	src=b.gif width=<?php echo $fino*1.5?> height=<?php echo $altura*1.5?> border=0><img
	src=p.gif width=<?php echo $fino*1.5?> height=<?php echo $altura*1.5?> border=0><img
	src=b.gif width=<?php echo $fino*1.5?> height=<?php echo $altura*1.5?> border=0><img
	<?php
	$texto = $valor ;
	if((strlen($texto) % 2) <> 0){
		$texto = "0" . $texto;
	}
	// Draw dos dados
	while (strlen($texto) > 0) {
	  $i = round(esquerda($texto,2));
	  $texto = direita($texto,strlen($texto)-2);
	  $f = $barcodes[$i];
	  for($i=1;$i<11;$i+=2){
		if (substr($f,($i-1),1) == "0") {
		  $f1 = $fino ;
		}else{
		  $f1 = $largo ;
		}
	?>
		src=p.gif width=<?php echo $f1*1.5?> height=<?php echo $altura*1.5?> border=0><img
	<?php
		if (substr($f,$i,1) == "0") {
		  $f2 = $fino ;
		}else{
		  $f2 = $largo ;
		}
	?>
		src=b.gif width=<?php echo $f2*1.5?> height=<?php echo $altura*1.5?> border=0><img
	<?php
	  }
	}
	
	// Draw guarda final
	?>
	src=p.gif width=<?php echo $largo*1.5?> height=<?php echo $altura*1.5?> border=0><img
	src=b.gif width=<?php echo $fino*1.5?> height=<?php echo $altura*1.5?> border=0><img
	src=p.gif width=<?php echo 1*1.5?> height=<?php echo $altura*1.5?> border=0>
	  <?php
//Fim da função
	


	?>
	</div>
	<div id="linha-digitavel"><?php echo "867".$quarto_num."0000000 ".$mod10_primeiroOnze." 00000456782 2 10000000000 8 0000008".$digitos." ".$mod10_ultimo_onze  ?></div>
	<div id="inscricao-aluno"><?php echo "08".$digitos?></div>

    <div id="cod-aluno">	
        <?php include_once("funcao-cod-aluno.php");  ?>
        
    </div>
</div>

<?php }
	function esquerda($entra,$comp){
		return substr($entra,0,$comp);
	}
	
	function direita($entra,$comp){
		return substr($entra,strlen($entra)-$comp,$comp);
	}?>


</body>
</html>