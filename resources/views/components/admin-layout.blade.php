<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>

<body class="bg-gray-100">

    <!-- HEADER -->
    <x-admin-header />

    <div class="flex min-h-screen">

        <!-- SIDEBAR -->
        <aside class="w-64 text-white bg-indigo-700">
            <nav class="p-4 space-y-2">
                <a href="{{ route('admin.dashboard') }}"
                   class="block px-4 py-2 rounded hover:bg-indigo-600">
                    Dashboard
                </a>

                <a href="{{ route('admin.applicants.index') }}"
                    class="block px-4 py-2 rounded hover:bg-indigo-600">
                    Applicants
                </a>

                <a href="#"
                   class="block px-4 py-2 rounded hover:bg-indigo-600">
                    Approved Forms
                </a>

                <a href="#"
                   class="block px-4 py-2 rounded hover:bg-indigo-600">
                    Rejected Forms
                </a>
            </nav>
        </aside>

        <!-- MAIN CONTENT -->
        <main class="flex-1 p-6">
            {{ $slot }}
        </main>

    </div>

</body>
</html>
