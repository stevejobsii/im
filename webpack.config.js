var path = require('path');
var webpack = require('webpack');

module.exports = {
    // 微信商城 迁移vuejs 1.x ->vuejs 2.x 千万不要动原来的微信商城！
    // entry: './resources/assets/js/main.js',
    // output: {
    //     path: path.resolve(__dirname, './public/js/mall'),
    //     publicPath: '/js/',
    //     filename: 'app.js'
    // },

    // 活动订单 迁移vuejs 1.x ->vuejs 2.x中
    // 入口main.js，出口eventapp.js
    entry: './resources/assets/js/event/main.js',
    output: {
        path: path.resolve(__dirname, './public/js/event'),
        publicPath: '/js/',
        filename: 'eventapp.js'
    },
    resolveLoader: {
        root: path.join(__dirname, 'node_modules'),
    },
    watch: true,
    module: {
        loaders: [{
            test: /\.vue$/,
            loader: 'vue'
        }, {
            test: /\.js$/,
            loader: 'babel',
            exclude: /node_modules/
        }, {
            test: /\.json$/,
            loader: 'json'
        }, {
            test: /\.css$/,
            loader: 'css'
        }, {
            test: /\.html$/,
            loader: 'vue-html'
        }, {
            test: /\.(png|jpg|gif|svg)$/,
            loader: 'url',
            query: {
                limit: 8192,
                name: '[name].[ext]?[hash]'
            }
        }]
    },
    devServer: {
        historyApiFallback: true,
        noInfo: true
    },
    devtool: '#eval-source-map',
    plugins: [
        new webpack.OldWatchingPlugin(),
        new webpack.optimize.UglifyJsPlugin({
            compress: {
                warnings: false
            }
        })
    ]
};

if (process.env.NODE_ENV === 'production') {
    module.exports.devtool = '#source-map';
    // http://vue-loader.vuejs.org/en/workflow/production.html
    module.exports.plugins = (module.exports.plugins || []).concat([
        new webpack.DefinePlugin({
            'process.env': {
                NODE_ENV: '"production"'
            }
        }),
        new webpack.optimize.UglifyJsPlugin({
            compress: {
                warnings: false
            }
        }),
        new webpack.optimize.OccurenceOrderPlugin()
    ])
};
