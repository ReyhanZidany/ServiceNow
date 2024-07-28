<!-- resources/views/profile.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
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
        .profile-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-top: 40px;
        }
        .profile-card {
            border-radius: 10px;
            padding: 20px;
            background-color: #ffffff;
            width: 400px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            text-align: left;
            border: 2px solid #ddd;
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        .profile-card img {
            border-radius: 50%;
            width: 100px;
            height: 100px;
            margin-bottom: 20px;
        }
        .profile-card h2 {
            font-size: 24px;
            margin-bottom: 10px;
            text-align: left; /* Tulisan di kiri */
        }
        .profile-card p {
            font-size: 18px;
            margin-bottom: 5px;
            text-align: left;
            width: 100%;
            display: flex;
            align-items: center;
        }
        .profile-card p span.label {
            font-weight: bold;
            width: 150px; /* Adjust as needed to align labels properly */
        }
        .profile-card p span.value {
            flex-grow: 1;
        }
        .profile-card button {
            margin-top: 10px;
            padding: 10px 20px;
            color: rgb(0, 0, 0);
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .profile-card input[type="file"] {
            margin-top: 10px;
            margin-bottom: 10px;
        }

        .profile-card button:hover {
            color: #45a049;
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
        function previewProfilePicture(event) {
        var reader = new FileReader();
        reader.onload = function(){
            var output = document.getElementById('profilePicturePreview');
            output.src = reader.result;
            output.onload = function() {
            URL.revokeObjectURL(output.src) // free memory
        }
        };
        reader.readAsDataURL(event.target.files[0]);

        // Copy file to hidden input
        var input = document.getElementById('profilePictureHiddenInput');
        input.files = event.target.files;
        }

        function uploadProfilePicture() {
            document.getElementById('profilePictureForm').submit();
        }
    </script>
</head>
<body>
    <header class="navbar">
        <div class="flex items-center">
            <button class="text-black hover:text-gray-500 focus:outline-none" onclick="toggleSidebar()">
                ☰
            </button>
            <a href="{{ route('home') }}">
                <img src="{{ asset('img/logotpk.png') }}" alt="Logo IPC" class="ml-4">
            </a>
        </div>
        <div class="profile-dropdown" id="profileDropdown">
            <button class="flex items-center text-black hover:text-gray-300 focus:outline-none profile-button" onclick="toggleDropdown()">
                <span>{{ Auth::user()->name }}</span>
                <img src="{{ asset('storage/' . Auth::user()->profile_picture) }}" alt="Profile Picture" class="h-8 w-8 rounded-full ml-2">
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
        <div class="profile-container">
            <div class="profile-card">
                <img src="{{ Auth::user()->profile_picture }}" alt="Profile Picture" id="profilePicturePreview">
                <input type="file" id="profilePictureInput" style="display:none;" accept="image/*" onchange="previewProfilePicture(event)">
                <button onclick="document.getElementById('profilePictureInput').click()">Change Profile Picture</button>
                <h2>Profile</h2>
                <p><span class="label">Username</span> <span class="value">: {{ Auth::user()->name }}</span></p>
                <p><span class="label">User ID</span> <span class="value">: {{ Auth::user()->id }}</span></p>
                <p><span class="label">Email</span> <span class="value">: {{ Auth::user()->email }}</span></p>
                <p><span class="label">Role</span> <span class="value">: {{ Auth::user()->role }}</span></p>
                <form id="profilePictureForm" method="POST" action="{{ route('profile.upload') }}" enctype="multipart/form-data" style="display:none;">
                    @csrf
                    <input type="file" name="profile_picture" id="profilePictureHiddenInput">
                </form>
                <button onclick="uploadProfilePicture()">Save Profile Picture</button>
            </div>
        </div>
    </div>
</body>
</html>
