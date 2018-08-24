var gulp           = require('gulp'),
		gutil          = require('gulp-util' ),
		sass           = require('gulp-sass'),
		browserSync    = require('browser-sync'),
		livereload     = require('gulp-livereload')
		concat         = require('gulp-concat'),
		uglify         = require('gulp-uglify'),
		cleanCSS       = require('gulp-clean-css'),
		rename         = require('gulp-rename'),
		del            = require('del'),
		imagemin       = require('gulp-imagemin'),
		cache          = require('gulp-cache'),
		autoprefixer   = require('gulp-autoprefixer'),
		ftp            = require('vinyl-ftp'),
		notify         = require("gulp-notify"),
		rsync          = require('gulp-rsync');

// Пользовательские скрипты проекта

gulp.task('common-js', function() {
	return gulp.src([
		'js/common.js',
		])
	.pipe(concat('common.min.js'))
	.pipe(uglify())
	.pipe(gulp.dest('js'));
});

gulp.task('js', ['common-js'], function() {
	return gulp.src([
		'js/common.min.js' // Всегда в конце
		])
	.pipe(concat('scripts.min.js'))
	// .pipe(uglify()) // Минимизировать весь js (на выбор)
	.pipe(gulp.dest('js'))
	.pipe(browserSync.reload({stream: true}));
});

gulp.task('browser-sync', function() {

    browserSync.init({
          open: 'external',
          host: 'localhost',
          proxy: 'localhost/wordpress', // or project.dev/app/
          port: 8080
    });
});

gulp.task('livereload', function() {
	gulp.src('./style.sass')
		.pipe(sass().on('error', sass.logError))
		.pipe(autoprefixer({
			browsers: ['last 15 versions'],
			cascade: false
		}))
		.pipe(gulp.dest('./'))
		.pipe(livereload());
});
gulp.task('sass', function() {
	return gulp.src('./style.sass')
	.pipe(sass({outputStyle: 'expand'}).on("error", notify.onError()))
	.pipe(rename({suffix: '', prefix : ''}))
	.pipe(autoprefixer(['last 15 versions']))
	.pipe(cleanCSS()) // Опционально, закомментировать при отладке
	.pipe(gulp.dest('./'))
	.pipe(browserSync.reload({stream: true}));
});

gulp.task('watch', ['sass', 'js', 'browser-sync'], function() {
	gulp.watch('./*.sass', ['sass']);
	gulp.watch(['libs/**/*.js', 'js/common.js'], ['js']);
	gulp.watch('*.php', browserSync.reload({stream: true}));
});

gulp.task('imagemin', function() {
	return gulp.src('img/**/*')
	.pipe(cache(imagemin())) // Cache Images
	.pipe(gulp.dest('dist/img')); 
});

gulp.task('build', ['removedist', 'imagemin', 'sass', 'js'], function() {

	var buildFiles = gulp.src([
		'*.html',
		'.htaccess',
		]).pipe(gulp.dest('dist'));

	var buildCss = gulp.src([
		'style.css',
		]).pipe(gulp.dest('dist/css'));

	var buildJs = gulp.src([
		'js/scripts.min.js',
		]).pipe(gulp.dest('dist/js'));

	var buildFonts = gulp.src([
		'fonts/**/*',
		]).pipe(gulp.dest('dist/fonts'));

});

gulp.task('deploy', function() {

	var conn = ftp.create({
		host:      'host',
		user:      'user',
		password:  'password',
		parallel:  10,
		log: gutil.log
	});

	var globs = [
	'dist/**',
	'dist/.htaccess',
	];
	return gulp.src(globs, {buffer: false})
	.pipe(conn.dest('/path/to/folder/on/server'));

});

gulp.task('rsync', function() {
	return gulp.src('dist/**')
	.pipe(rsync({
		root: 'dist/',
		hostname: 'host',
		destination: '/public_html/',
		// include: ['*.htaccess'], // Скрытые файлы, которые необходимо включить в деплой
		recursive: true,
		archive: true,
		silent: false,
		compress: true
	}));
});

gulp.task('removedist', function() { return del.sync('dist'); });
gulp.task('clearcache', function () { return cache.clearAll(); });

gulp.task('default', function() {
	livereload.listen();
	gulp.watch('./*.sass',['livereload'], ['watch']);
});
