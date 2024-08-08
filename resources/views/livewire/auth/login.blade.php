

<section class="bg-gray-50 dark:bg-gray-900">      
    
    
    @php
    if (isset($_GET['redirect'])) {
        $redirect = @base64_decode($_GET['redirect']);
    }
    @endphp
    
    
    <script>
        document.addEventListener('livewire:initialized',()=>{
        Livewire.on('setcookies',({ newcookies })=>{
            window.location.href = '{{ @$redirect != null ? $redirect : "/" }}';
        });
    });
    </script>
    
    
    
    
    <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">
        <a href="#" class="flex items-center mb-6 text-2xl font-semibold text-gray-900 dark:text-white">
            {{-- <img class="w-8 h-8 mr-2" src="https://flowbite.s3.amazonaws.com/blocks/marketing-ui/logo.svg" alt="logo"> --}}
            SAHABAT JAYA SUKSES    
        </a>
        <div class="w-full bg-white rounded-lg shadow dark:border md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-gray-700">
            <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
                    Sign in to your account
                </h1>
                @if($message)
                <div class="text-pink-500 truncate" >{{ $message }}</div>
                @endif
                
                <form class="space-y-4 md:space-y-6" wire:submit="submit">
                    @csrf
                    <div>
                        <label for="userid" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">User ID</label>
                        <input wire:model='userid' type="text" name="userid" id="userid" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="name@company.com" required="">
                    </div>
                    <div>
                        <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password</label>
                        <div class="relative">
                            <input wire:model='password' type="password" name="password" id="password" placeholder="••••••••" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required="">
                            <button type="button" class=" text-gray-600 absolute inset-y-0 right-0 pr-3 flex items-center focus:outline-none" onclick="togglePasswordVisibility()">
                                <i class="fa fa-eye-slash text-gray-400" id="togglePassword"></i>
                            </button>
                        </div>
                    </div>
                    
                    <script>
                        function togglePasswordVisibility() {
                            const passwordInput = document.getElementById('password');
                            const toggleIcon = document.getElementById('togglePassword');
                            if (passwordInput.type === 'password') {
                                passwordInput.type = 'text';
                                toggleIcon.classList.remove('fa-eye-slash');
                                toggleIcon.classList.add('fa-eye');
                            } else {
                                passwordInput.type = 'password';
                                toggleIcon.classList.remove('fa-eye');
                                toggleIcon.classList.add('fa-eye-slash');
                            }
                        }
                    </script>
                    
                    <div class="flex items-center justify-between">
                        <div class="flex items-start hidden">
                            <div class="flex items-center h-5">
                                <input id="remember" wire:model='remember' aria-describedby="remember" type="checkbox" class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-primary-300 dark:bg-gray-700 dark:border-gray-600 dark:focus:ring-primary-600 dark:ring-offset-gray-800">
                            </div>
                            <div class="ml-3 text-sm">
                                <label for="remember" class="text-gray-500 dark:text-gray-300">Remember me</label>
                            </div>
                        </div>
                        {{-- <a href="#" class="text-sm font-medium text-primary-600 hover:underline dark:text-primary-500">Forgot password?</a> --}}
                    </div> 
                    <button class="w-full text-white bg-red-600 hover:bg-red-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-300"
                    wire:loading.attr="disabled">
                    <span wire:loading.remove>
                        Sign in
                    </span>
                    
                    <span wire:loading>
                        Loading ... 
                    </span>
                </button>
                {{-- <p class="text-sm font-light text-gray-500 dark:text-gray-400">
                    Don’t have an account yet? <a href="#" class="font-medium text-primary-600 hover:underline dark:text-primary-500">Sign up</a>
                </p> --}}
            </form>
            
        </div>
    </div>
</div>
</section>