<?php
echo "<div style='text-align:center; font-size:20px;'>";

$origin = array(
    array(1, 1, 0, 0, 0, 0, 0, 0, 0, 0),
    array(1, 1, 0, 1, 1, 0, 0, 0, 0, 0),
    array(0, 0, 0, 1, 1, 0, 0, 0, 0, 0),
    array(0, 0, 0, 0, 0, 1, 1, 1, 0, 0),
    array(1, 1, 1, 1, 1, 0, 0, 0, 0, 0),
    array(0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
    array(1, 1, 1, 0, 1, 0, 1, 1, 1, 1),
    array(1, 0, 0, 0, 1, 0, 1, 1, 1, 1),
    array(1, 0, 0, 0, 1, 0, 1, 1, 1, 1),
    array(1, 1, 0, 1, 1, 0, 0, 0, 0, 1)
);

//變動陣列
$controlArray = array();
    
//最大陣列
$maxArray = array();

//最大面積的陣列
$maxCount = 0;
    
for($i=0; $i<=count($origin); $i++){
    for($j=0; $j<=count($origin[$i]); $j++){
        
        // 判斷最大陣列裡是否有值
        if($origin[$i][$j] && !$maxArray[$i][$j]){
            $controlArray[$i][$j] = $origin[$i][$j];
            $num = 1;
            $findNum = findMaxBlock($i,$j)+1;
            
            // 如果陣列數>最大陣列數 則取代
            if($maxCount < $findNum){
                $maxArray = $controlArray;
                $maxCount = $findNum;
            }
            
            // 變動陣列歸零
            for($z=0; $z<count($origin); $z++){
                for($x=0; $x<count($origin[$z]); $x++){
                    $controlArray[$z][$x] = 0;
                }
            }
        }
    }
}

// 印出最大陣列與面積
foreach($maxArray as $key){
    echo "<br>";
    foreach($key as $value){
        echo $value;
    }
}   
echo "<br><br>最大面積", $maxCount;
    
// 找到1丟給變動陣列後num+1
function findMaxBlock($i,$j){
    global $origin, $controlArray;
  
    if($origin[$i+1][$j] && !$controlArray[$i+1][$j]){
        $controlArray[$i+1][$j] = $origin[$i+1][$j];
        $num++;
        $num += findMaxBlock($i+1,$j);
    };
    if($origin[$i][$j+1] && !$controlArray[$i][$j+1]){
        $controlArray[$i][$j+1] = $origin[$i][$j+1];
        $num++;
        $num += findMaxBlock($i,$j+1);
    };
    if($origin[$i-1][$j] && !$controlArray[$i-1][$j]){
        $controlArray[$i-1][$j] = $origin[$i-1][$j];
        $num++;
        $num += findMaxBlock($i-1,$j);
    };
    if($origin[$i][$j-1] && !$controlArray[$i][$j-1]){
        $controlArray[$i][$j-1] = $origin[$i][$j-1];
        $num++;
        $num += findMaxBlock($i,$j-1);
    };
    return $num;
}
echo '</div>';
  
?>