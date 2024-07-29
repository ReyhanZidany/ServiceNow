<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ticket Detail</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="icon" href="{{ asset('img/ticketwave.png') }}" type="image/x-icon">
    <style>
        body {
            background-color: #ffffff;
            margin: 0;
            display: flex;
            flex-direction: column;
        }
        .navbar {
            background-color: #fafafa;
            color: white;
            padding: 16px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            width: 100%;
            position: fixed;
            top: 0;
            z-index: 1000;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }
        .navbar img {
            height: 40px;
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
            border-radius: 5px;
        }
        .profile-dropdown-content a {
            color: black;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
        }
        .profile-dropdown-content a:hover {
            background-color: #ddd;
            border-radius: 5px;
        }
        .profile-dropdown.open .profile-dropdown-content {
            display: block;
        }
        .sidebar {
            background-color: #e8e8e9;
            padding: 10px;
            width: 200px;
            height: calc(100vh - 64px);
            position: fixed;
            top: 64px;
            left: 0;
            transform: translateX(-200px);
            transition: transform 0.3s ease;
            margin-top: 10px;
        }
        .sidebar.open {
            transform: translateX(0);
        }
        .sidebar a {
            display: flex;
            align-items: center;
            color: #000000;
            padding: 10px;
            text-decoration: none;
            text-align: center;
            font-style: bold;
            border-radius: 10px;
            transition: background-color 0.3s, color 0.3s;
            margin-bottom: 10px;
            width: calc(100% + 20px); /* Extends the clickable area to the left */
            margin-left: -10px; /* Centers the link text */
            padding-left: 20px; /* Ensures text is properly aligned */
        }
        .sidebar a.active {
            background-color: #666666;
            color: white;
        }
        .sidebar a:hover:not(.active) {
            background-color: #555555;
            color: white;
        }
        .main-content {
            flex: 1;
            margin-left: 0;
            margin-top: 64px; /* Height of the navbar */
            padding: 20px;
            transition: margin-left 0.3s ease;
        }
        .main-content.shifted {
            margin-left: 200px;
        }
        .button-container {
            position: absolute;
            top: 10px;
            left: 10px;
        }
        .toggle-sidebar-button {
            display: inline-block;
            cursor: pointer;
            padding: 10px;
            border-radius: 5px;
            transition: background-color 0.3s;
        }
        .toggle-sidebar-button:hover {
            background-color: #555;
        }
        .sidebar-toggle-icon {
            font-size: 20px;
            color: #333;
        }
    </style>
    <script>
        function toggleDropdown() {
            var dropdown = document.getElementById("profileDropdown");
            dropdown.classList.toggle("open");
        }
        function toggleSidebar() {
            var sidebar = document.getElementById("sidebar");
            var mainContent = document.getElementById("mainContent");
            sidebar.classList.toggle("open");
            mainContent.classList.toggle("shifted");
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
    <div class="navbar">
        <div class="button-container">
            <div class="toggle-sidebar-button" onclick="toggleSidebar()">
                <i class="sidebar-toggle-icon">&#9776;</i>
            </div>
        </div>
        <a href="/home">
            <img src="{{ asset('img/ticketwave.png') }}" alt="Logo">
        </a>
        <div class="profile-dropdown">
            <button class="profile-button" onclick="toggleDropdown()">
                {{ Auth::user()->name }}
            </button>
            <div class="profile-dropdown-content" id="profileDropdown">
                <a href="#">View Profile</a>
                <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    Logout
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>
        </div>
    </div>

    <div class="sidebar" id="sidebar">
        <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}">Dashboard</a>
        <a href="{{ route('tickets.index') }}" class="{{ request()->routeIs('tickets.index') ? 'active' : '' }}">Tickets</a>
        <a href="{{ route('users.index') }}" class="{{ request()->routeIs('users.index') ? 'active' : '' }}">Users</a>
    </div>

    <div class="main-content" id="mainContent">
        <div class="container mx-auto mt-8 px-4">
            <div class="bg-white p-6 rounded-lg shadow-lg">
                <h1 class="text-2xl font-bold mb-4">Ticket Detail</h1>
                <div>
                    <p><strong>Ticket ID:</strong> {{ $ticket->ticket_id }}</p>
                    <p><strong>Title:</strong> {{ $ticket->title }}</p>
                    <p><strong>Description:</strong> {{ $ticket->description }}</p>
                    <p><strong>User ID:</strong> {{ $ticket->user_id }}</p>
                    <p><strong>Created At:</strong> {{ $ticket->createdat }}</p>
                    <p><strong>Status:</strong> 
                        @if(is_null($ticket->solvedat))
                            <span class="text-red-500">Unsolved</span>
                        @else
                            <span class="text-green-500">Solved</span>
                        @endif
                    </p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
