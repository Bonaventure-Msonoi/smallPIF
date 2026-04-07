<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                User management
            </h2>
            <a href="{{ route('admin.users.create') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700">
                Create user
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (session('success'))
                <div class="mb-4 rounded-md border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-800">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="overflow-x-auto">
                        <table class="min-w-full text-sm">
                            <thead class="text-left text-gray-600">
                                <tr class="border-b">
                                    <th class="py-2 pr-4">Name</th>
                                    <th class="py-2 pr-4">Email</th>
                                    <th class="py-2 pr-4">Role</th>
                                    <th class="py-2 pr-4">Created</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $u)
                                    <tr class="border-b last:border-0">
                                        <td class="py-2 pr-4">{{ $u->name }}</td>
                                        <td class="py-2 pr-4">{{ $u->email }}</td>
                                        <td class="py-2 pr-4">
                                            @if ($u->is_admin)
                                                <span class="inline-flex items-center rounded-full bg-gray-800 px-2 py-0.5 text-xs font-medium text-white">Admin</span>
                                            @else
                                                <span class="inline-flex items-center rounded-full bg-gray-100 px-2 py-0.5 text-xs font-medium text-gray-700">User</span>
                                            @endif
                                        </td>
                                        <td class="py-2 pr-4">{{ $u->created_at?->format('Y-m-d') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-4">
                        {{ $users->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

