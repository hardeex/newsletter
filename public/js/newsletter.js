 // Mobile menu toggle
        const mobileMenuButton = document.getElementById('mobile-menu-button');
        const mobileMenu = document.getElementById('mobile-menu');
        
        mobileMenuButton.addEventListener('click', () => {
            mobileMenu.classList.toggle('open');
        });

        // Response tabs
        function showResponseTab(tabId, button) {
            // Hide all content
            document.querySelectorAll('.response-content').forEach(content => {
                content.classList.add('hidden');
            });
            
            // Remove active class from all buttons
            document.querySelectorAll('.response-tab').forEach(tab => {
                tab.classList.remove('tab-active');
            });
            
            // Show selected content and mark button as active
            document.getElementById(tabId).classList.remove('hidden');
            button.classList.add('tab-active');
        }

        // Copy to clipboard
        function copyToClipboard(elementId) {
            const element = document.getElementById(elementId);
            const text = element.textContent || element.innerText;
            
            navigator.clipboard.writeText(text.trim()).then(() => {
                const button = event.target.closest('button');
                if (button) {
                    button.classList.add('copied');
                    button.innerHTML = '<i class="fas fa-check mr-1"></i> Copied';
                    
                    setTimeout(() => {
                        button.classList.remove('copied');
                        button.innerHTML = button.innerHTML.includes('fa-copy') ? 
                            button.innerHTML : '<i class="fas fa-copy mr-1"></i> Copy';
                    }, 2000);
                }
            }).catch(err => {
                console.error('Failed to copy text: ', err);
            });
        }

        // Try it out form submission
        const trySubscribeForm = document.getElementById('try-subscribe-form');
        const trySubscribeResult = document.getElementById('try-subscribe-result');
        const trySubscribeResponse = document.getElementById('try-subscribe-response');
        const trySubscribeStatus = document.getElementById('try-subscribe-status');
        
        if (trySubscribeForm) {
            trySubscribeForm.addEventListener('submit', async (e) => {
                e.preventDefault();
                
                const formData = {
                    email: document.getElementById('try-email').value,
                    platform: document.getElementById('try-platform').value,
                    honeypot: ''
                };
                
                try {
                    const response = await fetch('https://news-letter.essentialnews.ng/api/subscribe', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                        },
                        body: JSON.stringify(formData)
                    });
                    
                    const data = await response.json();
                    
                    trySubscribeStatus.textContent = `Status: ${response.status} ${response.statusText}`;
                    trySubscribeResponse.textContent = JSON.stringify(data, null, 2);
                    
                    if (response.ok) {
                        trySubscribeResponse.className = 'text-green-400 text-sm overflow-x-auto';
                    } else {
                        trySubscribeResponse.className = 'text-red-400 text-sm overflow-x-auto';
                    }
                    
                    trySubscribeResult.classList.remove('hidden');
                } catch (error) {
                    trySubscribeStatus.textContent = 'Status: Error';
                    trySubscribeResponse.textContent = `An error occurred: ${error.message}`;
                    trySubscribeResponse.className = 'text-red-400 text-sm overflow-x-auto';
                    trySubscribeResult.classList.remove('hidden');
                }
            });
        }

        // Smooth scrolling for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                
                // Close mobile menu if open
                mobileMenu.classList.remove('open');
                
                document.querySelector(this.getAttribute('href')).scrollIntoView({
                    behavior: 'smooth'
                });
            });
        });