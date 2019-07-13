/* global module */

let config = {
  'notGetBlocks': [
    'blocks-demo.html',
  ],
  'ignoredBlocks': [
    'no-js',
  ],
  'alwaysAddBlocks': [
    'page',
    'embed-responsive',
    'social-menu',
    // 'sprite-svg',
    // 'sprite-png',
    // 'object-fit-polyfill',
  ],
  'addStyleBefore': [
    'src/scss/variables.scss',
    'src/scss/mixins.scss',
    'src/scss/base.scss',
    // 'somePackage/dist/somePackage.css', // для 'node_modules/somePackage/dist/somePackage.css',
  ],
  'addStyleAfter': [
    // 'src/scss/print.scss',
  ],
  'addJsBefore': [
    // 'somePackage/dist/somePackage.js', // для 'node_modules/somePackage/dist/somePackage.js',
  ],
  'addJsAfter': [
    './script.js',
  ],
  'addAssets': {
    'src/fonts/liberationsans-bold.woff2': 'fonts/',
    'src/fonts/liberationsans-bold.woff': 'fonts/',
    'src/fonts/liberationsans-bold.ttf': 'fonts/',
    'src/fonts/liberationsans-regular.woff2': 'fonts/',
    'src/fonts/liberationsans-regular.woff': 'fonts/',
    'src/fonts/liberationsans-regular.ttf': 'fonts/',
    'src/fonts/unvr57x.woff2': 'fonts/',
    'src/fonts/unvr57x.woff': 'fonts/',
    'src/fonts/unvr57x.ttf': 'fonts/',
    //'src/img/demo-*.{png,svg,jpg,jpeg}': 'img/',
    'src/img/svg-icons.svg': 'img/',
    'src/languages/': 'languages/',
    // 'src/favicon/*.{png,ico,svg,xml,webmanifest}': 'img/favicon',
    // 'node_modules/somePackage/images/*.{png,svg,jpg,jpeg}': 'img/',
  },
  'dir': {
    'src': 'src/',
    'build': 'build/',
    'remote': '/var/www/aero/wp-content/themes/aero',
    'blocks': 'src/blocks/',
    'phpTemplates': { "pages/": "",
                      "inc/": "inc/",
                      "pages/template-parts/**/": "template-parts/"
                    },
  }
};

module.exports = config;
