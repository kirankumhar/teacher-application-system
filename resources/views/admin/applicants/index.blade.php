<x-admin-layout>
    <div class="p-6 bg-white rounded shadow">

        <h2 class="mb-4 text-xl font-semibold">Applicants List</h2>

        <div class="overflow-x-auto">
            <table class="w-full text-sm border border-collapse">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="p-2 border">#</th>
                        <th class="p-2 border">Name</th>
                        <th class="p-2 border">Email</th>
                        <th class="p-2 border">Post</th>
                        <th class="p-2 border">Subject</th>
                        <th class="p-2 border">Category</th>
                        <th class="p-2 border">Gender</th>
                        <th class="p-2 border">Status</th>
                        <th class="p-2 border">Reg. No.</th>
                        <th class="p-2 border">Action</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($applicants as $index => $applicant)
                        <tr class="hover:bg-gray-50">
                            <td class="p-2 border">{{ $index + 1 }}</td>

                            <td class="p-2 border">
                                {{ $applicant->user->name }}
                            </td>

                            <td class="p-2 border">
                                {{ $applicant->user->email }}
                            </td>

                            <td class="p-2 border">{{ $applicant->post }}</td>
                            <td class="p-2 border">{{ $applicant->subject }}</td>
                            <td class="p-2 border">{{ $applicant->category }}</td>
                            <td class="p-2 border">{{ $applicant->gender }}</td>

                            {{-- STATUS BADGE --}}
                            <td class="p-2 text-center border">
                                @if($applicant->status === 'submitted')
                                    <span class="px-2 py-1 text-xs text-yellow-800 bg-yellow-100 rounded">
                                        Submitted
                                    </span>
                                @elseif($applicant->status === 'approved')
                                    <span class="px-2 py-1 text-xs text-green-800 bg-green-100 rounded">
                                        Approved
                                    </span>
                                @elseif($applicant->status === 'rejected')
                                    <span class="px-2 py-1 text-xs text-red-800 bg-red-100 rounded">
                                        Rejected
                                    </span>
                                @else
                                    <span class="px-2 py-1 text-xs text-gray-600 bg-gray-100 rounded">
                                        Draft
                                    </span>
                                @endif
                            </td>

                            {{-- REGISTRATION NO --}}
                            <td class="p-2 text-center border">
                                {{ $applicant->registration_no ?? '-' }}
                            </td>

                            {{-- ACTIONS --}}
                            <td class="p-2 space-x-2 text-center border">
                                <a href="{{ route('admin.applicants.show', $applicant->id) }}"
                                   class="text-blue-600 hover:underline">
                                    View
                                </a>

                                @if($applicant->status === 'submitted')
                                    <form action="{{ route('admin.applicants.approve', $applicant->id) }}"
                                          method="POST"
                                          class="inline">
                                        @csrf
                                        <button class="text-green-600 hover:underline">
                                            Approve
                                        </button>
                                    </form>

                                    <form action="{{ route('admin.applicants.reject', $applicant->id) }}"
                                          method="POST"
                                          class="inline">
                                        @csrf
                                        <button class="text-red-600 hover:underline">
                                            Reject
                                        </button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="10" class="p-4 text-center text-gray-500 border">
                                No applicants found
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>
</x-admin-layout>
