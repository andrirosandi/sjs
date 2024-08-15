<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Andri Rosandi - Personal Website</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: {
                        light: '#f8f9fa',
                        dark: '#1a202c',
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-light dark:bg-dark text-gray-800 dark:text-gray-200 transition-colors duration-300">
    <!-- Navbar -->
    <nav class="fixed top-0 left-0 right-0 z-50">
        <div class="container mx-auto px-4 py-2 flex items-center justify-between">
            <!-- Logo -->
            <div class="flex items-center">
                <img src="your-logo.png" alt="" class="h-12">
            </div>
            
            <!-- Menu, Dark Mode Toggle, and Mobile Menu Button -->
            <div class="flex items-center space-x-4">
                <!-- Menu -->
                <div class="hidden md:flex items-center space-x-4">
                    <a href="#" class="text-gray-600 hover:text-gray-800 dark:text-gray-300 dark:hover:text-gray-100">Beranda</a>
                    <div class="relative group">
                        <button class="text-gray-600 hover:text-gray-800 dark:text-gray-300 dark:hover:text-gray-100">Layanan</button>
                        <div class="absolute right-0 mt-2 w-48 bg-white dark:bg-gray-800 rounded-md shadow-lg opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300">
                            <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-700 rounded-t-md">Web Development</a>
                            <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-700 rounded-b-md">Database Engineering</a>
                        </div>
                    </div>
                    <a href="#" class="text-gray-600 hover:text-gray-800 dark:text-gray-300 dark:hover:text-gray-100">Tentang</a>
                    <a href="#" class="text-gray-600 hover:text-gray-800 dark:text-gray-300 dark:hover:text-gray-100">Kontak</a>
                </div>
                
                <!-- Dark mode toggle -->
                <button id="darkModeToggle" class="text-gray-600 hover:text-gray-800 dark:text-gray-300 dark:hover:text-gray-100">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 hidden dark:block" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />
                    </svg>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 block dark:hidden" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
                    </svg>
                </button>
                
                <!-- Mobile menu button -->
                <button id="mobileMenuButton" class="md:hidden p-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
            </div>
        </div>
    </nav>

    <!-- Side menu -->
    <div id="sideMenu" class="fixed top-0 right-0 bottom-0 w-64 bg-white dark:bg-gray-800 shadow-lg transform translate-x-full transition-transform duration-300 ease-in-out">
        <div class="p-4">
            <h2 class="text-xl font-semibold mb-4">Menu</h2>
            <ul class="space-y-2">
                <li><a href="#" class="block text-gray-600 hover:text-gray-800 dark:text-gray-300 dark:hover:text-gray-100">Beranda</a></li>
                <li>
                    <button id="mobileLayananDropdown" class="w-full text-left text-gray-600 hover:text-gray-800 dark:text-gray-300 dark:hover:text-gray-100 flex justify-between items-center">
                        Layanan
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div id="mobileLayananContent" class="hidden mt-2 ml-4 space-y-2">
                        <a href="#" class="block text-gray-600 hover:text-gray-800 dark:text-gray-300 dark:hover:text-gray-100">Web Development</a>
                        <a href="#" class="block text-gray-600 hover:text-gray-800 dark:text-gray-300 dark:hover:text-gray-100">Database Engineering</a>
                    </div>
                </li>
                <li><a href="#" class="block text-gray-600 hover:text-gray-800 dark:text-gray-300 dark:hover:text-gray-100">Tentang</a></li>
                <li><a href="#" class="block text-gray-600 hover:text-gray-800 dark:text-gray-300 dark:hover:text-gray-100">Kontak</a></li>
            </ul>
        </div>
    </div>

    <!-- Main content -->
    <main class="container mx-auto px-4 pt-20">
        <!-- Konten kosong -->
    </main>

    <script>
        const darkModeToggle = document.getElementById('darkModeToggle');
        const mobileMenuButton = document.getElementById('mobileMenuButton');
        const sideMenu = document.getElementById('sideMenu');
        const mobileLayananDropdown = document.getElementById('mobileLayananDropdown');
        const mobileLayananContent = document.getElementById('mobileLayananContent');

        // Dark mode toggle
        darkModeToggle.addEventListener('click', () => {
            document.documentElement.classList.toggle('dark');
        });

        // Mobile menu toggle
        mobileMenuButton.addEventListener('click', () => {
            sideMenu.classList.toggle('translate-x-0');
            darkModeToggle.classList.toggle('md:block');
            darkModeToggle.classList.toggle('hidden');
        });

        // Mobile dropdown toggle
        mobileLayananDropdown.addEventListener('click', () => {
            mobileLayananContent.classList.toggle('hidden');
        });

        // Close side menu on window resize
        window.addEventListener('resize', () => {
            if (window.innerWidth >= 768) {
                sideMenu.classList.remove('translate-x-0');
                darkModeToggle.classList.remove('hidden');
                darkModeToggle.classList.add('md:block');
            }
        });
    </script>
</body>
</html>