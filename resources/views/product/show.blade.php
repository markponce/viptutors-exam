<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Product ID # ' . $product->id) }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <x-auth-session-status class="mb-4 text-center" :status="session('status')" />
                    <form method="POST" action="{{route('product.destroy', ['product' => $product->id])}}" onsubmit="let isConfirm = confirm('Are you sure to delete?'); if (isConfirm) {return true }else {return false};">
                        @csrf
                        @method('DELETE')
                        <!-- Title -->
                        <div>
                            <x-input-label for="title" :value="__('Title')" />
                            <x-text-input disable="true" id="title" class="block mt-1 w-full" type="text" name="title"
                                :value="$product->title" :disabled="true" required autofocus autocomplete="title" />
                            <x-input-error :messages="$errors->get('title')" class="mt-2" />
                        </div>

                        <!-- Body -->
                        <div class="mt-4">
                            <x-input-label for="body" :value="__('Body')" />
                            {{-- <x-text-input id="body" class="block mt-1 w-full" type="text" name="body"
                                :value="old('body')" required autocomplete="body" /> --}}
                            <textarea id="body" disabled
                                class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
                                name="body" required autocomplete="body">{{$product->body}}</textarea>
                            <x-input-error :messages="$errors->get('body')" class="mt-2" />
                        </div>
                        <div class="flex items-center justify-end mt-4">
                            <a class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150 ms-4" href="{{route('product.index')}}">
                                @if (!empty(session('status')))
                                    GO TO LIST
                                @else
                                    BACK
                                @endif
                            </a>
                            <a class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150 ms-4" href="{{route('product.edit', ['product' => $product->id])}}">Edit</a>
                            @if ($product->user->id == Auth::user()->id)
                                <x-primary-button class="ms-4 text-red-800 dark:text-red-800">
                                    {{ __('Delete') }}
                                </x-primary-button>  
                                
                            @endif
                                                     
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>