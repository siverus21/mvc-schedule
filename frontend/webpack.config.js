const path = require('path');
const MiniCssExtractPlugin = require('mini-css-extract-plugin');
const CssMinimizerPlugin = require('css-minimizer-webpack-plugin');
const TerserPlugin = require('terser-webpack-plugin');
const CopyPlugin = require('copy-webpack-plugin');

module.exports = (env, argv) => {
	const isProduction = argv.mode === 'production';

	return {
		entry: {
			lib: ['jquery', 'izimodal'],
			app: ['./src/js/import.js', './src/js/main/app.js', './src/scss/settings.scss'],
		},
		output: {
			path: path.resolve(__dirname, '../public/assets'),
			filename: 'js/[name].js',
			clean: true,
			publicPath: '/public/assets/',
		},
		module: {
			rules: [
				{
					test: /\.scss$/,
					use: [
						MiniCssExtractPlugin.loader,
						{
							loader: 'css-loader',
							options: {
								sourceMap: !isProduction,
								url: {
									filter: (url, resourcePath) => {
										// Фильтр для обработки путей к изображениям
										if (url.includes('images/')) {
											return true;
										}
										return false;
									},
								},
							},
						},
						{
							loader: 'sass-loader',
							options: {
								sourceMap: !isProduction,
								sassOptions: {
									outputStyle: isProduction ? 'compressed' : 'expanded',
								},
							},
						},
					],
				},
				{
					test: /\.(png|jpg|jpeg|gif)$/i,
					type: 'asset/resource',
					generator: {
						filename: 'images/[name][ext]',
					},
				},
				{
					test: /\.svg$/i,
					type: 'asset/resource',
					generator: {
						filename: 'images/[name][ext]',
					},
				},
				{
					test: require.resolve('jquery'),
					use: [
						{
							loader: 'expose-loader',
							options: {
								exposes: ['$', 'jQuery'],
							},
						},
					],
				},
				{
					test: require.resolve('izimodal'),
					use: [
						{
							loader: 'expose-loader',
							options: {
								exposes: ['iziModal'],
							},
						},
					],
				},
			],
		},
		plugins: [
			new MiniCssExtractPlugin({
				filename: 'css/app.css',
			}),
			new CopyPlugin({
				patterns: [
					{
						from: 'src/images',
						to: 'images',
						noErrorOnMissing: true,
						globOptions: {
							ignore: ['**/.DS_Store', '**/Thumbs.db'],
						},
					},
				],
			}),
		],
		optimization: {
			minimize: isProduction,
			minimizer: [
				new TerserPlugin({
					test: /\.js(\?.*)?$/i,
					terserOptions: {
						compress: isProduction,
						mangle: isProduction,
					},
				}),
				new CssMinimizerPlugin(),
			],
			splitChunks: {
				cacheGroups: {
					lib: {
						test: /[\\/]node_modules[\\/]/,
						name: 'lib',
						chunks: 'all',
						enforce: true,
					},
				},
			},
		},
		resolve: {
			extensions: ['.js', '.scss', '.css'],
		},
		devtool: isProduction ? false : 'source-map',
	};
};
