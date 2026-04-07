<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Export to Excel
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            @if ($errors->any())
                <div class="mb-4 rounded-md border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-800">
                    <ul class="list-disc pl-5">
                        @foreach ($errors->all() as $e)
                            <li>{{ $e }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <p class="mb-4 text-sm text-gray-600">
                        Filters apply to when the row was captured (submission time). Leave all fields empty to export everything.
                    </p>

                    <form method="get" action="{{ route('submissions.export') }}" class="space-y-4">
                        <div>
                            <x-input-label for="capture_date" value="Submitted on (single day)" />
                            <x-text-input id="capture_date" name="capture_date" type="date" class="mt-1 block w-full" value="{{ old('capture_date', request('capture_date')) }}" />
                        </div>

                        <div>
                            <x-input-label for="month" value="Submitted in month" />
                            <x-text-input id="month" name="month" type="month" class="mt-1 block w-full" value="{{ old('month', request('month')) }}" />
                        </div>

                        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                            <div>
                                <x-input-label for="date_from" value="From date (range)" />
                                <x-text-input id="date_from" name="date_from" type="date" class="mt-1 block w-full" value="{{ old('date_from', request('date_from')) }}" />
                            </div>
                            <div>
                                <x-input-label for="date_to" value="To date (range)" />
                                <x-text-input id="date_to" name="date_to" type="date" class="mt-1 block w-full" value="{{ old('date_to', request('date_to')) }}" />
                            </div>
                        </div>

                        <div>
                            <x-input-label for="fund_name" value="Fund name contains" />
                            <x-text-input id="fund_name" name="fund_name" type="text" class="mt-1 block w-full" value="{{ old('fund_name', request('fund_name')) }}" list="export-funds" placeholder="e.g. Growth" />
                            <datalist id="export-funds">
                                @foreach ($funds as $f)
                                    <option value="{{ $f }}"></option>
                                @endforeach
                            </datalist>
                        </div>

                        <div class="pt-2 flex items-center gap-3">
                            <x-primary-button>Download .xlsx</x-primary-button>
                            <a href="{{ route('submissions.create') }}" class="text-sm text-gray-600 hover:text-gray-900">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
