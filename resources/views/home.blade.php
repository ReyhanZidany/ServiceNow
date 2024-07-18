<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Home</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="antialiased bg-gray-100 dark:bg-gray-900">
    <div class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center sm:pt-0">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            <div class="flex justify-between items-center py-4 bg-white dark:bg-gray-800 border-b-4 border-indigo-600">
                <div class="flex-shrink-0">
                    <img src="{{ asset('img/logotpk.png') }}" alt="Logo IPC" class="h-16">
                </div>
                <nav class="space-x-4">
                    <a href="#" class="text-gray-600 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white">Dashboard</a>
                    <a href="#" class="text-gray-600 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white">Tickets</a>
                    <a href="#" class="text-gray-600 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white">History</a>
                    <a href="#" class="text-gray-600 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white">Logout</a>
                </nav>
            </div>
            <div class="mt-8 bg-white dark:bg-gray-800 overflow-hidden shadow sm:rounded-lg">
                <div class="p-6 sm:px-20 bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700">
                    <div>
                        <h2 class="text-2xl font-semibold text-gray-900 dark:text-gray-100">Welcome to TicketMaster</h2>
                    </div>
                    <div class="mt-4 text-gray-500 dark:text-gray-400 text-sm">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec tristique mattis urna, et iaculis dolor mollis vel.
                    </div>
                </div>
                <div class="p-6 sm:px-20 bg-white dark:bg-gray-800">
                    <!-- Isi konten dashboard-->
                </div>
            </div>
        </div>
    </div>
</body>
</html>
