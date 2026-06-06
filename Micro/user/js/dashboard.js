// coppy reffer link
function copyReferralLink() {
	const link = document.getElementById('referralLink');
	link.select();
	document.execCommand('copy');
	
	var msg = document.getElementById("copyMsg");
    msg.style.display = "inline";
	setTimeout(function() {
        msg.style.display = "none";
    }, 2000);
	//alert('Referral link copied!');
}

// Market Chart Animation
const ctx = document.getElementById('marketChart').getContext('2d');

// Generate random data that goes up and down
function generateRandomData() {
	let data = [];
	let value = 100;
	
	for (let i = 0; i < 20; i++) {
		data.push(value);
		// Random change between -10 and 15
		value += Math.floor(Math.random() * 25) - 10;
		// Ensure value doesn't go below 50
		value = Math.max(50, value);
	}
	
	return data;
}

const chart = new Chart(ctx, {
	type: 'line',
	data: {
		labels: Array.from({length: 20}, (_, i) => `Day ${i+1}`),
		datasets: [{
			label: 'Coin Price',
			data: generateRandomData(),
			borderColor: '#00d8ff',
			backgroundColor: 'rgba(0, 216, 255, 0.1)',
			borderWidth: 2,
			tension: 0.4,
			fill: true
		}]
	},
	options: {
		responsive: true,
		maintainAspectRatio: false,
		plugins: {
			legend: {
				display: false
			}
		},
		scales: {
			y: {
				beginAtZero: false,
				grid: {
					color: 'rgba(255, 255, 255, 0.1)'
				},
				ticks: {
					color: '#94a3b8'
				}
			},
			x: {
				grid: {
					color: 'rgba(255, 255, 255, 0.1)'
				},
				ticks: {
					color: '#94a3b8'
				}
			}
		},
		animation: {
			duration: 2000,
			easing: 'easeInOutQuad'
		}
	}
});

// Animate chart every 3 seconds
setInterval(() => {
	chart.data.datasets[0].data = generateRandomData();
	chart.update();
}, 3000);


// Comment section 
function showReplyForm(commentId) {
	var form = document.getElementById('reply-form-' + commentId);
	form.style.display = form.style.display === 'block' ? 'none' : 'block';
}

function incrementLike(button) {
    // Find the like count element inside the button
    const likeCountElement = button.querySelector('.like-count');
    
    // Get current like count and increment it
    let currentLikes = parseInt(likeCountElement.textContent);
    currentLikes++;
    
    // Update the displayed count
    likeCountElement.textContent = currentLikes;
    
    // Optional: Disable button after clicking to prevent multiple likes
    button.disabled = true;
    
    // Optional: Change style after liking
    button.style.opacity = '0.7';
}