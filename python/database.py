import mysql.connector


def databaseConncetion(data, screenshot_filename, title):
    # データベースに接続
    conn = mysql.connector.connect(
        host='localhost',
        user='root',
        password='',
        database='lp_system'
    )
    # conn = mysql.connector.connect(
    #     host='localhost',
    #     user='lp_system',
    #     password='MarmzprwtEszmHE5',
    #     database='lp_system'
    # )

    # カーソルオブジェクトを取得
    cur = conn.cursor()

    insert_data_query = """
    INSERT INTO lp_screenshots (lp_id, screenshot) VALUES (%s, %s)
    """
    insert_title_query = """
   UPDATE lp_sites SET title = %s WHERE id = %s
    """
    
    
    
    
    lp_id = data["lp_id"]
    screenshot = screenshot_filename

    user_data = (lp_id, screenshot)
    title_data = (title, lp_id)
    cur.execute(insert_data_query, user_data)
    cur.execute(insert_title_query, title_data)
    # 変更を保存
    conn.commit()
