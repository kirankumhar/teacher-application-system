<x-admin-layout>
    <div class="max-w-5xl p-6 mx-auto bg-white rounded shadow">

        <h2 class="mb-4 text-xl font-semibold">Step-2 : Personal & Education</h2>

        <!-- READ ONLY INFO -->
        <div class="grid grid-cols-2 gap-4 mb-6 text-sm">
            <p><b>Name:</b> {{ $applicant->user->name }}</p>
            <p><b>Date of Birth:</b> {{ \Carbon\Carbon::parse($applicant->dob)->format('d-m-Y') }}</p>

            <p>
                <b>Age (as on 01-01-2024):</b>
                {{ $age->y }} Years
                {{ $age->m }} Months
                {{ $age->d }} Days
            </p>
            <p><b>Gender:</b> {{ ucfirst($applicant->gender) }}</p>
            <p><b>Category:</b> {{ strtoupper($applicant->category) }}</p>
            <p><b>Mobile:</b> {{ $applicant->mobile }}</p>
            <p><b>Email:</b> {{ $applicant->user->email }}</p>
        </div>

        <form method="POST" action="{{ route('applicant.step2.store') }}">
            @csrf

            <h3 class="mb-2 font-semibold">Personal Information</h3>

            <input name="address" class="w-full p-2 mb-3 border" placeholder="Address">

            <select name="id_proof_type" class="w-full p-2 mb-3 border">
                <option value="">Select ID Proof</option>
                <option value="aadhaar">Aadhaar</option>
                <option value="pan">PAN</option>
            </select>

            <input name="id_proof_no" class="w-full p-2 mb-6 border" placeholder="ID Proof Number">

            <hr class="my-4">

            <h3 class="mb-2 font-semibold">Education (Marks out of 500)</h3>

            <label>Graduation Marks *</label>
            <input name="grad_marks" class="w-full p-2 mb-3 border">

            <label>Post-Graduation Marks</label>
            <input name="pg_marks" class="w-full p-2 mb-3 border">

            <label>B.Ed Marks</label>
            <input name="bed_marks" class="w-full p-2 mb-6 border">

            <button class="px-6 py-2 text-white bg-blue-600 rounded">
                Save & Continue
            </button>
        </form>
    </div>
</x-admin-layout>
