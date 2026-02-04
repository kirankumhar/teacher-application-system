<x-admin-layout>
    <div class="max-w-5xl p-6 mx-auto bg-white rounded shadow">

        <h2 class="mb-4 text-xl font-semibold">Step-2 : Personal & Education</h2>

        @if ($errors->any())
            <div class="p-4 mb-6 text-red-700 bg-red-100 border border-red-300 rounded">
                <p class="mb-2 font-semibold">Please fix the following errors:</p>
                <ul class="pl-5 list-disc">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

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

            {{-- GRADUATION --}}
            <div class="p-4 mb-4 border rounded">
                <h4 class="mb-2 font-medium">Graduation</h4>

                <input name="grad_board" class="w-full p-2 mb-2 border"
                    placeholder="University / Board" required>

                <input name="grad_subject" class="w-full p-2 mb-2 border"
                    placeholder="Subjects" required>

                <input name="grad_year" type="number" class="w-full p-2 mb-2 border"
                    placeholder="Year of Passing (YYYY)" required>

                <input name="grad_marks" type="number"
                    class="w-full p-2 mb-1 border edu-marks"
                    data-min="50" data-target="grad"
                    min="0" max="500" required>

                <p class="mb-2 text-sm text-gray-600">
                    Percentage: <span id="grad_percent">0%</span> |
                    Status: <span id="grad_status" class="font-semibold"></span>
                </p>

                <input name="grad_cert_no" class="w-full p-2 border"
                    placeholder="Certificate No. (optional)">
            </div>

            {{-- POST GRADUATION --}}
            <div class="p-4 mb-4 border rounded">
                <h4 class="mb-2 font-medium">Post Graduation (if any)</h4>

                <input name="pg_board" class="w-full p-2 mb-2 border"
                    placeholder="University / Board">

                <input name="pg_subject" class="w-full p-2 mb-2 border"
                    placeholder="Subjects">

                <input name="pg_year" type="number" class="w-full p-2 mb-2 border"
                    placeholder="Year of Passing (YYYY)">

                <input name="pg_marks" type="number"
                    class="w-full p-2 mb-1 border edu-marks"
                    data-min="60" data-target="pg"
                    min="0" max="500">

                <p class="mb-2 text-sm text-gray-600">
                    Percentage: <span id="pg_percent">0%</span> |
                    Status: <span id="pg_status" class="font-semibold"></span>
                </p>

                <input name="pg_cert_no" class="w-full p-2 border"
                    placeholder="Certificate No.">
            </div>

            {{-- B.Ed --}}
            <div class="p-4 mb-4 border rounded">
                <h4 class="mb-2 font-medium">B.Ed (if any)</h4>

                <input name="bed_board" class="w-full p-2 mb-2 border"
                    placeholder="University / Board">

                <input name="bed_subject" class="w-full p-2 mb-2 border"
                    placeholder="Subjects">

                <input name="bed_year" type="number" class="w-full p-2 mb-2 border"
                    placeholder="Year of Passing (YYYY)">

                <input name="bed_marks" type="number"
                    class="w-full p-2 mb-1 border edu-marks"
                    data-min="60" data-target="bed"
                    min="0" max="500">

                <p class="mb-2 text-sm text-gray-600">
                    Percentage: <span id="bed_percent">0%</span> |
                    Status: <span id="bed_status" class="font-semibold"></span>
                </p>

                <input name="bed_cert_no" class="w-full p-2 border"
                    placeholder="Certificate No.">
            </div>
            <button class="px-6 py-2 text-white bg-blue-600 rounded">
                Save & Continue
            </button>
        </form>
    </div>
    <script>
    document.querySelectorAll('.edu-marks').forEach(input => {
        input.addEventListener('input', function () {

            let marks = parseFloat(this.value);
            let minPercent = parseInt(this.dataset.min);
            let key = this.dataset.target;

            if (isNaN(marks) || marks > 500) return;

            let percent = ((marks / 500) * 100).toFixed(2);

            document.getElementById(key + '_percent').innerText = percent + '%';

            let statusEl = document.getElementById(key + '_status');

            if (percent >= minPercent) {
                statusEl.innerText = 'Eligible';
                statusEl.className = 'font-semibold text-green-600';
            } else {
                statusEl.innerText = 'Not Eligible';
                statusEl.className = 'font-semibold text-red-600';
            }
        });
    });
    </script>
</x-admin-layout>
