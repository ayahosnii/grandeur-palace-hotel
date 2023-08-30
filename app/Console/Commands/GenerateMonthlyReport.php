<?php

namespace App\Console\Commands;

use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class GenerateMonthlyReport extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'report:generate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate the monthly report';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        // Fetch data from your database (example)
        $data = DB::table('salary_details')->get();

        // Generate the report using Dompdf
        $pdf = PDF::loadView('admin.reports.monthly', ['data' => $data]);

        // Define the report's file name
        $fileName = 'monthly_report_' . now()->format('Y-m') . '.pdf';

        // Save or output the PDF (you can customize this part)
        $pdf->save(storage_path('app/reports/' . $fileName));

        // Optionally, you can send an email with the report attachment here

        $this->info('Monthly report generated successfully.');
    }
}
