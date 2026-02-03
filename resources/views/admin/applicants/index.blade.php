<x-admin-layout>
     <div class="p-6 bg-white rounded shadow">

        <h2 class="mb-4 text-xl font-semibold">Applicants List</h2>

        <table class="w-full border border-collapse">
            <thead class="bg-gray-100">
                <tr>
                    <th class="p-2 border">#</th>
                    <th class="p-2 border">Name</th>
                    <th class="p-2 border">Email</th>
                    <th class="p-2 border">Post</th>
                    <th class="p-2 border">Subject</th>
                    <th class="p-2 border">Category</th>
                    <th class="p-2 border">Gender</th>
                </tr>
            </thead>

            <tbody>
                @forelse($applicants as $index => $applicant)
                    <tr class="hover:bg-gray-50">
                        <td class="p-2 border">{{ $index + 1 }}</td>
                        <td class="p-2 border">{{ $applicant->user->name }}</td>
                        <td class="p-2 border">{{ $applicant->user->email }}</td>
                        <td class="p-2 border">{{ $applicant->post }}</td>
                        <td class="p-2 border">{{ $applicant->subject }}</td>
                        <td class="p-2 border">{{ $applicant->category }}</td>
                        <td class="p-2 border">{{ $applicant->gender }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="p-4 text-center text-gray-500 border">
                            No applicants found
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>

    </div>
</x-admin-layout>