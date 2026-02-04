<x-admin-layout>
    <div class="p-6">
        <h1 class="mb-6 text-2xl font-semibold text-red-600">
            Rejected Applications
        </h1>

        @if (session('error'))
            <div class="p-3 mb-4 text-red-700 bg-red-100 rounded">
                {{ session('error') }}
            </div>
        @endif

        <div class="overflow-x-auto bg-white rounded-lg shadow">
            <table class="min-w-full border border-gray-200">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-4 py-2 border">#</th>
                        <th class="px-4 py-2 border">Applicant Name</th>
                        <th class="px-4 py-2 border">Email</th>
                        <th class="px-4 py-2 border">Subject</th>
                        <th class="px-4 py-2 border">Category</th>
                        <th class="px-4 py-2 border">Rejected On</th>
                        <th class="px-4 py-2 border">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($applications as $application)
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-2 text-center border">
                                {{ $loop->iteration }}
                            </td>
                            <td class="px-4 py-2 border">
                                {{ $application->user->name }}
                            </td>
                            <td class="px-4 py-2 border">
                                {{ $application->user->email }}
                            </td>
                            <td class="px-4 py-2 border">
                                {{ $application->subject }}
                            </td>
                            <td class="px-4 py-2 border">
                                {{ $application->category }}
                            </td>
                            <td class="px-4 py-2 border">
                                {{ optional($application->updated_at)->format('d-m-Y') }}
                            </td>
                            <td class="px-4 py-2 text-center border">
                                <a href="{{ route('admin.applicants.show', $application->id) }}"
                                   class="text-blue-600 hover:underline">
                                    View
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="py-6 text-center text-gray-500">
                                No rejected applications found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-admin-layout>
