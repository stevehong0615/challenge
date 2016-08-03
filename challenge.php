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
// 取得最大陣列
$orginArray -> compute();
// 印出陣列
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
    
    // 
    function compute(){
       
        for($row=0; $row <= count($this->origin); $row++){
            for($col=0; $col <= count($this->origin[$row]); $col++){
                
                if($this->origin[$row][$col] && !$this->maxArray[$row][$col]){
                    $this->controlArray[$row][$col] = $this->origin[$row][$col];
                    $num = 1;
                    $findNum = $this->findMaxBlock($row,$col)+1;
                    
                    // 陣列數>最大陣列數 -> 取代
                    if($this->maxCount < $findNum){
                        $this->maxArray = $this->controlArray;
                        $this->maxCount = $findNum;
                    }
                    
                    // 變動陣列歸零
                    for($controlRow=0; $controlRow < count($this->origin); $controlRow++){
                        for($controlCol=0; $controlCol < count($this->origin[$controlRow]); $controlCol++){
                            $this->controlArray[$controlRow][$controlCol] = 0;
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
    function findMaxBlock($row,$col){
      
        if($this->origin[$row+1][$col] && !$this->controlArray[$row+1][$col]){
            $this->controlArray[$row+1][$col] = $this->origin[$row+1][$col];
            $num++;
            $num += $this->findMaxBlock($row+1,$col);
        };
        if($this->origin[$row-1][$col] && !$this->controlArray[$row-1][$col]){
            $this->controlArray[$row-1][$col] = $this->origin[$row-1][$col];
            $num++;
            $num += $this->findMaxBlock($row-1,$col);
        };
        if($this->origin[$row][$col+1] && !$this->controlArray[$row][$col+1]){
            $this->controlArray[$row][$col+1] = $this->origin[$row][$col+1];
            $num++;
            $num += $this->findMaxBlock($row,$col+1);
        };
        if($this->origin[$row][$col-1] && !$this->controlArray[$row][$col-1]){
            $this->controlArray[$row][$col-1] = $this->origin[$row][$col-1];
            $num++;
            $num += $this->findMaxBlock($row,$col-1);
        };
        return $num;
    }
}
echo '</div>';
?>