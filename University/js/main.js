document.addEventListener('DOMContentLoaded', function () {
    console.log('JS file is running');

    // ====== Slider ======
    const slides = document.querySelectorAll('.slide');
    const dotsContainer = document.querySelector('.slider-dots');
    let currentSlide = 0;

    if (slides.length > 0 && dotsContainer) {
        slides.forEach((_, index) => {
            const dot = document.createElement('div');
            dot.classList.add('dot');
            if (index === 0) dot.classList.add('active');
            dot.addEventListener('click', () => goToSlide(index));
            dotsContainer.appendChild(dot);
        });

        const dots = document.querySelectorAll('.dot');

        document.querySelector('.next-slide')?.addEventListener('click', nextSlide);
        document.querySelector('.prev-slide')?.addEventListener('click', prevSlide);

        let slideInterval = setInterval(nextSlide, 5000);

        function goToSlide(index) {
            slides[currentSlide].classList.remove('active');
            dots[currentSlide].classList.remove('active');
            currentSlide = (index + slides.length) % slides.length;
            slides[currentSlide].classList.add('active');
            dots[currentSlide].classList.add('active');
            resetInterval();
        }

        function nextSlide() {
            goToSlide(currentSlide + 1);
        }

        function prevSlide() {
            goToSlide(currentSlide - 1);
        }

        function resetInterval() {
            clearInterval(slideInterval);
            slideInterval = setInterval(nextSlide, 5000);
        }
    }

    // ====== Counter Animation ======
    const counters = document.querySelectorAll('.counter');
    const speed = 3000;

    function animateCounters() {
        counters.forEach(counter => {
            const target = +counter.getAttribute('data-target');
            const count = +counter.innerText;
            const increment = target / speed;

            if (count < target) {
                counter.innerText = Math.ceil(count + increment);
                setTimeout(animateCounters, 10); // slightly slower, smoother
            } else {
                counter.innerText = target;
            }
        });
    }

    const statsSection = document.querySelector('.university-stats');
    if (statsSection) {
        const observer = new IntersectionObserver((entries) => {
            if (entries[0].isIntersecting) {
                animateCounters();
                observer.unobserve(statsSection);
            }
        }, { threshold: 0.5 });

        observer.observe(statsSection);
    }

    // ====== Mobile Menu Toggle ======
    const mobileMenuBtn = document.querySelector('.mobile-menu-btn');
    const navLinks = document.querySelector('.nav-links');

    if (mobileMenuBtn && navLinks) {
        console.log('Elements found');
        mobileMenuBtn.addEventListener('click', () => {
            navLinks.classList.toggle('active');
        });
    } else {
        console.warn('Menu button or nav-links not found');
    }
});
