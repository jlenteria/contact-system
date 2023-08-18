<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("Thank you for registering") }}
                </div>
                <a class="btn btn-primary" href="{{ route('thank_you.proceed')}}">Continue</a>
            </div>
        </div>
    </div>
</x-app-layout>
