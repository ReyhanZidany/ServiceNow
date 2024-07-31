<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ asset('img/ticketwave.png') }}" type="image/x-icon">
    <title>View Ticket</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #ffffff;
            margin: 0;
            display: flex;
            flex-direction: column;
        }
        .navbar {
            background-color: #fafafa;
            color: black;
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
            transform: translateX(-250px);
            transition: transform 0.3s ease;
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
            background-color: #9e9d9d; /* Highlight color for active link */
            color: rgb(0, 0, 0);
        }
        .sidebar a:hover {
            background-color: #9e9d9d; /* Full-width highlight color */
            color: rgb(0, 0, 0);
        }
        .sidebar img {
            height: 15px;
            width: 15px;
            margin-right: 10px;
        }
        .main-content {
            margin-left: 0;
            flex-grow: 1;
            padding: 20px;
            padding-top: 80px;
            transition: margin-left 0.3s ease;
        }
        .main-content.shifted {
            margin-left: 200px;
        }
        .ticket-container {
            max-width: 900px;
            margin: 0 auto;
            margin-top: 15px;
            background-color: #f7f7f7;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }
        .ticket-header {
            border-bottom: 2px solid #e5e7eb;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }
        .ticket-header h1 {
            font-size: 2rem;
            font-weight: 700;
            color: #1f2937;
        }
        .ticket-detail p {
            margin-bottom: 10px;
            font-size: 1rem;
            color: #4b5563;
        }
        .ticket-detail p strong {
            color: #1f2937;
        }
        .status {
            padding: 10px;
            border-radius: 5px;
            color: #fff;
            font-weight: bold;
        }
        .status.solved {
            color: #10b981;
        }
        .status.unsolved {
            color: #ef4444;
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
    <header class="navbar">
        <div class="flex items-center">
            <button class="text-black hover:text-gray-500 focus:outline-none" onclick="toggleSidebar()">
                ☰
            </button>
            <a href="{{ url('home') }}">
                <img src="{{ asset('img/logotpk.png') }}" alt="Logo IPC" class="ml-4">
            </a>
        </div>
        <div class="profile-dropdown" id="profileDropdown">
            <button class="flex items-center text-black hover:text-gray-300 focus:outline-none profile-button" onclick="toggleDropdown()">
                <span>{{ Auth::user()->name }}</span>
                <img src="{{ asset('storage/profile_pictures/' . Auth::user()->profile_picture) }}" alt="Profile Picture" class="h-8 w-8 rounded-full ml-2">
            </button>
            <div class="profile-dropdown-content">
                <a href="{{ route('profile') }}">Profile</a>
                <a href="{{ route('logout') }}">Logout</a>
            </div>
        </div>
    </header>
    <div class="sidebar" id="sidebar">
        <a href="{{ route('home') }}">
            <img src="{{ asset('img/list.png') }}" alt="Home Icon"> Home
        </a>
        <a href="{{ route('tickets.index') }}">
            <img src="{{ asset('img/list.png') }}" alt="Tickets Icon"> Tickets
        </a>
        <a href="{{ route('history') }}">
            <img src="{{ asset('img/list.png') }}" alt="History Icon"> History
        </a>
    </div>
    <div class="main-content" id="mainContent">
        <div class="ticket-container">
            <div class="ticket-header text-center">
                <h1>Ticket Details</h1>
            </div>
            <div class="ticket-detail">
                <p><strong>Ticket ID:</strong> {{ 'REQ'. $ticket->id }}</p>
                <p><strong>Title:</strong> {{ $ticket->title }}</p>
                <p><strong>Description:</strong> {{ $ticket->description }}</p>
                <p><strong>Created At:</strong> {{ $ticket->createdat }}</p>
                <p><strong>Assigned to User ID:</strong> {{ $ticket->user_id }}</p>
                <p><strong>Image:</strong> <img src="{{ asset('storage/' . $ticket->image) }}" alt="Ticket Image" class="max-w-full h-auto"></p>
                <p><strong>Status:</strong>
                    @if ($ticket->solvedat)
                        <span class="status solved">Solved</span>
                    @else
                        <span class="status unsolved">Unsolved</span>
                    @endif
                </p>
                @if (!is_null($ticket->solvedat))
                    <p><strong>Solution Description:</strong> {{ $ticket->solutiondesc }}</p>
                    <p><strong>Solved At:</strong> {{ $ticket->solvedat}}</p>
                @else
                    <p><strong>Solution Description:</strong> Not yet solved</p>
                @endif
            </div>
        </div>
    </div>
</body>
</html>
