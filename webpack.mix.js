const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */
mix.js('resources/src/index.js', 'public/assets/js').react()
  .extract(['crypto', 'ethers', 'web3modal',  "web3", "@web3-react/injected-connector", "@web3-react/core", "web3-react", "@testing-library/jest-dom", "@testing-library/react", "@testing-library/user-event", "d3-ease", "disqus-react", "emailjs-com","google-map-react","react","react-animate-on-scroll","react-bootstrap","react-circular-progressbar","react-countup","react-dom","react-helmet","react-icons","react-move","react-on-screen","react-router-dom","react-scripts","react-slick","react-tabs","react-typed","sass","web-vitals","axios","bootstrap","cross-env","laravel-mix","lodash","popper.js","resolve-url-loader","sass","sass-loader"])
  .sass('resources/src/assets/scss/style.scss', 'public/assets/css')
  .webpackConfig({
    resolve: {
      extensions: ['*', '.js', '.jsx', '.wasm', '.mjs', '.json', '.*'],
      fallback: {
        "stream": require.resolve("stream-browserify"),
        "zlib": require.resolve("browserify-zlib"),
        "https": require.resolve("https-browserify"),
        "http": require.resolve("stream-http"),
        "crypto": require.resolve("crypto-browserify"),
        "os": require.resolve("os-browserify/browser"),
        "path": require.resolve("path-browserify"),
        "fs" : false,
        "tls" : false,
        "net" : false
      },
    }
  });
  // .sourceMaps(false, 'source-map');
  
if (mix.inProduction()) {
  mix.version();
}

if (!mix.inProduction()) {
  mix.browserSync('http://nodigy.test')
}