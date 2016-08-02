<?php
echo "<div style='font-size:25px;'>";

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

$orginArray = new block($origin);

$orginArray -> compute();

$orginArray -> printArray();

class block{
    // 變動陣列
    var $controlArray = array();
    // 最大陣列
    var $maxArray = array();
    // 原始陣列
    var $origin;
    // 最大面積的陣列
    var $maxCount = 0;
    
    function __construct($array){
        $this -> origin = $array;
    }
    
    function compute(){
       
        for($i=0; $i<=count($this->origin); $i++){
            for($j=0; $j<=count($this->origin[$i]); $j++){
                
                // 判斷最大陣列裡是否有值
                if($this->origin[$i][$j] && !$this->maxArray[$i][$j]){
                    $this->controlArray[$i][$j] = $this->origin[$i][$j];
                    $num = 1;
                    $findNum = $this->findMaxBlock($i,$j)+1;
                    
                    // 如果陣列數>最大陣列數 則取代
                    if($this->maxCount < $findNum){
                        $this->maxArray = $this->controlArray;
                        $this->maxCount = $findNum;
                    }
                    
                    // 變動陣列歸零
                    for($z=0; $z<count($this->origin); $z++){
                        for($x=0; $x<count($this->origin[$z]); $x++){
                            $this->controlArray[$z][$x] = 0;
                        }
                    }
                }
             }
        }
    }
    
    function printArray(){
        
        // 印出最大陣列與面積
        foreach($this->maxArray as $key){
            echo "<br>";
            foreach($key as $value){
                echo $value;
            }
        }   
        echo "<br><br>最大面積", $this->maxCount;
    }
    
    // 找到1丟給變動陣列後num+1
    function findMaxBlock($i,$j){
      
        if($this->origin[$i+1][$j] && !$this->controlArray[$i+1][$j]){
            $this->controlArray[$i+1][$j] = $this->origin[$i+1][$j];
            $num++;
            $num += $this->findMaxBlock($i+1,$j);
        };
        if($this->origin[$i-1][$j] && !$this->controlArray[$i-1][$j]){
            $this->controlArray[$i-1][$j] = $this->origin[$i-1][$j];
            $num++;
            $num += $this->findMaxBlock($i-1,$j);
        };
        if($this->origin[$i][$j+1] && !$this->controlArray[$i][$j+1]){
            $this->controlArray[$i][$j+1] = $this->origin[$i][$j+1];
            $num++;
            $num += $this->findMaxBlock($i,$j+1);
        };
        if($this->origin[$i][$j-1] && !$this->controlArray[$i][$j-1]){
            $this->controlArray[$i][$j-1] = $this->origin[$i][$j-1];
            $num++;
            $num += $this->findMaxBlock($i,$j-1);
        };
        return $num;
    }
}

echo '</div>';
  
?>