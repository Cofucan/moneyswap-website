const dotenvExpand = require('dotenv-expand');
dotenvExpand(require('dotenv').config({ path: '../../.env'/*, debug: true*/}));

const mix = require('laravel-mix');
require('laravel-mix-merge-manifest');

mix.setPublicPath('../../public').mergeManifest();

mix.js(__dirname + '/Resources/assets/js/app.js', 'js/contentmanagement.js')
    .sass( __dirname + '/Resources/assets/sass/app.scss', 'css/contentmanagement.css')
    .copy(__dirname + '/Resources/assets/css/faq-index.css', 'modules/contentmanagement/css/faq-index.css')
    .copy(__dirname + '/Resources/assets/js/faq-index.js', 'modules/contentmanagement/js/faq-index.js')
    .copy(__dirname + '/Resources/assets/css/howitworks-index.css', 'modules/contentmanagement/css/howitworks-index.css')
    .copy(__dirname + '/Resources/assets/js/howitworks-index.js', 'modules/contentmanagement/js/howitworks-index.js');

if (mix.inProduction()) {
    mix.version();
}
