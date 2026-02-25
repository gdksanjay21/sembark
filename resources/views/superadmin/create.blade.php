<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Invite New Client') }}
        </h2>
    </x-slot>
    
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="max-w-3xl mx-auto py-12 px-6 bg-white shadow-md rounded-lg">
                        <form method="POST" action="{{ route('create') }}" class="space-y-6">
                            @csrf

                            <div class="mb-3">
                                <label for="company_name" class="block text-gray-700 font-semibold mb-2">Name</label>
                                <input type="text" id="company_name" name="company_name" placeholder="Client Name..."value="{{ old('company_name') }}"class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                @error('company_name')
                                <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label">Admin Email</label>
                                <input type="email" id="email" name="email" placeholder="ex. sample@example.com" value="{{ old('email') }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                @error('email')
                                <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <button type="submit"class="px-6 py-2 bg-blue-600 font-semibold rounded-lg shadow hover:bg-blue-700 transition-colors duration-200">Send Invite</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
