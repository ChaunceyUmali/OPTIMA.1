<!DOCTYPE html>
<html lang="en" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'OPTIMA') }} - FAQs</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
</head>

<body class="text-white m-0 p-0 font-sans">

    {{-- Navbar --}}
    <nav
        class="bg-[#1e293b] flex items-center py-2.5 px-10 flex-wrap fixed top-0 left-0 right-0 z-[1000] md:flex-row md:justify-between max-md:flex-col max-md:items-start max-md:gap-[15px] max-md:px-5">
        <div class="flex items-center gap-2.5 max-md:mb-[5px] max-[480px]:gap-2">
            <img src="{{ asset('backgrounds/optima-logo.png') }}" class="w-10 h-10 mr-0 max-[480px]:w-[30px] max-[480px]:h-[30px]">
            <a href="{{ route('home') }}">
                <h1 class="text-2xl font-bold text-white mr-[50px] m-0 max-md:text-xl max-md:mr-0 max-[480px]:text-lg">
                    OPTIMA</h1>
            </a>
        </div>
        <ul
            class="list-none flex items-center gap-5 ml-auto flex-wrap max-md:ml-0 max-md:w-full max-md:gap-2.5 max-[480px]:gap-[5px]">
            <li><a href="{{ route('home') }}"
                    class="block text-[#8899a6] py-3.5 px-4 no-underline text-base font-medium transition-all duration-300 hover:text-[#1abc9c] hover:bg-[rgba(26,188,156,0.1)] hover:rounded-[5px] max-[480px]:py-2.5 max-[480px]:px-3 max-[480px]:text-sm">Home</a>
            </li>
            <li><a href="#faqs"
                    class="block text-[#8899a6] py-3.5 px-4 no-underline text-base font-medium transition-all duration-300 hover:text-[#1abc9c] hover:bg-[rgba(26,188,156,0.1)] hover:rounded-[5px] max-[480px]:py-2.5 max-[480px]:px-3 max-[480px]:text-sm">FAQs
                </a>
            </li>
            <li><a href="#team"
                    class="block text-[#8899a6] py-3.5 px-4 no-underline text-base font-medium transition-all duration-300 hover:text-[#1abc9c] hover:bg-[rgba(26,188,156,0.1)] hover:rounded-[5px] max-[480px]:py-2.5 max-[480px]:px-3 max-[480px]:text-sm">Our
                    Team</a>
            </li>
            <span class="w-px h-[30px] bg-[rgba(136,153,166,0.3)] mx-2.5 max-md:hidden"></span>
            <div class="flex gap-2.5 ml-auto items-center max-md:ml-0 max-md:w-full">
                <li><a href="{{ route('login') }}"
                        class="block text-[#8899a6] py-3.5 px-4 no-underline text-base font-medium transition-all duration-300 hover:text-[#1abc9c] hover:bg-[rgba(26,188,156,0.1)] hover:rounded-[5px] max-[480px]:py-2.5 max-[480px]:px-3 max-[480px]:text-sm">Login</a>
                </li>
                <li id="start"><a href="{{ route('register') }}"
                        class="bg-gradient-to-br from-[#1abc9c] to-[#16a085] text-white py-2.5 px-6 rounded-[30px] font-semibold shadow-[0_5px_20px_rgba(26,188,156,0.3)] transition-transform duration-300 hover:bg-gradient-to-br hover:from-[#16a085] hover:to-[#1abc9c] hover:-translate-y-0.5 block max-[480px]:py-2 max-[480px]:px-5 max-[480px]:text-sm">Get
                        Started</a></li>
            </div>
        </ul>
    </nav>

    {{-- FAQs Section --}}
    <div
        class="bg-[url('{{ asset('backgrounds/testbg.png') }}')] bg-cover bg-center bg-no-repeat min-h-screen pt-[120px] pb-[60px] px-[50px] flex items-center justify-center max-md:px-[30px] max-md:pt-[150px] max-[480px]:px-5">
        <div class="w-full max-w-[1200px] flex flex-col gap-[100px]">

            {{-- FAQs Area --}}
            <div id="faqs"
                class="scroll-mt-[150px] grid grid-cols-2 gap-20 items-center max-md:grid-cols-1 max-md:gap-10">

                {{-- Left Graphic --}}
                <div class="flex justify-center md:justify-end">
                    <div class="relative w-[300px] h-[220px] md:w-[400px] md:h-[300px]">
                        {{-- Chat bubble container --}}
                        <div
                            class="w-full h-full border-[15px] border-[#81e6d9] rounded-[40px] flex items-center justify-center relative bg-transparent">
                            {{-- Question Mark --}}
                            <span
                                class="text-[150px] md:text-[200px] font-medium text-[#81e6d9] leading-none mb-4">?</span>

                            {{-- Dot --}}
                            <div class="absolute bottom-[40px] text-[#81e6d9]"></div>

                            {{-- Tail of speech bubble --}}
                            <div
                                class="absolute -bottom-[60px] left-1/2 -translate-x-1/2 w-0 h-0 border-l-[30px] border-l-transparent border-r-[30px] border-r-transparent border-t-[50px] border-t-[#81e6d9]">
                            </div>
                            {{-- Tail inner cutout (to make it outline) --}}
                            <div
                                class="absolute -bottom-[30px] left-1/2 -translate-x-1/2 w-0 h-0 border-l-[15px] border-l-transparent border-r-[15px] border-r-transparent border-t-[30px] border-t-[#18253a]">
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Right Content --}}
                <div class="text-left w-full max-w-[600px]">
                    <h1 class="text-5xl font-bold mb-8 text-white max-md:text-4xl">Frequently Asked<br>Questions</h1>

                    <div class="relative mb-8">
                        <input type="text" placeholder="Search Question Here" id="faq-search"
                            class="w-full bg-white/90 rounded-none py-4 px-5 text-gray-600 placeholder-gray-400 text-lg outline-none pr-12">
                        <i class="bi bi-search absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 text-xl"></i>
                    </div>

                    <div class="bg-white/90 rounded-none p-0 overflow-hidden">
                        <ul class="list-none">
                            @forelse($faqs ?? [] as $faq)
                                <li class="border-b border-gray-200 last:border-0 hover:bg-gray-50 transition-colors">
                                    <a href="{{ $faq->url ?? '#' }}" class="flex items-center py-4 px-5 text-gray-600 text-lg group">
                                        <i class="bi bi-caret-right-fill mr-4 text-[#1e293b] group-hover:text-[#1abc9c]"></i>
                                        {{ $faq->question ?? 'lorem ipsum lorem ipsum' }}
                                    </a>
                                </li>
                            @empty
                                @for($i = 0; $i < 6; $i++)
                                    <li class="border-b border-gray-200 last:border-0 hover:bg-gray-50 transition-colors">
                                        <a href="#" class="flex items-center py-4 px-5 text-gray-600 text-lg group">
                                            <i class="bi bi-caret-right-fill mr-4 text-[#1e293b] group-hover:text-[#1abc9c]"></i>
                                            lorem ipsum lorem ipsum
                                        </a>
                                    </li>
                                @endfor
                            @endforelse
                        </ul>
                    </div>
                </div>
            </div>

            {{-- Team Section --}}
            <div id="team" class="text-center w-full">
                <div class="flex flex-col items-center mb-10">
                    <i class="bi bi-people-fill text-6xl text-gray-300 mb-4"></i>
                    <h2 class="text-5xl font-bold text-white max-md:text-4xl">Meet our Team</h2>
                </div>

                <div class="grid grid-cols-3 gap-x-8 gap-y-12 max-lg:grid-cols-2 max-md:grid-cols-1">
                    @php
                        $teamMembers = $team ?? [
                            ['name' => 'Jewel Balbaira', 'role' => 'Project Manager', 'image' => 'balbaira.png'],
                            ['name' => 'Chauncey M. Umali', 'role' => 'Frontend Developer', 'image' => 'umali.png'],
                            ['name' => 'Cherry Mae Dampios', 'role' => 'Backend Developer', 'image' => 'dampios.png'],
                            ['name' => 'Judy May Paras', 'role' => 'Web Designer', 'image' => 'paras.png'],
                            ['name' => 'Lorenze Concepcion', 'role' => 'Database', 'image' => 'concepcion.png'],
                            ['name' => 'Hans Tenia', 'role' => 'Database', 'image' => 'tenia.png'],
                        ];
                    @endphp

                    @foreach($teamMembers as $member)
                        <div
                            class="border border-gray-300 rounded-full p-2 pr-8 flex items-center gap-4 bg-transparent transition-transform hover:-translate-y-1">
                            <div class="w-16 h-16 rounded-full overflow-hidden shrink-0 bg-gray-200 border-2 border-white">
                                <img src="{{ asset('team/' . $member['image']) }}" alt="{{ $member['name'] }}" class="w-full h-full object-cover">
                            </div>
                            <div class="text-left">
                                <h3 class="text-white font-bold text-lg leading-tight">{{ $member['name'] }}</h3>
                                <p class="text-blue-300 text-sm">{{ $member['role'] }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    {{-- Footer Section --}}
    <footer id="footer"
        class="bg-gradient-to-br from-[#0d9488] to-[#14b8a6] text-white py-[60px] px-[50px] pb-5 m-0 max-md:py-[50px] max-md:px-[30px] max-md:pb-5 max-[480px]:py-[40px] max-[480px]:px-5 max-[480px]:pb-5">
        <div
            class="max-w-[1200px] mx-auto grid grid-cols-[1.5fr_2fr] gap-[60px] mb-10 max-md:grid-cols-1 max-md:gap-10">
            <div class="footer-brand">
                <h2 class="text-4xl font-bold mb-5">OPTIMA</h2>
                <h3 class="text-2xl font-semibold mb-5">Connect with us</h3>
                <form action="{{ route('newsletter.subscribe') }}" method="POST" class="flex gap-2.5 max-w-[400px]">
                    @csrf
                    <input type="email" name="email" placeholder="Email Address" required
                        class="flex-1 py-3 px-5 border-none rounded-[5px] text-base bg-white text-[#333] placeholder-[#999]">
                    <button type="submit"
                        class="py-3 px-[30px] bg-[#0d9488] text-white border-2 border-white rounded-[5px] text-base font-semibold cursor-pointer transition-all duration-300 hover:bg-[#0a7a6e] hover:-translate-y-0.5">Sign-up</button>
                </form>
            </div>

            <div class="grid grid-cols-3 gap-10 max-md:grid-cols-2">
                <div class="text-left">
                    <h4 class="text-xl font-semibold mb-5">Explore</h4>
                    <ul class="list-none p-0">
                        <li class="mb-3 text-base flex items-center gap-2"><a href="#faqs"
                                class="text-white no-underline transition-all duration-300 hover:text-[#0d1c34]">FAQs
                            </a></li>
                        <li class="mb-3 text-base flex items-center gap-2"><a href="#team"
                                class="text-white no-underline transition-all duration-300 hover:text-[#0d1c34]">Our
                                Team</a>
                        </li>
                        <li class="mb-3 text-base flex items-center gap-2"><a
                                href="https://docs.google.com/document/d/12rcI7CzA21jyFSq4aoudxHbF750kN49pKMPxTBPoRPg/edit?tab=t.0"
                                target="_blank"
                                class="text-white no-underline transition-all duration-300 hover:text-[#0d1c34]">Privacy
                                Policy</a></li>
                        <li class="mb-3 text-base flex items-center gap-2"><a
                                href="https://docs.google.com/document/d/1x0PEgYyN6U3mz6BVGKUDuJGr1TAXdcn4OAmqppcJkwY/edit?tab=t.0"
                                target="_blank"
                                class="text-white no-underline transition-all duration-300 hover:text-[#0d1c34]">Terms
                                of Use</a></li>
                    </ul>
                </div>

                <div class="text-left">
                    <h4 class="text-xl font-semibold mb-5">Quick links</h4>
                    <ul class="list-none p-0">
                        <li class="mb-3 text-base flex items-center gap-2"><a href="{{ route('home') }}#homepage"
                                class="text-white no-underline transition-all duration-300 hover:text-[#0d1c34]">Home</a>
                        </li>
                        <li class="mb-3 text-base flex items-center gap-2"><a href="{{ route('home') }}#about"
                                class="text-white no-underline transition-all duration-300 hover:text-[#0d1c34]">About</a>
                        </li>
                        <li class="mb-3 text-base flex items-center gap-2"><a href="{{ route('home') }}#features"
                                class="text-white no-underline transition-all duration-300 hover:text-[#0d1c34]">Features</a>
                        </li>
                        <li class="mb-3 text-base flex items-center gap-2"><a href="{{ route('home') }}#tutorial"
                                class="text-white no-underline transition-all duration-300 hover:text-[#0d1c34]">How to
                                Use</a></li>
                    </ul>
                </div>

                <div class="text-left">
                    <h4 class="text-xl font-semibold mb-5">Contact Us</h4>
                    <ul class="list-none p-0">
                        <li class="mb-3 text-base flex items-center gap-2"><i class="bi bi-geo-alt text-lg"></i> Put
                            address here</li>
                        <li class="mb-3 text-base flex items-center gap-2"><i class="bi bi-telephone text-lg"></i> (+63)
                            915-241-3915</li>
                        <li class="mb-3 text-base flex items-center gap-2"><i class="bi bi-envelope text-lg"></i>
                            start@optima.com</li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="border-t border-[rgba(255,255,255,0.3)] pt-5 text-center max-w-[1200px] mx-auto">
            <p class="text-sm text-white">© {{ date('Y') }} Optima. All Rights Reserved. | <a
                    href="https://docs.google.com/document/d/12rcI7CzA21jyFSq4aoudxHbF750kN49pKMPxTBPoRPg/edit?tab=t.0"
                    target="_blank" class="text-white underline hover:text-[#0d1c34]">Privacy Policy</a></p>
        </div>
    </footer>

</body>

</html>