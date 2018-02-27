var webpack           = require('webpack'),
    // HtmlWebpackPlugin = require('html-webpack-plugin'),
    ExtractTextPlugin = require('extract-text-webpack-plugin'),
    helpers           = require('../helpers'),
	path = require('path');
module.exports = {
  entry: {
    'polyfills': './web/src/polyfills.ts',
    'vendor':    './web/src/vendor.ts',
    'app':       './web/src/main.ts'
  },

  resolve: {
    extensions: ['.ts', '.js']
  },

  module: {
    loaders: [
      {
        test:    /\.ts$/,
        loaders: ['awesome-typescript-loader', 'angular2-template-loader']
      },
      {
        test:   /\.html$/,
        loader: 'html-loader'
      },
      {
        test:   /\.(png|jpeg|jpg|gif|svg)$/,
        use: 'url-loader?limit=25000'
      },
      {
		test: /\.scss$/,
		exclude: /node_modules/,
		loaders: ['css-to-string-loader', 'css-loader', 'sass-loader'] // sass-loader not scss-loader
	  },
	  {
		test: /\.(woff|woff2|eot|ttf|otf)$/,
		loader: 'file-loader'
	  }
    ]
  },

  plugins: [
    new webpack.optimize.CommonsChunkPlugin({
      name: ['app', 'vendor', 'polyfills']
    }),
	// correct warning critical dependencies
	new webpack.ContextReplacementPlugin(
		/angular(\\|\/)core(\\|\/)(@angular|esm5)/,
		 path.join(__dirname, './web/src'
	))
	
	/*,
	
     new HtmlWebpackPlugin({
     template: 'web/src/index.html'
     })*/
  ]
};
