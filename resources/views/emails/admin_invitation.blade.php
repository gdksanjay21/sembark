<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Account Invitation Mail') }}
        </h2>
    </x-slot>
    <div class="container">
        <h2>Welcome to Short URL Service</h2>

        <p>You have been invited as a Company User.</p>

        <p><strong>Email:</strong> {{ $admin->email }}</p>
        <p><strong>Temporary Password:</strong> {{ $password }}</p>

        <p>Please login and change your password.</p>
    </div>
</x-app-layout>
