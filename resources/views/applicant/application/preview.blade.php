<x-admin-layout>
    <div class="max-w-5xl p-6 mx-auto bg-white rounded shadow">

        <h2 class="mb-4 text-xl font-semibold">Application Preview</h2>

        {{-- BASIC INFO --}}
        <h3 class="mb-2 font-semibold">Basic Information</h3>
        <p><b>Name:</b> {{ $applicant->user->name }}</p>
        <p><b>DOB:</b> {{ \Carbon\Carbon::parse($applicant->dob)->format('d-m-Y') }}</p>
        <p><b>Category:</b> {{ strtoupper($applicant->category) }}</p>
        <p><b>Gender:</b> {{ ucfirst($applicant->gender) }}</p>
        <p><b>Mobile:</b> {{ $applicant->mobile }}</p>

        <hr class="my-4">

        {{-- PERSONAL INFO --}}
        <h3 class="mb-2 font-semibold">Personal Information</h3>
        <p><b>Address:</b> {{ $applicant->address }}</p>
        <p><b>ID Proof:</b> {{ strtoupper($applicant->aadhaar_pan_type) }} - {{ $applicant->aadhaar_pan_no }}</p>

        <hr class="my-4">

        {{-- EDUCATION --}}
        <h3 class="mb-2 font-semibold">Education</h3>

        @foreach ($applicant->educations as $edu)
            <div class="p-3 mb-3 border rounded">
                <p><b>Level:</b> {{ ucfirst($edu->level) }}</p>
                <p><b>Board / University:</b> {{ $edu->board_university }}</p>
                <p><b>Subjects:</b> {{ $edu->subjects }}</p>
                <p><b>Year:</b> {{ $edu->year_of_passing }}</p>
                <p><b>Marks:</b> {{ $edu->marks_obtained }} / 500</p>
                <p><b>Division:</b> {{ $edu->division }}</p>
                <p><b>Certificate No:</b> {{ $edu->certificate_no }}</p>
            </div>
        @endforeach

        <hr class="my-4">

        {{-- DOCUMENTS --}}
        <h3 class="mb-2 font-semibold">Uploaded Documents</h3>

        @foreach ($applicant->documents as $doc)
            <p>
                {{ ucfirst($doc->document_type) }} :
                <a href="{{ asset('storage/'.$doc->file_path) }}" target="_blank"
                   class="text-blue-600 underline">
                    View
                </a>
            </p>
        @endforeach

        <hr class="my-4">

        <form method="POST" action="{{ route('applicant.final.submit') }}">
            @csrf
            <button class="px-6 py-2 text-white bg-green-600 rounded">
                Final Submit & Download PDF
            </button>
        </form>

    </div>
</x-admin-layout>
