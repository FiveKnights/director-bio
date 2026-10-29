// Fade-and-rise elements marked with data-reveal, once, when they first scroll into view.
export function initReveal() {
    const items = document.querySelectorAll('[data-reveal]');
    if (!items.length) return;

    // No observer support, or the visitor prefers reduced motion: leave everything visible
    if (!('IntersectionObserver' in window) || window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
        return;
    }

    const observer = new IntersectionObserver((entries) => {
        entries.forEach((entry) => {
            if (!entry.isIntersecting) return;

            entry.target.classList.add('is-visible');
            observer.unobserve(entry.target); // once only
        });
    }, { threshold: 0.15, rootMargin: '0px 0px -40px 0px' });

    items.forEach((el) => {
        el.classList.add('reveal');
        observer.observe(el);
    });
}