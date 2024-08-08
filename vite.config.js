// import { defineConfig } from 'vite';
// import laravel from 'laravel-vite-plugin';

// export default defineConfig({
//     plugins: [
//         laravel({
//             input: ['resources/css/app.css', 'resources/js/app.js'],
//             refresh: true,
//         }),
//     ],
// });

import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import basicSsl from '@vitejs/plugin-basic-ssl';
import { Html5Qrcode } from 'html5-qrcode';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/js/app.js'],
            
            refresh: true,
        }),
        basicSsl(),
    ],
    server: {
	    // host: '122.144.1.254', // Ganti dengan alamat IP yang Anda inginkan
	    // port: 5173
	  },
});

