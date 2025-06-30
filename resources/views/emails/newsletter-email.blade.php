<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to Essential Nigeria</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'nigeria-green': '#008751',
                        'nigeria-white': '#ffffff',
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-gray-50 font-sans">
    <div class="max-w-2xl mx-auto bg-white rounded-lg shadow-lg overflow-hidden my-8">
        <!-- Header with Nigeria-inspired gradient -->
        <div class="bg-gradient-to-r from-nigeria-green to-emerald-600 px-8 py-12 text-center">
            <div class="mb-4">
                <div class="inline-flex items-center justify-center w-16 h-16 bg-white rounded-full mb-4">
                    <span class="text-2xl font-bold text-nigeria-green">EN</span>
                </div>
            </div>
            <h1 class="text-3xl font-bold text-white mb-2">Welcome to Essential Nigeria!</h1>
            <p class="text-green-100 text-lg">Your gateway to Nigeria's digital ecosystem</p>
        </div>

        <!-- Main Content -->
        <div class="px-8 py-8">
            <div class="mb-6">
                <p class="text-gray-700 text-lg mb-4">Hello <span class="font-semibold text-nigeria-green">{{ $email }}</span>,</p>
                <p class="text-gray-600 mb-4">Thank you for joining the Essential Nigeria community! We're excited to have you as part of our growing network of innovators, entrepreneurs, and forward-thinking Nigerians.</p>
                <p class="text-gray-600 mb-6">You now have access to our comprehensive suite of digital solutions designed to empower businesses and individuals across Nigeria.</p>
            </div>

            <!-- Services Grid -->
            <div class="bg-gray-50 rounded-lg p-6 mb-8">
                <h2 class="text-xl font-semibold text-gray-800 mb-4 text-center">Explore Our Services</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="bg-white rounded-lg p-4 border border-gray-200 hover:shadow-md transition-shadow">
                        <div class="flex items-center mb-2">
                            <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center mr-3">
                                <span class="text-blue-600 font-bold text-sm">ED</span>
                            </div>
                            <h3 class="font-semibold text-gray-800">Edirect</h3>
                        </div>
                        <p class="text-sm text-gray-600">Connect with local business owners and service providers in your area</p>
                    </div>
                    
                    <div class="bg-white rounded-lg p-4 border border-gray-200 hover:shadow-md transition-shadow">
                        <div class="flex items-center mb-2">
                            <div class="w-8 h-8 bg-red-100 rounded-full flex items-center justify-center mr-3">
                                <span class="text-red-600 font-bold text-sm">EN</span>
                            </div>
                            <h3 class="font-semibold text-gray-800">Essential News</h3>
                        </div>
                        <p class="text-sm text-gray-600">Stay updated with the latest news and insights from across Nigeria</p>
                    </div>
                    
                    <div class="bg-white rounded-lg p-4 border border-gray-200 hover:shadow-md transition-shadow">
                        <div class="flex items-center mb-2">
                            <div class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center mr-3">
                                <span class="text-green-600 font-bold text-sm">EM</span>
                            </div>
                            <h3 class="font-semibold text-gray-800">eMedical</h3>
                        </div>
                        <p class="text-sm text-gray-600">Access healthcare services and medical information at your fingertips</p>
                    </div>
                    
                    <div class="bg-white rounded-lg p-4 border border-gray-200 hover:shadow-md transition-shadow">
                        <div class="flex items-center mb-2">
                            <div class="w-8 h-8 bg-purple-100 rounded-full flex items-center justify-center mr-3">
                                <span class="text-purple-600 font-bold text-sm">ES</span>
                            </div>
                            <h3 class="font-semibold text-gray-800">eStores</h3>
                        </div>
                        <p class="text-sm text-gray-600">Shop from verified local stores and discover amazing products</p>
                    </div>
                </div>
            </div>

            <!-- Call to Action -->
            <div class="text-center mb-6">
                <a href="{{ url('/') }}" class="inline-block bg-gradient-to-r from-nigeria-green to-emerald-600 text-white font-semibold px-8 py-3 rounded-lg hover:from-emerald-600 hover:to-nigeria-green transition-all duration-300 transform hover:scale-105 shadow-lg">
                    Explore Our Platform
                </a>
            </div>

            <!-- What's Next -->
            <div class="bg-gradient-to-r from-blue-50 to-green-50 rounded-lg p-6 mb-6">
                <h3 class="font-semibold text-gray-800 mb-3">What's Next?</h3>
                <ul class="space-y-2 text-sm text-gray-600">
                    <li class="flex items-center">
                        <span class="w-2 h-2 bg-nigeria-green rounded-full mr-3"></span>
                        Complete your profile to get personalized recommendations
                    </li>
                    <li class="flex items-center">
                        <span class="w-2 h-2 bg-nigeria-green rounded-full mr-3"></span>
                        Explore our services and find what suits your needs
                    </li>
                    <li class="flex items-center">
                        <span class="w-2 h-2 bg-nigeria-green rounded-full mr-3"></span>
                        Connect with local businesses and service providers
                    </li>
                    <li class="flex items-center">
                        <span class="w-2 h-2 bg-nigeria-green rounded-full mr-3"></span>
                        Stay tuned for exclusive offers and updates
                    </li>
                </ul>
            </div>

            <!-- Support Section -->
            <div class="text-center p-4 bg-gray-50 rounded-lg">
                <p class="text-sm text-gray-600 mb-2">Need help getting started?</p>
                <p class="text-sm text-gray-500">Contact our support team at <a href="mailto:support@essentialnigeria.com" class="text-nigeria-green hover:underline">support@essentialnigeria.com</a></p>
            </div>
        </div>

        <!-- Footer -->
        <div class="bg-gray-100 px-8 py-6 text-center border-t">
            <div class="flex justify-center space-x-6 mb-4">
                <a href="#" class="text-gray-500 hover:text-nigeria-green text-sm">Privacy Policy</a>
                <a href="#" class="text-gray-500 hover:text-nigeria-green text-sm">Terms of Service</a>
                <a href="#" class="text-gray-500 hover:text-nigeria-green text-sm">Contact Us</a>
            </div>
            <p class="text-xs text-gray-500 mb-2">
                © <span id="currentYear"></span> Essential Nigeria. All rights reserved.
            </p>
            <p class="text-xs text-gray-400">
                You're receiving this email because you subscribed to Essential Nigeria updates.
            </p>
            <p class="text-xs text-gray-400 mt-2">
                <a href="{{ $unsubscribeLink }}" class="text-gray-500 hover:text-gray-700 underline">Unsubscribe</a> | 
                <a href="#" class="text-gray-500 hover:text-gray-700 underline">Update Preferences</a>
            </p>
        </div>
    </div>

    <script>
        // Set current year dynamically
        document.getElementById('currentYear').textContent = new Date().getFullYear();
    </script>
</body>
</html>