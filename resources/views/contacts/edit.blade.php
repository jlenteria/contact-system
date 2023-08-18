<x-app-layout>
  <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
          <div class="bg-white sm:rounded-lg">
            <div class="p-6 text-gray-900 py-8">
            <div class="flex justify-between align-items">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ __('Edit Contact') }}
                </h2>
              </div>
              <form method="POST" action="{{route('contacts.update', $contact->id)}}">
                @csrf
                @method('PUT')

                <div class="mt-5">
                  <x-input-label for="name" :value="__('Name')" />
                  <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" value="{{$contact->name}}" required autofocus autocomplete="name" />
                </div>
                <div class="mt-5">
                  <x-input-label for="company" :value="__('Company')" />
                  <x-text-input id="company" class="block mt-1 w-full" type="text" name="company" value="{{$contact->company}}" required autofocus autocomplete="company" />
                </div>
                <div class="mt-5">
                  <x-input-label for="phone" :value="__('Phone')" />
                  <x-text-input id="phone" class="block mt-1 w-full" type="text" name="phone" value="{{$contact->phone}}" required autofocus autocomplete="phone" />
                </div>
                <div class="mt-4">
                    <x-input-label for="email" :value="__('Email')" />
                    <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" value="{{$contact->email}}" required autocomplete="username" />
                </div>
                <x-primary-button class="mt-5" type="submit">Submit</x-primary-button>
              </form>
            </div>
          </div> 
      </div>
  </div>
</x-app-layout>
