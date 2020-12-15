<html>
<meta charset="utf-8"/>
<head><title>kanji2number.php</title></head>
<body>
<?php
    function number($k){
        $result;
        if ($k == "零"){
            $result = 0;
        } else if ($k == "壱"){
            $result = 1;
        } elseif ($k == "弐"){
            $result = 2;
        } elseif ($k == "参"){
            $result = 3;
        } elseif ($k == "四"){
            $result = 4;
        } elseif ($k == "五"){
            $result = 5;
        } elseif ($k == "六"){
            $result = 6;
        } elseif ($k == "七"){
            $result = 7;
        } elseif ($k == "八"){
            $result = 8;
        } elseif ($k == "九"){
            $result = 9;
        } elseif ($k == "拾"){
            $result = 10;
        } elseif ($k == "百"){
            $result = 11;
        } elseif ($k == "千"){
            $result = 12;
        } elseif ($k == "万"){
            $result = 13;
        } elseif ($k == "億"){
            $result = 14;
        } elseif ($k == "兆"){
            $result = 15;
        } else {
            $result = 16;
        }
        return $result;
    }
    function kanji2number($arr){
        $result = 0;
        $tmp = 0;
        $tmp2 = 0;
        for ($i = 0; $i < count($arr); $i++) {
            if (number($arr[$i]) == 10){
                if ($tmp == 0){
                    $tmp = 10;
                } else {
                    $tmp *= 10;
                }
                $tmp2 += $tmp;
                $tmp = 0;
            } elseif (number($arr[$i]) == 11){
                if ($tmp == 0){
                    $tmp = 100;
                } else {
                    $tmp *= 100;
                }
                $tmp2 += $tmp;
                $tmp = 0;
            } elseif (number($arr[$i]) == 12){
                if ($tmp == 0){
                    $tmp = 1000;
                } else {
                    $tmp *= 1000;
                }
                $tmp2 += $tmp;
                $tmp = 0;
            } elseif (number($arr[$i]) == 13){
                $tmp *= 10000;
                $result += $tmp;
                $tmp2 *= 10000;
                $result += $tmp2;
                $tmp = 0;
                $tmp2 = 0;
            } elseif (number($arr[$i]) == 14){
                $tmp *= 100000000;
                $result += $tmp;
                $tmp2 *= 100000000;
                $result += $tmp2;
                $tmp = 0;
                $tmp2 = 0;
            } elseif (number($arr[$i]) == 15){
                $tmp *= 1000000000000;
                $result += $tmp;
                $tmp2 *= 1000000000000;
                $result += $tmp2;
                $tmp = 0;
                $tmp2 = 0;
            } else {
                $tmp = number($arr[$i]);
            }
        }
        $result += $tmp;
        $result += $tmp2;
        
        return $result;
    }
    function corrent_check($arr){
        if (number($arr[0]) >= 10){
            return false;
        } elseif (count($arr) == 1){
            return true;
        } else{
            $check = 16;
            $check2 = 13;
            for ($i = 0; $i < count($arr); $i++){
                if (number($arr[$i]) >= 13 && number($arr[$i]) <= 15){
                    if (number($arr[$i]) >= $check){
                        return false;
                    }
                    $check = number($arr[$i]);
                    $check2 = 13;
                } else if (number($arr[$i]) >= 10 && number($arr[$i]) <= 13){
                    if (number($arr[$i]) >= $check2){
                        return false;
                    }
                    $check2 = number($arr[$i]);
                }
                if (number($arr[$i]) == 16){
                    return false;
                }
            }
            for ($i = 0; $i < count($arr)-1; $i++){
                if (number($arr[$i]) <= 9 && number($arr[$i+1]) <= 9){
                    return false;
                } elseif (number($arr[$i]) >= 10 && number($arr[$i+1]) >= 10){
                    return false;
                }
            }
            return true;
        }
    }
    $name = $_POST['name'];
    $arr = preg_split('//u', $name, -1, PREG_SPLIT_NO_EMPTY);
    if (corrent_check($arr) == false){
        header("HTTP/1.1 204");
        print ("HTTP/1.1 204 変換できない入力です!");
    }else{
        $len = count($arr);
        $output= kanji2number($arr);
        print ("$name<br /> の変換結果<br />");
        print ("$output<br />");
    }
?>
</body>
</html>
<script type="text/javascript">
　var name = <?php echo json_encode($name); ?>;
　var url = 'v1/kanji2number/' + name
  history.replaceState('', '', url);
</script>