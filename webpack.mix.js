const mix = require('laravel-mix');
const path = require('path');  // Import module path

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js('resources/js/main.js', 'public/js')
    .postCss('resources/css/style.css', 'public/css', [
        // Có thể thêm các plugin postCSS ở đây, ví dụ như Tailwind CSS nếu cần
    ])
    .copy('resources/img', 'public/img') // Sao chép tất cả hình ảnh từ resources/img vào public/img
    .copy('resources/lib', 'public/lib') // Sao chép tất cả hình ảnh từ resources/img vào public/img
    .webpackConfig({
        resolve: {
            alias: {
                '@': path.resolve(__dirname, 'resources/js'), // Alias để dễ dàng import từ thư mục resources/js
            },
        },
    })
    .version(); // Thêm versioning để tự động thay đổi tên file khi có thay đổi
