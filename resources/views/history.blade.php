<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body>
    <header class="bg-white shadow">
        <div class="container mx-auto flex items-center justify-between py-4 px-6">
            <div class="flex items-center">
                <div class="mr-6">
                    <img src="img/logotpk.png" alt="Logo IPC" class="h-14">
                </div>
                <nav class="space-x-4">
                    <a href="{{ route('home') }}" class="text-gray-600 hover:text-gray-900">Home</a>
                    <a href="{{ route('tickets') }}" class="text-gray-600 hover:text-gray-900">Tickets</a>
                    <a href="#" class="text-gray-600 hover:text-gray-900">History</a>
                    <a href="{{ route('logout') }}" class="text-gray-600 hover:text-gray-900">Logout</a>
                </nav>
            </div>
        </div>
    </header>
    <main>
        <div class="container mx-auto mt-8">
            <section class="text-center">
                <h1 class="text-4xl font-bold text-gray-900 mb-4">This is History Page </h1>
                <p class="text-lg text-gray-600">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec tristique mattis urna, et iaculis dolor mollis vel.</p>
            </section>
            <section class="mt-8 bg-white shadow rounded-lg p-6">
                <!-- Isi konten dashboard -->
            </section>
        </div>
    </main>
</body>
</html>
