<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ asset('img/ticketwave.png') }}" type="image/x-icon">
    <title>History</title>
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
            transform: translateX(-250px);
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
        .table-container {
            overflow-x: auto;
            padding: 20px;
            background-color: #ffffff;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 12px;
            border-top: 1px solid #ddd;
            border-bottom: 1px solid #ddd;
            text-align: left;
        }
        th {
            background-color: #f1f1f1;
        }
        .odd {
            background-color: #fafafa;
        }
        .even {
            background-color: #f2f2f2;
        }
        .profile-dropdown img {
            border-radius: 50%; /* Makes the image circular */
            width: 40px; /* Adjust the width as needed */
            height: 40px; /* Adjust the height as needed */
        }
        .search-wrapper {
            position: relative;
            display: flex;
            align-items: center;
        }
        .search-input {
            border: 3px solid transparent;
            border-radius: 4px;
            padding-left: 40px; /* Adjust based on icon size */
            transition: border 0.3s ease;
            flex-grow: 1;
            opacity: 0; /* Initially hidden */
            transition: opacity 0.3s ease, border 0.3s ease;
        }
        .search-input.active {
            border: 3px solid #ddd; /* Border color when active */
            opacity: 1; /* Make the input visible */
        }
        .search-icon {
            position: absolute;
            top: 50%;
            left: 10px;
            transform: translateY(-50%);
            cursor: pointer;
            background: none; /* Ensure no background is applied */
            border: none; /* Ensure no border is applied */
        }
        .submit-button {
            display: none; /* Initially hidden */
            color: white;
            margin-left: 10px;
            border: 2px solid #ffffff; /* Add border to button */
            padding: 3px 6px; /* Add padding for better appearance */
            border-radius: 7px; /* Rounded corners */
            background-color: #333ac1; /* Background color */
            cursor: pointer; /* Pointer cursor on hover */
        }
        .search-wrapper.show-submit .submit-button {
            display: inline-block; /* Show the button when active */
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
        function toggleSearch() {
            var searchWrapper = document.querySelector(".search-wrapper");
            var searchInput = document.getElementById("ticket_id");
            searchWrapper.classList.toggle("show-submit");
            searchInput.classList.toggle("active");
        }
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('toggleSearchBorder').addEventListener('click', toggleSearch);
        });
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
            <a href="{{ url('home') }}" >
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
        <div class="table-container">
            @if (session('success'))
                <div class="bg-green-500 text-white p-4 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif
            <h1 class="text-4xl font-bold text-gray-900 mb-6 text-center">History of Tickets</h1>

            <!-- History Table -->
            <table>
                <thead>
                    <tr>
                        <th><a href="{{ route('history', ['sort' => 'ticket_id']) }}">Ticket ID</a></th>
                        <th><a href="{{ route('history', ['sort' => 'activity']) }}">Activity</a></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($data as $item)
                        <tr class="{{ $loop->iteration % 2 == 0 ? 'even' : 'odd' }}">
                            <td>{{ 'REQ'. $item->ticket_id }}</td>
                            <td>{{ $item->activity }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="text-center py-4">No records found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

        </div>
    </div>
</body>
</html>
