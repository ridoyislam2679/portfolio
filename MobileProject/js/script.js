// Image slider functionality
function changeImage(element) {
	const mainImg = document.getElementById('mainImage').querySelector('img');
	mainImg.src = element.src;
	
	// Modal image পরিবর্তন
    const modalImg = document.getElementById('modalImage');
    modalImg.src = element.src;
	
	// Update active thumbnail
	document.querySelectorAll('.thumbnail').forEach(thumb => {
		thumb.style.borderColor = '#ddd';
	});
	element.style.borderColor = '#0d6efd';
}

// Animate rating bars on page load
document.addEventListener('DOMContentLoaded', function() {
	const ratingBars = document.querySelectorAll('.rating-fill');
	ratingBars.forEach(bar => {
		const width = bar.getAttribute('data-width');
		setTimeout(() => {
			bar.style.width = width;
		}, 100);
	});
});