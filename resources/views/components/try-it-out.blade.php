  <section id="try-it-out" class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl sm:text-4xl font-bold text-gray-900 mb-4">Try It Out</h2>
                <p class="text-lg sm:text-xl text-gray-600">Test the API endpoints directly from your browser</p>
            </div>

            <div class="bg-gray-50 rounded-xl shadow-lg p-6 sm:p-8">
                <div class="mb-6">
                    <h3 class="text-xl font-semibold mb-3">POST /subscribe</h3>
                    <p class="text-gray-600 mb-4">Subscribe to the newsletter by filling the form below:</p>
                    
                    <form id="try-subscribe-form" class="space-y-4">
                        <div>
                            <label for="try-email" class="block text-sm font-medium text-gray-700 mb-1">Email *</label>
                            <input type="email" id="try-email" name="email" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-nigeria-green focus:border-nigeria-green">
                        </div>
                        <div>
                            <label for="try-platform" class="block text-sm font-medium text-gray-700 mb-1">Platform *</label>
                            <input type="text" id="try-platform" name="platform" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-nigeria-green focus:border-nigeria-green" value="API Demo">
                        </div>
                        <input type="text" name="honeypot" style="display: none;">
                        
                        <button type="submit" class="bg-nigeria-green text-white px-6 py-3 rounded-lg hover:bg-green-700 transition-colors font-medium w-full sm:w-auto">
                            Send Request
                        </button>
                    </form>
                    
                    <div id="try-subscribe-result" class="mt-6 hidden">
                        <h4 class="text-lg font-medium mb-2">Response</h4>
                        <div class="code-bg rounded-lg p-4">
                            <div class="flex justify-between items-start mb-2">
                                <span id="try-subscribe-status" class="text-xs text-gray-400">Status: </span>
                            </div>
                            <pre id="try-subscribe-response" class="text-green-400 text-sm overflow-x-auto"></pre>
                        </div>
                    </div>
                </div>
                
                <div class="pt-6 border-t border-gray-200">
                    <h3 class="text-xl font-semibold mb-3">GET /unsubscribe/{token}</h3>
                    <p class="text-gray-600 mb-4">To test the unsubscribe endpoint, you'll need a valid token from a subscription email.</p>
                    
                    <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4 mb-4">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <i class="fas fa-exclamation-circle text-yellow-400 mt-1"></i>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm text-yellow-700">
                                    Note: You need to subscribe first to get a valid unsubscribe token.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>