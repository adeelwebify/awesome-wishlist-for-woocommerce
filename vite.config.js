import { defineConfig } from 'vite';
import { resolve } from 'path';

export default defineConfig({
  build: {
    outDir: 'dist',
    rollupOptions: {
      input: {
        main: resolve(__dirname, 'assets/js/script.js'),
        style: resolve(__dirname, 'assets/css/style.css'),
      },
      output: {
        entryFileNames: '[name].js',
        assetFileNames: '[name][extname]', // Keeps the original file name and extension
      },
    },
  },
});
