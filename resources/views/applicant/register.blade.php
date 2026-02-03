<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Applicant Registration</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>
<body class="bg-gray-100">

    
    <header class="bg-white shadow">
        <div class="flex items-center justify-between max-w-6xl px-4 py-4 mx-auto">
            <h1 class="text-xl font-semibold text-gray-800">
                Teacher Application System
            </h1>

            <a href="{{ route('login') }}"
               class="text-sm text-indigo-600 hover:underline">
                Admin Login
            </a>
        </div>
    </header>

    
    <main class="max-w-3xl p-8 mx-auto mt-10 mb-10 bg-white rounded-lg shadow">

        <h2 class="mb-6 text-2xl font-semibold text-gray-800">
            Applicant Registration (Screen-1)
        </h2>

        <form method="POST" action="{{ route('applicant.register.store') }}" class="space-y-5">
            @csrf

            
            <div>
                <label class="block mb-1 font-medium">
                    Have you already applied in Advt. No. 01/2024?
                </label>
                <select name="already_applied" class="w-full px-3 py-2 border rounded">
                    <option value="">Select</option>
                    <option value="1">Yes</option>
                    <option value="0">No</option>
                </select>
            </div>

            
            <div>
                <label class="block mb-1 font-medium">Post</label>
                <input type="text" name="post" value="Teacher"
                    class="w-full px-3 py-2 bg-gray-100 border rounded" readonly>
            </div>

            
            <div>
                <label class="block mb-1 font-medium">Subject</label>
                <select name="subject" class="w-full px-3 py-2 border rounded">
                    <option value="">Select Subject</option>
                    <option>English</option>
                    <option>Maths</option>
                    <option>Hindi</option>
                    <option>Agriculture</option>
                </select>
                <p class="mt-2 text-xs text-gray-500">
                    In case of selection of Agriculture B.Ed is not mandatory, for rest fields B.Ed. is mandatory.
                </p>
            </div>

            <div>
                <label class="block mb-1 font-medium">Gender</label>
                <select name="gender" class="w-full px-3 py-2 border rounded">
                    <option value="">Select</option>
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                    <option value="others">Others</option>
                </select>
            </div>


            <div class="mb-4">
                <label class="block mb-1 font-medium">
                    Are you physically handicapped?
                </label>

                <select name="physically_handicapped"
                        id="physically_handicapped"
                        class="w-full px-3 py-2 border rounded"
                        onchange="toggleHandicapField()"
                        required>
                    <option value="">-- Select --</option>
                    <option value="0">No</option>
                    <option value="1">Yes</option>
                </select>
            </div>

            
            <div class="hidden mb-4" id="handicap_reason_box">
                <label class="block mb-1 font-medium">
                    Please mention disability
                </label>

                <input type="text"
                    name="handicap_reason"
                    id="handicap_reason"
                    class="w-full px-3 py-2 border rounded"
                    placeholder="Mention disability">
            </div>

            
            <div>
                <label class="block mb-1 font-medium">Category</label>
                <select name="category" class="w-full px-3 py-2 border rounded">
                    <option value="">Select</option>
                    <option value="general">General</option>
                    <option value="st">ST</option>
                    <option value="sc">SC</option>
                    <option value="obc">OBC</option>
                </select>
                <p class="mt-2 text-xs text-gray-500">
                    other than general category, at the time of document uploading, upload caste certificate
                </p>
            </div>

            
            <div>
                <label class="block mb-1 font-medium">Date of Birth</label>
                <input type="date" name="dob"
                    class="w-full px-3 py-2 border rounded">
            </div>

            
            <div>
                <label class="block mb-1 font-medium">Full Name</label>
                <input type="text" name="name"
                    class="w-full px-3 py-2 border rounded">
            </div>

            
            <div>
                <label class="block mb-1 font-medium">Mobile No</label>
                <input type="text" name="mobile"
                    class="w-full px-3 py-2 border rounded">
            </div>

            
            <div>
                <label class="block mb-1 font-medium">Email (Username)</label>
                <input type="email" name="email"
                    class="w-full px-3 py-2 border rounded">
            </div>

            
            <div>
                <label class="block mb-1 font-medium">Password</label>
                <input type="password" name="password"
                    class="w-full px-3 py-2 border rounded">
            </div>

            
            <div>
                <label class="block mb-1 font-medium">Confirm Password</label>
                <input type="password" name="password_confirmation"
                    class="w-full px-3 py-2 border rounded">
            </div>

            
            <div class="pt-4">
                <button type="submit"
                    class="w-full py-2 text-white transition bg-indigo-600 rounded hover:bg-indigo-700">
                    Register & Continue
                </button>
            </div>

        </form>
    </main>

    <script>
        function toggleHandicapField() {
            const select = document.getElementById('physically_handicapped');
            const box = document.getElementById('handicap_reason_box');
            const input = document.getElementById('handicap_reason');

            if (select.value === '1') {
                box.classList.remove('hidden');
                input.required = true;
            } else {
                box.classList.add('hidden');
                input.value = '';
                input.required = false;
            }
        }
    </script>
</body>
</html>
