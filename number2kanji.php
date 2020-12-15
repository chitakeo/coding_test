<html>
<meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
<head><title>number2kanji.php</title></head>
<body>
<?php
    function number2kanji($d, $n, $len){
        $result = "";
        if($n == 1){
            $result = $result . "壱";
        } elseif ($n == 2){
            $result = $result . "弐";
        } elseif ($n == 3){
            $result = $result . "参";
        } elseif ($n == 4){
            $result = $result . "四";
        } elseif ($n == 5){
            $result = $result . "五";
        } elseif ($n == 6){
            $result = $result . "六";
        } elseif ($n == 7){
            $result = $result . "七";
        } elseif ($n == 8){
            $result = $result . "八";
        } elseif ($n == 9){
            $result = $result . "九";
        }
        if ($n != 0){
            if (($len-$d-1) % 4 == 1){
                $result = $result . "拾";
            } else if (($len-$d-1) % 4 == 2){
                $result = $result . "百";
            } else if (($len-$d-1) % 4 == 3){
                $result = $result . "千";
            }
        } 
        if ($len-$d-1 == 4){
            $result = $result . "万";
        } else if ($len-$d-1 == 8){
            $result = $result . "億";
        } else if ($len-$d-1 == 12){
            $result = $result . "兆";
        }
        return $result;
    }
    $name = $_POST['name']; //入力されたテキストを受け取る
    //数値かどうかの判定と数字の範囲の確認
    if (is_numeric($name) == false || $name < 0 || $name > 10000000000000000){ 
        header("HTTP/1.1 204");
        print ("HTTP/1.1 204 変換できない入力です!");
    } else {
        $len = strlen($name);
        $arr = str_split($name);
        //数値に小数点が入っていないか確認
        for ($i = 0; $i < count($arr); $i++){
            if ($arr[$i] == "."){
                header("HTTP/1.1 204");
                print ("HTTP/1.1 204 変換できない入力です!");
            }
        }
        //2桁以上の数字が0から始まっていないか確認
        if (count($arr) >= 2){
            if ($arr[0] == 0){
                header("HTTP/1.1 204");
                print ("HTTP/1.1 204 変換できない入力です!");
            }
        }
        $output = ""; //変換結果を入れる変数
        //number2kanji() で漢字に変換. README でアルゴリズムを説明します
        for ($i = 0; $i < $len; $i++) {
            $output = $output . number2kanji($i, $arr[$i], $len); 
        }
        //0だったら零を代入
        if ($name == 0){
            $output = "零";
        }
        print ("$name<br /> の変換結果<br />");
        //変換結果出力
        print ("$output<br />");
    }
?>
</body>
</html>
<script type="text/javascript">
  var name = <?php echo json_encode($name); ?>;
  var url = 'v1/number2kanji/' + name;
  history.replaceState('','', url);
</script>