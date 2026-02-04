<x-admin-layout>
<div class="max-w-4xl p-6 mx-auto bg-white rounded shadow">

<h2 class="mb-4 text-xl font-semibold">Step-3 : Document Upload</h2>

@if ($errors->any())
<div class="p-3 mb-4 text-red-700 bg-red-100 rounded">
    <ul class="list-disc list-inside">
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<form method="POST" action="{{ route('applicant.step3.store') }}" enctype="multipart/form-data">
@csrf

<label>Photo</label>
<input type="file" name="photo" class="w-full mb-3 border">

<label>Signature</label>
<input type="file" name="signature" class="w-full mb-3 border">

<label>Date of Birth Proof</label>
<input type="file" name="dob_proof" class="w-full mb-3 border">

<label>ID Proof (Aadhaar / PAN)</label>
<input type="file" name="id_proof" class="w-full mb-6 border">

<button class="px-6 py-2 text-white bg-green-600 rounded">
    Save & Continue
</button>

</form>
</div>
</x-admin-layout>
