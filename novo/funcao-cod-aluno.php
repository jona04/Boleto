

<?php 
//	$digitos = str_pad($ii, 4, "0", STR_PAD_LEFT);
//	$valor21 = "04".$digitos;
	
	
//	fbarcode2($valor21);

function fbarcode2($valor){

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
<div id="cod-aluno3">
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
	  $i = round(esquerda2($texto,2));
	  $texto = direita2($texto,strlen($texto)-2);
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
    <div class="cod_aluno_top"><?php echo $valor ?></div>
</div> 	   
    <?php } ?>

    <?php 
	function esquerda2($entra,$comp){
		return substr($entra,0,$comp);
	}
	
	function direita2($entra,$comp){
		return substr($entra,strlen($entra)-$comp,$comp);
	}?>
