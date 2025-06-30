<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to Essential Nigeria</title>
    <style>
        /* Tailwind CSS Inline Styling */
        body {
            font-family: 'Arial', sans-serif;
        }
    </style>
</head>

<body class="bg-gray-50 p-8">

    <div class="max-w-2xl mx-auto bg-white shadow-lg rounded-lg overflow-hidden">
        <div class="bg-blue-600 p-6 text-white">
            <h1 class="text-3xl font-bold">Welcome to Essential Nigeria!</h1>
        </div>

        <div class="p-6">
            <p class="text-lg text-gray-700 mb-4">Hello {{ $email }},</p>

            <p class="text-gray-600">
                Thank you for subscribing to Essential Nigeria! We're thrilled to have you on board.
            </p>

            <p class="mt-4 text-gray-600">
                Stay tuned for exciting updates, news, and exclusive offers from Essential Nigeria.
            </p>

            {{-- <div class="mt-8">
                <a href="{{ url('/') }}" class="bg-blue-600 text-white font-semibold py-2 px-4 rounded-full hover:bg-blue-700">
                    Visit our website
                </a>
            </div> --}}
        </div>

        <div class="bg-gray-100 p-4 text-center text-sm text-gray-600">
            <p>&copy; 2025 Essential Nigeria. All rights reserved.</p>
        </div>
    </div>

</body>

</html>
