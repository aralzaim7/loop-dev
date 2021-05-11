const path = require('path')
const webpack = require('webpack')

module.exports = {
    output: { chunkFilename: 'js/[name].js?id=[chunkhash]' },
    resolve: {
        alias: {
            '@': path.resolve('./resources/js'),
        },
    },
	plugins: [
		new webpack.DefinePlugin({
			__VUE_OPTIONS_API__: false,
			__VUE_PROD_DEVTOOLS__: false,
		}),
	],
}
