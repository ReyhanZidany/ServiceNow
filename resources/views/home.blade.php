<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="icon" href="{{ asset('img/ticketwave.png') }}" type="image/x-icon">
    <style>
        body {
            background-color: #ffffff;
            margin: 0;
        }
        .home-container {
            display: flex;
            flex-direction: column; /* Stack items vertically */
            justify-content: center;
            align-items: center; /* Center items horizontally */
            height: calc(100vh - 64px); /* Adjust for navbar height */
            padding-top: 40px; /* Add padding to move content down */
            text-align: center;
        }
        .tickets-row {
            display: flex;
            gap: 30px; /* Space between columns */
            margin-bottom: 30px; /* Space below the row */
        }
        .ticket {
            border-radius: 30px; /* Rounded corners */
            padding: 40px; /* Increased padding for more space */
            background-color: #e3e3e3;
            width: 400px; /* Increased width for wider sections */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Add subtle shadow */
            text-align: center;
        }
        .unsolved-tickets {
            font-size: 70px;
            font-weight: bold;
            color: #ea1212;
            margin-bottom: 10px;
        }
        .solved-tickets {
            font-size: 70px;
            font-weight: bold;
            color: #4a90e2;
            margin-bottom: 10px;
        }
        .total-tickets {
            font-size: 70px;
            font-weight: bold;
            color: #28a745; /* Green color for total tickets */
            margin-bottom: 10px;
        }
        .navbar {
            background-color: #4a90e2;
            color: white;
            padding: 16px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
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
        <div class="container mx-auto flex items-center justify-between py-4 px-6">
            <div class="flex items-center">
                <div class="mr-6">
                    <img src="{{ asset('img/logotpk.png') }}" alt="Logo IPC" class="h-14">
                </div>
                <nav class="space-x-4">
                    <a href="#" class="text-gray-600 hover:text-gray-900">Home</a>
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
    <main class="home-container">
        <div class="tickets-row">
            <div class="ticket">
                <h1 class="unsolved-tickets">{{ $unsolvedTickets }}</h1>
                <p>Tickets Unresolved</p>
            </div>
            <div class="ticket">
                <h1 class="solved-tickets">{{ $solvedTickets }}</h1>
                <p>Tickets Solved</p>
            </div>
        </div>
        <div class="ticket">
            <h1 class="total-tickets">{{ $totalTickets }}</h1>
            <p>Total Tickets</p>
        </div>
    </main>
</body>
</html>
