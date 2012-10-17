<?php
	
	define('CUBE', '20121015.png');
	
	//print_r(getimagesize(CUBE));
	$img = imagecreatefrompng(CUBE);
	$imagex = imagesx($img);
	$imagey = imagesy($img);
	
	$red = array(150, 110, 110);
	$green = array(110, 80, 110);
	$white = array(110, 110, 110);
	$blue = array(100, 100, 80);
	$histogramR = array(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
	$histogramG = array(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
	$histogramB = array(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
	
	function writeHistogram($value, $char){
		for($i=0;$i<$value;$i++){
			echo $char;
		}
	}
	
	for($y = 0; $y < $imagey;$y++){
		for($x = 0; $x < $imagex; $x++){
			$rgb = imagecolorat($img, $x, $y);
			$r = ($rgb >> 16) & 0xFF;
			$g = ($rgb >> 8) & 0xFF;
			$b = $rgb & 0xFF;
			$histogramR[(int)($r/16)]++;
			$histogramG[(int)($g/16)]++;
			$histogramB[(int)($b/16)]++;
			/*
			$colors = imagecolorsforindex($img, $rgb);
			$r = $colors['red'];
			$g = $colors['green'];
			$b = $colors['blue'];
			if($white[0] < $r && $white[1] < $g && $white[2] < $b){
				echo 'w';
			}else if($red[0] < $r && $red[1] > $g && $red[2] > $b){
				echo 'r';
			}else if($gren[0] > $r && $green[1] < $g && $green[2] > $b){
				echo 'g';	
			}else if($blue[0] > $r && $blue[1] > $g && $blue[2] < $b){
				echo 'b';
			}else{
				echo '@';
			}
			*/
		}
	}
	echo 'Red <br>';
	foreach($histogramR as $countR){
		writeHistogram($countR/100, 'r');
		echo '<br>';
	}
	echo 'Green <br>';
	foreach($histogramG as $countG){
		writeHistogram($countG/100, 'g');
		echo '<br>';
	}
	echo 'Blue <br>';
	foreach($histogramB as $countB){
		writeHistogram($countB/100, 'b');
		echo '<br>';
	}
?>
<!DOCTYPE html>
<html> 
	<head>
		<meta charset="utf-8">
		<title>rubic</title>
	</head>
	<body>
		<dl>
			<dt>x</dt><dd><?php echo imagesx($img); ?></dd>
			<dt>y</dt><dd><?php echo imagesy($img); ?></dd>
		</dl>
	</body>
</html>