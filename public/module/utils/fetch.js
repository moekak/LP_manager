import { sendErrorLog, redirectToErrorPage } from "@index/index.js";

export const fetchOperation = (data, url) => {

  console.log(data);
    return fetch(`${process.env.API_URL}/${url}`, {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
      },
      body: JSON.stringify(data),
    }).then((response) => {
      if (!response.ok) {
        throw new Error("サーバーエラーが発生しました。");
      }
      return response.json();
    })
    .catch((error)=>{

      console.log(error);
      // エラーが発生した場合の処理
      // sendErrorLog(error); // エラーログを送信
      // redirectToErrorPage(); // エラーページにリダイレクト

    })
  };

  // サーバーからレスポンスを返さなくていい場合
export const fetchOperation2 = (data, url) => {

  console.log(data);
    return fetch(`${process.env.API_URL}/${url}`, {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
      },
      body: JSON.stringify(data),
    }).then((response) => {
      if (!response.ok) {
        throw new Error("サーバーエラーが発生しました。");
      }
      return;
    })
    .catch((error)=>{

      console.log(error);
      // エラーが発生した場合の処理
      sendErrorLog(error); // エラーログを送信
      redirectToErrorPage(); // エラーページにリダイレクト

    })
  };