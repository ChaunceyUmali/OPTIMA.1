<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - {{ config('app.name', 'OPTIMA') }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <style>
        body {
            background: url("{{ asset('backgrounds/loginbg.png') }}") center/cover no-repeat;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
    </style>
</head>

<body class="min-h-screen flex justify-center items-center text-center text-white relative">

    {{-- Logo Header --}}
    <div class="absolute top-[30px] left-[30px] z-10">
        <a href="{{ route('home') }}"
            class="flex items-center gap-[15px] no-underline text-white transition-all duration-300 hover:translate-x-[5px] hover:opacity-80">
            <img src="{{ asset('backgrounds/optima-logo.png') }}" alt="Optima Logo"
                class="h-[50px] w-auto transition-transform duration-300 hover:rotate-[5deg]">
            <h1 class="text-[32px] font-bold m-0 tracking-[2px]">OPTIMA</h1>
        </a>
    </div>

    {{-- Login Form Wrapper --}}
    <div
        class="w-[450px] bg-[rgba(15,35,55,0.95)] text-white border-2 border-[rgba(26,188,156,0.3)] rounded-[20px] p-[40px_50px] shadow-[0_15px_50px_rgba(0,0,0,0.5)] backdrop-blur-[10px] z-[1] max-[480px]:w-[90%] max-[480px]:p-[30px_25px]">
        
        {{-- Display validation errors --}}
        @if ($errors->any())
            <div class="bg-red-500/20 border border-red-500 text-red-200 px-4 py-3 rounded-lg mb-4">
                <ul class="list-none p-0 m-0 text-sm">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Display success message --}}
        @if (session('success'))
            <div class="bg-green-500/20 border border-green-500 text-green-200 px-4 py-3 rounded-lg mb-4 text-sm">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('login.submit') }}" method="POST">
            @csrf
            
            <h1 class="text-[36px] text-white mb-[10px] font-semibold max-[480px]:text-[28px]">Welcome!</h1>
            <h4 class="text-base text-[#8899a6] mb-[35px] font-normal max-[480px]:text-sm">Please login to your account
            </h4>

            {{-- Username Input --}}
            <div class="relative w-full h-[55px] mb-[25px] mt-5">
                <input type="text" name="username" placeholder="Username" value="{{ old('username') }}" required
                    class="w-full h-full bg-[rgba(26,188,156,0.08)] border-2 border-[rgba(26,188,156,0.2)] rounded-[10px] px-[20px] pr-[45px] py-[15px] text-base text-white transition-all duration-300 placeholder:text-[#8899a6] focus:outline-none focus:border-[#1abc9c] focus:bg-[rgba(26,188,156,0.12)] focus:shadow-[0_0_15px_rgba(26,188,156,0.2)] @error('username') border-red-500 @enderror">
                <i class="bi bi-person-fill absolute right-5 top-1/2 -translate-y-1/2 text-xl"></i>
            </div>

            {{-- Password Input --}}
            <div class="relative w-full h-[55px] mb-[25px] mt-5">
                <input type="password" name="password" placeholder="Password" required
                    class="w-full h-full bg-[rgba(26,188,156,0.08)] border-2 border-[rgba(26,188,156,0.2)] rounded-[10px] px-[20px] pr-[45px] py-[15px] text-base text-white transition-all duration-300 placeholder:text-[#8899a6] focus:outline-none focus:border-[#1abc9c] focus:bg-[rgba(26,188,156,0.12)] focus:shadow-[0_0_15px_rgba(26,188,156,0.2)] @error('password') border-red-500 @enderror">
                <i class="bi bi-lock-fill absolute right-5 top-1/2 -translate-y-1/2 text-xl"></i>
            </div>

            {{-- Remember Me & Forgot Password --}}
            <div class="flex justify-between items-center mb-[30px] text-sm">
                <div class="flex items-center gap-2">
                    <input type="checkbox" id="remember" name="remember" value="1" {{ old('remember') ? 'checked' : '' }}
                        class="accent-black w-[18px] h-[18px] cursor-pointer">
                    <label for="remember" class="text-[#8899a6] cursor-pointer select-none">Remember Me</label>
                </div>
                <a href="{{ route('password.request') }}" id="forgot"
                    class="text-[#1abc9c] no-underline transition-colors duration-300 hover:text-[#16a085] hover:underline">Forgot
                    Password?</a>
            </div>

            {{-- Login Button --}}
            <button type="submit" id="login_btn"
                class="w-full h-[50px] bg-gradient-to-br from-[#1abc9c] to-[#16a085] border-none rounded-[25px] text-white text-lg font-semibold cursor-pointer transition-all duration-300 shadow-[0_5px_20px_rgba(26,188,156,0.3)] mb-[25px] hover:bg-gradient-to-br hover:from-[#16a085] hover:to-[#1abc9c] hover:-translate-y-[2px] hover:shadow-[0_8px_25px_rgba(26,188,156,0.4)] active:translate-y-0">
                Login
            </button>

            {{-- Register Link --}}
            <div class="text-center text-sm">
                <p class="text-[#8899a6] m-0">
                    Don't have an account?
                    <a href="{{ route('register') }}"
                        class="text-[#1abc9c] no-underline font-semibold transition-colors duration-300 hover:text-[#16a085] hover:underline">Register</a>
                </p>
            </div>
        </form>
    </div>

</body>

</html>