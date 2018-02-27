var webpackMerge      = require('webpack-merge'),
    commonConfig      = require('./webpack.common.js'),
    helpers           = require('../helpers');

module.exports = webpackMerge(commonConfig, {
  devtool: 'cheap-module-eval-source-map',

  output: {
    path:          helpers.root('dist'),
    publicPath:    'http://localhost:8080/static',
    filename:      '[name].js',
    chunkFilename: '[id].chunk.js'
  },

  plugins: [
  
  ],

  devServer: {
    historyApiFallback: true,
    stats:              'minimal'
  }
});
