<?php

namespace App\Exports;

use App\Models\BusinessSubmission;
use Illuminate\Database\Eloquent\Builder;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class BusinessSubmissionsExport implements FromQuery, WithHeadings, WithMapping
{
    public function __construct(
        public readonly ?string $captureDate = null,
        public readonly ?string $month = null,
        public readonly ?string $fundName = null,
        public readonly ?string $dateFrom = null,
        public readonly ?string $dateTo = null,
    ) {}

    public function query(): Builder
    {
        $q = BusinessSubmission::query()->orderBy('created_at');

        if ($this->captureDate) {
            $q->whereDate('created_at', $this->captureDate);
        }

        if ($this->month && preg_match('/^\d{4}-\d{2}$/', $this->month)) {
            [$year, $mon] = explode('-', $this->month);
            $q->whereYear('created_at', (int) $year)->whereMonth('created_at', (int) $mon);
        }

        if ($this->dateFrom) {
            $q->whereDate('created_at', '>=', $this->dateFrom);
        }

        if ($this->dateTo) {
            $q->whereDate('created_at', '<=', $this->dateTo);
        }

        if ($this->fundName !== null && $this->fundName !== '') {
            $q->where('fund_name', 'like', '%'.addcslashes($this->fundName, '%_\\').'%');
        }

        return $q;
    }

    public function headings(): array
    {
        return [
            'Name',
            'Other',
            'Surname',
            'NRC',
            'Man Number',
            'Amount',
            'Fund Name',
            'Start Date',
            'Phone No',
            'Email',
            'D.O.B',
            'Gender',
            'Physical Address',
            'Note',
            'Submitted at',
        ];
    }

    public function map($row): array
    {
        return [
            $row->first_name,
            $row->other_names,
            $row->surname,
            $row->nrc,
            $row->man_number,
            $row->amount,
            $row->fund_name,
            $row->start_date?->format('Y-m-d'),
            $row->phone_no,
            $row->email,
            $row->date_of_birth?->format('Y-m-d'),
            $row->gender,
            $row->physical_address,
            $row->note,
            $row->created_at?->format('Y-m-d H:i:s'),
        ];
    }
}
