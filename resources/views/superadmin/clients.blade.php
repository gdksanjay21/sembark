<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Clients List') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <!-- Client table start here -->
                <div class="p-6 text-gray-900">
                    <div class="p-6 text-gray-900 max-w-5xl mx-auto bg-white p-6 rounded shadow overflow-x-auto">
                        <div class="flex items-center justify-between mb-6">

                            <!-- Page Title -->
                            <h1 class="text-3xl font-bold text-gray-800">
                                All Client
                            </h1>

                            <!-- Button / Link -->
                            <a href="{{ route('invite') }}" class="px-4 py-2 bg-blue-600 font-semibold rounded-lg shadow hover:bg-blue-700 transition-colors duration-200 bg-blue-600">
                                Invite
                            </a>

                        </div>
                        <div class="table-container max-w-5xl mx-auto overflow-x-auto">
                            <table class="w-full min-w-full divide-y divide-gray-200 table-auto border border-gray-300 border-collapse">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col" class="border border-gray-300 px-6 py-4 text-left text-sm font-bold text-gray-900 uppercase tracking-wider"><a href="?sort_by=name&sort_dir=asc">Company</a></th>
                                        <th scope="col" class="border border-gray-300 px-6 py-4 text-left text-sm font-bold text-gray-900 uppercase tracking-wider">Admin Email</th>
                                        <th scope="col" class="border border-gray-300 px-6 py-4 text-left text-sm font-bold text-gray-900 uppercase tracking-wider"><a href="?sort_by=users_count">Users</a></th>
                                        <th scope="col" class="border border-gray-300 px-6 py-4 text-left text-sm font-bold text-gray-900 uppercase tracking-wider">Total URLs</th>
                                        <th scope="col" class="border border-gray-300 px-6 py-4 text-left text-sm font-bold text-gray-900 uppercase tracking-wider">Total Hits</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach($companies as $company)
                                    <tr>
                                        <td class="border border-gray-300 px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $company->name }}</td>
                                        <td class="border border-gray-300 px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ optional($company->users->first())->email }}</td>
                                        <td class="border border-gray-300 px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $company->users_count }}</td>
                                        <td class="border border-gray-300 px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $company->total_urls }}</td>
                                        <td class="border border-gray-300 px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $company->total_hits }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{ $companies->links() }}
                        </div>
                    </div>
                </div>
                <!-- Client table ends here -->
            </div>
        </div>
    </div>

</x-app-layout>
