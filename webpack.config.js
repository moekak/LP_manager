const path = require("path");
const webpack = require("webpack");



module.exports = (env) => {
    const isProduction = env.production === 'true';
    const basePath = "public/module"
    const baseJsPath = "public/js"
    const baseIndexPath = "public"

    return{
        mode: isProduction ? 'production' : 'development',
        
        entry: {
            index: path.resolve(__dirname, `${baseJsPath}/index.js`),
            group: path.resolve(__dirname, `${baseJsPath}/group.js`),
        },
        optimization: {
            usedExports: true,
            sideEffects: false, // 特に必要であれば設定
          },
        resolve: {
            alias: {
            // エイリアスの設定
            '@modules': path.resolve(__dirname, basePath),
            '@index': path.resolve(__dirname, baseIndexPath),

            // 他のエイリアスも同様に設定可能
            }
        },
        output: {
            path: path.resolve(__dirname, 'dist'),
            filename: '[name].js',
        },
        
        plugins: [
            // DefinePluginを使って環境変数を設定
            new webpack.DefinePlugin({
                'process.env': {
                    // ここに環境に応じた変数を定義
                    API_URL: JSON.stringify(isProduction? '/app/Fetch' : '/LP_system/app/Fetch'),
                    SYSTEM_URL: JSON.stringify(isProduction ? '/' : '/LP_system/'),
                }
            })
        ],
    }
   
}