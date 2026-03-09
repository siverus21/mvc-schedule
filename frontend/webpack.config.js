const path = require('path');
const RemoveEmptyScriptsPlugin = require('webpack-remove-empty-scripts');
const MiniCssExtractPlugin = require('mini-css-extract-plugin');
const CssMinimizerPlugin = require('css-minimizer-webpack-plugin');
const TerserPlugin = require('terser-webpack-plugin');
const CopyPlugin = require('copy-webpack-plugin');

module.exports = (env, argv) => {
	const isProduction = argv.mode === 'production';

	return {
		entry: {
			lib: ['jquery', 'izimodal'],
			vendor: ['izimodal/css/iziModal.min.css'],
			app: {
				import: ['./src/js/import.js', './src/js/main/app.js', './src/scss/settings.scss'],
				dependOn: 'lib',
			},
		},
		output: {
			path: path.resolve(__dirname, '../public/assets'),
			filename: 'js/[name].js',
			clean: true,
			publicPath: '/assets/',
		},
		module: {
			rules: [
				{
					test: /\.scss$/i,
					use: [
						MiniCssExtractPlugin.loader,
						{
							loader: 'css-loader',
							options: {
								sourceMap: !isProduction,
								url: { filter: (url) => url.includes('images/') },
							},
						},
						{
							loader: 'sass-loader',
							options: {
								sourceMap: !isProduction,
								sassOptions: { outputStyle: isProduction ? 'compressed' : 'expanded' },
							},
						},
					],
				},
				{
					test: /\.css$/i,
					use: [MiniCssExtractPlugin.loader, 'css-loader'],
				},
				{
					test: /\.(png|jpg|jpeg|gif|svg)$/i,
					type: 'asset/resource',
					generator: { filename: 'images/[name][ext]' },
				},
				{
					test: require.resolve('jquery'),
					use: [{ loader: 'expose-loader', options: { exposes: ['$', 'jQuery'] } }],
				},
				{
					test: require.resolve('izimodal'),
					use: [{ loader: 'expose-loader', options: { exposes: ['iziModal'] } }],
				},
			],
		},
		plugins: [
			new RemoveEmptyScriptsPlugin(),
			new MiniCssExtractPlugin({
				filename: 'css/[name].css',
				chunkFilename: 'css/[id].[contenthash].css',
			}),
			new CopyPlugin({
				patterns: [
					{
						from: 'src/images',
						to: 'images',
						noErrorOnMissing: true,
						globOptions: { ignore: ['**/.DS_Store', '**/Thumbs.db'] },
					},
				],
			}),
		],
		optimization: {
			minimize: isProduction,
			minimizer: [
				new TerserPlugin({
					test: /\.js(\?.*)?$/i,
					terserOptions: { compress: isProduction, mangle: isProduction },
				}),
				new CssMinimizerPlugin(),
			],
			splitChunks: {
				chunks: 'all',
				cacheGroups: {
					vendor: {
						name: 'vendor',
						test: (module) => {
							if (!module.resource) return false;
							const r = module.resource;
							if (/[\\/]node_modules[\\/].*\.css$/.test(r)) return true;
							if (module.chunks?.some((c) => c.name === 'vendor')) return true;
							if (/[\\/]src[\\/]scss[\\/]vendor\.scss$/.test(r)) return true;
							let issuer = module.issuer;
							while (issuer) {
								if (issuer.resource && /[\\/]src[\\/]scss[\\/]vendor\.scss$/.test(issuer.resource))
									return true;
								issuer = issuer.issuer;
							}
							return false;
						},
						chunks: 'all',
						enforce: true,
						priority: 50,
						reuseExistingChunk: true,
					},
					defaultVendors: {
						test: /[\\/]node_modules[\\/]/,
						name: 'vendors',
						chunks: 'all',
						priority: 10,
						reuseExistingChunk: true,
					},
					default: {
						minChunks: 2,
						priority: -20,
						reuseExistingChunk: true,
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
