const path = require('path');
const ExtractTextPlugin = require('extract-text-webpack-plugin');
const UglifyJsPlugin = require('uglifyjs-webpack-plugin');
const OptimizeCssAssetsPlugin = require('optimize-css-assets-webpack-plugin');

module.exports = {
    mode: 'development',
    resolve: {
        alias: {
            swup: path.resolve(__dirname, 'assets/js/lib/swup.js'),
            smoothscroll: path.resolve(__dirname, 'assets/js/lib/smooth-scroll.polyfills.js')
        }
    },
    entry: {
        site: './assets/js/dist/site'
    },
    output: {
        path: path.resolve(__dirname, 'assets/js'),
        filename: 'bundle.min.js'
    },
    externals: {
        jquery: 'jQuery'
    },
    module: {
        rules: [
            {
                test: /\.js$/,
                exclude: /(node_modules)/,
                use: {
                    loader: 'babel-loader',
                    options: {
                        presets: ['env'],
                    }
                }
            },
            {
                test: /\.css$/,
                use: ExtractTextPlugin.extract({
                    fallback: 'style-loader',
                    use: [
                        {
                            loader: 'css-loader',
                            options: {
                                importLoaders: 1,
                                sourceMap: true,
                                minimize: true
                            }
                        }
                    ]
                })
            },
            {
                test: /\.scss$/,
                use: ExtractTextPlugin.extract({
                    fallback: 'style-loader',
                    use: ['css-loader','sass-loader'],
                    publicPath: 'dist'
                })
            },
            {
                test: /\.(woff(2)?|ttf|eot|svg)(\?v=\d+\.\d+\.\d+)?$/,
                use: [{
                    loader: 'file-loader',
                    options: {
                        name: '[name].[ext]',
                        outputPath: '../fonts'
                    }
                }]
            }
        ]
    },
    optimization: {
        minimizer: [
            new UglifyJsPlugin({
                sourceMap: false,
                minify(file, sourceMap) {
                    const uglifyJsOptions = {
                        ie8: false,
                        ecma: 8,
                        mangle: true,
                        output: {
                            comments: false,
                            beautify: false
                        },
                        warnings: false
                    };
                    if (sourceMap) {
                        uglifyJsOptions.sourceMap = {
                            content: sourceMap,
                        };
                    }
                    return require('terser').minify(file, uglifyJsOptions);
                }
            }),
            new OptimizeCssAssetsPlugin({
                assetNameRegExp: /\.optimize\.css$/g,
                cssProcessor: require('cssnano'),
                cssProcessorPluginOptions: {
                    preset: ['default', { discardComments: { removeAll: true } }],
                },
                canPrint: true
            })
        ]
    },
    plugins: [
        new ExtractTextPlugin({
            filename: '../css/style.min.css',
            allChunks: true,
        })
    ]
}