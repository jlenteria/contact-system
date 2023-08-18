<x-app-layout>
  <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
          <div class="bg-white sm:rounded-lg">
            <div class="p-6 text-gray-900 py-8">
              <div class="flex justify-between align-items">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ __('Contacts') }}
                </h2>
                <div class="flex">
                  <a href="{{route('contacts.add')}}" class="underline text-blue-600 hover:text-blue-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    {{__('Add Contacts')}}
                  </a>
                  <strong class="mx-1">|</strong>
                  <a href="{{route('contacts.index')}}" class="underline text-blue-600 hover:text-blue-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    {{__('Contacts')}}
                  </a>
                  <strong class="mx-1">|</strong>
                  <form method="POST" action="{{ route('logout') }}">
                      @csrf
                      <a href="{{route('logout')}}" onclick="event.preventDefault();
                                          this.closest('form').submit();" class="underline text-blue-600 hover:text-blue-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        {{__('Logout')}}
                      </a>
                  </form>
                  
                </div>
              </div>
              <div class="flex justify-end mt-2">
                <div></div>
                <input type="text" name="query" placeholder="Search" class="form-control w-1/5" id="query">
              </div>
              <div id="search-results">
              </div>
              <table id="table" class="mt-5 w-full text-base text-left text-gray-500 dark:text-gray-400 table-auto">
                <thead class="text-gray-700 bg-gray-100 dark:bg-gray-700 dark:text-gray-400">
                  <tr>
                    <th scope="col" class="px-6 py-3">{{__('Name')}}</th>
                    <th scope="col" class="px-6 py-3">{{__('Company')}}</th>
                    <th scope="col" class="px-6 py-3">{{__('Phone')}}</th>
                    <th scope="col" class="px-6 py-3">{{__('Email')}}</th>
                    <th scope="col" class="px-6 py-3">{{__('Options')}}</th>
                  </tr>
                </thead>
                <tbody id="tbody">
                  @foreach($contacts as $contact)
                    <tr class="bg-white border-b hover:bg-gray-50" >
                        <td class="px-6 py-4">{{$contact->name}}</td>
                        <td class="px-6 py-4">{{$contact->company}}</td>
                        <td class="px-6 py-4">{{$contact->phone}}</td>
                        <td class="px-6 py-4">{{$contact->email}}</td>
                        <td class="px-6 py-4">
                          <div class="flex">
                            <a href="{{route('contacts.edit', $contact->id)}}" class="underline text-blue-600 hover:text-blue-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                              {{__('Edit')}}
                            </a>
                            <strong class="mx-1">|</strong>
                            <a data-contact-id="{{$contact->id}}" class="delete-button cursor-pointer underline text-blue-600 hover:text-blue-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                              {{__('Delete')}}
                            </a>
                          </div>
                        </td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
              <div class="mt-5">
                {{ $contacts->links() }}
              </div>
            </div>
            <div id="deleteModal" class="hidden" style="position: absolute; background: gray; padding: 20px; top: 50%; left: 40%; border-radius: 5px">
              <h2 class="text-lg font-medium text-white">
                {{ __('Are you sure you want to DELETE?') }}
              </h2>
              <div class="mt-6 flex justify-end">
                <form id="deleteForm" action="" method="POST">
                  @csrf
                  @method('DELETE')
                  <button id="cancel-btn" type="button" style="background: white; padding: 5px 20px ">No</button>
                  <button id="confirm-delete" type="submit" style="background: red; color: white; padding: 5px 20px; margin-left: 5px; ">Yes</button>

                </form>
              </div>
            </div>
          </div>
      </div>
  </div>

</x-app-layout>

<script>
    document.addEventListener('DOMContentLoaded', function() {
      const modal = document.getElementById('deleteModal');
      const deleteButtons = document.querySelectorAll('.delete-button');
      const closeButton = document.getElementById('cancel-btn');
      const deleteForm = document.getElementById('deleteForm');
      if(deleteButtons !== null){
        deleteButtons.forEach(button => {
          button.addEventListener('click', function(){
            const contactId = button.getAttribute('data-contact-id');
            const actionUrl = "{{ route('contacts.destroy', ':id') }}".replace(':id', contactId);
            deleteForm.action = actionUrl;
            modal.classList.remove('hidden');
          })
        })
  
        deleteForm.addEventListener('submit', function(event) {
            event.preventDefault();
            this.submit();
        });
  
        closeButton.addEventListener('click', function(event){
          modal.classList.add('hidden');
        })
      }

      // search
      const searchResults = document.getElementById('search-results');
      const searchInput = document.getElementById('query');
      const tbody = document.getElementById('tbody');
      const tbodyOldHtml = tbody.innerHTML;
      searchInput.addEventListener('input', function(){
        const query = searchInput.value;

        if (query.trim() !== '') {
            tbody.innerHTML = '';
            fetch(`/ajaxResult?query=${encodeURIComponent(query)}`)
                .then(response => response.json())
                .then(data => {
                  
                    data.results.forEach(data => {
                      const tr = document.createElement('tr');
                      tr.innerHTML = `
                        <td class="px-6 py-4">${data.name}</td>
                        <td class="px-6 py-4">${data.company}</td>
                        <td class="px-6 py-4">${data.phone}</td>
                        <td class="px-6 py-4">${data.email}</td>
                      `
                      tbody.append(tr);
                    })
                })
                .catch(error => {
                    console.error('Error fetching search results:', error);
                });
        } else {
          tbody.innerHTML = tbodyOldHtml;
        }
      });

    });
</script>