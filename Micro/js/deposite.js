document.addEventListener('DOMContentLoaded', function() {
            // Method selection
            const methodCards = document.querySelectorAll('.custom-method-card:not(.custom-coming-soon)');
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
                    
                    // Update calculation
                    updateCalculation();
                });
            });
            
            // Amount calculation
            const amountInputs = document.querySelectorAll('input[type="number"]');
            
            amountInputs.forEach(input => {
                input.addEventListener('input', updateCalculation);
            });
            
            function updateCalculation() {
                const activeMethod = document.querySelector('.custom-method-card.active').getAttribute('data-method');
                let amount = 0;
                let feeRate = 0.015; // Default 1.5%
                
                // Get amount based on active method
                if (activeMethod === 'binance') {
                    amount = parseFloat(document.querySelector('#binance-details input[type="number"]').value) || 0;
                    feeRate = 0.005; // 0.5% for Binance
                } else {
                    // Convert BDT to USD (approximate rate 100 BDT = 1 USD)
                    const bdtAmount = parseFloat(document.querySelector(`#${activeMethod}-details input[type="number"]`).value) || 0;
                    amount = bdtAmount / 100;
                }
                
                const fee = amount * feeRate;
                const total = amount + fee;
                
                document.getElementById('deposit-amount').textContent = `$${amount.toFixed(2)}`;
                document.getElementById('fee-amount').textContent = `$${fee.toFixed(2)}`;
                document.getElementById('total-amount').textContent = `$${total.toFixed(2)}`;
            }
            
            // Initialize
            updateCalculation();
        });