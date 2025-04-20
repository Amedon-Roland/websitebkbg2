{{-- filepath: d:\BKBG\websitebkbg2\resources\views\components\contact-form.blade.php --}}
<div class="max-w-5xl mx-auto px-6 py-10">
    <form {{-- method="POST" action="{{ route('contact.submit') --}}>
        @csrf

        <!-- Fullname and Email Row -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            <div class="flex flex-col">
                <label for="fullname" class="font-semibold mb-2 text-gray-700">Fullname</label>
                <input type="text" id="fullname" name="fullname" placeholder="e.g John Becker" value="{{ $fullname }}"
                    class="w-full h-[60px] border border-gray-800 px-4 py-2 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>

            <div class="flex flex-col">
                <label for="email" class="font-semibold mb-2 text-gray-700">Email</label>
                <input type="email" id="email" name="email" placeholder="johnbecker@gmail.com" value="{{ $email }}"
                    class="w-full h-[60px] border border-gray-800 px-4 py-2 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>
        </div>

        <!-- Message Field -->
        <div class="flex flex-col mb-8">
            <label for="message" class="font-semibold mb-2 text-gray-700">Message</label>
            <textarea id="message" name="message" placeholder="message"
                class="w-full h-[300px] border border-gray-800 px-4 py-2 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 resize-none" required>{{ $message }}</textarea>
        </div>

        <!-- Submit Button -->
        <div class="flex justify-center">
            <button type="submit"
                class="bg-blue-500 text-white px-8 py-4 rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-300">
                Send
            </button>
        </div>
    </form>
</div>

