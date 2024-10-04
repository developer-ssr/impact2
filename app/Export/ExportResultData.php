<?php

use App\Models\result;
use Maatwebsite\Excel\Concerns\FromCollection;

class ExportResultData implements FromCollection{
    public function collection(){
        return result::all();
    }
}

?>