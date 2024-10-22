
from selenium import webdriver
from flask import Flask, jsonify, request
from flask_cors import CORS
from webdriver_manager.chrome import ChromeDriverManager
from selenium.webdriver.chrome.service import Service
from selenium.webdriver.common.by import By
from selenium.webdriver.support.ui import WebDriverWait
from selenium.webdriver.support import expected_conditions as EC
from database import databaseConncetion
import random
import string
import os
from urllib.parse import urlparse

# 「サーバー上で実行できる」とは、FlaskアプリケーションをWebサーバーとして動かし、そのサーバーにリクエストを送ることで、Pythonスクリプトが実行される
app = Flask(__name__)
CORS(app)  # これで全てのエンドポイントにCORSを許可します

def random_string():
    characters = string.ascii_letters + string.digits
    return ''.join(random.choice(characters) for _ in range(20))

def is_valid_url(url):
    parsed_url = urlparse(url)
    # スキームとネットロケーションが存在することを確認
    return all([parsed_url.scheme, parsed_url.netloc])

@app.route('/run-script', methods=['POST'])
def run_script():
    data = request.get_json()
    screenshot_filename = f"{random_string()}.png"
    
    # ChromeDriverのログを有効にする
    service = Service(ChromeDriverManager().install())
    service.command_line_args()
    service.log_path = "/www/wwwroot/twitter-clone.click/python/logs/chromedriver.log"

    
    # ChromeDriverを設定
    chrome_options = webdriver.ChromeOptions()
    chrome_options.add_argument('--ignore-certificate-errors')  # SSLエラーを無視する
    chrome_options.add_argument('--headless')  # ヘッドレスモードで実行
    chrome_options.add_argument('--disable-gpu')  # GPUの使用を無効化
    chrome_options.add_argument('--no-sandbox')  # サンドボックスを無効化
    chrome_options.add_argument('--disable-dev-shm-usage')  # 共有メモリの使用を無効化

    # ChromeDriverのパスを取得してインスタンスを作成
    service = Service(ChromeDriverManager().install())
    driver = webdriver.Chrome(service=service, options=chrome_options)
    
    try:
        
        
        if is_valid_url(data["domain"]): 
            url = data["domain"]
        else: 
            url = f"https://{data['domain']}"
    
        print(url)
        driver.get(url)
        title = driver.title

        WebDriverWait(driver, 10).until(EC.presence_of_element_located((By.TAG_NAME, "body")))
        
        
        # フォルダパスを指定
        # 開発環境
        folder_path = "C:\\Users\\user\\Dropbox\\Lp_system\\public\\screenshot\\"
        # 本番環境
        # folder_path = "/www/wwwroot/production1.server-check.tokyo/public/screenshot/"


        # フォルダが存在しない場合は作成
        # フォルダが存在しない場合は作成
        if not os.path.exists(folder_path):
            try:
                os.makedirs(folder_path)
                print(f"Directory created at {folder_path}")
            except Exception as e:
                print(f"Error creating directory: {e}")

        screenshot_path = os.path.join(folder_path, screenshot_filename)
        print(f"Saving screenshot to: {screenshot_path}")
        
        # 正しいエラーキャッチとログ記録のためのコード
        try:
            success = driver.save_screenshot(screenshot_path)
            if not success:
                raise Exception("Failed to save screenshot.")
        except Exception as e:
            print(f"Error saving screenshot: {e}")
            return jsonify({"status": "error", "message": str(e)}), 500



        # データベースに接続し、データを保存
        try:
            databaseConncetion(data, screenshot_filename, title)
        except Exception as e:
            print(f"Database connection error: {e}")
            return jsonify({"status": "error", "message": str(e)}), 500

        # # ブラウザを閉じる
        driver.quit()

        return jsonify({"status": "success", "title": title}).get_data(as_text=True).encode('utf-8')
    
    except Exception as e:
        print(f"Error: {e}")
        return jsonify({"status": "error", "message": str(e)}), 500
    
if __name__ == '__main__':
    app.run(debug=True)