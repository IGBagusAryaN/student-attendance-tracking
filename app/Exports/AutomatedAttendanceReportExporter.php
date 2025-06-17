<?php

namespace App\Exports;

use App\Models\Attendance;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class AutomatedAttendanceReportExporter implements FromCollection, WithHeadings, WithMapping
{
    protected $startDate, $endDate;

    public function __construct($startDate, $endDate)
    {
        $this->startDate = $startDate;
        $this->endDate = $endDate;
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Attendance::whereBetween('date', [$this->startDate, $this->endDate])->get();
    }

    
    public function map($row): array
    {
        return [
            $row->student->first_name .' '.$row->student->last_name,
            $row->date,
            ucfirst($row->status),
            $row->reason
        ];
    }

    public function headings(): array
    {
        return [
            'Student Name',
            'Date',
            'Status',
            'Reason'
        ];
    }
}
