@extends('layouts.public')

@section('title', __('site.meta_title'))

@section('content')

{{-- Hero with background slider --}}
<section id="home" class="relative min-h-[80vh] sm:min-h-[90vh] flex items-center overflow-hidden">
    <div class="hero-slider absolute inset-0">
        <div class="hero-slide active" style="background-image: url('{{ asset('images/hero/hero-1.jpg') }}');"></div>
        <div class="hero-slide" style="background-image: url('{{ asset('images/hero/hero-2.jpg') }}');"></div>
        <div class="hero-slide" style="background-image: url('{{ asset('images/hero/hero-3.jpg') }}');"></div>
        <div class="hero-slide" style="background-image: url('{{ asset('images/hero/hero-4.jpg') }}');"></div>
    </div>
    <div class="absolute inset-0 bg-gradient-to-b from-black/60 via-black/40 to-[#0f1119] z-[1]"></div>
    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 py-16 sm:py-24">
        <p class="text-orange-500 font-semibold text-xs sm:text-sm tracking-widest uppercase mb-3 sm:mb-4">{{ __('home.hero_subtitle') }}</p>
        <h1 class="text-3xl sm:text-4xl md:text-6xl lg:text-7xl font-extrabold text-white leading-tight mb-4 sm:mb-6">
            {{ __('home.hero_title_1') }}<br class="hidden sm:block"> {{ __('home.hero_title_2') }}
        </h1>
        <p class="text-gray-400 text-base sm:text-lg md:text-xl max-w-2xl mb-8 sm:mb-10">
            {{ __('home.hero_desc') }}
        </p>
        <a href="#services" class="inline-block bg-orange-500 hover:bg-orange-600 text-white px-6 sm:px-8 py-3 sm:py-4 rounded-lg font-semibold text-sm sm:text-base transition shadow-lg shadow-orange-500/20">
            {{ __('home.hero_btn') }}
        </a>
    </div>
</section>

{{-- Stats --}}
<section class="relative z-10 -mt-10 sm:-mt-16 px-4 sm:px-6">
    <div class="max-w-7xl mx-auto grid grid-cols-3 gap-3 sm:gap-6">
        <div class="bg-[#161a24] border border-white/5 rounded-xl p-4 sm:p-8 text-center">
            <p class="text-2xl sm:text-4xl font-bold text-white mb-1 sm:mb-2">100+</p>
            <p class="text-gray-400 text-xs sm:text-base">{{ __('home.stat_projects') }}</p>
        </div>
        <div class="bg-[#161a24] border border-white/5 rounded-xl p-4 sm:p-8 text-center">
            <p class="text-2xl sm:text-4xl font-bold text-white mb-1 sm:mb-2">10+</p>
            <p class="text-gray-400 text-xs sm:text-base">{{ __('home.stat_years') }}</p>
        </div>
        <div class="bg-[#161a24] border border-white/5 rounded-xl p-4 sm:p-8 text-center">
            <p class="text-2xl sm:text-4xl font-bold text-white mb-1 sm:mb-2">100%</p>
            <p class="text-gray-400 text-xs sm:text-base">{{ __('home.stat_satisfaction') }}</p>
        </div>
    </div>
</section>

{{-- Services --}}
<section id="services" class="py-16 sm:py-24 px-4 sm:px-6">
    <div class="max-w-7xl mx-auto">
        <div class="text-center mb-10 sm:mb-16">
            <span class="inline-block text-orange-500 font-semibold text-xs sm:text-sm tracking-widest uppercase mb-2">{{ __('home.services_label') }}</span>
            <h2 class="text-2xl sm:text-3xl md:text-4xl font-bold text-white mb-4">{{ __('home.services_title') }}</h2>
            <div class="w-16 h-1 bg-orange-500 mx-auto mb-4 sm:mb-6"></div>
            <p class="text-gray-400 max-w-2xl mx-auto text-sm sm:text-base">{{ __('home.services_desc') }}</p>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-6">
            @foreach([
                ['icon' => '🎨', 'title' => __('home.svc_design'), 'desc' => __('home.svc_design_desc'), 'color' => 'orange'],
                ['icon' => '🚚', 'title' => __('home.svc_build'), 'desc' => __('home.svc_build_desc'), 'color' => 'teal'],
                ['icon' => '⚙️', 'title' => __('home.svc_custom'), 'desc' => __('home.svc_custom_desc'), 'color' => 'orange'],
                ['icon' => '🔧', 'title' => __('home.svc_repair'), 'desc' => __('home.svc_repair_desc'), 'color' => 'orange'],
                ['icon' => '🍳', 'title' => __('home.svc_kitchen'), 'desc' => __('home.svc_kitchen_desc'), 'color' => 'purple'],
                ['icon' => '✨', 'title' => __('home.svc_wrap'), 'desc' => __('home.svc_wrap_desc'), 'color' => 'green'],
            ] as $s)
            <div class="bg-[#161a24] border border-white/5 rounded-xl p-6 sm:p-8 hover:border-orange-500/30 transition group">
                <div class="w-12 h-12 sm:w-14 sm:h-14 rounded-lg bg-{{ $s['color'] }}-500/20 flex items-center justify-center text-xl sm:text-2xl mb-4 sm:mb-6 group-hover:scale-110 transition">{{ $s['icon'] }}</div>
                <h3 class="text-lg sm:text-xl font-bold text-white mb-2 sm:mb-3">{{ $s['title'] }}</h3>
                <p class="text-gray-400 text-xs sm:text-sm leading-relaxed">{{ $s['desc'] }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- Projects --}}
<section id="projects" class="py-16 sm:py-24 px-4 sm:px-6 bg-[#0a0c14]">
    <div class="max-w-7xl mx-auto">
        <div class="text-center mb-10 sm:mb-16">
            <span class="inline-block text-orange-500 font-semibold text-xs sm:text-sm tracking-widest uppercase mb-2">{{ __('home.projects_label') }}</span>
            <h2 class="text-2xl sm:text-3xl md:text-4xl font-bold text-white mb-4">{{ __('home.projects_title') }}</h2>
            <div class="w-16 h-1 bg-orange-500 mx-auto mb-4 sm:mb-6"></div>
            <p class="text-gray-400 max-w-2xl mx-auto text-sm sm:text-base">{{ __('home.projects_desc') }}</p>
        </div>
        <div class="flex justify-center gap-2 sm:gap-3 mb-8 sm:mb-12 flex-wrap">
            <button class="projects-filter px-4 sm:px-6 py-2 rounded-lg bg-orange-500 text-white font-medium text-sm" data-category="all">{{ __('home.filter_all') }}</button>
            <button class="projects-filter px-4 sm:px-6 py-2 rounded-lg bg-[#161a24] text-gray-400 hover:text-white border border-white/5 text-sm" data-category="food_truck">{{ __('site.food_truck') }}</button>
            <button class="projects-filter px-4 sm:px-6 py-2 rounded-lg bg-[#161a24] text-gray-400 hover:text-white border border-white/5 text-sm" data-category="mobile_kitchen">{{ __('site.mobile_kitchen') }}</button>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 projects-grid">
            @forelse($projects as $project)
            @php
                $allImages = collect([$project->image_url])->merge($project->sliderImages->map(fn($i) => $i->image_url))->values()->all();
            @endphp
            <div class="project-item rounded-xl overflow-hidden bg-[#161a24] border border-white/5" data-category="{{ $project->category }}">
                <div class="project-card cursor-pointer aspect-[4/3] relative group"
                    data-images='@json($allImages)'
                    data-title="{{ e($project->t('title')) }}">
                    <img src="{{ $project->image_url }}" alt="{{ $project->t('title') }}" class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-105" loading="lazy">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent"></div>
                    <div class="absolute bottom-0 left-0 right-0 p-5">
                        <span class="inline-block px-2 py-0.5 rounded text-xs font-medium {{ $project->category === 'food_truck' ? 'bg-orange-500/80' : 'bg-teal-500/80' }} text-white mb-2">
                            {{ $project->category === 'food_truck' ? __('site.food_truck') : __('site.mobile_kitchen') }}
                        </span>
                        <h3 class="font-bold text-white text-lg">{{ $project->t('title') }}</h3>
                        @if($project->t('short_description'))
                        <p class="text-gray-300 text-sm mt-1">{{ Str::limit($project->t('short_description'), 60) }}</p>
                        @endif
                    </div>
                </div>
            </div>
            @empty
            @php
                $fallbacks = [
                    ['url' => 'https://images.unsplash.com/photo-1556742049-0cfed4f6a45d?w=800', 'title' => __('site.food_truck'), 'cat' => 'food_truck'],
                    ['url' => 'https://images.unsplash.com/photo-1527529482837-4698179dc6ce?w=800', 'title' => __('site.mobile_kitchen'), 'cat' => 'mobile_kitchen'],
                ];
            @endphp
            @foreach($fallbacks as $fb)
            <div class="project-item rounded-xl overflow-hidden bg-[#161a24] border border-white/5" data-category="{{ $fb['cat'] }}">
                <div class="project-card cursor-pointer aspect-[4/3] relative group"
                    data-images='@json([$fb["url"]])'
                    data-title="{{ $fb['title'] }}">
                    <img src="{{ $fb['url'] }}" alt="{{ $fb['title'] }}" class="w-full h-full object-cover" loading="lazy">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent"></div>
                    <div class="absolute bottom-0 left-0 right-0 p-5">
                        <span class="inline-block px-2 py-0.5 rounded text-xs font-medium {{ $fb['cat'] === 'food_truck' ? 'bg-orange-500/80' : 'bg-teal-500/80' }} text-white mb-2">
                            {{ $fb['cat'] === 'food_truck' ? __('site.food_truck') : __('site.mobile_kitchen') }}
                        </span>
                        <h3 class="font-bold text-white text-lg">{{ $fb['title'] }}</h3>
                    </div>
                </div>
            </div>
            @endforeach
            @endforelse
        </div>
    </div>
</section>

{{-- Lightbox --}}
<div id="lightbox" class="lightbox" aria-hidden="true">
    <div class="lightbox-overlay" data-close></div>
    <div class="lightbox-content">
        <img id="lightbox-img" src="" alt="" class="lightbox-img">
        <button type="button" id="lightbox-prev" class="lightbox-nav lightbox-prev-btn" aria-label="{{ __('site.previous') }}">&lsaquo;</button>
        <button type="button" id="lightbox-next" class="lightbox-nav lightbox-next-btn" aria-label="{{ __('site.next') }}">&rsaquo;</button>
        <div class="lightbox-footer">
            <span id="lightbox-counter" class="text-gray-400 text-sm"></span>
            <h3 id="lightbox-title" class="text-white font-semibold"></h3>
            <button type="button" class="lightbox-close-btn" data-close>{{ __('site.close') }}</button>
        </div>
    </div>
</div>

{{-- Testimonials --}}
<section id="testimonials" class="py-16 sm:py-24 px-4 sm:px-6 relative overflow-hidden">
    <div class="absolute inset-0 bg-cover bg-center blur-md brightness-[0.2]" style="background-image: url('https://images.unsplash.com/photo-1556742049-0cfed4f6a45d?w=1920');"></div>
    <div class="relative z-10 max-w-7xl mx-auto">
        <div class="text-center mb-10 sm:mb-16">
            <span class="inline-block text-orange-500 font-semibold text-xs sm:text-sm tracking-widest uppercase mb-2">{{ __('home.testimonials_label') }}</span>
            <h2 class="text-2xl sm:text-3xl md:text-4xl font-bold text-white mb-4">{{ __('home.testimonials_title') }}</h2>
            <div class="w-16 h-1 bg-orange-500 mx-auto mb-6"></div>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 sm:gap-8">
            @forelse($testimonials as $t)
            <div class="bg-white/10 backdrop-blur-sm border border-white/10 rounded-xl p-5 sm:p-8">
                <p class="text-gray-300 mb-6 italic">"{{ $t->t('quote') }}"</p>
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 rounded-full bg-orange-500/30 flex items-center justify-center text-white font-bold">{{ Str::limit($t->author_name, 1, '') }}</div>
                    <div>
                        <p class="font-semibold text-white">{{ $t->author_name }}</p>
                        <p class="text-gray-400 text-sm">{{ $t->t('author_title') ?? '' }}</p>
                    </div>
                </div>
                <div class="flex gap-1 mt-4 text-orange-500">{{ str_repeat('★', $t->rating) }}{{ str_repeat('☆', 5 - $t->rating) }}</div>
            </div>
            @empty
            <div class="bg-white/10 backdrop-blur-sm border border-white/10 rounded-xl p-5 sm:p-8">
                <p class="text-gray-300 mb-6 italic">"{{ __('home.testimonial_fallback_1') }}"</p>
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 rounded-full bg-orange-500/30 flex items-center justify-center text-white font-bold">S</div>
                    <div><p class="font-semibold text-white">{{ __('home.testimonial_fallback_1_name') }}</p><p class="text-gray-400 text-sm">{{ __('home.testimonial_fallback_1_title') }}</p></div>
                </div>
                <div class="flex gap-1 mt-4 text-orange-500">★★★★★</div>
            </div>
            <div class="bg-white/10 backdrop-blur-sm border border-white/10 rounded-xl p-5 sm:p-8">
                <p class="text-gray-300 mb-6 italic">"{{ __('home.testimonial_fallback_2') }}"</p>
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 rounded-full bg-orange-500/30 flex items-center justify-center text-white font-bold">J</div>
                    <div><p class="font-semibold text-white">{{ __('home.testimonial_fallback_2_name') }}</p><p class="text-gray-400 text-sm">{{ __('home.testimonial_fallback_2_title') }}</p></div>
                </div>
                <div class="flex gap-1 mt-4 text-orange-500">★★★★★</div>
            </div>
            @endforelse
        </div>
    </div>
</section>

{{-- CTA --}}
<section class="py-16 sm:py-24 px-4 sm:px-6 relative overflow-hidden">
    <div class="absolute inset-0 bg-cover bg-center brightness-[0.25]" style="background-image: url('https://images.unsplash.com/photo-1565123409695-7b5ef63a2efb?w=1920');"></div>
    <div class="relative z-10 max-w-7xl mx-auto text-center">
        <span class="inline-block text-orange-500 font-semibold text-xs sm:text-sm tracking-widest uppercase mb-2">{{ __('home.cta_label') }}</span>
        <h2 class="text-2xl sm:text-3xl md:text-4xl font-bold text-white mb-4">{{ __('home.cta_title') }}</h2>
        <p class="text-gray-400 max-w-2xl mx-auto mb-6 sm:mb-8 text-sm sm:text-base">{{ __('home.cta_desc') }}</p>
        <div class="inline-block bg-orange-500 px-8 sm:px-12 py-5 sm:py-6 rounded-xl">
            <p class="text-3xl sm:text-4xl font-bold text-white">{{ __('home.cta_weeks') }}</p>
            <p class="text-orange-100 text-xs sm:text-sm">{{ __('home.cta_weeks_sub') }}</p>
        </div>
    </div>
</section>

{{-- FAQ --}}
<section id="faq" class="py-16 sm:py-24 px-4 sm:px-6 bg-[#0a0c14]">
    <div class="max-w-3xl mx-auto">
        <div class="text-center mb-10 sm:mb-16">
            <span class="inline-block text-orange-500 font-semibold text-xs sm:text-sm tracking-widest uppercase mb-2">{{ __('home.faq_label') }}</span>
            <h2 class="text-2xl sm:text-3xl md:text-4xl font-bold text-white mb-4">{{ __('home.faq_title') }}</h2>
            <div class="w-16 h-1 bg-orange-500 mx-auto mb-6"></div>
        </div>
        <div class="space-y-2">
            @foreach([
                ['q' => __('home.faq_q1'), 'a' => __('home.faq_a1')],
                ['q' => __('home.faq_q2'), 'a' => __('home.faq_a2')],
                ['q' => __('home.faq_q3'), 'a' => __('home.faq_a3')],
                ['q' => __('home.faq_q4'), 'a' => __('home.faq_a4')],
                ['q' => __('home.faq_q5'), 'a' => __('home.faq_a5')],
            ] as $faq)
            <details class="group bg-[#161a24] border border-white/5 rounded-lg overflow-hidden">
                <summary class="flex items-center justify-between p-4 sm:p-6 cursor-pointer list-none text-white font-medium text-sm sm:text-base hover:bg-white/5 transition">
                    <span class="pr-4">{{ $faq['q'] }}</span>
                    <span class="text-gray-400 group-open:rotate-180 transition flex-shrink-0">▼</span>
                </summary>
                <div class="px-4 sm:px-6 pb-4 sm:pb-6 text-gray-400 text-xs sm:text-sm"><p>{{ $faq['a'] }}</p></div>
            </details>
            @endforeach
        </div>
    </div>
</section>

{{-- Contact --}}
<section id="contact" class="py-16 sm:py-24 px-4 sm:px-6">
    <div class="max-w-7xl mx-auto">
        <div class="text-center mb-10 sm:mb-16">
            <span class="inline-block text-orange-500 font-semibold text-xs sm:text-sm tracking-widest uppercase mb-2">{{ __('home.contact_label') }}</span>
            <h2 class="text-2xl sm:text-3xl md:text-4xl font-bold text-white mb-4">{{ __('home.contact_title') }}</h2>
            <div class="w-16 h-1 bg-orange-500 mx-auto mb-6"></div>
        </div>
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 sm:gap-12">
            <div class="bg-[#161a24] border border-white/5 rounded-xl p-5 sm:p-8 space-y-5 sm:space-y-6">
                <div class="flex items-start gap-4">
                    <span class="text-2xl">📞</span>
                    <div>
                        <p class="text-gray-400 text-sm">{{ __('home.contact_phone') }}</p>
                        <a href="tel:+17133576408" class="text-white font-medium hover:text-orange-400 transition">+1 (713) 357-6408</a>
                    </div>
                </div>
                <div class="flex items-start gap-4">
                    <span class="text-2xl">💬</span>
                    <div>
                        <p class="text-gray-400 text-sm">WhatsApp</p>
                        <a href="https://wa.me/12816833196" target="_blank" class="text-white font-medium hover:text-green-400 transition">+1 (281) 683-3196</a>
                    </div>
                </div>
                <div class="flex items-start gap-4">
                    <span class="text-2xl">✉️</span>
                    <div>
                        <p class="text-gray-400 text-sm">{{ __('home.contact_email') }}</p>
                        <a href="mailto:contacto@mobilkitchenpro.com" class="text-white font-medium hover:text-orange-400 transition">contacto@mobilkitchenpro.com</a>
                    </div>
                </div>
                <div class="flex items-start gap-4">
                    <span class="text-2xl">📍</span>
                    <div>
                        <p class="text-gray-400 text-sm">{{ __('home.contact_location') }}</p>
                        <p class="text-white font-medium">130 Mitchell Rd Unit B8</p>
                        <p class="text-white font-medium">Houston TX 77037</p>
                    </div>
                </div>
                <div class="flex items-start gap-4">
                    <span class="text-2xl">🔗</span>
                    <div>
                        <p class="text-gray-400 text-sm mb-2">{{ __('home.contact_social') }}</p>
                        @if(isset($socialLinks) && $socialLinks->count())
                        <div class="flex flex-wrap gap-4">
                            @foreach($socialLinks as $link)
                            <a href="{{ $link->url }}" target="_blank" class="text-gray-500 hover:text-orange-500 transition">{{ $link->platform }}</a>
                            @endforeach
                        </div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="bg-[#161a24] border border-white/5 rounded-xl p-5 sm:p-8">
                @if(session('success'))
                <div class="mb-6 p-4 bg-green-500/20 border border-green-500/50 rounded-lg text-green-400 text-sm">{{ __('home.contact_success') }}</div>
                @endif
                @if($errors->any())
                <div class="mb-6 p-4 bg-red-500/20 border border-red-500/50 rounded-lg text-red-400 text-sm">
                    <ul class="list-disc list-inside">@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
                </div>
                @endif
                <form action="{{ route('contact.store') }}" method="POST" class="space-y-6">
                    @csrf
                    <div>
                        <label class="block text-gray-400 text-sm mb-2">{{ __('home.contact_name') }}</label>
                        <input type="text" name="name" value="{{ old('name') }}" class="w-full bg-[#0f1119] border border-white/10 rounded-lg px-4 py-3 text-white focus:border-orange-500 outline-none transition" required>
                    </div>
                    <div>
                        <label class="block text-gray-400 text-sm mb-2">{{ __('home.contact_email') }}</label>
                        <input type="email" name="email" value="{{ old('email') }}" class="w-full bg-[#0f1119] border border-white/10 rounded-lg px-4 py-3 text-white focus:border-orange-500 outline-none transition" required>
                    </div>
                    <div>
                        <label class="block text-gray-400 text-sm mb-2">{{ __('home.contact_phone') }}</label>
                        <input type="tel" name="phone" value="{{ old('phone') }}" class="w-full bg-[#0f1119] border border-white/10 rounded-lg px-4 py-3 text-white focus:border-orange-500 outline-none transition" required>
                    </div>
                    <div>
                        <label class="block text-gray-400 text-sm mb-2">{{ __('home.contact_message') }}</label>
                        <textarea name="message" rows="4" class="w-full bg-[#0f1119] border border-white/10 rounded-lg px-4 py-3 text-white focus:border-orange-500 outline-none transition resize-none">{{ old('message') }}</textarea>
                    </div>
                    <button type="submit" class="w-full bg-orange-500 hover:bg-orange-600 text-white px-6 py-4 rounded-lg font-semibold transition">{{ __('site.send_message') }}</button>
                </form>
            </div>
        </div>
    </div>
</section>

@endsection
