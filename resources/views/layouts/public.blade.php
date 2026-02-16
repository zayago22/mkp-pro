<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', __('site.meta_title'))</title>
    <meta name="description" content="@yield('meta_description', __('site.meta_description'))">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
</head>
<body class="bg-[#0f1119] text-white antialiased" style="font-family: 'Inter', sans-serif;">

    {{-- Header --}}
    <header class="fixed top-0 left-0 right-0 z-50 bg-[#0f1119]/90 backdrop-blur-md border-b border-white/5">
        <nav class="max-w-7xl mx-auto px-4 sm:px-6 py-2 sm:py-3 flex justify-between items-center">
            <a href="/" class="flex items-center gap-3 min-w-0">
                @if(file_exists(public_path('images/logo.png')))
                    <img src="{{ asset('images/logo.png') }}" alt="MKP Mobil Kitchen Pro" class="h-12 sm:h-14 w-auto flex-shrink-0 drop-shadow-lg">
                @endif
            </a>

            <div class="hidden lg:flex items-center gap-8 text-sm font-medium text-gray-300">
                <a href="/#home" class="hover:text-white transition">{{ __('site.nav_home') }}</a>
                <a href="/#services" class="hover:text-white transition">{{ __('site.nav_services') }}</a>
                <a href="/#projects" class="hover:text-white transition">{{ __('site.nav_projects') }}</a>
                <a href="/#testimonials" class="hover:text-white transition">{{ __('site.nav_testimonials') }}</a>
                <a href="{{ route('blog.index') }}" class="hover:text-white transition">{{ __('site.nav_blog') }}</a>
                <a href="/#contact" class="hover:text-white transition">{{ __('site.nav_contact') }}</a>
            </div>

            <div class="hidden lg:flex items-center gap-3">
                {{-- Language selector --}}
                <div class="flex items-center gap-1 text-sm">
                    <a href="{{ route('lang.switch', 'en') }}" class="px-2 py-1 rounded {{ app()->getLocale() === 'en' ? 'bg-orange-500 text-white' : 'text-gray-400 hover:text-white' }} transition">EN</a>
                    <a href="{{ route('lang.switch', 'es') }}" class="px-2 py-1 rounded {{ app()->getLocale() === 'es' ? 'bg-orange-500 text-white' : 'text-gray-400 hover:text-white' }} transition">ES</a>
                </div>
                <a href="/#contact" class="bg-orange-500 hover:bg-orange-600 text-white px-6 py-2.5 rounded-lg font-semibold text-sm transition">
                    {{ __('site.get_quote') }}
                </a>
            </div>

            <button type="button" id="mobile-menu-btn" class="lg:hidden flex items-center justify-center w-10 h-10 rounded-lg border border-white/20 text-white" aria-label="{{ __('site.menu') }}">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16"/></svg>
            </button>
        </nav>
    </header>

    {{-- Mobile menu --}}
    <div id="mobile-menu-overlay" class="fixed inset-0 bg-black/60 z-[100] hidden"></div>
    <aside id="mobile-menu" class="fixed top-0 right-0 bottom-0 w-72 max-w-[85vw] bg-[#0f1119] border-l border-white/10 z-[110] translate-x-full transition-transform duration-300 lg:hidden overflow-y-auto">
        <div class="pt-20 px-6 pb-6 flex flex-col gap-2">
            <a href="/#home" class="mobile-link py-3 text-white font-medium border-b border-white/5">{{ __('site.nav_home') }}</a>
            <a href="/#services" class="mobile-link py-3 text-gray-300 font-medium border-b border-white/5">{{ __('site.nav_services') }}</a>
            <a href="/#projects" class="mobile-link py-3 text-gray-300 font-medium border-b border-white/5">{{ __('site.nav_projects') }}</a>
            <a href="/#testimonials" class="mobile-link py-3 text-gray-300 font-medium border-b border-white/5">{{ __('site.nav_testimonials') }}</a>
            <a href="{{ route('blog.index') }}" class="mobile-link py-3 text-gray-300 font-medium border-b border-white/5">{{ __('site.nav_blog') }}</a>
            <a href="/#contact" class="mobile-link py-3 text-gray-300 font-medium border-b border-white/5">{{ __('site.nav_contact') }}</a>
            {{-- Mobile language selector --}}
            <div class="flex gap-2 py-3 border-b border-white/5">
                <a href="{{ route('lang.switch', 'en') }}" class="mobile-link px-4 py-2 rounded-lg text-sm font-medium {{ app()->getLocale() === 'en' ? 'bg-orange-500 text-white' : 'bg-white/5 text-gray-400' }}">EN</a>
                <a href="{{ route('lang.switch', 'es') }}" class="mobile-link px-4 py-2 rounded-lg text-sm font-medium {{ app()->getLocale() === 'es' ? 'bg-orange-500 text-white' : 'bg-white/5 text-gray-400' }}">ES</a>
            </div>
            <a href="/#contact" class="mobile-link mt-4 bg-orange-500 text-white px-6 py-3 rounded-lg font-semibold text-center">{{ __('site.get_quote') }}</a>
        </div>
    </aside>

    <main class="pt-[60px] sm:pt-[72px]">
        @yield('content')
    </main>

    {{-- Footer --}}
    <footer class="bg-[#0a0c14] border-t border-white/5">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 py-10 sm:py-16">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8 sm:gap-12 mb-12">
                <div>
                    <a href="/" class="inline-flex items-center gap-3 mb-4">
                        @if(file_exists(public_path('images/logo.png')))
                            <img src="{{ asset('images/logo.png') }}" alt="MKP Mobil Kitchen Pro" class="h-16 w-auto drop-shadow-lg">
                        @endif
                    </a>
                    <p class="text-gray-500 text-sm">&copy; {{ date('Y') }} {{ __('site.brand') }}. {{ __('site.all_rights') }}</p>
                </div>
                <div>
                    <h4 class="font-semibold mb-4 text-white">{{ __('site.company') }}</h4>
                    <ul class="space-y-2 text-gray-400 text-sm">
                        <li><a href="/#services" class="hover:text-white transition">{{ __('site.nav_services') }}</a></li>
                        <li><a href="/#projects" class="hover:text-white transition">{{ __('site.nav_projects') }}</a></li>
                        <li><a href="/#testimonials" class="hover:text-white transition">{{ __('site.nav_testimonials') }}</a></li>
                        <li><a href="{{ route('blog.index') }}" class="hover:text-white transition">{{ __('site.nav_blog') }}</a></li>
                        <li><a href="/#contact" class="hover:text-white transition">{{ __('site.nav_contact') }}</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-semibold mb-4 text-white">{{ __('site.services') }}</h4>
                    <ul class="space-y-2 text-gray-400 text-sm">
                        <li>{{ __('home.svc_design') }}</li>
                        <li>{{ __('home.svc_build') }}</li>
                        <li>{{ __('home.svc_kitchen') }}</li>
                        <li>{{ __('home.svc_repair') }}</li>
                        <li>{{ __('home.svc_wrap') }}</li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-semibold mb-4 text-white">{{ __('site.contact_us') }}</h4>
                    <p class="text-gray-400 text-sm mb-1">130 Mitchell Rd Unit B8</p>
                    <p class="text-gray-400 text-sm mb-3">Houston TX 77037</p>
                    <p class="text-gray-400 text-sm mb-1"><a href="tel:+17133576408" class="hover:text-orange-400 transition">+1 (713) 357-6408</a></p>
                    <p class="text-gray-400 text-sm mb-1"><a href="https://wa.me/12816833196" target="_blank" class="hover:text-green-400 transition">WhatsApp: +1 (281) 683-3196</a></p>
                    <p class="text-gray-400 text-sm mb-4"><a href="mailto:contacto@mobilkitchenpro.com" class="hover:text-orange-400 transition">contacto@mobilkitchenpro.com</a></p>
                    @php $socialLinks = $socialLinks ?? \App\Models\SocialLink::where('is_active', true)->orderBy('order')->get(); @endphp
                    @if($socialLinks->count())
                    <div class="flex gap-3">
                        @foreach($socialLinks as $link)
                        <a href="{{ $link->url }}" target="_blank" rel="noopener" class="text-gray-500 hover:text-orange-500 transition text-sm">{{ $link->platform }}</a>
                        @endforeach
                    </div>
                    @endif
                </div>
            </div>
            <div class="pt-8 border-t border-white/5 text-center text-gray-500 text-sm">
                <p>&copy; {{ date('Y') }} {{ __('site.brand') }}. {{ __('site.footer_tagline') }}</p>
            </div>
        </div>
    </footer>

    {{-- Floating buttons: WhatsApp + Call --}}
    <div class="fixed bottom-6 right-6 z-[90] flex flex-col gap-3">
        <a href="tel:+17133576408" class="w-14 h-14 rounded-full bg-orange-500 hover:bg-orange-600 text-white flex items-center justify-center shadow-lg shadow-orange-500/30 transition-transform hover:scale-110" aria-label="Call us">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
        </a>
        <a href="https://wa.me/12816833196" target="_blank" rel="noopener" class="w-14 h-14 rounded-full bg-[#25D366] hover:bg-[#1fb855] text-white flex items-center justify-center shadow-lg shadow-green-500/30 transition-transform hover:scale-110" aria-label="WhatsApp">
            <svg class="w-7 h-7" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
        </a>
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        var btn = document.getElementById('mobile-menu-btn');
        var menu = document.getElementById('mobile-menu');
        var overlay = document.getElementById('mobile-menu-overlay');
        var links = document.querySelectorAll('.mobile-link');

        function open() {
            menu.classList.remove('translate-x-full');
            overlay.classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }
        function close() {
            menu.classList.add('translate-x-full');
            overlay.classList.add('hidden');
            document.body.style.overflow = '';
        }

        if (btn) btn.addEventListener('click', open);
        if (overlay) overlay.addEventListener('click', close);
        links.forEach(function(l) { l.addEventListener('click', close); });
        document.addEventListener('keydown', function(e) { if (e.key === 'Escape') close(); });
    });
    </script>

    @stack('scripts')
</body>
</html>
