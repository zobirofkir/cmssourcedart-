<?php

namespace App\Http\Controllers;

use App\Services\Facades\ExportFacade;

class ExportController extends Controller
{

    public function export()
    {
        return ExportFacade::export();
    }
}
