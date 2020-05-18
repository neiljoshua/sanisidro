var merge = require('webpack-merge');
var common = require('./webpack.common.js');

module.exports = merge(common, {
  mode: 'development',
  watch: true,
  devtool: '#eval-source-map'
});
