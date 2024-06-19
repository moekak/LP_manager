<?php


class DataValidation{

    // 入力された値の長さを検証
    public static function isSatisfiedRequiredLength($input_text, $max_length){
        return mb_strlen($input_text, 'UTF-8') >= $max_length;
    }

    // データをサニタイズする
    public static function sanitizeInput($input_text){
        return htmlspecialchars($input_text, ENT_QUOTES, 'UTF-8');
    }


    // 有効なIDかの検証
    public static function isValidID($id){
        return (filter_var($id, FILTER_VALIDATE_INT));
    }

    // 必要な値がすべて入っているかチェック
    public static function hasAllNecessaryValues($requiredData, $optionalData){
        $array = [];

        foreach($requiredData as $key){
            if(empty($_POST[$key])){
                array_push($array, $key);
            }
        }

    
        if($optionalData){
          
            $allEmpty = true; // 全ての値が空かどうかを追跡するフラグ

            foreach ($optionalData as $key) {
                // $_POSTにキーが存在するか、またはその値が空でない場合
                if (!isset($_POST[$key]) || $_POST[$key] != "") {
                    $allEmpty = false; // 一つでも空でない値があればフラグをfalseに設定
                    break; // ループを中断
                }
            }

            if($allEmpty){
                array_push($array, "tag");
            }
        }
        return $array;
        
    }

    

    public static function generateNumberRange($num, $range){
        $formattedNums = [];

        //指定された範囲の一番最後の数を取得
        $end = $num + $range - 1;

        for ($i = $num; $i <= $end; $i++) {
            // sprintfを使用して、数値を適切なフォーマットでフォーマット
            $formattedNums [] = sprintf("%0" . (strlen($num)) . "d", $i);
        }

        return $formattedNums ;
    }
}