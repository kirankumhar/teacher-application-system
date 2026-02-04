<x-admin-layout>

    <div class="p-6 space-y-6">

        {{-- Header --}}
        <div class="flex items-center justify-between">
            <h2 class="text-xl font-semibold text-gray-800">
                Application Details
            </h2>

            <span class="px-3 py-1 text-sm font-semibold rounded
                @if($applicant->status === 'submitted') bg-yellow-100 text-yellow-800
                @elseif($applicant->status === 'approved') bg-green-100 text-green-800
                @else bg-red-100 text-red-800 @endif">
                {{ ucfirst($applicant->status) }}
            </span>
        </div>

        {{-- Basic Info --}}
        <div class="p-5 bg-white rounded-lg shadow">
            <h3 class="mb-3 font-semibold text-gray-700">Basic Information</h3>

            <div class="grid grid-cols-1 gap-4 text-sm md:grid-cols-2">
                <div><strong>Name:</strong> {{ $applicant->user->name }}</div>
                <div><strong>Email:</strong> {{ $applicant->user->email }}</div>
                <div><strong>Mobile:</strong> {{ $applicant->mobile }}</div>
                <div><strong>Gender:</strong> {{ $applicant->gender }}</div>
                <div><strong>Category:</strong> {{ $applicant->category }}</div>
                <div><strong>Subject:</strong> {{ $applicant->subject }}</div>
                <div><strong>DOB:</strong> {{ $applicant->dob?->format('d-m-Y') }}</div>
                <div><strong>Address:</strong> {{ $applicant->address }}</div>
            </div>
        </div>

        {{-- Payment --}}
        <div class="p-5 bg-white rounded-lg shadow">
            <h3 class="mb-3 font-semibold text-gray-700">Payment Details</h3>

            @if($applicant->payments)
                <div class="grid grid-cols-1 gap-4 text-sm md:grid-cols-2">
                    <div><strong>Bank:</strong> {{ $applicant->payments->bank_name }}</div>
                    <div><strong>Amount:</strong> ₹{{ $applicant->payments->amount }}</div>
                    <div><strong>Ref No:</strong> {{ $applicant->payments->payment_ref }}</div>
                    <div><strong>Date:</strong> {{ $applicant->payments->payment_date }}</div>

                    <div class="md:col-span-2">
                        <a href="{{ asset('storage/'.$applicant->payments->receipt) }}"
                           target="_blank"
                           class="text-blue-600 underline">
                            View Receipt
                        </a>
                    </div>
                </div>
            @else
                <p class="text-gray-500">Payment not found.</p>
            @endif
        </div>

        {{-- Education --}}
        <div class="p-5 bg-white rounded-lg shadow">
            <h3 class="mb-3 font-semibold text-gray-700">Educational Qualification</h3>

            <div class="overflow-x-auto">
                <table class="min-w-full text-sm border">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-2 py-1 border">Level</th>
                            <th class="px-2 py-1 border">Board / University</th>
                            <th class="px-2 py-1 border">Subjects</th>
                            <th class="px-2 py-1 border">Year</th>
                            <th class="px-2 py-1 border">Marks</th>
                            <th class="px-2 py-1 border">Division</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($applicant->educations as $edu)
                            <tr>
                                <td class="px-2 py-1 border">{{ $edu->level }}</td>
                                <td class="px-2 py-1 border">{{ $edu->board_university }}</td>
                                <td class="px-2 py-1 border">{{ $edu->subjects }}</td>
                                <td class="px-2 py-1 border">{{ $edu->year_of_passing }}</td>
                                <td class="px-2 py-1 border">{{ $edu->marks_obtained }}</td>
                                <td class="px-2 py-1 border">{{ $edu->division }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Documents --}}
        <div class="p-5 bg-white rounded-lg shadow">
            <h3 class="mb-3 font-semibold text-gray-700">Uploaded Documents</h3>

            <div class="grid grid-cols-1 gap-4 text-sm md:grid-cols-3">
                @foreach($applicant->documents as $doc)
                    <a href="{{ asset('storage/'.$doc->file_path) }}"
                       target="_blank"
                       class="block p-3 border rounded hover:bg-gray-50">
                        <strong>{{ ucfirst(str_replace('_',' ', $doc->document_type)) }}</strong>
                    </a>
                @endforeach
            </div>
        </div>

        {{-- Actions --}}
        @if($applicant->status === 'submitted')
            <div class="flex gap-4">
                <form method="POST" action="{{ route('admin.applicants.approve', $applicant->id) }}">
                    @csrf
                    <button class="px-5 py-2 text-white bg-green-600 rounded hover:bg-green-700">
                        Approve
                    </button>
                </form>

                <form method="POST" action="{{ route('admin.applicants.reject', $applicant->id) }}">
                    @csrf
                    <button class="px-5 py-2 text-white bg-red-600 rounded hover:bg-red-700"
                        onclick="return confirm('Are you sure you want to reject this application?')">
                        Reject
                    </button>
                </form>
            </div>
        @endif

    </div>

</x-admin-layout>
