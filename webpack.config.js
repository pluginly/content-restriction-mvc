const path = require('path');
const defaultConfig = require('@wordpress/scripts/config/webpack.config');

const devHost = 'wpmvc.test';

module.exports = {
	...defaultConfig,
	entry: {
		'js/admin-app': './resources/js/index.js',
	},
	output: {
		path: path.resolve( __dirname, './assets/build/' ),
		filename: '[name].js',
		clean: false,
	},
	devServer: {
		devMiddleware: {
			writeToDisk: true,
		},
		allowedHosts: 'auto',
		port: 8887,
		host: devHost,
		proxy: {
			'/assets/build': {
				pathRewrite: {
					'^/assets/build': '',
				},
			},
		},
		headers: { 'Access-Control-Allow-Origin': '*' },
	},
	resolve: {
		alias: {
			'@components': path.resolve( __dirname, 'resources/js/components' ),
			'@features': path.resolve( __dirname, 'resources/js/features' ),
			'@helpers': path.resolve( __dirname, 'resources/js/helpers' ),
			'@store': path.resolve( __dirname, 'resources/js/store' ),
			'@icons': path.resolve( __dirname, 'resources/js/icons' ),
			'@pages': path.resolve( __dirname, 'resources/js/pages' ),
		},
	},
};
