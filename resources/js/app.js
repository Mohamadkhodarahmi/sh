import './bootstrap';

// Header scroll effect
document.addEventListener('DOMContentLoaded', function() {
    const header = document.querySelector('header');
    const headerSpacer = document.getElementById('header-spacer');
    const logo = header?.querySelector('a[href*="home"]');
    const mainNav = header?.querySelector('nav[aria-label="منوی اصلی"]');
    
    if (!header) return;
    
    // Get initial header height
    const headerInitialHeight = header.offsetHeight;
    const headerScrolledHeight = 90; // Approximate scrolled height
    
    if (headerSpacer) {
        headerSpacer.style.height = headerInitialHeight + 'px';
    }
    
    let ticking = false;
    
    function updateHeader() {
        const currentScroll = window.pageYOffset || document.documentElement.scrollTop;
        
        if (currentScroll > 50) {
            if (!header.classList.contains('scrolled')) {
                header.classList.add('scrolled');
                if (logo) logo.classList.add('scrolled');
                if (mainNav) mainNav.classList.add('scrolled');
                if (headerSpacer) {
                    headerSpacer.style.height = headerScrolledHeight + 'px';
                }
            }
        } else {
            if (header.classList.contains('scrolled')) {
                header.classList.remove('scrolled');
                if (logo) logo.classList.remove('scrolled');
                if (mainNav) mainNav.classList.remove('scrolled');
                if (headerSpacer) {
                    headerSpacer.style.height = headerInitialHeight + 'px';
                }
            }
        }
        
        ticking = false;
    }
    
    window.addEventListener('scroll', function() {
        if (!ticking) {
            window.requestAnimationFrame(updateHeader);
            ticking = true;
        }
    }, { passive: true });
    
    // Update spacer on resize
    window.addEventListener('resize', function() {
        if (!header.classList.contains('scrolled')) {
            const newHeight = header.offsetHeight;
            if (headerSpacer) {
                headerSpacer.style.height = newHeight + 'px';
            }
        }
    }, { passive: true });
    
    // Initial check
    updateHeader();
});
