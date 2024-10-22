<?php

class PythonRequestHandler{
    public function sendRequest($data){
        $data_json = json_encode($data);

        // cURLセッションを初期化
        // $ch = curl_init('http://twitter-clone.click/run-script');
        $ch = curl_init('http://127.0.0.1:5000/run-script');
        // $ch = curl_init('http://127.0.0.1:8000/run-script');

        // cURLオプションを設定
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data_json);

        // URLからデータを取得
        $response = curl_exec($ch);

        $data = json_decode($response, true);


     ;

        // エラーチェック
        if(curl_errno($ch)) {
            return false;
            echo 'cURLエラー: ' . curl_error($ch);
        } else {

            if($data["status"] == "error"){
                return false;
            // 取得したデータを表示
            // return true;
                echo "サーバーの応答: $response\n";
            }else{
                return true;
            }

        }

        // cURLセッションを閉じる
        curl_close($ch);
        exit;
    }
}

