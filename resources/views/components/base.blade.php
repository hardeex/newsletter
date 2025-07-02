<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Essential Nigeria Newsletter API')</title>
    <script src="/js/newsletter.js" defer></script>
    @include('components.theme')
</head>
<body class="bg-gray-50 text-gray-800">
    
    <!-- Navigation -->
    @include('components.nav')

    <!-- Hero Section -->
    @include('components.hero')

    <!-- Stats Section -->
   @include('components.stats')

    <!-- Features Section -->
   @include('components.feature')

    <!-- API Documentation Section -->
   @include('components.api-doc')

    <!-- Try It Out Section -->
  @include('components.try-it-out')

    <!-- Code Examples Section -->
   @include('components.code-sample')

    <!-- Installation Section -->
  @include('components.installation-guide')

    <!-- Additional Resources Section -->
   @include('components.resource')

    <!-- Footer -->
    <footer class="gradient-bg text-white pt-12 pb-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8 mb-8">
                <div>
                    <div class="flex items-center mb-4">
                        <div class="w-8 h-8 bg-white rounded-lg flex items-center justify-center mr-3">
                            <span class="text-nigeria-green font-bold text-lg">N</span>
                        </div>
                        <span class="text-xl font-bold">Essential Nigeria</span>
                    </div>
                    <p class="text-green-100">A robust newsletter API solution for Nigerian developers and businesses.</p>
                </div>
                <div>
                    <h4 class="text-lg font-semibold mb-4">Quick Links</h4>
                    <ul class="space-y-2">
                        <li><a href="#features" class="text-green-100 hover:text-white">Features</a></li>
                        <li><a href="#documentation" class="text-green-100 hover:text-white">Documentation</a></li>
                        <li><a href="#examples" class="text-green-100 hover:text-white">Examples</a></li>
                        <li><a href="#installation" class="text-green-100 hover:text-white">Installation</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-lg font-semibold mb-4">Resources</h4>
                    <ul class="space-y-2">
                        <li><a href="https://github.com/hardeex/newsletter" target="_blank" class="text-green-100 hover:text-white">GitHub Repository</a></li>
                        <li><a href="https://docs.google.com/document/d/1gPZEBVJ-N89fHOAXxpN41q2a3bOBO71sbQ2ek5TfhiM/edit?tab=t.0" target="_blank" class="text-green-100 hover:text-white">Google Doc</a></li>
                        <li><a href="https://laravel.com/docs" target="_blank" class="text-green-100 hover:text-white">Laravel Documentation</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-lg font-semibold mb-4">Contact</h4>
                    <ul class="space-y-2">
                        <li class="flex items-center"><i class="fas fa-envelope mr-2"></i> <a href="mailto:webmasterjdd@gmail.com" class="text-green-100 hover:text-white">webmasterjdd@gmail.com</a></li>
                        <li class="flex items-center"><i class="fas fa-globe mr-2"></i> <a href="https://dev.connectnesthub.com/" target="_blank" class="text-green-100 hover:text-white">dev.connectnesthub.com</a></li>
                    </ul>
                </div>
            </div>
            <div class="border-t border-green-300 pt-6 flex flex-col md:flex-row justify-between items-center">
               <p class="text-green-100 mb-4 md:mb-0">
    © {{ now()->year }} Essential Nigeria Newsletter API. All rights reserved.
</p>

                <div class="flex space-x-4">
                    <a href="#" class="text-green-100 hover:text-white"><i class="fab fa-twitter"></i></a>
                    <a href="#" class="text-green-100 hover:text-white"><i class="fab fa-github"></i></a>
                    <a href="#" class="text-green-100 hover:text-white"><i class="fab fa-linkedin"></i></a>
                </div>
            </div>
        </div>
    </footer>

</body>
</html>