import './bootstrap';

// Header scroll effect
document.addEventListener('DOMContentLoaded', function() {
    const header = document.querySelector('header');
    const headerSpacer = document.getElementById('header-spacer');
    const logo = header?.querySelector('a[href*="home"]');
    const mainNav = header?.querySelector('nav[aria-label="منوی اصلی"]');
    
    if (!header) return;
    
    // Calculate initial header height once
    const initialHeaderHeight = header.offsetHeight;
    
    if (headerSpacer) {
        headerSpacer.style.height = initialHeaderHeight + 'px';
        headerSpacer.style.minHeight = initialHeaderHeight + 'px';
    }
    
    let ticking = false;
    
    function updateHeader() {
        const currentScroll = window.pageYOffset || document.documentElement.scrollTop;
        
        if (currentScroll > 50) {
            if (!header.classList.contains('scrolled')) {
                header.classList.add('scrolled');
                if (logo) logo.classList.add('scrolled');
                if (mainNav) mainNav.classList.add('scrolled');
                // Don't change spacer height when scrolling - keep it stable
            }
        } else {
            if (header.classList.contains('scrolled')) {
                header.classList.remove('scrolled');
                if (logo) logo.classList.remove('scrolled');
                if (mainNav) mainNav.classList.remove('scrolled');
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
    
    // Update spacer on resize - only update if header actually changed height
    let lastHeaderHeight = initialHeaderHeight;
    window.addEventListener('resize', function() {
        const newHeight = header.offsetHeight;
        if (Math.abs(newHeight - lastHeaderHeight) > 5) { // Only update if significant change
            if (headerSpacer) {
                headerSpacer.style.height = newHeight + 'px';
                headerSpacer.style.minHeight = newHeight + 'px';
            }
            lastHeaderHeight = newHeight;
        }
    }, { passive: true });
    
    // Initial check
    updateHeader();
});

// Font loading detection
document.fonts.ready.then(function() {
    document.documentElement.classList.add('fonts-loaded');
});

// Fallback for browsers that don't support font loading API
setTimeout(function() {
    if (document.fonts && document.fonts.check('1em Vazirmatn')) {
        document.documentElement.classList.add('fonts-loaded');
    }
}, 3000);

// Mobile categories menu toggle
document.addEventListener('DOMContentLoaded', function() {
    const toggle = document.getElementById('mobile-categories-toggle');
    const menu = document.getElementById('mobile-categories-menu');
    const arrow = document.getElementById('mobile-categories-arrow');
    
    if (toggle && menu && arrow) {
        toggle.addEventListener('click', function() {
            const isExpanded = toggle.getAttribute('aria-expanded') === 'true';
            
            if (isExpanded) {
                // Close menu
                menu.style.maxHeight = '0';
                menu.style.opacity = '0';
                arrow.style.transform = 'rotate(0deg)';
                toggle.setAttribute('aria-expanded', 'false');
            } else {
                // Open menu
                const scrollHeight = menu.scrollHeight;
                menu.style.maxHeight = scrollHeight + 'px';
                menu.style.opacity = '1';
                arrow.style.transform = 'rotate(180deg)';
                toggle.setAttribute('aria-expanded', 'true');
            }
        });
    }
});
