// Lazy load the map when it comes into view
    document.addEventListener('DOMContentLoaded', function () {
        const mapFrame = document.querySelector('iframe[data-src]');
        if (mapFrame) {
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        mapFrame.src = mapFrame.dataset.src;
                        observer.unobserve(mapFrame);
                    }
                });
            });
            observer.observe(mapFrame);
        }
    });