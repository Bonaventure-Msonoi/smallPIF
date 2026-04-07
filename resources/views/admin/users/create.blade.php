<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Create user
            </h2>
            <a href="{{ route('admin.users.index') }}" class="text-sm text-gray-600 hover:text-gray-900">
                Back to users
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @if ($errors->any())
                        <div class="mb-4 rounded-md border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-800">
                            <ul class="list-disc pl-5">
                                @foreach ($errors->all() as $e)
                                    <li>{{ $e }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="post" action="{{ route('admin.users.store') }}">
                        @csrf

                        <div>
                            <x-input-label for="name" value="Name" />
                            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" value="{{ old('name') }}" required autofocus />
                        </div>

                        <div class="mt-4">
                            <x-input-label for="email" value="Email" />
                            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" value="{{ old('email') }}" required />
                        </div>

                        <div class="mt-4">
                            <x-input-label for="password" value="Password" />
                            <x-text-input id="password" name="password" type="password" class="mt-1 block w-full" required />
                        </div>

                        <div class="mt-4">
                            <x-input-label for="password_confirmation" value="Confirm password" />
                            <x-text-input id="password_confirmation" name="password_confirmation" type="password" class="mt-1 block w-full" required />
                        </div>

                        <div class="mt-4">
                            <label class="inline-flex items-center gap-2">
                                <input type="checkbox" name="is_admin" value="1" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" @checked(old('is_admin'))>
                                <span class="text-sm text-gray-700">Make this user an admin</span>
                            </label>
                        </div>

                        <div class="mt-6 flex items-center gap-3">
                            <x-primary-button>Create user</x-primary-button>
                            <a href="{{ route('admin.users.index') }}" class="text-sm text-gray-600 hover:text-gray-900">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

