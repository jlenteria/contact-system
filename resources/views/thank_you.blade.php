<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white sm:rounded-lg text-center">
                <div class="p-6 text-gray-900 py-8">
                    Thank you for registering
                </div>
                <a class="mb-5 inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150 cursor-pointer" href="{{ route('thank_you.proceed')}}">Continue</a>
            </div>
        </div>
    </div>
</x-app-layout>
