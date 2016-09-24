var webpack = require('webpack');
var path = require('path');

var BUILD_DIR = path.resolve(__dirname, 'public/js/dist');
var APP_DIR = path.resolve(__dirname, 'public/js/src/');

var config = {
  entry: {
      modules_list: APP_DIR + '/modules/index.jsx',
      //second: APP_DIR + '/index.jsx'
  },
  
  output: {
    path: BUILD_DIR,
    filename: '[name].bundle.js'
  },
  module : {
    loaders : [
      {
        test : /\.jsx?/,
        include : APP_DIR,
        loader : 'babel'
      }
    ]
  }
};

module.exports = config;
///\.jsx?/,