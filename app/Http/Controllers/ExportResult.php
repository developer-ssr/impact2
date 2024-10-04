<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Export\ExportResultData;
use Maatwebsite\Excel\Facades\Excel;


class ExportResult extends Controller
{
    public function exportexcel(){
    
        return Excel::download($this, 'results.xlsx');
    }
}
