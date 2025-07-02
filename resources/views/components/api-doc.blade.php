 <section id="documentation" class="py-20 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl sm:text-4xl font-bold text-gray-900 mb-4">API Documentation</h2>
                <p class="text-lg sm:text-xl text-gray-600">Complete reference for integrating with the Essential Nigeria Newsletter API</p>
            </div>

            <!-- Base URL -->
            <div class="bg-white rounded-xl shadow-lg p-6 sm:p-8 mb-8">
                <h3 class="text-xl sm:text-2xl font-semibold mb-4 text-gray-900">Base URL</h3>
                <div class="code-bg rounded-lg p-4 flex justify-between items-center">
                    <code class="text-green-400 overflow-x-auto">https://news-letter.essentialnews.ng/api</code>
                    <button onclick="copyToClipboard('https://news-letter.essentialnews.ng/api')" class="copy-btn bg-nigeria-green text-white px-3 py-1 rounded text-sm ml-4">
                        <i class="fas fa-copy"></i>
                    </button>
                </div>
                <div class="mt-4 flex flex-wrap gap-2">
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                        <i class="fas fa-globe mr-1"></i> Production
                    </span>
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                        <i class="fas fa-lock mr-1"></i> HTTPS
                    </span>
                </div>
            </div>

            <!-- Subscribe Endpoint -->
            <div class="bg-white rounded-xl shadow-lg p-6 sm:p-8 mb-8">
                <div class="flex flex-col sm:flex-row sm:items-center mb-6">
                    <span class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-sm font-semibold mb-2 sm:mb-0 sm:mr-4 w-max">POST</span>
                    <h3 class="text-xl sm:text-2xl font-semibold text-gray-900">/subscribe</h3>
                </div>
                
                <p class="text-gray-600 mb-6">Subscribe a user to the newsletter. Handles new subscriptions and re-subscriptions automatically.</p>
                
                <div class="space-y-6">
                    <div>
                        <h4 class="text-lg font-semibold mb-3 text-gray-900">Request Body</h4>
                        <div class="overflow-x-auto">
                            <table class="w-full border-collapse border border-gray-200">
                                <thead>
                                    <tr class="bg-gray-50">
                                        <th class="border border-gray-200 px-4 py-2 text-left">Field</th>
                                        <th class="border border-gray-200 px-4 py-2 text-left">Type</th>
                                        <th class="border border-gray-200 px-4 py-2 text-left">Required</th>
                                        <th class="border border-gray-200 px-4 py-2 text-left">Description</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="border border-gray-200 px-4 py-2 font-mono text-sm">email</td>
                                        <td class="border border-gray-200 px-4 py-2">string</td>
                                        <td class="border border-gray-200 px-4 py-2"><span class="text-red-600">Yes</span></td>
                                        <td class="border border-gray-200 px-4 py-2">The subscriber's email address</td>
                                    </tr>
                                    <tr>
                                        <td class="border border-gray-200 px-4 py-2 font-mono text-sm">platform</td>
                                        <td class="border border-gray-200 px-4 py-2">string</td>
                                        <td class="border border-gray-200 px-4 py-2"><span class="text-red-600">Yes</span></td>
                                        <td class="border border-gray-200 px-4 py-2">Source platform or website</td>
                                    </tr>
                                    <tr>
                                        <td class="border border-gray-200 px-4 py-2 font-mono text-sm">honeypot</td>
                                        <td class="border border-gray-200 px-4 py-2">string</td>
                                        <td class="border border-gray-200 px-4 py-2"><span class="text-gray-600">No</span></td>
                                        <td class="border border-gray-200 px-4 py-2">Bot detection field (leave empty)</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div>
                        <h4 class="text-lg font-semibold mb-3 text-gray-900">Headers</h4>
                        <div class="code-bg rounded-lg p-4">
                            <code class="text-green-400 text-sm">Content-Type: application/json</code>
                        </div>
                    </div>

                    <div>
                        <h4 class="text-lg font-semibold mb-3 text-gray-900">Response Examples</h4>
                        <div class="border-b border-gray-200 mb-4">
                            <nav class="-mb-px flex space-x-8">
                                <button onclick="showResponseTab('success-new', this)" class="response-tab tab-active whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                                    Success (New)
                                </button>
                                <button onclick="showResponseTab('success-resend', this)" class="response-tab whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                                    Success (Resend)
                                </button>
                                <button onclick="showResponseTab('error', this)" class="response-tab whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                                    Errors
                                </button>
                            </nav>
                        </div>
                        
                        <div id="success-new" class="response-content">
                            <div class="code-bg rounded-lg p-4">
                                <div class="flex justify-between items-start mb-2">
                                    <span class="text-xs text-gray-400">Status: 201 Created</span>
                                    <button onclick="copyToClipboard('success-new-code')" class="copy-btn bg-gray-700 hover:bg-gray-600 text-white px-2 py-1 rounded text-xs">
                                        <i class="fas fa-copy mr-1"></i> Copy
                                    </button>
                                </div>
                                <pre id="success-new-code" class="text-green-400 text-sm overflow-x-auto"><code>{
    "message": "Successfully subscribed!"
}</code></pre>
                            </div>
                        </div>
                        
                        <div id="success-resend" class="response-content hidden">
                            <div class="code-bg rounded-lg p-4">
                                <div class="flex justify-between items-start mb-2">
                                    <span class="text-xs text-gray-400">Status: 200 OK</span>
                                    <button onclick="copyToClipboard('success-resend-code')" class="copy-btn bg-gray-700 hover:bg-gray-600 text-white px-2 py-1 rounded text-xs">
                                        <i class="fas fa-copy mr-1"></i> Copy
                                    </button>
                                </div>
                                <pre id="success-resend-code" class="text-green-400 text-sm overflow-x-auto"><code>{
    "message": "This email is already subscribed, but we've resent the welcome email!"
}</code></pre>
                            </div>
                        </div>
                        
                        <div id="error" class="response-content hidden">
                            <div class="space-y-4">
                                <div>
                                    <div class="code-bg rounded-lg p-4">
                                        <div class="flex justify-between items-start mb-2">
                                            <span class="text-xs text-gray-400">Status: 400 Bad Request</span>
                                            <button onclick="copyToClipboard('error-400-code')" class="copy-btn bg-gray-700 hover:bg-gray-600 text-white px-2 py-1 rounded text-xs">
                                                <i class="fas fa-copy mr-1"></i> Copy
                                            </button>
                                        </div>
                                        <pre id="error-400-code" class="text-red-400 text-sm overflow-x-auto"><code>{
    "message": "This email is already subscribed."
}</code></pre>
                                    </div>
                                </div>
                                <div>
                                    <div class="code-bg rounded-lg p-4">
                                        <div class="flex justify-between items-start mb-2">
                                            <span class="text-xs text-gray-400">Status: 403 Forbidden</span>
                                            <button onclick="copyToClipboard('error-403-code')" class="copy-btn bg-gray-700 hover:bg-gray-600 text-white px-2 py-1 rounded text-xs">
                                                <i class="fas fa-copy mr-1"></i> Copy
                                            </button>
                                        </div>
                                        <pre id="error-403-code" class="text-red-400 text-sm overflow-x-auto"><code>{
    "message": "Your IP has been blacklisted."
}</code></pre>
                                    </div>
                                </div>
                                <div>
                                    <div class="code-bg rounded-lg p-4">
                                        <div class="flex justify-between items-start mb-2">
                                            <span class="text-xs text-gray-400">Status: 403 Forbidden</span>
                                            <button onclick="copyToClipboard('error-bot-code')" class="copy-btn bg-gray-700 hover:bg-gray-600 text-white px-2 py-1 rounded text-xs">
                                                <i class="fas fa-copy mr-1"></i> Copy
                                            </button>
                                        </div>
                                        <pre id="error-bot-code" class="text-red-400 text-sm overflow-x-auto"><code>{
    "message": "Bot detected. Subscription rejected."
}</code></pre>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Unsubscribe Endpoint -->
            <div class="bg-white rounded-xl shadow-lg p-6 sm:p-8">
                <div class="flex flex-col sm:flex-row sm:items-center mb-6">
                    <span class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-sm font-semibold mb-2 sm:mb-0 sm:mr-4 w-max">GET</span>
                    <h3 class="text-xl sm:text-2xl font-semibold text-gray-900">/unsubscribe/{token}</h3>
                </div>
                
                <p class="text-gray-600 mb-6">Unsubscribe a user using their unique token.</p>
                
                <div class="space-y-6">
                    <div>
                        <h4 class="text-lg font-semibold mb-3 text-gray-900">Path Parameters</h4>
                        <div class="overflow-x-auto">
                            <table class="w-full border-collapse border border-gray-200">
                                <thead>
                                    <tr class="bg-gray-50">
                                        <th class="border border-gray-200 px-4 py-2 text-left">Parameter</th>
                                        <th class="border border-gray-200 px-4 py-2 text-left">Type</th>
                                        <th class="border border-gray-200 px-4 py-2 text-left">Description</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="border border-gray-200 px-4 py-2 font-mono text-sm">token</td>
                                        <td class="border border-gray-200 px-4 py-2">string</td>
                                        <td class="border border-gray-200 px-4 py-2">Unique unsubscribe token</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div>
                        <h4 class="text-lg font-semibold mb-3 text-gray-900">Response Examples</h4>
                        <div class="border-b border-gray-200 mb-4">
                            <nav class="-mb-px flex space-x-8">
                                <button onclick="showResponseTab('unsub-success', this)" class="response-tab tab-active whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                                    Success
                                </button>
                                <button onclick="showResponseTab('unsub-error', this)" class="response-tab whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                                    Error
                                </button>
                            </nav>
                        </div>
                        
                        <div id="unsub-success" class="response-content">
                            <div class="code-bg rounded-lg p-4">
                                <div class="flex justify-between items-start mb-2">
                                    <span class="text-xs text-gray-400">Status: 200 OK</span>
                                    <button onclick="copyToClipboard('unsub-success-code')" class="copy-btn bg-gray-700 hover:bg-gray-600 text-white px-2 py-1 rounded text-xs">
                                        <i class="fas fa-copy mr-1"></i> Copy
                                    </button>
                                </div>
                                <pre id="unsub-success-code" class="text-green-400 text-sm overflow-x-auto"><code>{
    "message": "You have been successfully unsubscribed."
}</code></pre>
                            </div>
                        </div>
                        
                        <div id="unsub-error" class="response-content hidden">
                            <div class="code-bg rounded-lg p-4">
                                <div class="flex justify-between items-start mb-2">
                                    <span class="text-xs text-gray-400">Status: 404 Not Found</span>
                                    <button onclick="copyToClipboard('unsub-error-code')" class="copy-btn bg-gray-700 hover:bg-gray-600 text-white px-2 py-1 rounded text-xs">
                                        <i class="fas fa-copy mr-1"></i> Copy
                                    </button>
                                </div>
                                <pre id="unsub-error-code" class="text-red-400 text-sm overflow-x-auto"><code>{
    "message": "Invalid or expired unsubscribe link."
}</code></pre>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>