// ফোনের specification লোড করার function
function loadPhoneSpecs(phoneName, phoneNumber) {
    if(!phoneName || phoneName.trim() === '') {
        console.log('Phone name is empty');
        return;
    }
    
    console.log('Loading specs for phone ' + phoneNumber + ': ' + phoneName);
    
    // AJAX request দিয়ে ডেটাবেস থেকে ফোনের ডেটা fetch করুন
    fetch('get_phone_specs.php?phone=' + encodeURIComponent(phoneName))
        .then(response => {
            console.log('Response status:', response.status);
            return response.json();
        })
        .then(data => {
            console.log('Received data:', data);
            
            if(data.success && data.phone) {
                displayPhoneSpecs(data.phone, phoneNumber);
                // phone id hidden field এ সেট করুন
                document.getElementById('phone' + phoneNumber + '_id').value = data.phone.mobile_id;
                
                // Comparison results show করুন যদি দুটি ফোনই selected থাকে
                const phone1 = document.getElementById('phone1').value;
                const phone2 = document.getElementById('phone2').value;
                if(phone1 && phone2) {
                    document.getElementById('comparisonResults').style.display = 'block';
                }
            } else {
                console.error('Error loading phone specs:', data.message);
                alert('Error loading phone specifications: ' + data.message);
            }
        })
        .catch(error => {
            console.error('Fetch error:', error);
            alert('Error loading phone specifications');
        });
}

// ফোনের specification display করার function - CORRECTED
function displayPhoneSpecs(phone, phoneNumber) {
    console.log('Displaying specs for phone ' + phoneNumber + ':', phone);
    
    // Phone header এ নাম সেট করুন
    const headerElement = document.getElementById('phone' + phoneNumber + 'Header');
    if(headerElement) {
        headerElement.innerHTML = phone.model_name || 'N/A';
    }
    
    // Specification গুলো সেট করুন - CORRECTED IDs
    setSpecValue('phone' + phoneNumber + 'Price', phone.price ? '₹' + phone.price : 'N/A');
    setSpecValue('phone' + phoneNumber + 'Display', phone.display || 'N/A');
    setSpecValue('phone' + phoneNumber + 'Processor', phone.processor || 'N/A');
    setSpecValue('phone' + phoneNumber + 'Ram', phone.ram || 'N/A');
    setSpecValue('phone' + phoneNumber + 'Storage', phone.storage || 'N/A');
    setSpecValue('phone' + phoneNumber + 'Camera', phone.camera || 'N/A');
    setSpecValue('phone' + phoneNumber + 'Battery', phone.battery || 'N/A');
    setSpecValue('phone' + phoneNumber + 'Os', phone.os || 'N/A');
    
    // Image সেট করুন
    const imgElement = document.querySelector('#comparisonResults td:nth-child(' + (phoneNumber + 1) + ') img');
    if(imgElement && phone.image_url) {
        imgElement.src = phone.image_url;
        imgElement.alt = phone.model_name;
    }
}

// Helper function to set specification values
function setSpecValue(elementId, value) {
    const element = document.getElementById(elementId);
    if(element) {
        element.innerHTML = value;
    } else {
        console.error('Element not found:', elementId);
    }
}

// Compare function
function comparePhones() {
    const phone1 = document.getElementById('phone1').value;
    const phone2 = document.getElementById('phone2').value;
    
    if(phone1 && phone2) {
        // Reload specs for both phones
        loadPhoneSpecs(phone1, 1);
        loadPhoneSpecs(phone2, 2);
        
        // Comparison results show করুন
        document.getElementById('comparisonResults').style.display = 'block';
        
        // Scroll to results
        document.getElementById('comparisonResults').scrollIntoView({behavior: 'smooth'});
    } else {
        alert('Please select both phones to compare');
    }
}