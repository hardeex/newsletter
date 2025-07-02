 <section id="examples" class="py-20 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl sm:text-4xl font-bold text-gray-900 mb-4">Code Examples</h2>
                <p class="text-lg sm:text-xl text-gray-600">Ready-to-use examples for quick integration</p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                <!-- Laravel/PHP Example -->
                <div class="bg-white rounded-xl shadow-lg p-6">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-xl font-semibold text-gray-900 flex items-center">
                            <i class="fab fa-laravel text-red-500 mr-2"></i> Laravel/PHP Example
                        </h3>
                        <button onclick="copyToClipboard('php-example')" class="copy-btn bg-gray-200 hover:bg-gray-300 text-gray-800 px-3 py-1 rounded text-sm">
                            <i class="fas fa-copy mr-1"></i> Copy
                        </button>
                    </div>
                    <div class="code-bg rounded-lg p-4">
                        <pre id="php-example" class="text-green-400 text-sm overflow-x-auto"><code>use Illuminate\Support\Facades\Http;

$response = Http::post('https://news-letter.essentialnews.ng/api/subscribe', [
    'email' => 'user@example.com',
    'platform' => 'My Website',
    'honeypot' => '' // Leave empty
]);

if ($response->successful()) {
    $data = $response->json();
    echo $data['message'];
} else {
    $error = $response->json();
    echo 'Error: ' . $error['message'];
    
    // Handle specific error cases
    if ($response->status() === 403) {
        // IP blocked or bot detected
    }
}</code></pre>
                    </div>
                </div>

                <!-- JavaScript/Fetch Example -->
                <div class="bg-white rounded-xl shadow-lg p-6">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-xl font-semibold text-gray-900 flex items-center">
                            <i class="fab fa-js-square text-yellow-400 mr-2"></i> JavaScript Example
                        </h3>
                        <button onclick="copyToClipboard('js-example')" class="copy-btn bg-gray-200 hover:bg-gray-300 text-gray-800 px-3 py-1 rounded text-sm">
                            <i class="fas fa-copy mr-1"></i> Copy
                        </button>
                    </div>
                    <div class="code-bg rounded-lg p-4">
                        <pre id="js-example" class="text-green-400 text-sm overflow-x-auto"><code>const subscribeUser = async (email, platform) => {
    try {
        const response = await fetch('https://news-letter.essentialnews.ng/api/subscribe', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({
                email: email,
                platform: platform,
                honeypot: ''
            })
        });
        
        const data = await response.json();
        
        if (!response.ok) {
            throw new Error(data.message || 'Subscription failed');
        }
        
        console.log('Success:', data.message);
        return data;
    } catch (error) {
        console.error('Error:', error);
        // Show error to user
        alert(error.message);
        throw error;
    }
};

// Usage
subscribeUser('user@example.com', 'My Website')
    .then(data => {
        // Handle success
    })
    .catch(error => {
        // Handle error
    });</code></pre>
                    </div>
                </div>

                <!-- cURL Example -->
                <div class="bg-white rounded-xl shadow-lg p-6">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-xl font-semibold text-gray-900 flex items-center">
                            <i class="fas fa-terminal text-gray-600 mr-2"></i> cURL Example
                        </h3>
                        <button onclick="copyToClipboard('curl-example')" class="copy-btn bg-gray-200 hover:bg-gray-300 text-gray-800 px-3 py-1 rounded text-sm">
                            <i class="fas fa-copy mr-1"></i> Copy
                        </button>
                    </div>
                    <div class="code-bg rounded-lg p-4">
                        <pre id="curl-example" class="text-green-400 text-sm overflow-x-auto"><code>curl -X POST https://news-letter.essentialnews.ng/api/subscribe \
  -H "Content-Type: application/json" \
  -d '{
    "email": "user@example.com",
    "platform": "My Website",
    "honeypot": ""
  }'

# Example response:
# {"message":"Successfully subscribed!"}</code></pre>
                    </div>
                </div>

                <!-- Blade Template Example -->
                <div class="bg-white rounded-xl shadow-lg p-6">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-xl font-semibold text-gray-900 flex items-center">
                            <i class="fab fa-html5 text-orange-500 mr-2"></i> Laravel Blade Form
                        </h3>
                        <button onclick="copyToClipboard('blade-example')" class="copy-btn bg-gray-200 hover:bg-gray-300 text-gray-800 px-3 py-1 rounded text-sm">
                            <i class="fas fa-copy mr-1"></i> Copy
                        </button>
                    </div>
                    <div class="code-bg rounded-lg p-4">
                        <pre id="blade-example" class="text-green-400 text-sm overflow-x-auto"><code>&lt;form id="newsletter-form" class="max-w-md mx-auto"&gt;
    @csrf
    &lt;div class="mb-4"&gt;
        &lt;label for="email" class="block text-gray-700 mb-2"&gt;Email Address&lt;/label&gt;
        &lt;input type="email" name="email" id="email" required
               class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-nigeria-green focus:border-nigeria-green"&gt;
    &lt;/div&gt;
    &lt;input type="hidden" name="platform" value="{{ config('app.name') }}"&gt;
    &lt;!-- Honeypot field --&gt;
    &lt;input type="text" name="honeypot" style="display:none"&gt;
    
    &lt;button type="submit" class="w-full bg-nigeria-green text-white py-2 px-4 rounded-lg hover:bg-green-700 transition"&gt;
        Subscribe
    &lt;/button&gt;
    
    &lt;div id="form-message" class="mt-3 text-sm hidden"&gt;&lt;/div&gt;
&lt;/form&gt;

&lt;script&gt;
document.getElementById('newsletter-form').addEventListener('submit', async (e) => {
    e.preventDefault();
    const form = e.target;
    const messageEl = document.getElementById('form-message');
    messageEl.classList.add('hidden');
    
    try {
        const response = await fetch('https://news-letter.essentialnews.ng/api/subscribe', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify({
                email: form.email.value,
                platform: form.platform.value,
                honeypot: form.honeypot.value
            })
        });
        
        const data = await response.json();
        
        if (!response.ok) {
            throw new Error(data.message || 'Subscription failed');
        }
        
        messageEl.textContent = data.message;
        messageEl.classList.remove('hidden', 'text-red-600');
        messageEl.classList.add('text-green-600');
        form.reset();
    } catch (error) {
        messageEl.textContent = error.message;
        messageEl.classList.remove('hidden', 'text-green-600');
        messageEl.classList.add('text-red-600');
    }
});
&lt;/script&gt;</code></pre>
                    </div>
                </div>
            </div>
        </div>
    </section>