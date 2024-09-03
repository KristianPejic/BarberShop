<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Uredi artikal: <span class="ml-1 font-normal text-red-500">{{$product->name}}</span>
            <span class="ml-1 font-black"> (ID: {{$product->id}})</span>
        </h2>
    </x-slot>

    <div class="py-12 max-w-7xl mx-auto px-5 sm:px-6 lg:px-8">

        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-5">
            <form method="POST" action="/product/{{$product->id}}" enctype="multipart/form-data">
                @csrf
                @method('PATCH')
                <div class="space-y-12">
                    <div class="border-b border-gray-900/10 pb-12">
                        <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">

                            <div class="sm:col-span-4">
                                <label for="name" class="block text-sm font-medium leading-6 text-gray-900">
                                    Ime artikla
                                </label>
                                <div class="mt-2">
                                    <div
                                        class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-orange-500 sm:max-w-md">
                                        <input type="text" name="name" id="name" value="{{$product->name}}"
                                            autocomplete="name"
                                            class="block flex-1 border-0 bg-transparent py-1.5 pl-3 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6"
                                            placeholder="Ime artikla...">
                                    </div>
                                </div>
                                @error('name')
                                    <p class="text-xs text-red-500 font-semibold py-2">*{{$message}}</p>
                                @enderror
                            </div>

                            <div class="col-span-full">
                                <label for="description" class="block text-sm font-medium leading-6 text-gray-900">
                                    Unesi opis artikla
                                </label>
                                <div class="mt-2">
                                    <textarea id="description" name="description" rows="3"
                                        class="px-2 block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-orange-500 sm:text-sm sm:leading-6"
                                        required>{{$product->description}}</textarea>
                                </div>
                                @error('description')
                                    <p class="text-xs text-red-500 font-semibold py-2">*{{$message}}</p>
                                @enderror
                            </div>

                            <div class="col-span-full">
                                <div class="max-w-md mx-auto sm:mx-0">
                                    <label for="description"
                                        class="block text-sm font-medium leading-6 text-gray-900 mb-2">
                                        Unesi sliku artikla
                                    </label>
                                    <input type="file" name="photo" id="photo" value="{{$product->photo}}"
                                        class="w-full text-gray-400 font-semibold text-sm bg-white border border-gray-300 file:cursor-pointer cursor-pointer file:border-0 file:py-3 file:px-4 file:mr-4 file:bg-gray-400 file:hover:bg-gray-500 file:text-white rounded shadow-sm" />
                                    <p class="text-xs text-gray-700 mt-2">PNG, JPG SVG, WEBP, and GIF are Allowed.</p>
                                </div>
                                @error('photo')
                                    <p class="text-xs text-red-500 font-semibold py-2">*{{$message}}</p>
                                @enderror
                            </div>

                            <div class="sm:col-span-6">
                                <label for="price" class="block text-sm font-medium leading-6 text-gray-900">Unesi
                                    redovnu cijenu (KM)</label>
                                <div class="mt-2">
                                    <div
                                        class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-orange-500 sm:max-w-md">
                                        <input type="text" name="price" id="price" autocomplete="price"
                                            class="block flex-1 border-0 bg-transparent py-1.5 pl-3 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6"
                                            placeholder="30,00" value="{{$product->price}}" required>
                                    </div>
                                </div>
                                @error('price')
                                    <p class="text-xs text-red-500 font-semibold py-2">*{{$message}}</p>
                                @enderror
                            </div>

                            <div class="sm:col-span-4">
                                <label for="discount_price"
                                    class="block text-sm font-medium leading-6 text-gray-900">Unesi
                                    sniženu cijenu (KM)</label>
                                <div class="mt-2">
                                    <div
                                        class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-orange-500 sm:max-w-md">
                                        <input type="text" name="discount_price" id="discount_price"
                                            autocomplete="discount_price" value="{{$product->discount_price}}"
                                            class="block flex-1 border-0 bg-transparent py-1.5 pl-3 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6"
                                            placeholder="30,00">
                                    </div>
                                </div>
                                @error('discount_name')
                                    <p class="text-xs text-red-500 font-semibold py-2">*{{$message}}</p>
                                @enderror
                            </div>
                        </div>
                    </div>


                    <div class="border-b border-gray-900/10 pb-12">
                        <div class="space-y-10">
                            <fieldset>
                                <legend class="text-sm font-semibold leading-6 text-gray-900">Dostupno?
                                </legend>
                                <div class="mt-6 space-y-6">
                                    <div class="flex items-center gap-x-3">
                                        <input id="true" name="availability" value="1" type="radio"
                                            class="h-4 w-4 border-gray-300 text-orange-500 focus:ring-orange-500">
                                        <label for="true"
                                            class="block text-sm font-medium leading-6 text-gray-900">DA</label>
                                    </div>
                                    <div class="flex items-center gap-x-3">
                                        <input id="false" name="availability" value="0" type="radio"
                                            class="h-4 w-4 border-gray-300 text-orange-500 focus:ring-orange-500">
                                        <label for="false"
                                            class="block text-sm font-medium leading-6 text-gray-900">NE</label>
                                    </div>
                                </div>
                            </fieldset>
                            @error('availability')
                                <p class="text-xs text-red-500 font-semibold py-2">*{{$message}}</p>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="mt-6 flex items-center gap-x-6">
                    <div>
                        <button form="delete"
                            class="text-sm font-semibold rounded-md bg-red-500 hover:bg-red-800 text-white py-2 px-3">Delete
                        </button>
                    </div>
                    <div class="space-x-6 ml-auto">
                        <a href="/products" class="text-sm font-semibold leading-6 text-gray-900">Cancel</a>
                        <button type="submit"
                            class="rounded-md bg-orange-500 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-orange-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-orange-500">Update</button>
                    </div>
                </div>
            </form>
        </div>

        <form id="delete" action="/product/{{$product->id}}" method="POST" class="hidden">
            @csrf
            @method('DELETE')
        </form>
    </div>
</x-app-layout>