const path = require('path');
const MiniCssExtractPlugin = require("mini-css-extract-plugin");

module.exports = {
  context: path.resolve(__dirname, '../src'),
  entry: {
    app: './js/index.js'
  },
  plugins: [
    new MiniCssExtractPlugin({})
  ],
  module: {
    rules: [
      {
        test: /\.(css|scss)$/,
        use: [
          MiniCssExtractPlugin.loader,
          'css-loader',
          {
            loader: 'postcss-loader' },
          {
            /* for ~slick-carousel/slick/slick-theme.scss */
            loader: 'resolve-url-loader' },
          {
            /* for resolve-url-loader:
                source maps must be enabled on any preceding loader */
            loader: 'sass-loader?sourceMap' }
        ]
      },
      {
        test: /\.(woff|woff2|eot|ttf|otf)$/,
        use: [
          'file-loader',
        ],
      },
    ]
  }
}
