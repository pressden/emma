const baseConfig = require('./base.config.js');
const merge = require('webpack-merge');
const OptimizeCSSAssetsPlugin = require("optimize-css-assets-webpack-plugin");

module.exports = merge(baseConfig, {
    optimization: {
        minimizer: [
          new OptimizeCSSAssetsPlugin({})
        ]
    }
});
