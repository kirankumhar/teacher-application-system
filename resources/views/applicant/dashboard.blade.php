<x-admin-layout>
    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="p-6 bg-white rounded-lg shadow">
                <h3 class="mb-4 text-lg font-semibold">Personal Details</h3>
                <table class="w-full border">
                    <tr>
                        <th class="p-2 text-left border">Name</th>
                        <td class="p-2 border">{{ $user->name }}</td>
                    </tr>
                    <tr>
                        <th class="p-2 text-left border">Email</th>
                        <td class="p-2 border">{{ $user->email }}</td>
                    </tr>
                    <tr>
                        <th class="p-2 text-left border">Mobile</th>
                        <td class="p-2 border">{{ $user->applicant->mobile }}</td>
                    </tr>
                    <tr>
                        <th class="p-2 text-left border">Dob</th>
                        <td class="p-2 border">{{ $user->applicant->dob }}</td>
                    </tr>
                    <tr>
                        <th class="p-2 text-left border">Post</th>
                        <td class="p-2 border">{{ $user->applicant->post }}</td>
                    </tr>
                    <tr>
                        <th class="p-2 text-left border">Subject</th>
                        <td class="p-2 border">{{ $user->applicant->subject }}</td>
                    </tr>
                    <tr>
                        <th class="p-2 text-left border">Category</th>
                        <td class="p-2 border">{{ $user->applicant->category }}</td>
                    </tr>
                    <tr>
                        <th class="p-2 text-left border">Gender</th>
                        <td class="p-2 border">{{ $user->applicant->gender }}</td>
                    </tr>
                    <tr>
                        <th class="p-2 text-left border">Physically Handicapped</th>
                        <td class="p-2 border">
                            {{ $user->applicant->handicapped ? 'Yes' : 'No' }}
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</x-admin-layout>