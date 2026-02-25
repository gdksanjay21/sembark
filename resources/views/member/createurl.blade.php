<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Generate URL') }}
        </h2>
    </x-slot>
    
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    
                    <div class="max-w-3xl mx-auto py-12 px-6 bg-white shadow-md rounded-lg grid grid-cols-1 md:grid-cols-2 gap-8">
                        
                        <form method="POST" action="{{ route('mstroreurl') }}" class="space-y-6">
                            @csrf

                            <div class="mb-4">
                                <label for="original_url" class="block text-gray-700 font-semibold mb-2">Long URL</label>
                                <input type="text" id="original_url" name="original_url" placeholder="e.g. https://sembark.com/travel-software/features/best-itinerary-build"value="{{ old('original_url') }}"class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                @error('original_url')
                                <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <button type="submit"class="px-6 py-2 bg-blue-600 font-semibold rounded-lg shadow hover:bg-blue-700 transition-colors duration-200">Generate</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
