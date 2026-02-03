<header>
    <nav class="flex items-center justify-between px-6 py-3 bg-white shadow">
        <h1 class="text-xl font-semibold text-gray-800">
            Teacher Application
        </h1>

        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit"
                class="font-medium text-red-600 hover:text-red-800">
                Logout
            </button>
        </form>
    </nav>
</header>