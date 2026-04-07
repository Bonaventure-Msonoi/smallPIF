<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Admin dashboard
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3">
                        <a href="{{ route('submissions.export.form') }}" class="block rounded-lg border border-gray-200 p-4 hover:bg-gray-50">
                            <div class="text-sm font-semibold">Export to Excel</div>
                            <div class="mt-1 text-sm text-gray-600">Download submissions filtered by date, month, and fund.</div>
                        </a>
                        <a href="{{ route('admin.users.index') }}" class="block rounded-lg border border-gray-200 p-4 hover:bg-gray-50">
                            <div class="text-sm font-semibold">User management</div>
                            <div class="mt-1 text-sm text-gray-600">Create staff accounts and assign admin role.</div>
                        </a>
                        <a href="{{ route('submissions.create') }}" class="block rounded-lg border border-gray-200 p-4 hover:bg-gray-50">
                            <div class="text-sm font-semibold">Submission form</div>
                            <div class="mt-1 text-sm text-gray-600">View the advisor submission form.</div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

