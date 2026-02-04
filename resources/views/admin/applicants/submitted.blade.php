<x-admin-layout>

    <div class="p-6">
        <h2 class="mb-4 text-xl font-semibold text-gray-800">
            Submitted Applications
        </h2>

        <div class="overflow-x-auto bg-white rounded-lg shadow">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-4 py-3 text-sm font-medium text-left text-gray-600">#</th>
                        <th class="px-4 py-3 text-sm font-medium text-left text-gray-600">Name</th>
                        <th class="px-4 py-3 text-sm font-medium text-left text-gray-600">Subject</th>
                        <th class="px-4 py-3 text-sm font-medium text-left text-gray-600">Category</th>
                        <th class="px-4 py-3 text-sm font-medium text-left text-gray-600">Ack. No</th>
                        <th class="px-4 py-3 text-sm font-medium text-left text-gray-600">Submitted On</th>
                        <th class="px-4 py-3 text-sm font-medium text-center text-gray-600">Action</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-200">
                    @forelse($applications as $index => $app)
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-3 text-sm text-gray-700">
                                {{ $index + 1 }}
                            </td>

                            <td class="px-4 py-3 text-sm text-gray-700">
                                {{ $app->user->name }}
                            </td>

                            <td class="px-4 py-3 text-sm text-gray-700">
                                {{ $app->subject }}
                            </td>

                            <td class="px-4 py-3 text-sm text-gray-700">
                                {{ $app->category }}
                            </td>

                            <td class="px-4 py-3 text-sm text-gray-700">
                                {{ $app->acknowledgement_no }}
                            </td>

                            <td class="px-4 py-3 text-sm text-gray-700">
                                {{ $app->submitted_at?->format('d-m-Y') }}
                            </td>

                            <td class="px-4 py-3 text-center">
                                <a href="{{ route('admin.applicants.show', $app->id) }}"
                                   class="inline-flex items-center px-3 py-1 text-sm font-medium text-white bg-blue-600 rounded hover:bg-blue-700">
                                    View
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-4 py-6 text-center text-gray-500">
                                No submitted applications found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</x-admin-layout>
