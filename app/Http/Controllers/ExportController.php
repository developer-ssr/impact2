<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Result;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ToModel;


class ExportController extends Controller implements FromCollection,Excel
{
    protected $dataArray;

    public function index()
    {
        $results = Result::all();
        $header = ["Participant", "Device", "Date Taken"];
        $data = [];

        foreach ($results as $result) {
            $data[] = [
                $result->testid,
                $result->devices,
                $result->created_at,
                // Add other fields as necessary...
            ];
        }

        array_unshift($data, $header); // Add header at the beginning
        $this->dataArray = array_slice($data, 1); // Exclude header for FromArray

        return Excel::download($this, 'results.xlsx');
    }

    public function array(): array
    {
        return $this->dataArray;
    }

    public function headings(): array
    {
        return [
            "Participant",
            "Device",
            "Date Taken",
            // Add dynamic headers here if needed...
        ];
    }
}