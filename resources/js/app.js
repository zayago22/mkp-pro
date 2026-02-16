import './bootstrap';
import Alpine from 'alpinejs';
window.Alpine = Alpine;
Alpine.start();

function initApp() {
    // Hero background slider
    var heroSlides = document.querySelectorAll('.hero-slide');
    if (heroSlides.length > 1) {
        var heroIdx = 0;
        setInterval(function () {
            heroSlides[heroIdx].classList.remove('active');
            heroIdx = (heroIdx + 1) % heroSlides.length;
            heroSlides[heroIdx].classList.add('active');
        }, 5000);
    }

    // Project filters
    document.querySelectorAll('.projects-filter').forEach(function (btn) {
        btn.addEventListener('click', function () {
            var cat = btn.dataset.category;
            document.querySelectorAll('.projects-filter').forEach(function (f) {
                f.classList.remove('bg-orange-500', 'text-white');
                f.classList.add('bg-[#161a24]', 'text-gray-400', 'border', 'border-white/5');
            });
            btn.classList.add('bg-orange-500', 'text-white');
            btn.classList.remove('bg-[#161a24]', 'text-gray-400', 'border', 'border-white/5');
            document.querySelectorAll('.project-item').forEach(function (p) {
                p.style.display = (cat === 'all' || p.dataset.category === cat) ? '' : 'none';
            });
        });
    });

    // Lightbox
    var lightbox = document.getElementById('lightbox');
    if (!lightbox) return;

    var lbImg = document.getElementById('lightbox-img');
    var lbTitle = document.getElementById('lightbox-title');
    var lbCounter = document.getElementById('lightbox-counter');
    var lbPrev = document.getElementById('lightbox-prev');
    var lbNext = document.getElementById('lightbox-next');
    var lbImages = [];
    var lbIdx = 0;

    function closeLightbox() {
        lightbox.classList.remove('is-open');
        lightbox.setAttribute('aria-hidden', 'true');
        document.body.style.overflow = '';
    }

    function showImage(i) {
        lbIdx = Math.max(0, Math.min(i, lbImages.length - 1));
        lbImg.src = lbImages[lbIdx];
        if (lbCounter) lbCounter.textContent = (lbIdx + 1) + ' / ' + lbImages.length;
        if (lbPrev) lbPrev.style.display = lbImages.length > 1 ? 'flex' : 'none';
        if (lbNext) lbNext.style.display = lbImages.length > 1 ? 'flex' : 'none';
    }

    function openLightbox(card) {
        var raw = card.getAttribute('data-images');
        if (!raw) return;

        try {
            lbImages = JSON.parse(raw);
        } catch (e) {
            return;
        }
        if (!lbImages || !lbImages.length) return;

        if (lbTitle) lbTitle.textContent = card.getAttribute('data-title') || '';

        showImage(0);
        lightbox.classList.add('is-open');
        lightbox.setAttribute('aria-hidden', 'false');
        document.body.style.overflow = 'hidden';
    }

    // Click on project card
    document.addEventListener('click', function (e) {
        var card = e.target.closest('.project-card');
        if (card) {
            e.preventDefault();
            e.stopPropagation();
            openLightbox(card);
            return;
        }

        // Close lightbox
        var closeEl = e.target.closest('[data-close]');
        if (closeEl && lightbox.classList.contains('is-open')) {
            closeLightbox();
            return;
        }
    });

    if (lbPrev) lbPrev.addEventListener('click', function (e) {
        e.stopPropagation();
        showImage(lbIdx - 1);
    });
    if (lbNext) lbNext.addEventListener('click', function (e) {
        e.stopPropagation();
        showImage(lbIdx + 1);
    });

    document.addEventListener('keydown', function (e) {
        if (!lightbox.classList.contains('is-open')) return;
        if (e.key === 'Escape') closeLightbox();
        if (e.key === 'ArrowLeft') showImage(lbIdx - 1);
        if (e.key === 'ArrowRight') showImage(lbIdx + 1);
    });
}

// Run when DOM is ready (handles both module and regular loading)
if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initApp);
} else {
    initApp();
}
