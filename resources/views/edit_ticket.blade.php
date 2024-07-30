<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ asset('img/ticketwave.png') }}" type="image/x-icon">
    <title>Solve Ticket</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        .navbar a {
            color: white;
            text-decoration: none;
            padding: 0 15px;
        }
        .profile-dropdown {
            position: relative;
            display: inline-block;
        }
        .profile-dropdown-content {
            display: none;
            position: absolute;
            right: 0;
            background-color: white;
            min-width: 160px;
            box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
            z-index: 1;
        }
        .profile-dropdown-content a {
            color: black;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
        }
        .profile-dropdown-content a:hover {
            background-color: #ddd;
        }
        .profile-dropdown.open .profile-dropdown-content {
            display: block;
        }
        .profile-dropdown img {
            border-radius: 50%; /* Makes the image circular */
            width: 40px; /* Adjust the width as needed */
            height: 40px; /* Adjust the height as needed */
        }
    </style>
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
</head>
<body>
    <header class="bg-white shadow">
        <div class="container mx-auto flex items-center justify-between py-2 px-6">
            <div class="flex items-center">
                <div class="mr-6">
                    <a href="{{ url('home') }}" >
                    <img src="{{ asset('img/logotpk.png') }}" alt="Logo IPC" class="h-12">
                    </a>
                </div>
                <nav class="space-x-4">
                    <a href="{{ route('home') }}" class="text-gray-600 hover:text-gray-900">Home</a>
                    <a href="{{ route('tickets.index') }}" class="text-gray-600 hover:text-gray-900">Tickets</a>
                    <a href="{{ route('history') }}" class="text-gray-600 hover:text-gray-900">History</a>
                </nav>
            </div>
            <div class="profile-dropdown" id="profileDropdown">
                <button class="flex items-center text-gray-600 hover:text-gray-900 focus:outline-none profile-button" onclick="toggleDropdown()">
                    <span>{{ Auth::user()->name }}</span>
                    <img src="{{ asset('storage/profile_pictures/' . Auth::user()->profile_picture) }}" alt="Profile Picture" class="h-10 w-10 rounded-full ml-2">
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
            <h2 class="text-2xl font-semibold text-gray-900 mb-4">Solve Ticket</h2>
            <form action="{{ route('tickets.update', $ticket->id) }}" method="POST" class="bg-white p-6 rounded-lg shadow-md">
                @csrf
                @method('PUT')

                
                <div class="mb-4">
                    <label for="title" class="block text-gray-700 text-sm font-bold mb-2">Problem Statement</label>
                    <input type="text" name="title" id="title" class="w-full border-2 border-gray-300 rounded-lg p-3 bg-gray-100 shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500" value="{{ old('title', $ticket->title) }}" readonly>
                </div>

                <!-- Ticket Description -->
                <div class="mb-4">
                    <label for="description" class="block text-gray-700 text-sm font-bold mb-2">Description</label>
                    <textarea name="description" id="description" class="w-full border-2 border-gray-300 rounded-lg p-3 bg-gray-100 shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500" readonly>{{ old('description', $ticket->description) }}</textarea>
                </div>

                <!-- Solution Description -->
                <div class="mb-4">
                    <label for="solution" class="block text-gray-700 text-sm font-bold mb-2">Solution Description</label>
                    <textarea name="solution" id="solution" class="w-full border-2 border-gray-300 rounded-lg p-3 shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500" required>{{ old('solution', $ticket->solution) }}</textarea>
                </div>


                <button type="submit" class="bg-blue-500 text-white p-2 rounded hover:bg-blue-600">Submit</button>
            </form>
        </div>
    </main>
</body>
</html>
