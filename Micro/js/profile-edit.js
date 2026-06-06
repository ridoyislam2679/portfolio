document.addEventListener('DOMContentLoaded', function() {	
	// Cancel button
	document.querySelector('.btn-cancel').addEventListener('click', function() {
		if (confirm('Discard all changes?')) {
			window.location.href = 'profile-edit.php';
		}
	});
});