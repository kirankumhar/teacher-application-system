<x-admin-layout>
    <div class="max-w-3xl p-6 mx-auto bg-white rounded shadow">
    <h2 class="mb-4 text-xl font-semibold">Step 1 : Payment Details</h2>

    <form method="POST" action="" enctype="multipart/form-data">
        @csrf

        <div class="mb-4">
            <label>Bank Name</label>
            <input type="text" name="bank_name" class="w-full p-2 border" required>
        </div>

        <div class="mb-4">
            <label>Amount</label>
            <input type="text" value="₹ {{ $amount }}" class="w-full p-2 bg-gray-100 border" readonly>
        </div>

        <div class="mb-4">
            <label>Payment Reference No</label>
            <input type="text" name="payment_ref" class="w-full p-2 border" required>
        </div>

        <div class="mb-4">
            <label>Payment Date</label>
            <input type="date" name="payment_date" class="w-full p-2 border" required>
        </div>

        <div class="mb-4">
            <label>Upload Receipt</label>
            <input type="file" name="receipt" class="w-full p-2 border" required>
        </div>

        <button class="px-6 py-2 text-white bg-indigo-600 rounded">
            Save & Continue
        </button>
    </form>
</div>
</x-admin-layout>