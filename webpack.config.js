// ライセンス情報をjsファイルに含める
const TerserPlugin = require('terser-webpack-plugin');

const mode = process.env.NODE_ENV === 'production' ? 'production' : 'development';
const isProduction = process.env.NODE_ENV === 'production';

module.exports = {
  mode: mode,
  cache: true,
  devtool: isProduction ? false : 'source-map',
  output: {
    filename: '[name].js',
    chunkFilename: '[chunkhash].js',
    sourceMapFilename: 'map/[file].map',
  },
  optimization: {
    minimizer: [
      new TerserPlugin({
        extractComments: false,
        terserOptions: {
          compress: isProduction
            ? {
                // drop_console: true, // 本番ではconsole.logを削除
                drop_debugger: true, // 本番ではdebuggerを削除
              }
            : false,
          format: {
            comments: !isProduction, // 本番ではコメントを削除
          },
        },
      }),
    ],
  },
  module: {
    rules: [
      {
        test: /\.css$/,
        use: ['style-loader', 'css-loader'],
      },
    ],
  },
  performance: {
    hints: 'warning', // パフォーマンス警告を有効化
    maxEntrypointSize: 250000, // エントリーポイントサイズの制限
    maxAssetSize: 250000, // アセットサイズの制限
  },
};
