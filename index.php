<img src="20121015.png">
<?php
	
	define('CUBE', '20121015.png');
	
	//print_r(getimagesize(CUBE));
	$img = imagecreatefrompng(CUBE);
	$imagex = imagesx($img);
	$imagey = imagesy($img);
	
	$red = array(255, 0, 0, 'r'); //FF0000	
	$green = array(0, 255, 0, 'g'); //00FF00
	$white = array(255, 255, 255, 'w'); //FFFFFF
	$blue = array(0, 0, 255, 'b'); //0000FF
	$orange = array(255, 160, 0, 'o'); //FF9900
	$yellow = array(255, 255, 0, 'y'); //FFFF00
	$black = array(0, 0, 0, '@'); //000000
	/*
	$histogramR = array(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
	$histogramG = array(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
	$histogramB = array(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
	*/
	$colors = array($red, $green, $blue, $white, $orange, $yellow);
		
	function writeHistogram($value, $char){
		for($i=0;$i<$value;$i++){
			echo $char;
		}
	}
	function square($value){
		return $value*$value;
	}
	function similarly($r, $g, $b, $color){
		return 1/(1+sqrt(square($r-$color[0]) + square($g-$color[1]) + square($b-$color[2])));
	}
	
	/*
	for($y = 0; $y < $imagey/3;$y++){
		for($x = $imagex*0; $x < $imagex/3; $x++){
			$rgb = imagecolorat($img, $x, $y);
			/*
			$r = ($rgb >> 16) & 0xFF;
			$g = ($rgb >> 8) & 0xFF;
			$b = $rgb & 0xFF;
			$histogramR[(int)($r/16)]++;
			$histogramG[(int)($g/16)]++;
			$histogramB[(int)($b/16)]++;
			
			
			$rgb = imagecolorsforindex($img, $rgb);
			$r = $rgb['red'];
			$g = $rgb['green'];
			$b = $rgb['blue'];
			$max = 0; 
			$maxColor = '';
			foreach($colors as $color){
				if($max < similarly($r, $g, $b, $color)){
					$max = similarly($r, $g, $b, $color);
					$maxColor = $color[3];
				}
			}
			echo $maxColor;
			/*
			if($red[0] < $r && $red[1] > $g && $red[2] > $b){
				echo 'r';
			}else if($gren[0] > $r && $green[1] < $g && $green[2] > $b){
				echo 'g';	
			}else if($blue[0] > $r && $blue[1] > $g && $blue[2] < $b){
				echo 'b';
			}else if($white[0] < $r && $white[1] < $g && $white[2] < $b){
				echo 'w';
			}else{
				echo '@';
			}
			
			
			
		}
		echo '<br>';
	}
	*/
	echo '<table>';
	for($j=0; $j<3; $j++){
		echo '<tr>';
		for($i=0; $i<3; $i++){
			for($y = $imagey*($j/3); $y < $imagey*(($j+1)/3); $y++){
				for($x = $imagex*($i/3); $x < $imagex*(($i+1)/3); $x++){
					$rgb = imagecolorat($img, $x, $y);
					$rgb = imagecolorsforindex($img, $rgb);
					$r = $rgb['red'];
					$g = $rgb['green'];
					$b = $rgb['blue'];
					$maxSimilarly = 0; 
					$similarlyColor = '';
					foreach($colors as $color){
						if($maxSimilarly < similarly($r, $g, $b, $color)){
							$maxSimilarly = similarly($r, $g, $b, $color);
							$similarlyColor = $color[3];
						}
					}
					$colorCount[$similarlyColor]++;
					//echo $similarlyColor;
				}
				//echo '<br>';
			}
			$maxColor = max($colorCount);
			$colorCount = array_flip($colorCount);
			echo '<td>' . $colorCount[$maxColor] . '</td>';
			$colorCount = array(
				'r' => 0,
				'g' => 0,
				'b' => 0,
				'w' => 0,
				'o' => 0,
				'y' => 0
			);
		}
		echo '</tr>';
	}
	echo '</table>';
	
	
	
	/*
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
	*/
	
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