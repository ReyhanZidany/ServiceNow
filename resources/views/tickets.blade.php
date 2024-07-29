<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tickets</title>
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
            background-color: #9e9d9d; /* Highlight color for active link */
            color: rgb(0, 0, 0);
        }
        .sidebar a:hover {
            background-color: #9e9d9d;
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
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 12px;
            border-bottom: 1px solid #ddd;
            border-top: 1px solid #ddd;
            border-radius: 5px;
            text-align: left;
        }
        th {
            background-color: #f4f4f4;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        tr:nth-child(odd) {
            background-color: #fafafa;
        }
        .profile-dropdown img {
            border: 2px solid black; /* Black border around the image */
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
                <img src="{{ asset('img/panjul.jpg') }}" alt="Profile Picture" class="h-8 w-8 rounded-full ml-2">
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
        <a href="{{ route('tickets') }}">
            <img src="{{ asset('img/list.png') }}" alt="Tickets Icon"> Tickets
        </a>
        <a href="{{ route('history') }}">
            <img src="{{ asset('img/list.png') }}" alt="History Icon"> History
        </a>
    </div>
    <div class="main-content" id="mainContent">
        <main class="container mx-auto mt-8 px-4">
            @if (session('success'))
                <div class="bg-green-500 text-white p-4 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif

            <section class="text-center">
                <div class="flex justify-between items-center mb-4">
                    <h1 class="text-4xl font-bold text-gray-900">List Tickets</h1>
                    @if(Auth::user()->role === 'servicedesk')
                    <a href="{{ route('tickets.create') }}" class="border-2 border-blue-500 bg-blue-500 text-white p-2 rounded hover:bg-blue-600">Add Ticket</a>
                    @endif
                </div>
                <div class="overflow-x-auto mt-4">
                    <table class="w-full mx-auto">
                        <thead>
                            <tr>
                                <th class="px-4 py-2">Ticket ID</th>
                                <th class="px-4 py-2">Problem Statement</th>
                                <th class="px-4 py-2">User ID</th>
                                <th class="px-4 py-2">Created At</th>
                                <th class="px-4 py-2">Status</th>
                                @if(Auth::user()->role !== 'servicedesk')
                                    <th class="px-4 py-2 border">Action</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $item)
                                @if(Auth::user()->role === 'servicedesk')
                                    <tr class="{{ $loop->iteration % 2 == 0 ? 'even' : 'odd' }}">
                                        <td class="px-4 py-2">
                                            <a href="{{ route('tickets.view', $item->id) }}" class="text-blue-500 hover:underline">
                                                {{ 'REQ' .$item->id }}
                                            </a>
                                        </td>
                                        <td class="px-4 py-2">{{ $item->title }}</td>
                                        <td class="px-4 py-2">{{ $item->user_id }}</td>
                                        <td class="px-4 py-2">{{ $item->createdat }}</td>
                                        <td class="px-4 py-2">
                                            @if(is_null($item->solvedat))
                                                <span class="text-red-500">Unsolved</span>
                                            @else
                                                <span class="text-green-500">Solved</span>
                                            @endif
                                        </td>
                                    </tr>
                                @else
                                    @if(is_null($item->solvedat))
                                        <tr class="{{ $loop->iteration % 2 == 0 ? 'even' : 'odd' }}">
                                            <td class="px-4 py-2">
                                                <a href="{{ route('tickets.view', $item->id) }}" class="text-blue-500 hover:underline">
                                                {{ $item->id }}
                                                </a>
                                            </td>
                                            <td class="px-4 py-2">{{ $item->title }}</td>
                                            <td class="px-4 py-2">{{ $item->user_id }}</td>
                                            <td class="px-4 py-2">{{ $item->createdat }}</td>
                                            <td class="px-4 py-2 text-red-500">Unsolved</td>
                                            <td class="px-4 py-2">
                                                <a href="{{ route('tickets.edit', $item->id) }}" class="text-blue-500 hover:text-blue-700">Solve Incident</a>
                                            </td>
                                        </tr>
                                    @endif
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </section>
        </main>
    </div>
</body>
</html>
