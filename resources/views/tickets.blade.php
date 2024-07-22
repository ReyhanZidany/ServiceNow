<!-- tickets.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ asset('img/ticketwave.png') }}" type="image/x-icon">
    <title>Tickets</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        table {
            width: calc(100%);
        }
        td {
            padding: 10px;
            margin-bottom: 5px;
        }
        .odd {
            background-color: #e1e1e1;
        }
        .even {
            background-color: #f2f2f2;
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
                    <a href="{{ route('home') }}" class="text-gray-600 hover:text-gray-900">Home</a>
                    <a href="{{ route('tickets') }}" class="text-gray-600 hover:text-gray-900">Tickets</a>
                    <a href="{{ route('history') }}" class="text-gray-600 hover:text-gray-900">History</a>
                    <a href="{{ route('logout') }}" class="text-gray-600 hover:text-gray-900">Logout</a>
                </nav>
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
                <h1 class="text-4xl font-bold text-gray-900 mb-4">Welcome to Tickets</h1>
                <p class="text-lg text-gray-600 mb-4">LIST TICKET.</p>
                <a href="{{ route('tickets.create') }}" class="bg-blue-500 text-white p-2 rounded hover:bg-blue-600">Add Ticket</a>
                <div class="overflow-x-auto mt-4">
                    <table class="w-full mx-auto">
                        <thead>
                            <tr>
                                <th class="px-4 py-2 border">Title</th>
                                <th class="px-4 py-2 border">Description</th>
                                <th class="px-4 py-2 border">User ID</th>
                                <th class="px-4 py-2 border">Created At</th>
                                <th class="px-4 py-2 border">Solved At</th>
                                <th class="px-4 py-2 border">Solution Description</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $item)
                                <tr class="{{ $loop->iteration % 2 == 0 ? 'even' : 'odd' }}">
                                    <td class="px-4 py-2">{{ $item->title }}</td>
                                    <td class="px-4 py-2">{{ $item->description }}</td>
                                    <td class="px-4 py-2">{{ $item->user_id }}</td>
                                    <td class="px-4 py-2">{{ $item->createdat }}</td>
                                    <td class="px-4 py-2">{{ $item->solvedat }}</td>
                                    <td class="px-4 py-2">{{ $item->solutiondesc }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </section>
        </div>
    </main>
</body>
</html>
