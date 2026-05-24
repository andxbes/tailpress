import { defineConfig } from 'vite'
import tailwindcss from '@tailwindcss/vite'

export default defineConfig(({ command }) => {
    const isBuild = command === 'build';

    return {
        base: isBuild ? '/wp-content/themes/tailpress/dist/' : '/',
        server: {
            host: true,
            port: 3000,
            strictPort: true,
            cors: true,
            origin: 'http://tailpress.local',
            allowedHosts: ['localhost', 'host.docker.internal', 'tailpress.local'],
            hmr: {
                host: 'localhost',
                port: 3000,
            },
        },
        build: {
            manifest: true,
            outDir: 'dist',
            rollupOptions: {
                input: [
                    'resources/js/app.js',
                    'resources/css/app.css',
                    'resources/css/editor-style.css'
                ],
            },
        },
        plugins: [
            tailwindcss(),
        ],
    }
});
