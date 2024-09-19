<?php

namespace App\Http\Controllers;

use App\Services\Facades\ExportFacade;

class ExportController extends Controller
{
    /**
     * Export the project.
     *
     * @return void
     */
    public function export()
    {
        return ExportFacade::export();
    }
}
