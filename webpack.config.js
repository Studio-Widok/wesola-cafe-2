const path = require('path');
const MiniCssExtractPlugin = require('mini-css-extract-plugin');

// const mode = 'production';
const mode = 'development';

module.exports = {
  mode,
  devtool: mode === 'development' ? 'source-map' : false,
  entry: ['./src/js/main.js', './src/scss/main.scss'],
  output: {
    filename: 'main.js',
    path: path.resolve(__dirname, 'dist'),
  },
  module: {
    rules: [
      {
        test: /\.scss$/i,
        use: [
          {
            loader: MiniCssExtractPlugin.loader,
            options: {
              publicPath: './',
            },
          },
          {
            loader: 'css-loader',
          },
          {
            loader: 'postcss-loader',
            options: {
              postcssOptions: {
                plugins: [
                  [
                    'postcss-preset-env',
                    {
                      browsers:
                        mode === 'development'
                          ? '> 5%, last 2 versions, not dead'
                          : '> 0.1%, last 3 versions, not dead',
                    },
                  ],
                ],
              },
            },
          },
          'sass-loader',
        ],
      },
      {
        test: /\.js$/,
        exclude: /(node_modules)/,
        use: {
          loader: 'swc-loader',
        },
      },
      {
        test: /\.(eot|otf|ttf|woff|woff2|jpg|png|gif|webp|svg)$/,
        type: 'asset',
      },
    ],
  },
  plugins: [
    new MiniCssExtractPlugin({
      filename: 'main.css',
    }),
  ],
};
