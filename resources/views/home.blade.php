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
            justify-content: center;
            align-items: flex-start; /* Align items to the start (top) */
            height: calc(100vh - 64px); /* Adjust for navbar height */
            padding-top: 40px; /* Add padding to move content down */
            text-align: center;
        }
        .ticket {
            border-radius: 30px; /* Rounded corners */
            padding: 20px;
            background-color: #e3e3e3;
        }
        .total-tickets {
            font-size: 48px;
            font-weight: bold;
            color: #4a90e2;
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
    </style>
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
                    <a href="{{ route('logout') }}" class="text-gray-600 hover:text-gray-900">Logout</a>
                </nav>
            </div>
        </div>
    </header>
    <main class="home-container">
        <div class="ticket">
            <h1 class="total-tickets">{{ $totalTickets }}</h1>
            <p>Total Tickets</p>
        </div>
    </main>
</body>
</html>
