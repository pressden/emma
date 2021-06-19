const path = require("path");
const MiniCssExtractPlugin = require("mini-css-extract-plugin");

function recursiveIssuer(m) {
	if (m.issuer) {
		return recursiveIssuer(m.issuer);
	} else if (m.name) {
		return m.name;
	} else {
		return false;
	}
}

module.exports = {
	entry: {
		theme: path.resolve(__dirname, "../src/theme"),
		admin: path.resolve(__dirname, "../src/admin"),
	},
	optimization: {
		splitChunks: {
			cacheGroups: {
				themeStyles: {
					name: "theme",
					test: (m, c, entry = "theme") =>
						m.constructor.name === "CssModule" && recursiveIssuer(m) === entry,
					chunks: "all",
					enforce: true,
				},
				adminStyles: {
					name: "admin",
					test: (m, c, entry = "admin") =>
						m.constructor.name === "CssModule" && recursiveIssuer(m) === entry,
					chunks: "all",
					enforce: true,
				},
			},
		},
	},
	plugins: [
		new MiniCssExtractPlugin({
			filename: "[name].css",
		}),
	],
	module: {
		rules: [
			{
				test: /\.(css|scss)$/,
				use: [
					MiniCssExtractPlugin.loader,
					{
						loader: "css-loader",
						options: { url: false },
					},
					{
						loader: "postcss-loader",
					},
					{
						/* for ~slick-carousel/slick/slick-theme.scss */
						loader: "resolve-url-loader",
					},
					{
						/* for resolve-url-loader: source maps must be enabled on any preceding loader */
						loader: "sass-loader",
						options: { sourceMap: true },
					},
				],
			},
			{
				test: /\.(woff|woff2|eot|ttf|otf)$/,
				use: ["file-loader"],
			},
		],
	},
};
