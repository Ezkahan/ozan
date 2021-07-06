const { mix } = require("laravel-mix");
require("laravel-mix-merge-manifest");

var publicPath = "../../../public/themes/ozan/assets";

if (mix.inProduction()) {
    publicPath = 'publishable/assets';
}

// mix.setPublicPath(publicPath).mergeManifest();
// mix.disableNotifications();

mix
    .js(
        __dirname + "/assets/js/app.js",
         "/assets/js/ozan.js"
    )

    // .copy(__dirname + "/assets/images", publicPath + "/images")

    // .sass(
    //     __dirname + '/assets/sass/admin.scss',
    //     __dirname + '/' + publicPath + '/css/ozan-admin.css'
    // )
    .sass(
        __dirname + '/assets/css/main.scss',
        __dirname + '/assets/css/main.css', {
            includePaths: ['node_modules/bootstrap-sass/assets/stylesheets/'],
        }
    )

    .options({
        processCssUrls: false
    });

if (mix.inProduction()) {
    mix.version();
}
