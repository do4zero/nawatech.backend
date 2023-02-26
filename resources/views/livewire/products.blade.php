<div>
  <div class="py-2">
    <div class="max-w-7xl mx-auto">
      <div class="flex justify-between mt-1">
        <div class="text-lg">Products List</div>
        <button
          wire:click="create()"
          class="bg-white hover:bg-blue-700 hover:text-white text-blue-500 py-1 mb-6 px-3 rounded my-3 mt-1 border border-blue-500"
        >
          <i class="fa fa-plus-square-o" aria-hidden="true"></i>
          Add Product
        </button>
      </div>

      <div class="relative mb-4">
        <div
          class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none"
        >
          <svg
            aria-hidden="true"
            class="w-5 h-5 text-gray-500 dark:text-gray-400"
            fill="none"
            stroke="currentColor"
            viewBox="0 0 24 24"
            xmlns="http://www.w3.org/2000/svg"
          >
            <path
              stroke-linecap="round"
              stroke-linejoin="round"
              stroke-width="2"
              d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"
            ></path>
          </svg>
        </div>
        <input
          type="search"
          id="default-search"
          class="block w-full p-3 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-white focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
          placeholder="Search Product . . ."
          wire:model="searchTerm"
        />
      </div>

      <div>
        @if (session()->has('message'))
        <div
          class="bg-teal-100 border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md my-3"
          role="alert"
        >
          <div class="flex">
            <div>
              <p class="text-sm">{{ session('message') }}</p>
            </div>
          </div>
        </div>
        @endif @if($isOpen) @include('livewire.create') @endif

        <div>
          @forelse($products as $product)
          <div class="bg-white rounded-md shadow-lg mb-4">
            <div class="p-2">
              <div class="font-bold text-lg">
                {{ $product->name }}
              </div>
              <div class="flex justify-between">
                <div>
                  Harga : Rp
                  {{ number_format($product->price,2,',','.') }}
                </div>
                <div>Stok : {{ $product->stok }}</div>
              </div>
            </div>
            <div
              class="h-[250px] overflow-hidden flex justify-center bg-gray-200"
            >
              <img
                src="{{asset($product->image)}}"
                class="object-contain h-[250px]"
              />
            </div>
            <div>
              <div class="flex rounded-md shadow-sm" role="group">
                <button
                  wire:click="edit({{ $product->id }})"
                  class="flex-1 px-4 py-1.5 text-sm font-medium text-white bg-slate-600 hover:bg-slate-900 hover:text-white focus:text-white dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:hover:text-white dark:hover:bg-gray-600"
                >
                  <i
                    class="fa fa-pencil-square-o text-white"
                    aria-hidden="true"
                  ></i>
                  Edit
                </button>
                <button
                  type="button"
                  wire:click="delete({{ $product->id }})"
                  class="flex-1 px-4 py-1.5 text-sm font-medium text-white bg-red-600 hover:bg-red-900 hover:text-white focus:text-white dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:hover:text-white dark:hover:bg-gray-600"
                >
                  <i
                    class="fa fa-trash-o text-white"
                    aria-hidden="true"
                  ></i>
                  Delete
                </button>
              </div>
            </div>
          </div>
          @empty
          <div>
            <span
              class="text-center p-2 w-full block bg-yellow-50 rounded-lg"
            >
              No Items data found.
            </span>
          </div>
          @endforelse
        </div>
        <div class="py-2">
          {{$products->links()}}
        </div>
      </div>
    </div>
  </div>
</div>

<script>
  function copyToClipboard(text) {
    var dummy = document.createElement('textarea');
    // to avoid breaking orgain page when copying more words
    // cant copy when adding below this code
    // dummy.style.display = 'none'
    document.body.appendChild(dummy);
    //Be careful if you use texarea. setAttribute('value', value), which works with "input" does not work with "textarea". – Eduard
    dummy.value = text;
    dummy.select();
    document.execCommand('copy');
    document.body.removeChild(dummy);
  }

  function salinToko(text) {
    copyToClipboard(text);
    alert('link toko berhasil disalin : ' + text);
  }

  function menujuToko(location) {
    window.location.href = location;
  }
</script>
