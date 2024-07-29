<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ asset('img/ticketwave.png') }}" type="image/x-icon">
    <title>Ticket Details</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body>
    <header class="bg-white shadow">
        <div class="container mx-auto flex items-center justify-between py-2 px-6">
            <div class="flex items-center">
                <div class="mr-6">
                    <img src="{{ asset('img/logotpk.png') }}" alt="Logo IPC" class="h-12">
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
                    <a href="{{ route('profile') }}">Profile</a>
                    <a href="{{ route('logout') }}">Logout</a>
                </div>
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
                <h2 class="text-2xl font-semibold text-gray-900 mb-4">Ticket Details</h2>
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <h3 class="text-xl font-bold">{{ $ticket->title }}</h3>
                    <p class="text-gray-700">{{ $ticket->description }}</p>
                    <p class="text-gray-500 mt-4">Assigned to: {{ $ticket->user->name }}</p>
                    @if($ticket->image)
                        <div class="mb-4">
                            <img src="{{ asset('storage/' . $ticket->image) }}" alt="Ticket Image" class="w-full rounded">
                        </div>
                    @endif
                    <a href="{{ route('tickets.index') }}" class="bg-blue-500 text-white p-2 rounded hover:bg-blue-600 mt-4 inline-block">Back to Tickets</a>
                </div>
            </section>
        </div>
    </main>

    <script>
        function toggleDropdown() {
            var dropdown = document.getElementById("profileDropdown");
            dropdown.classList.toggle("open");
        }
        window.onclick = function(event) {
            if (!event.target.matches('.profile-button')) {
                var dropdowns = document.getElementsByClassName("profile-dropdown-content");
                for (var i = 0; i < dropdowns.length; i++) {
                    var openDropdown = dropdowns[i];
                    if (openDropdown.classList.contains('open')) {
                        openDropdown.classList.remove('open');
                    }
                }
            }
        }
    </script>
</body>
</html>
