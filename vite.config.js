import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
        vue({
            template: {
                transformAssetUrls: {
                    base: null,
                    includeAbsolute: false,
                },
            },
        }),
    ],
    resolve: {
        alias: {
            '@': '/resources/js',
        },
    },
    server: {
        proxy: {
          '/api/zipcloud': {
            target: 'https://zipcloud.ibsnet.co.jp',
            changeOrigin: true,
            rewrite: (path) => path.replace(/^\/api\/zipcloud/, ''),
          },
        },
      },
});
