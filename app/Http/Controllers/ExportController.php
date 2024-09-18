<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use ZipArchive;

class ExportController extends Controller
{
    // Other methods...

    public function export()
    {
        $projectPath = public_path('project');
        $zipFileName = 'project_export.zip';
        $zipFilePath = storage_path('app/public/' . $zipFileName);
        
        $zip = new ZipArchive;

        if ($zip->open($zipFilePath, ZipArchive::CREATE) === TRUE) {
            $files = new \RecursiveIteratorIterator(
                new \RecursiveDirectoryIterator($projectPath),
                \RecursiveIteratorIterator::LEAVES_ONLY
            );

            foreach ($files as $name => $file) {
                if (!$file->isDir()) {
                    $filePath = $file->getRealPath();
                    $relativePath = substr($filePath, strlen($projectPath) + 1);
                    $zip->addFile($filePath, $relativePath);
                }
            }

            $zip->close();
            
            return response()->download($zipFilePath)->deleteFileAfterSend(true);
        } else {
            return redirect()->route('eposter.index')->withErrors('Failed to create ZIP file.');
        }
    }
}
