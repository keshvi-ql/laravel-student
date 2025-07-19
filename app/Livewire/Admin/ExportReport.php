<?php

namespace App\Livewire\Admin;

use App\Exports\AutomatedAttendanceReportExporter;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;
use Carbon\Carbon;

class ExportReport extends Component
{
    public $start_date;
    public $end_date;

    public function mount()
    {
        $this->start_date = Carbon::now()->startOfMonth()->format('Y-m-d');
        $this->end_date = Carbon::now()->endOfMonth()->format('Y-m-d');
    }

    public function export()
    {
        $this->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);
        return Excel::download(new AutomatedAttendanceReportExporter($this->start_date, $this->end_date), 'attendance_report_' . $this->start_date . '_to_' . $this->end_date . '.xlsx');
    }

    public function render()
    {
        return view('livewire.admin.export-report');
    }
} 