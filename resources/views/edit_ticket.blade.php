<!-- resources/views/edit_ticket.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ asset('img/ticketwave.png') }}" type="image/x-icon">
    <title>Edit Ticket</title>
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
                </nav>
            </div>
            <div class="profile-dropdown" id="profileDropdown">
                <button class="flex items-center text-gray-600 hover:text-gray-900 focus:outline-none profile-button" onclick="toggleDropdown()">
                    <span>{{ Auth::user()->name }}</span>
                    <img src="{{ asset('img/ticketwave.png') }}" alt="Profile Picture" class="h-10 w-10 rounded-full ml-2">
                </button>
                <div class="profile-dropdown-content">
                    <a href="{{ route('logout') }}">Logout</a>
                </div>
            </div>
        </div>
    </header>

    <main>
        <div class="container mx-auto mt-8 px-4">
            <h2 class="text-2xl font-semibold text-gray-900 mb-4">Add Solution</h2>
            <form action="{{ route('tickets.update', $ticket->id) }}" method="POST" class="bg-white p-6 rounded-lg shadow-md">
                @csrf
                @method('PUT')
                <div class="mb-4">
                    <label for="solutiondesc" class="block text-gray-700 text-sm font-bold mb-2">Solution Description</label>
                    <textarea id="solutiondesc" name="solutiondesc" class="border border-gray-300 p-2 w-full rounded" rows="4" required></textarea>
                </div>
                <button type="submit" class="bg-blue-500 text-white p-2 rounded hover:bg-blue-600">Submit</button>
            </form>
        </div>
    </main>
</body>
</html>
