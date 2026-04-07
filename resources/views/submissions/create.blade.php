@extends('layouts.public')

@section('title', 'Daily business submission')

@section('content')
    <div class="card">
        <div class="card-hd">
            <h1>Daily business submission</h1>
            <p class="lede">Please capture the client and policy details. This matches the bulk business Excel fields.</p>
        </div>
        <div class="card-bd">
            @if (session('success'))
                <div class="alert">{{ session('success') }}</div>
            @endif

            @if ($errors->any())
                <div class="alert alert-error">
                    Please fix the highlighted fields and try again.
                </div>
            @endif

            <form method="post" action="{{ route('submissions.store') }}" novalidate>
                @csrf

                <div class="row">
                    <div class="field">
                        <label for="first_name">Name</label>
                        <input type="text" id="first_name" name="first_name" value="{{ old('first_name') }}" required autocomplete="given-name">
                        @error('first_name')<div class="error">{{ $message }}</div>@enderror
                    </div>
                    <div class="field">
                        <label for="other_names">Other</label>
                        <input type="text" id="other_names" name="other_names" value="{{ old('other_names') }}" autocomplete="additional-name">
                        @error('other_names')<div class="error">{{ $message }}</div>@enderror
                    </div>
                </div>

                <div class="field">
                    <label for="surname">Surname</label>
                    <input type="text" id="surname" name="surname" value="{{ old('surname') }}" required autocomplete="family-name">
                    @error('surname')<div class="error">{{ $message }}</div>@enderror
                </div>

                <div class="row">
                    <div class="field">
                        <label for="nrc">NRC</label>
                        <input type="text" id="nrc" name="nrc" value="{{ old('nrc') }}" required>
                        @error('nrc')<div class="error">{{ $message }}</div>@enderror
                    </div>
                    <div class="field">
                        <label for="man_number">Man Number</label>
                        <input type="text" id="man_number" name="man_number" value="{{ old('man_number') }}" required>
                        @error('man_number')<div class="error">{{ $message }}</div>@enderror
                    </div>
                </div>

                <div class="row">
                    <div class="field">
                        <label for="amount">Amount</label>
                        <input type="number" id="amount" name="amount" value="{{ old('amount') }}" step="0.01" min="0" required>
                        @error('amount')<div class="error">{{ $message }}</div>@enderror
                    </div>
                    <div class="field">
                        <label for="fund_name">Fund Name</label>
                        <input type="text" id="fund_name" name="fund_name" value="{{ old('fund_name') }}" required list="fund-suggestions" placeholder="Start typing…">
                        <datalist id="fund-suggestions">
                            @foreach ($funds as $f)
                                <option value="{{ $f }}"></option>
                            @endforeach
                        </datalist>
                        @error('fund_name')<div class="error">{{ $message }}</div>@enderror
                        <div class="hint">Use consistent naming for easier monthly exports.</div>
                    </div>
                </div>

                <div class="row">
                    <div class="field">
                        <label for="start_date">Start Date</label>
                        <input type="date" id="start_date" name="start_date" value="{{ old('start_date') }}" required>
                        @error('start_date')<div class="error">{{ $message }}</div>@enderror
                    </div>
                    <div class="field">
                        <label for="date_of_birth">D.O.B</label>
                        <input type="date" id="date_of_birth" name="date_of_birth" value="{{ old('date_of_birth') }}" required>
                        @error('date_of_birth')<div class="error">{{ $message }}</div>@enderror
                    </div>
                </div>

                <div class="row">
                    <div class="field">
                        <label for="phone_no">Phone No</label>
                        <input type="text" id="phone_no" name="phone_no" value="{{ old('phone_no') }}" required autocomplete="tel">
                        @error('phone_no')<div class="error">{{ $message }}</div>@enderror
                    </div>
                    <div class="field">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" value="{{ old('email') }}" required autocomplete="email">
                        @error('email')<div class="error">{{ $message }}</div>@enderror
                    </div>
                </div>

                <div class="row">
                    <div class="field">
                        <label for="gender">Gender</label>
                        <select id="gender" name="gender" required>
                            <option value="" disabled @selected(!old('gender'))>Select…</option>
                            @foreach (['Male', 'Female', 'Other', 'Prefer not to say'] as $g)
                                <option value="{{ $g }}" @selected(old('gender') === $g)>{{ $g }}</option>
                            @endforeach
                        </select>
                        @error('gender')<div class="error">{{ $message }}</div>@enderror
                    </div>
                    <div class="field">
                        <label for="physical_address">Physical Address</label>
                        <input type="text" id="physical_address" name="physical_address" value="{{ old('physical_address') }}" required autocomplete="street-address">
                        @error('physical_address')<div class="error">{{ $message }}</div>@enderror
                    </div>
                </div>

                <div class="field">
                    <label for="note">Note</label>
                    <textarea id="note" name="note" placeholder="Optional…">{{ old('note') }}</textarea>
                    @error('note')<div class="error">{{ $message }}</div>@enderror
                </div>

                <div class="row" style="grid-template-columns: 1fr auto;">
                    <div class="hint" style="margin: 0; align-self:center;">By submitting, you confirm the details are correct.</div>
                    <button type="submit" class="btn" id="reviewBtn">Review submission</button>
                </div>
            </form>
        </div>
    </div>

    <div id="previewModal" style="display:none; position:fixed; inset:0; background:rgba(0,0,0,0.45); padding: 18px; z-index: 50;">
        <div style="max-width: 720px; margin: 6vh auto; background: var(--surface); border: 1px solid var(--border); border-radius: 14px; box-shadow: 0 18px 60px rgba(0,0,0,0.22); overflow:hidden;">
            <div style="padding: 16px 18px; border-bottom: 1px solid rgba(0,0,0,0.06); display:flex; justify-content:space-between; gap:12px; align-items:center;">
                <div>
                    <div style="font-weight: 700; letter-spacing: -0.02em;">Confirm submission</div>
                    <div class="hint" style="margin-top: 2px;">Please confirm the details below. Choose Edit to make changes.</div>
                </div>
                <button type="button" id="closePreview" class="btn btn-secondary" style="padding: 8px 10px;">Close</button>
            </div>
            <div style="padding: 14px 18px;">
                <div id="previewBody" style="display:grid; grid-template-columns: 1fr 1fr; gap: 10px 14px;"></div>
                <div style="margin-top: 14px; display:flex; justify-content:flex-end; gap: 10px;">
                    <button type="button" id="editBtn" class="btn btn-secondary">Edit</button>
                    <button type="button" id="confirmSubmitBtn" class="btn">Submit</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        (function () {
            const form = document.querySelector('form[action="{{ route('submissions.store') }}"]');
            const modal = document.getElementById('previewModal');
            const body = document.getElementById('previewBody');
            const closeBtn = document.getElementById('closePreview');
            const editBtn = document.getElementById('editBtn');
            const confirmBtn = document.getElementById('confirmSubmitBtn');

            if (!form || !modal || !body || !confirmBtn) return;

            const labels = {
                first_name: 'Name',
                other_names: 'Other',
                surname: 'Surname',
                nrc: 'NRC',
                man_number: 'Man Number',
                amount: 'Amount',
                fund_name: 'Fund Name',
                start_date: 'Start Date',
                phone_no: 'Phone No',
                email: 'Email',
                date_of_birth: 'D.O.B',
                gender: 'Gender',
                physical_address: 'Physical Address',
                note: 'Note'
            };

            function escapeHtml(s) {
                return String(s ?? '').replace(/[&<>"']/g, c => ({'&':'&amp;','<':'&lt;','>':'&gt;','"':'&quot;',"'":'&#39;'}[c]));
            }

            function fieldValue(name) {
                const el = form.elements[name];
                if (!el) return '';
                if (el.tagName === 'SELECT') return el.options[el.selectedIndex]?.text || '';
                return el.value || '';
            }

            function openPreview() {
                body.innerHTML = '';

                Object.keys(labels).forEach((k) => {
                    const v = fieldValue(k);
                    const cell = document.createElement('div');
                    cell.style.padding = '10px 10px';
                    cell.style.border = '1px solid rgba(0,0,0,0.06)';
                    cell.style.borderRadius = '12px';
                    cell.style.background = '#fbfbf9';
                    cell.innerHTML = `
                        <div style="font-size:12px; font-weight:700; color: var(--muted); margin-bottom:4px;">${escapeHtml(labels[k])}</div>
                        <div style="font-size:14px; color: var(--text); white-space: pre-wrap;">${escapeHtml(v || '—')}</div>
                    `;
                    body.appendChild(cell);
                });

                modal.style.display = 'block';
                document.body.style.overflow = 'hidden';
            }

            function closePreview() {
                modal.style.display = 'none';
                document.body.style.overflow = '';
            }

            form.addEventListener('submit', function (e) {
                // Let server-side validation handle missing required fields, but show preview first.
                e.preventDefault();
                openPreview();
            });

            closeBtn && closeBtn.addEventListener('click', closePreview);
            editBtn && editBtn.addEventListener('click', closePreview);

            modal.addEventListener('click', function (e) {
                if (e.target === modal) closePreview();
            });

            confirmBtn.addEventListener('click', function () {
                closePreview();
                form.submit();
            });
        })();
    </script>
@endsection
