var merge = require('webpack-merge');
var common = require('./webpack.common.js');
var UglifyJsPlugin = require("uglifyjs-webpack-plugin");
var MiniCssExtractPlugin = require("mini-css-extract-plugin");
var OptimizeCSSAssetsPlugin = require("optimize-css-assets-webpack-plugin");


module.exports = merge(common, {
  mode: 'production',
  devtool: 'source-map',

});
