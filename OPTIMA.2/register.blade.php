<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Account - {{ config('app.name', 'OPTIMA') }}</title>
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

    {{-- Register Form Container --}}
    <div
        class="flex text-white border-2 border-[rgba(26,188,156,0.3)] rounded-[20px] p-[40px_50px] shadow-[0_15px_50px_rgba(0,0,0,0.5)] backdrop-blur-[10px] z-[1] bg-[rgba(15,35,55,0.95)]">
        
        {{-- Display validation errors --}}
        @if ($errors->any())
            <div class="absolute top-[120px] left-1/2 -translate-x-1/2 w-[90%] max-w-[500px] bg-red-500/20 border border-red-500 text-red-200 px-4 py-3 rounded-lg mb-4">
                <ul class="list-none p-0 m-0 text-sm">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('register.submit') }}" method="POST">
            @csrf
            
            <h1 class="text-[36px] text-white mb-[30px] font-semibold">Create an account</h1>
            <h4 class="text-base text-[#8899a6] mb-[35px] font-normal">Complete your profile.</h4>

            {{-- Name Row --}}
            <div class="flex gap-4">
                <div class="relative w-full h-[55px] mb-[25px] mt-5">
                    <label for="firstname"
                        class="absolute -top-5 left-[5px] text-[#1abc9c] text-sm font-medium z-[1] bg-transparent pointer-events-none transition-all duration-300">Name</label>
                    <input type="text" placeholder="First name" id="firstname" name="first_name" value="{{ old('first_name') }}" required
                        class="w-full h-full bg-[rgba(26,188,156,0.08)] border-2 border-[rgba(26,188,156,0.2)] rounded-[10px] px-[20px] pr-[45px] py-[15px] text-base text-white transition-all duration-300 placeholder:text-[#8899a6] focus:outline-none focus:border-[#1abc9c] focus:bg-[rgba(26,188,156,0.12)] focus:shadow-[0_0_15px_rgba(26,188,156,0.2)] @error('first_name') border-red-500 @enderror">
                </div>
                <div class="relative w-full h-[55px] mb-[25px] mt-5">
                    <label for="lastname"
                        class="absolute -top-5 left-[5px] text-[#1abc9c] text-sm font-medium z-[1] bg-transparent pointer-events-none transition-all duration-300 invisible">Last
                        Name</label>
                    <input type="text" placeholder="Last name" id="lastname" name="last_name" value="{{ old('last_name') }}" required
                        class="w-full h-full bg-[rgba(26,188,156,0.08)] border-2 border-[rgba(26,188,156,0.2)] rounded-[10px] px-[20px] pr-[45px] py-[15px] text-base text-white transition-all duration-300 placeholder:text-[#8899a6] focus:outline-none focus:border-[#1abc9c] focus:bg-[rgba(26,188,156,0.12)] focus:shadow-[0_0_15px_rgba(26,188,156,0.2)] @error('last_name') border-red-500 @enderror">
                </div>
            </div>

            {{-- Email & Birthdate Row --}}
            <div class="flex gap-4">
                <div class="relative w-full h-[55px] mb-[25px] mt-5">
                    <label for="email"
                        class="absolute -top-5 left-[5px] text-[#1abc9c] text-sm font-medium z-[1] bg-transparent pointer-events-none transition-all duration-300">Email</label>
                    <input type="email" placeholder="" id="email" name="email" value="{{ old('email') }}" required
                        class="w-full h-full bg-[rgba(26,188,156,0.08)] border-2 border-[rgba(26,188,156,0.2)] rounded-[10px] px-[20px] pr-[45px] py-[15px] text-base text-white transition-all duration-300 placeholder:text-[#8899a6] focus:outline-none focus:border-[#1abc9c] focus:bg-[rgba(26,188,156,0.12)] focus:shadow-[0_0_15px_rgba(26,188,156,0.2)] @error('email') border-red-500 @enderror">
                </div>
                <div class="relative w-full h-[55px] mb-[25px] mt-5">
                    <label for="birthdate"
                        class="absolute -top-5 left-[5px] text-[#1abc9c] text-sm font-medium z-[1] bg-transparent pointer-events-none transition-all duration-300">Birthdate</label>
                    <input type="date" placeholder="MM/DD/YYYY" id="birthdate" name="birthdate" value="{{ old('birthdate') }}" required
                        class="w-full h-full bg-[rgba(26,188,156,0.08)] border-2 border-[rgba(26,188,156,0.2)] rounded-[10px] px-[20px] pr-[45px] py-[15px] text-base text-white transition-all duration-300 placeholder:text-[#8899a6] focus:outline-none focus:border-[#1abc9c] focus:bg-[rgba(26,188,156,0.12)] focus:shadow-[0_0_15px_rgba(26,188,156,0.2)] @error('birthdate') border-red-500 @enderror">
                </div>
            </div>

            {{-- Password Input --}}
            <div class="relative w-full h-[55px] mb-[25px] mt-5">
                <label for="password"
                    class="absolute -top-5 left-[5px] text-[#1abc9c] text-sm font-medium z-[1] bg-transparent pointer-events-none transition-all duration-300">Password</label>
                <input type="password" placeholder="" id="password" name="password" required
                    class="w-full h-full bg-[rgba(26,188,156,0.08)] border-2 border-[rgba(26,188,156,0.2)] rounded-[10px] px-[20px] pr-[45px] py-[15px] text-base text-white transition-all duration-300 placeholder:text-[#8899a6] focus:outline-none focus:border-[#1abc9c] focus:bg-[rgba(26,188,156,0.12)] focus:shadow-[0_0_15px_rgba(26,188,156,0.2)] @error('password') border-red-500 @enderror">
            </div>

            {{-- Password Confirmation Input --}}
            <div class="relative w-full h-[55px] mb-[25px] mt-5">
                <label for="password_confirmation"
                    class="absolute -top-5 left-[5px] text-[#1abc9c] text-sm font-medium z-[1] bg-transparent pointer-events-none transition-all duration-300">Confirm Password</label>
                <input type="password" placeholder="" id="password_confirmation" name="password_confirmation" required
                    class="w-full h-full bg-[rgba(26,188,156,0.08)] border-2 border-[rgba(26,188,156,0.2)] rounded-[10px] px-[20px] pr-[45px] py-[15px] text-base text-white transition-all duration-300 placeholder:text-[#8899a6] focus:outline-none focus:border-[#1abc9c] focus:bg-[rgba(26,188,156,0.12)] focus:shadow-[0_0_15px_rgba(26,188,156,0.2)]">
            </div>

            {{-- Terms Text --}}
            <div class="text-sm text-[#8899a6] mb-6">
                By creating an account, you agree to our
                <a href="https://docs.google.com/document/d/1x0PEgYyN6U3mz6BVGKUDuJGr1TAXdcn4OAmqppcJkwY/edit?tab=t.0" target="_blank"
                    class="text-[#1abc9c] no-underline transition-colors duration-300 hover:text-[#16a085] hover:underline">Terms
                    of Use</a> &
                <a href="https://docs.google.com/document/d/12rcI7CzA21jyFSq4aoudxHbF750kN49pKMPxTBPoRPg/edit?tab=t.0" target="_blank"
                    class="text-[#1abc9c] no-underline transition-colors duration-300 hover:text-[#16a085] hover:underline">Privacy
                    Policy</a>
            </div>

            {{-- Create Account Button --}}
            <button type="submit" id="register_btn"
                class="w-full h-[50px] bg-gradient-to-br from-[#1abc9c] to-[#16a085] border-none rounded-[25px] text-white text-lg font-semibold cursor-pointer transition-all duration-300 shadow-[0_5px_20px_rgba(26,188,156,0.3)] mb-[25px] hover:bg-gradient-to-br hover:from-[#16a085] hover:to-[#1abc9c] hover:-translate-y-[2px] hover:shadow-[0_8px_25px_rgba(26,188,156,0.4)] active:translate-y-0">
                Create Account
            </button>

            {{-- Login Link --}}
            <div class="text-center text-sm">
                <p class="text-[#8899a6] m-0">
                    Already have an account?
                    <a href="{{ route('login') }}"
                        class="text-[#1abc9c] no-underline font-semibold transition-colors duration-300 hover:text-[#16a085] hover:underline">Login</a>
                </p>
            </div>
        </form>
    </div>

</body>

</html>