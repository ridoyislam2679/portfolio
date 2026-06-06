document.addEventListener('DOMContentLoaded', function() {
            // Method selection
            const methodCards = document.querySelectorAll('.method-card:not(.coming-soon)');
            const methodDetails = document.querySelectorAll('.method-details');
            
            methodCards.forEach(card => {
                card.addEventListener('click', function() {
                    // Remove active class from all cards
                    methodCards.forEach(c => c.classList.remove('active'));
                    
                    // Add active class to clicked card
                    this.classList.add('active');
                    
                    // Hide all method details
                    methodDetails.forEach(detail => detail.classList.add('d-none'));
                    
                    // Show selected method details
                    const method = this.getAttribute('data-method');
                    document.getElementById(`${method}-details`).classList.remove('d-none');
                    
                    // Update fee based on method
                    updateFee();
                });
            });
            
            // Amount calculation
            const amountInput = document.querySelector('input[type="number"]');
            const feeAmount = document.getElementById('fee-amount');
            const feePercent = document.getElementById('fee-percent');
            const receiveAmount = document.getElementById('receive-amount');
            const withdrawAllBtn = document.getElementById('withdraw-all');
            
            amountInput.addEventListener('input', updateFee);
            withdrawAllBtn.addEventListener('click', function() {
                amountInput.value = '125.50';
                updateFee();
            });
            
            function updateFee() {
                const amount = parseFloat(amountInput.value) || 0;
                let feeRate = 0.015; // Default 1.5%
                
                // Adjust fee for Binance
                if (document.querySelector('.method-card.active').getAttribute('data-method') === 'binance') {
                    feeRate = 0.005; // 0.5%
                    feePercent.textContent = '0.5%';
                } else {
                    feePercent.textContent = '1.5%';
                }
                
                const fee = amount * feeRate;
                const receive = amount - fee;
                
                feeAmount.textContent = `$${fee.toFixed(2)}`;
                receiveAmount.textContent = `$${receive.toFixed(2)}`;
            }
            
            // Initialize
            updateFee();
        });