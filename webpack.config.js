const path = require('path');
const defaultConfig = require('@wordpress/scripts/config/webpack.config');

const devHost = 'wpmvc.test';

module.exports = {
	...defaultConfig,
	entry: {
		'admin/dashboard': './resources/admin-dashboard/index.js',
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
			'@components': path.resolve( __dirname, 'resources/admin-dashboard/components' ),
			'@features': path.resolve( __dirname, 'resources/admin-dashboard/features' ),
			'@helpers': path.resolve( __dirname, 'resources/admin-dashboard/helpers' ),
			'@store': path.resolve( __dirname, 'resources/admin-dashboard/store' ),
			'@icons': path.resolve( __dirname, 'resources/admin-dashboard/icons' ),
			'@pages': path.resolve( __dirname, 'resources/admin-dashboard/pages' ),
		},
	},
};
