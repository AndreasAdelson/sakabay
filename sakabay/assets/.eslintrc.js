module.exports = {
  root: true,
  'parserOptions': {
    'parser': 'babel-eslint',
    'ecmaVersion': 2017,
    'sourceType': 'module'
  },
  env: {
    browser: true,
  },
  extends: [
    'eslint:recommended',
    'plugin:vue/recommended'
  ],
  // required to lint *.vue files
  plugins: [
    'jest',
    'import',
    'vue',
    'json'
  ],
  // add your custom rules here
  rules: {
    'indent': ['error', 2],
    'semi': [2, 'always'],
    'quotes': [2, 'single', 'avoid-escape'],
    'space-before-function-paren': [2, 'never'],
    'vue/script-indent': ['error', 2, {
      'baseIndent': 1
    }],
    'no-trailing-spaces': ['error', {
      'ignoreComments': true
    }]
  },
  'overrides': [{
    'files': ['js/**/*.test.js'],
    'rules': {
      'camelcase': 0,
      'no-underscore-dangle': 0,
    }
  },
  {
    'files': ['*.vue', 'js/**/*.js'],
    'rules': {
      'indent': 'off'
    }
  }
  ],
  globals: {
    '$': 'readonly',
  }
};
