/*
import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/sass/app.scss',
                'resources/js/app.js',
            ],
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
            vue: 'vue/dist/vue.esm-bundler.js',
            "simple-peer": "simple-peer/simplepeer.min.js",
        },
    },
});
*/
import { defineConfig } from 'vite';
import vue from '@vitejs/plugin-vue';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/js/app.js'],
            refresh: true,
        }),
        vue(),
    ],
    build: {
        outDir: 'public/js',  // Output files to public/js/
        rollupOptions: {
            output: {
                entryFileNames: '[name].js',  // No hash for entry file
                chunkFileNames: 'chunks/[name].js',  // Customize chunk files if needed
                assetFileNames: 'assets/[name].[ext]',
            },
        },
    },
});
