@extends('layouts.app')

@section('title', 'Daily business submission')

@section('content')
    <h1>Daily business submission</h1>
    <p class="lede">Enter the client and policy details below. Fields match the bulk Excel template.</p>

    <div class="card">
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <form method="post" action="{{ route('submissions.store') }}" novalidate>
            @csrf

            <div class="row2">
                <div class="field">
                    <label for="first_name">Name</label>
                    <input type="text" id="first_name" name="first_name" value="{{ old('first_name') }}" required autocomplete="given-name">
                    @error('first_name')<div class="error-text">{{ $message }}</div>@enderror
                </div>
                <div class="field">
                    <label for="other_names">Other</label>
                    <input type="text" id="other_names" name="other_names" value="{{ old('other_names') }}" autocomplete="additional-name">
                    @error('other_names')<div class="error-text">{{ $message }}</div>@enderror
                </div>
            </div>

            <div class="field">
                <label for="surname">Surname</label>
                <input type="text" id="surname" name="surname" value="{{ old('surname') }}" required autocomplete="family-name">
                @error('surname')<div class="error-text">{{ $message }}</div>@enderror
            </div>

            <div class="row2">
                <div class="field">
                    <label for="nrc">NRC</label>
                    <input type="text" id="nrc" name="nrc" value="{{ old('nrc') }}" required>
                    @error('nrc')<div class="error-text">{{ $message }}</div>@enderror
                </div>
                <div class="field">
                    <label for="man_number">Man Number</label>
                    <input type="text" id="man_number" name="man_number" value="{{ old('man_number') }}" required>
                    @error('man_number')<div class="error-text">{{ $message }}</div>@enderror
                </div>
            </div>

            <div class="row2">
                <div class="field">
                    <label for="amount">Amount</label>
                    <input type="number" id="amount" name="amount" value="{{ old('amount') }}" step="0.01" min="0" required>
                    @error('amount')<div class="error-text">{{ $message }}</div>@enderror
                </div>
                <div class="field">
                    <label for="fund_name">Fund Name</label>
                    <input type="text" id="fund_name" name="fund_name" value="{{ old('fund_name') }}" required list="fund-suggestions">
                    <datalist id="fund-suggestions">
                        @foreach ($funds as $f)
                            <option value="{{ $f }}">
                        @endforeach
                    </datalist>
                    @error('fund_name')<div class="error-text">{{ $message }}</div>@enderror
                </div>
            </div>

            <div class="row2">
                <div class="field">
                    <label for="start_date">Start Date</label>
                    <input type="date" id="start_date" name="start_date" value="{{ old('start_date') }}" required>
                    @error('start_date')<div class="error-text">{{ $message }}</div>@enderror
                </div>
                <div class="field">
                    <label for="date_of_birth">D.O.B</label>
                    <input type="date" id="date_of_birth" name="date_of_birth" value="{{ old('date_of_birth') }}" required>
                    @error('date_of_birth')<div class="error-text">{{ $message }}</div>@enderror
                </div>
            </div>

            <div class="row2">
                <div class="field">
                    <label for="phone_no">Phone No</label>
                    <input type="text" id="phone_no" name="phone_no" value="{{ old('phone_no') }}" required autocomplete="tel">
                    @error('phone_no')<div class="error-text">{{ $message }}</div>@enderror
                </div>
                <div class="field">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}" required autocomplete="email">
                    @error('email')<div class="error-text">{{ $message }}</div>@enderror
                </div>
            </div>

            <div class="field">
                <label for="gender">Gender</label>
                <select id="gender" name="gender" required>
                    <option value="" disabled @selected(!old('gender'))>Select…</option>
                    @foreach (['Male', 'Female', 'Other', 'Prefer not to say'] as $g)
                        <option value="{{ $g }}" @selected(old('gender') === $g)>{{ $g }}</option>
                    @endforeach
                </select>
                @error('gender')<div class="error-text">{{ $message }}</div>@enderror
            </div>

            <div class="field">
                <label for="physical_address">Physical Address</label>
                <textarea id="physical_address" name="physical_address" required>{{ old('physical_address') }}</textarea>
                @error('physical_address')<div class="error-text">{{ $message }}</div>@enderror
            </div>

            <div class="field">
                <label for="note">Note</label>
                <textarea id="note" name="note">{{ old('note') }}</textarea>
                @error('note')<div class="error-text">{{ $message }}</div>@enderror
            </div>

            <button type="submit" class="btn">Submit</button>
        </form>
    </div>
@endsection
