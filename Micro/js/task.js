// Filter tasks functionality
document.addEventListener('DOMContentLoaded', function() {
	const filterButtons = document.querySelectorAll('.filter-btn');
	const taskItems = document.querySelectorAll('.task-item');
	
	filterButtons.forEach(button => {
		button.addEventListener('click', function() {
			// Remove active class from all buttons
			filterButtons.forEach(btn => btn.classList.remove('active'));
			// Add active class to clicked button
			this.classList.add('active');
			
			const filterValue = this.getAttribute('data-filter');
			
			// Show/hide tasks based on filter
			taskItems.forEach(item => {
				if (filterValue === 'all' || item.getAttribute('data-category') === filterValue) {
					item.style.display = 'block';
				} else {
					item.style.display = 'none';
				}
			});
		});
	});
});
