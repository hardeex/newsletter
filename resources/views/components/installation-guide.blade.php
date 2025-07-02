  <section id="installation" class="py-20 bg-white">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl sm:text-4xl font-bold text-gray-900 mb-4">Quick Installation</h2>
                <p class="text-lg sm:text-xl text-gray-600">Get started with the Essential Nigeria Newsletter API in minutes</p>
            </div>

            <div class="bg-gray-50 rounded-xl shadow-lg p-6 sm:p-8">
                <div class="space-y-6">
                    <div>
                        <h3 class="text-lg font-semibold mb-3 text-gray-900 flex items-center">
                            <i class="fas fa-server text-nigeria-green mr-2"></i> 1. Prerequisites
                        </h3>
                        <div class="bg-white rounded-lg p-4 border border-gray-200">
                            <ul class="list-disc pl-5 space-y-2 text-gray-700">
                                <li>PHP >= 8.0</li>
                                <li>Laravel >= 8.x</li>
                                <li>Composer</li>
                                <li>MySQL or other database systems supported by Laravel</li>
                                <li>Mailer setup (e.g., SMTP, Mailgun, etc.)</li>
                            </ul>
                        </div>
                    </div>

                    <div>
                        <h3 class="text-lg font-semibold mb-3 text-gray-900 flex items-center">
                            <i class="fas fa-download text-nigeria-green mr-2"></i> 2. Clone the Repository
                        </h3>
                        <div class="code-bg rounded-lg p-4 flex justify-between items-center">
                            <code class="text-green-400">git clone https://github.com/hardeex/newsletter</code>
                            <button onclick="copyToClipboard('git-clone')" class="copy-btn bg-gray-700 hover:bg-gray-600 text-white px-3 py-1 rounded text-sm ml-4">
                                <i class="fas fa-copy"></i>
                            </button>
                        </div>
                    </div>

                    <div>
                        <h3 class="text-lg font-semibold mb-3 text-gray-900 flex items-center">
                            <i class="fas fa-cogs text-nigeria-green mr-2"></i> 3. Install Dependencies
                        </h3>
                        <div class="code-bg rounded-lg p-4 flex justify-between items-center">
                            <code class="text-green-400">composer install</code>
                            <button onclick="copyToClipboard('composer-install')" class="copy-btn bg-gray-700 hover:bg-gray-600 text-white px-3 py-1 rounded text-sm ml-4">
                                <i class="fas fa-copy"></i>
                            </button>
                        </div>
                    </div>

                    <div>
                        <h3 class="text-lg font-semibold mb-3 text-gray-900 flex items-center">
                            <i class="fas fa-wrench text-nigeria-green mr-2"></i> 4. Configure Environment
                        </h3>
                        <div class="space-y-2">
                            <div class="code-bg rounded-lg p-4 flex justify-between items-center">
                                <code class="text-green-400">cp .env.example .env</code>
                                <button onclick="copyToClipboard('cp-env')" class="copy-btn bg-gray-700 hover:bg-gray-600 text-white px-3 py-1 rounded text-sm ml-4">
                                    <i class="fas fa-copy"></i>
                                </button>
                            </div>
                            <div class="code-bg rounded-lg p-4 flex justify-between items-center">
                                <code class="text-green-400">php artisan key:generate</code>
                                <button onclick="copyToClipboard('key-generate')" class="copy-btn bg-gray-700 hover:bg-gray-600 text-white px-3 py-1 rounded text-sm ml-4">
                                    <i class="fas fa-copy"></i>
                                </button>
                            </div>
                            <div class="code-bg rounded-lg p-4 flex justify-between items-center">
                                <code class="text-green-400">php artisan migrate</code>
                                <button onclick="copyToClipboard('migrate')" class="copy-btn bg-gray-700 hover:bg-gray-600 text-white px-3 py-1 rounded text-sm ml-4">
                                    <i class="fas fa-copy"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <div>
                        <h3 class="text-lg font-semibold mb-3 text-gray-900 flex items-center">
                            <i class="fas fa-envelope text-nigeria-green mr-2"></i> 5. Configure Mail Settings
                        </h3>
                        <div class="code-bg rounded-lg p-4">
                            <div class="flex justify-between items-start mb-2">
                                <span class="text-xs text-gray-400">.env file configuration</span>
                                <button onclick="copyToClipboard('mail-config')" class="copy-btn bg-gray-700 hover:bg-gray-600 text-white px-3 py-1 rounded text-sm">
                                    <i class="fas fa-copy mr-1"></i> Copy
                                </button>
                            </div>
                            <pre id="mail-config" class="text-green-400 text-sm overflow-x-auto"><code>MAIL_MAILER=smtp
MAIL_HOST=your-smtp-host
MAIL_PORT=587
MAIL_USERNAME=your-username
MAIL_PASSWORD=your-password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS="no-reply@essentialnews.ng"
MAIL_FROM_NAME="Essential Nigeria"</code></pre>
                        </div>
                        <p class="mt-2 text-sm text-gray-600">Supported mailers: SMTP, Mailgun, Postmark, Amazon SES, Sendmail</p>
                    </div>

                    <div>
                        <h3 class="text-lg font-semibold mb-3 text-gray-900 flex items-center">
                            <i class="fas fa-rocket text-nigeria-green mr-2"></i> 6. Run the Application
                        </h3>
                        <div class="code-bg rounded-lg p-4 flex justify-between items-center">
                            <code class="text-green-400">php artisan serve</code>
                            <button onclick="copyToClipboard('serve')" class="copy-btn bg-gray-700 hover:bg-gray-600 text-white px-3 py-1 rounded text-sm ml-4">
                                <i class="fas fa-copy"></i>
                            </button>
                        </div>
                        <p class="mt-2 text-sm text-gray-600">For production, configure a proper web server like Nginx or Apache</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
