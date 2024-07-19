<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <style>
        table tr:nth-child(odd) {
    background-color: #f8c291;
}

table tr:nth-child(even) {
    background-color: #82ccdd;
}

    </style>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body>
    <header class="bg-white shadow">
        <div class="container mx-auto flex items-center justify-between py-4 px-6">
            <div class="flex items-center">
                <div class="mr-6">
                    <img src="img/logotpk.png" alt="Logo IPC" class="h-14">
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
        <table border="1">
           @foreach ($data as $item)
           @endforeach
        </table>
        <div class="container mx-auto mt-8">
            <section class="text-center">
                <h1 class="text-4xl font-bold text-gray-900 mb-4">Welcome to Tickets</h1>
                <p class="text-lg text-gray-600">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec tristique mattis urna, et iaculis dolor mollis vel.</p>
                <table>
                    @foreach ($data as $item)
        <tr style="background-color: {{ $loop->iteration % 2 == 0 ? '#f8c291' : '#82ccdd' }}; margin-bottom: 5px;">
            <td style="padding: 10px; margin-bottom: 5px;">
                {{ $item->title }}
            </td>
        </tr>
    @endforeach
                </table>
                
            </section>
            <section class="mt-8 bg-white shadow rounded-lg p-6">
                <!-- Isi konten dashboard -->
            </section>
        </div>
    </main>
</body>
</html>

    