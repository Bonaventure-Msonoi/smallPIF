<?php

namespace App\Http\Controllers;

use App\Exports\BusinessSubmissionsExport;
use App\Http\Requests\StoreBusinessSubmissionRequest;
use App\Models\BusinessSubmission;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class BusinessSubmissionController extends Controller
{
    public function create(): View
    {
        $funds = BusinessSubmission::query()
            ->select('fund_name')
            ->distinct()
            ->orderBy('fund_name')
            ->pluck('fund_name');

        return view('submissions.create', ['funds' => $funds]);
    }

    public function store(StoreBusinessSubmissionRequest $request): RedirectResponse
    {
        BusinessSubmission::create($request->validated());

        return redirect()->route('submissions.create')
            ->with('success', 'Submission saved. Thank you.');
    }

    public function exportForm(): View
    {
        $funds = BusinessSubmission::query()
            ->select('fund_name')
            ->distinct()
            ->orderBy('fund_name')
            ->pluck('fund_name');

        return view('submissions.export', ['funds' => $funds]);
    }

    public function export(Request $request): BinaryFileResponse
    {
        $validated = $request->validate([
            'capture_date' => ['nullable', 'date'],
            'month' => ['nullable', 'regex:/^\d{4}-\d{2}$/'],
            'fund_name' => ['nullable', 'string', 'max:255'],
            'date_from' => ['nullable', 'date'],
            'date_to' => ['nullable', 'date'],
        ]);

        $export = new BusinessSubmissionsExport(
            captureDate: $validated['capture_date'] ?? null,
            month: $validated['month'] ?? null,
            fundName: $validated['fund_name'] ?? null,
            dateFrom: $validated['date_from'] ?? null,
            dateTo: $validated['date_to'] ?? null,
        );

        $parts = array_filter([
            $validated['capture_date'] ?? null,
            $validated['month'] ?? null,
            $validated['fund_name'] ? preg_replace('/[^a-zA-Z0-9_-]+/', '-', $validated['fund_name']) : null,
        ]);
        $suffix = $parts ? implode('-', $parts) : 'all';
        $filename = 'business-submissions-'.$suffix.'.xlsx';

        return Excel::download($export, $filename);
    }
}
