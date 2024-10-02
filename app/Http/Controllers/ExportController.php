<?php

namespace App\Http\Controllers;

use App\Models\items;
use App\Models\Result;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Concerns\FromArray;
use Illuminate\Support\Collection;

class ExportController extends Controller implements FromArray
{
    protected $dataArray;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Fetch all results from the database
        $results = Result::all();

        // Initialize the header and data arrays
        $header = ["Participant", "Device", "Date Taken"];
        $data = [];

        // Find unique demoPart values and the highest demoPart
        $demoParts = $results->pluck('demoPart')->unique();
        $highestDemoPart = $demoParts->max();

        foreach ($results as $result) {
            // Construct dynamic headers based on demoPart values
            if ($result->demoPart == 1) {
                $header[] = $result->index . "_practice_rt";
            } elseif ($result->demoPart == 2) {
                $header[] = $result->index . "_dummy_rt";
            } elseif ($result->demoPart >= 3 && $result->demoPart != $highestDemoPart) {
                $header[] = $result->index . "_main_rt";
            } elseif ($result->demoPart == $highestDemoPart) {
                $header[] = $result->index . "_explicit";
            }
        }

        foreach ($results as $result) {
            // Check if this is the first result for unique values
            if (!in_array($result->testid, array_column($data, 0))) {
                // Initialize the row with the first unique values
                $row = [
                    $result->testid,
                    $result->devices,
                    $result->created_at,
                ];
            } else {
                // If the testid already exists, just use the last row
                $row = end($data); // Get the last row to modify
            }

            // Append rt value based on demoPart conditions
            if ($result->demoPart == 1) {
                $row[] = $result->rt; // Add rt to the row for practice
            } elseif ($result->demoPart == 2) {
                $row[] = $result->rt; // Add rt to the row for dummy
            } elseif ($result->demoPart >= 3 && $result->demoPart != $highestDemoPart) {
                $row[] = $result->rt; // Add rt to the row for main
            } elseif ($result->demoPart == $highestDemoPart) {
                $row[] = $result->rt; // Add rt to the row for explicit
            }

            // Push the constructed row to the data array only if it's unique
            if (!in_array($result->testid, array_column($data, 0))) {
                $data[] = $row; // Add new unique row
            } else {
                // If it's not unique, update the last row
                $data[count($data) - 1] = $row; // Update the last row with new rt value
            }
        }

        // Add header as the first row of the data
        array_unshift($data, $header);

        // Set dataArray for exporting
        $this->dataArray = $data;

        // Generate and return the Excel file
        return Excel::download($this, 'results.xlsx');
    }

    /**
     * Convert data to array for Excel export
     */
    public function array(): array
    {
        return $this->dataArray;
    }


    /**
     * Helper function to calculate the median of an array
     */
    private function calculateMedian($values)
    {
        if (empty($values)) {
            return null;
        }

        sort($values);
        $count = count($values);
        $middle = floor(($count - 1) / 2);

        if ($count % 2) {
            return $values[$middle];
        } else {
            return ($values[$middle] + $values[$middle + 1]) / 2;
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(items $items)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(items $items)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, items $items)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(items $items)
    {
        //
    }
}
