const mix   = require('laravel-mix');
const wpPot = require('wp-pot');

mix.options({
    autoprefixer: {
        remove: false
    },
    processCssUrls: false,
	terser: {
		terserOptions: {
			compress: false
		},
		extractComments: false
	}
});

mix.webpackConfig({
	target: 'web',
	externals: {
		jquery: "window.jQuery",
		$: "window.jQuery",
		wp: 'window.wp',
		React: 'window.React',
		GSTM_DATA: 'window.GSTM_DATA'
	},
	watchOptions: {
		ignored: /node_modules/
	}
});

// Disable notification on dev mode
if ( process.env.NODE_ENV.trim() !== 'production' ) {
	mix.disableNotifications();
}


// Form Builder JS
mix.scripts('./dev/public/js/recordrtc.js', './assets/public/js/recordrtc.min.js');
mix.scripts('./dev/public/js/form-public.js', './assets/public/js/form-public.min.js');
mix.scripts('./dev/admin/js/form-admin.js', './assets/admin/js/form-admin.min.js');

// Form Builder SCSS
mix.sass('./dev/public/css/form-public.scss', './assets/public/css/form-public.min.css');
mix.sass('./dev/admin/css/form-admin.scss', './assets/admin/css/form-admin.min.css');

// Freemius
if ( process.env.NODE_ENV.trim() === 'production' ) {

	// Language pot file generator
	wpPot({
		destFile: 'languages/skt-review.pot',
		domain: 'skt-review',
		package: 'Skt_Customer_Review',
		src: ['**/*.php', '!freemius/**/*.php']
	});

}