// Product image slider functionality
function changeImage(element) {
	document.getElementById('main-image').src = element.src;
	
	// Remove active class from all thumbnails
	var thumbnails = document.getElementsByClassName('thumbnail');
	for (var i = 0; i < thumbnails.length; i++) {
		thumbnails[i].classList.remove('active');
	}
	
	// Add active class to clicked thumbnail
	element.classList.add('active');
}

/*
// Order Modal Functionality
document.addEventListener('DOMContentLoaded', function() {
	const orderModal = document.getElementById('orderModal');
	
	// Quantity control functionality
	document.getElementById('increase-qty').addEventListener('click', function() {
		const quantityInput = document.getElementById('quantity');
		quantityInput.value = parseInt(quantityInput.value) + 1;
		updateOrderSummary();
	});
	
	document.getElementById('decrease-qty').addEventListener('click', function() {
		const quantityInput = document.getElementById('quantity');
		if (parseInt(quantityInput.value) > 1) {
			quantityInput.value = parseInt(quantityInput.value) - 1;
			updateOrderSummary();
		}
	});
	
	document.getElementById('quantity').addEventListener('change', function() {
		if (parseInt(this.value) < 1) this.value = 1;
		updateOrderSummary();
	});
	
	// Payment method selection
	document.querySelectorAll('.payment-card').forEach(card => {
		card.addEventListener('click', function() {
			document.querySelectorAll('.payment-card').forEach(c => c.classList.remove('selected'));
			this.classList.add('selected');
			const radioInput = this.querySelector('input[type="radio"]');
			radioInput.checked = true;
		});
	});
	
	// Update order summary
	function updateOrderSummary() {
		const quantity = parseInt(document.getElementById('quantity').value);
		const productPrice = 350;
		const deliveryCharge = 50;
		
		const productAmount = quantity * productPrice;
		const totalAmount = productAmount + deliveryCharge;
		
		document.getElementById('product-amount').textContent = productAmount + ' টাকা';
		document.getElementById('total-amount').textContent = totalAmount + ' টাকা';
		
		// JSON format for PHP processing
		const orderData = {
			product_id: 101,
			product_name: "খেজুর গুড় (প্রিমিয়াম কোয়ালিটি)",
			quantity: quantity,
			unit_price: productPrice,
			delivery_charge: deliveryCharge,
			total_amount: totalAmount,
			payment_method: document.querySelector('input[name="paymentMethod"]:checked').value
		};
		
		console.log("JSON Data for PHP:", JSON.stringify(orderData));
	}
	
	// Initialize order summary
	updateOrderSummary();
	
});

/*
// Product data for different categories
const products = {
	'খেজুর-গুড়': [
		{ id: 1, name: 'খেজুর গুড় (প্রিমিয়াম কোয়ালিটি)', price: '৩৫০', oldPrice: '৪০০', image: 'https://images.unsplash.com/photo-1578985544336-5f5d445d2f8e?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80' },
		{ id: 2, name: 'খেজুর গুড় (স্ট্যান্ডার্ড কোয়ালিটি)', price: '২৮০', oldPrice: '৩২০', image: 'https://images.unsplash.com/photo-1594201279943-9d33bfb40b5f?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80' },
		{ id: 3, name: 'খেজুর গুড় (অর্গানিক)', price: '৪২০', oldPrice: '৫০০', image: 'https://images.unsplash.com/photo-1592486058516-0a72d7717c6b?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80' },
		{ id: 4, name: 'খেজুর গুড় (বিশেষ edition)', price: '৩৮০', oldPrice: '৪৫০', image: 'https://images.unsplash.com/photo-1600271886742-f049cd451bba?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80' }
	],
	'আকর-গুড়': [
		{ id: 5, name: 'আকর গুড় (প্রিমিয়াম কোয়ালিটি)', price: '৩০০', oldPrice: '৩৫০', image: 'https://images.unsplash.com/photo-1600271886742-f049cd451bba?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80' },
		{ id: 6, name: 'আকর গুড় (স্ট্যান্ডার্ড কোয়ালিটি)', price: '২৫০', oldPrice: '২৮০', image: 'https://images.unsplash.com/photo-1598033129183-c4f50c736f10?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80' }
	],
	'নাটোরের-কাচা-গুড়': [
		{ id: 7, name: 'নাটোরের কাচা গুড় (ফ্রেশ)', price: '২৮০', oldPrice: '৩২০', image: 'https://images.unsplash.com/photo-1598033129183-c4f50c736f10?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80' },
		{ id: 8, name: 'নাটোরের কাচা গুড় (বিশেষ)', price: '৩২০', oldPrice: '৩৮০', image: 'https://images.unsplash.com/photo-1550258987-190a2d41a8ba?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80' }
	],
	'আম': [
		{ id: 9, name: 'তাজা আম (হিমসাগর)', price: '২০০', oldPrice: '২৪০', image: 'https://images.unsplash.com/photo-1550258987-190a2d41a8ba?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80' },
		{ id: 10, name: 'তাজা আম (ল্যাংড়া)', price: '২২০', oldPrice: '২৬০', image: 'https://images.unsplash.com/photo-1595154352637-4dfb41b7f1d0?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80' },
		{ id: 11, name: 'তাজা আম (ফজলি)', price: '২৫০', oldPrice: '৩০০', image: 'https://images.unsplash.com/photo-1594633312681-425c7b97ccd1?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80' }
	],
	'ড্রাগন': [
		{ id: 12, name: 'ড্রাগন ফল (লাল)', price: '২৫০', oldPrice: '৩০০', image: 'https://images.unsplash.com/photo-1595154352637-4dfb41b7f1d0?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80' },
		{ id: 13, name: 'ড্রাগন ফল (সাদা)', price: '২২০', oldPrice: '২৮০', image: 'https://images.unsplash.com/photo-1592486058516-0a72d7717c6b?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80' }
	],
	'পেয়ারা': [
		{ id: 14, name: 'পেয়ারা (তাজা)', price: '১৫০', oldPrice: '১৮০', image: 'https://images.unsplash.com/photo-1594633312681-425c7b97ccd1?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80' },
		{ id: 15, name: 'পেয়ারা (অর্গানিক)', price: '২০০', oldPrice: '২৪০', image: 'https://images.unsplash.com/photo-1578911372310-9c9a78892b59?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80' }
	],
	'বরই': [
		{ id: 16, name: 'বরই (তাজা)', price: '১৮০', oldPrice: '২০০', image: 'https://images.unsplash.com/photo-1592486058516-0a72d7717c6b?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80' },
		{ id: 17, name: 'বরই (শুকনো)', price: '২২০', oldPrice: '২৬০', image: 'https://images.unsplash.com/photo-1589985270826-4b7fe135a9c4?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80' }
	]
};

// Function to get URL parameters
function getUrlParameter(name) {
	name = name.replace(/[\[]/, '\\[').replace(/[\]]/, '\\]');
	const regex = new RegExp('[?&]' + name + '(=([^&#]*)|&|#|$)');
	const results = regex.exec(window.location.search);
	if (!results) return null;
	if (!results[2]) return '';
	return decodeURIComponent(results[2].replace(/\+/g, ' '));
}

// Function to load products based on category
function loadProductsByCategory() {
	const category = getUrlParameter('category') || 'all';
	const productsContainer = document.getElementById('products-container');
	const categoryTitle = document.getElementById('category-title');
	const breadcrumbCategory = document.getElementById('breadcrumb-category');
	const productsTitle = document.getElementById('products-title');
	
	// Update page titles
	if (category !== 'all') {
		categoryTitle.textContent = category.replace(/-/g, ' ');
		breadcrumbCategory.textContent = category.replace(/-/g, ' ');
		productsTitle.textContent = category.replace(/-/g, ' ') + ' পণ্য';
		
		// Activate the current category button
		document.querySelectorAll('.category-btn').forEach(btn => {
			if (btn.getAttribute('data-category') === category) {
				btn.classList.add('active');
			} else {
				btn.classList.remove('active');
			}
		});
	}
	
	// Clear products container
	productsContainer.innerHTML = '';
	
	// Get products to display
	let productsToDisplay = [];
	if (category === 'all') {
		// Show all products from all categories
		for (const cat in products) {
			productsToDisplay = productsToDisplay.concat(products[cat]);
		}
	} else if (products[category]) {
		productsToDisplay = products[category];
	} else {
		productsToDisplay = [];
	}
	
	// Display products
	if (productsToDisplay.length > 0) {
		productsToDisplay.forEach(product => {
			const productCard = `
				<div class="col-lg-3 col-md-4 col-6 mb-4">
					<div class="product-card card h-100">
						<img src="${product.image}" class="product-img card-img-top" alt="${product.name}">
						<div class="card-body">
							<h5 class="product-title">${product.name}</h5>
							<div class="d-flex align-items-center">
								<span class="product-price">${product.price} টাকা</span>
								${product.oldPrice ? `<span class="product-old-price">${product.oldPrice} টাকা</span>` : ''}
							</div>
							<button class="add-to-cart" onclick="window.location.href='product-details.html?id=${product.id}'">কার্টে যোগ করুন</button>
						</div>
					</div>
				</div>
			`;
			productsContainer.innerHTML += productCard;
		});
	} else {
		productsContainer.innerHTML = `
			<div class="col-12 text-center py-5">
				<i class="fas fa-box-open fa-3x mb-3 text-muted"></i>
				<h4 class="text-muted">এই ক্যাটেগরিতে কোনো পণ্য পাওয়া যায়নি</h4>
				<p>অন্যান্য ক্যাটেগরি থেকে পণ্য ব্রাউজ করুন</p>
			</div>
		`;
	}
}

// Load products when page loads
document.addEventListener('DOMContentLoaded', function() {
	loadProductsByCategory();
});

*/