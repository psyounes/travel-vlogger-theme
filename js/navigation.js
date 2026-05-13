(function() {
    const nav = document.querySelector('.main-navigation');
    const toggle = document.querySelector('.menu-toggle');

    if (!nav || !toggle) return;

    nav.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            toggle.classList.remove('active');
            nav.classList.remove('active');
            toggle.focus();
        }
    });

    document.addEventListener('click', function(e) {
        if (!nav.contains(e.target) && !toggle.contains(e.target)) {
            toggle.classList.remove('active');
            nav.classList.remove('active');
        }
    });

    let lastWidth = window.innerWidth;
    window.addEventListener('resize', function() {
        if (lastWidth <= 768 && window.innerWidth > 768) {
            toggle.classList.remove('active');
            nav.classList.remove('active');
        }
        lastWidth = window.innerWidth;
    });
})();
