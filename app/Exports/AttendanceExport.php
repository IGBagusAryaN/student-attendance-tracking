<?php

namespace App\Exports;

use App\Models\Attendance;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class AttendanceExport implements FromCollection, WithMapping, WithHeadings
{
    protected $year, $month, $grade;

    public function __construct($year, $month, $grade)
    {
        $this->year = $year;
        $this->month = $month;
        $this->grade = $grade;
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Attendance::whereYear('date', $this->year)
        ->whereMonth('date', $this->month)
        ->whereHas('student', function($query) {
            $query->where('grade_id', $this->grade);
        })->get();
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
