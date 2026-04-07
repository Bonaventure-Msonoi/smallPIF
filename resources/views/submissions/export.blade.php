@extends('layouts.app')

@section('title', 'Export to Excel')

@section('content')
    <h1>Export to Excel</h1>
    <p class="lede">Filters apply to when the row was captured (submission time). Combine filters to narrow the download. Leave all empty to export everything.</p>

    <div class="card">
        @if ($errors->any())
            <div class="alert alert-error">
                <ul style="margin:0;padding-left:1.25rem;">
                    @foreach ($errors->all() as $e)
                        <li>{{ $e }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="get" action="{{ route('submissions.export') }}">
            <div class="field">
                <label for="capture_date">Submitted on (single day)</label>
                <input type="date" id="capture_date" name="capture_date" value="{{ old('capture_date', request('capture_date')) }}">
                <p class="hint">Rows created on this calendar day (server time).</p>
            </div>

            <div class="field">
                <label for="month">Submitted in month</label>
                <input type="month" id="month" name="month" value="{{ old('month', request('month')) }}">
                <p class="hint">Use with or without the single-day filter.</p>
            </div>

            <div class="row2">
                <div class="field">
                    <label for="date_from">From date (range)</label>
                    <input type="date" id="date_from" name="date_from" value="{{ old('date_from', request('date_from')) }}">
                </div>
                <div class="field">
                    <label for="date_to">To date (range)</label>
                    <input type="date" id="date_to" name="date_to" value="{{ old('date_to', request('date_to')) }}">
                </div>
            </div>
            <p class="hint">Range is inclusive, based on submission date.</p>

            <div class="field">
                <label for="fund_name">Fund name contains</label>
                <input type="text" id="fund_name" name="fund_name" value="{{ old('fund_name', request('fund_name')) }}" list="export-funds" placeholder="e.g. Growth">
                <datalist id="export-funds">
                    @foreach ($funds as $f)
                        <option value="{{ $f }}">
                    @endforeach
                </datalist>
            </div>

            <button type="submit" class="btn">Download .xlsx</button>
            <a href="{{ route('submissions.create') }}" class="btn btn-secondary" style="margin-left:0.5rem;">Cancel</a>
        </form>
    </div>
@endsection
