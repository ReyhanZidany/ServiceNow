<!-- resources/views/add_ticket.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ asset('img/ticketwave.png') }}" type="image/x-icon">
    <title>Add Ticket</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body>
    <header class="bg-white shadow">
        <div class="container mx-auto flex items-center justify-between py-4 px-6">
            <div class="flex items-center">
                <div class="mr-6">
                    <img src="{{ asset('img/logotpk.png') }}" alt="Logo IPC" class="h-14">
                </div>
                <nav class="space-x-4">
                    <a href="{{ route('home') }}" class="text-gray-600 hover:text-gray-900">Home</a>
                    <a href="{{ route('tickets') }}" class="text-gray-600 hover:text-gray-900">Tickets</a>
                    <a href="{{ route('history') }}" class="text-gray-600 hover:text-gray-900">History</a>
                    <a href="{{ route('logout') }}" class="text-gray-600 hover:text-gray-900">Logout</a>
                </nav>
            </div>
        </div>
    </header>

    <main>
        <div class="container mx-auto mt-8 px-4">
            @if (session('success'))
                <div class="bg-green-500 text-white p-4 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif

            <section class="text-center">
                <h2 class="text-2xl font-semibold text-gray-900 mb-4">Add New Ticket</h2>
                <form action="{{ route('tickets.store') }}" method="POST" class="bg-white p-6 rounded-lg shadow-md">
                    @csrf
                    <div class="mb-4">
                        <label for="title" class="block text-gray-700 text-sm font-bold mb-2">Title</label>
                        <input type="text" id="title" name="title" class="border border-gray-300 p-2 w-full rounded" required>
                    </div>
                    <div class="mb-4">
                        <label for="description" class="block text-gray-700 text-sm font-bold mb-2">Description</label>
                        <textarea id="description" name="description" class="border border-gray-300 p-2 w-full rounded" rows="4" required></textarea>
                    </div>
                    <button type="submit" class="bg-blue-500 text-white p-2 rounded hover:bg-blue-600">Add Ticket</button>
                </form>
            </section>
        </div>
    </main>
</body>
</html>
