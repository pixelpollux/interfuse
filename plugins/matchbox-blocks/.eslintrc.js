module.exports = {
	extends: [
		require.resolve('@wordpress/scripts/config/.eslintrc'),
		// 'plugin:prettier/recommended',
	],
	rules: {
		indent: [
			'error',
			'tab',
			{
				SwitchCase: 1,
				ignoredNodes: ['JSXElement *', 'JSXElement'],
			},
		],
		'function-paren-newline': ['error', 'multiline-arguments'],
		'arrow-body-style': ['error', 'as-needed'],
		'prettier/prettier': 'off', // optional if prettier plugin is disabled anyway
	},
};
