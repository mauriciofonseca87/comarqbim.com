module.exports = {
	plugins: [
		require('postcss-nested'),
		require('postcss-css-variables')({
			preserve: false,
			preserveAtRulesOrder: true
		}),
		require('postcss-calc')({
			precision: 0
		}),
<<<<<<< HEAD
		require('postcss-discard-duplicates'),
		require('postcss-merge-rules')
=======
		require('postcss-discard-duplicates')
>>>>>>> 1a8512902478d1f180da0b94acec62f945bfaa21
	]
};
