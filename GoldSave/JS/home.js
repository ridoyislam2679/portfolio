(function() {
	const slides = document.querySelectorAll('.slide');
	const dots = document.querySelectorAll('.dot');
	const prevBtn = document.getElementById('prevSlide');
	const nextBtn = document.getElementById('nextSlide');
	let currentIndex = 0;
	const totalSlides = slides.length;
	let autoInterval;
	
	function showSlide(index) {
		slides.forEach(slide => slide.classList.remove('active'));
		dots.forEach(dot => dot.classList.remove('active'));
		
		if (index < 0) index = totalSlides - 1;
		if (index >= totalSlides) index = 0;
		currentIndex = index;
		
		slides[currentIndex].classList.add('active');
		dots[currentIndex].classList.add('active');
	}
	
	function nextSlide() { showSlide(currentIndex + 1); }
	function prevSlide() { showSlide(currentIndex - 1); }
	
	function startAutoSlide() {
		if (autoInterval) clearInterval(autoInterval);
		autoInterval = setInterval(nextSlide, 5000);
	}
	
	function stopAutoSlide() {
		if (autoInterval) clearInterval(autoInterval);
	}
	
	if (prevBtn) prevBtn.addEventListener('click', () => { stopAutoSlide(); prevSlide(); startAutoSlide(); });
	if (nextBtn) nextBtn.addEventListener('click', () => { stopAutoSlide(); nextSlide(); startAutoSlide(); });
	
	dots.forEach((dot, idx) => {
		dot.addEventListener('click', () => { stopAutoSlide(); showSlide(idx); startAutoSlide(); });
	});
	
	// Touch events for mobile
	const sliderContainer = document.querySelector('.shape-card');
	let touchStartX = 0;
	let touchEndX = 0;
	
	if (sliderContainer) {
		sliderContainer.addEventListener('touchstart', (e) => {
			touchStartX = e.changedTouches[0].screenX;
			stopAutoSlide();
		});
		
		sliderContainer.addEventListener('touchend', (e) => {
			touchEndX = e.changedTouches[0].screenX;
			if (touchEndX < touchStartX - 50) nextSlide();
			if (touchEndX > touchStartX + 50) prevSlide();
			startAutoSlide();
		});
	}
	
	startAutoSlide();
})();