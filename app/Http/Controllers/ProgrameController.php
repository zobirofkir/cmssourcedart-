<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ProgrameController extends Controller
{
    // List all PDFs
    public function index()
    {
        $basePath = public_path('project/application/assets/img/app/programme');
        
        // Get list of files
        $files = File::files($basePath);
        $pdfs = [];

        foreach ($files as $file) {
            $pdfs[basename($file)] = $file->getPathname();
        }

        return view('programme.index', compact('pdfs'));
    }

    // Show the form to add a new PDF
    public function create()
    {
        return view('programme.create');
    }

    // Store a new PDF
    public function store(Request $request)
    {
        $request->validate([
            'pdf' => 'required|file|mimes:pdf|max:10240', // Validate PDF file
        ]);
    
        if ($request->hasFile('pdf')) {
            $file = $request->file('pdf');
            $fileName = $file->getClientOriginalName(); // Get the original file name
            $filePath = public_path('project/application/assets/img/app/programme');
    
            // Check if the directory exists
            if (!File::isDirectory($filePath)) {
                File::makeDirectory($filePath, 0755, true);
            }
    
            // Move the uploaded file to the target directory
            try {
                $file->move($filePath, $fileName);
                return redirect()->route('programme.index')->withSuccess('PDF uploaded successfully.');
            } catch (\Exception $e) {
                return redirect()->back()->withErrors('Failed to upload PDF: ' . $e->getMessage());
            }
        }
    
        return redirect()->back()->withErrors('No file uploaded.');
    }
    
    // Show the form to edit a specific PDF
    public function edit($pdfName)
    {
        $pdfPath = public_path("project/application/assets/img/app/programme/$pdfName");

        if (File::exists($pdfPath)) {
            return view('programme.edit', compact('pdfPath', 'pdfName'));
        }

        return redirect()->back()->withErrors('PDF not found.');
    }

    // Update a specific PDF
    public function update(Request $request, $pdfName)
    {
        $pdfPath = public_path("project/application/assets/img/app/programme/$pdfName");

        if (File::exists($pdfPath)) {
            // Handle PDF upload if provided
            if ($request->hasFile('pdf')) {
                $file = $request->file('pdf');

                // Ensure the uploaded file is a PDF and overwrite the old file
                if ($file->isValid()) {
                    // Move the new file to replace the old one
                    $newPdfPath = public_path("project/application/assets/img/app/programme/$pdfName");
                    $file->move(dirname($newPdfPath), $pdfName);
                }
            }

            return redirect()->route('programme.index')->withSuccess('PDF updated successfully.');
        }

        return redirect()->back()->withErrors('Unable to update PDF.');
    }

    // Delete a specific PDF
    public function destroy($pdfName)
    {
        $filePath = public_path("project/application/assets/img/app/programme/$pdfName");

        if (File::exists($filePath)) {
            File::delete($filePath);
            return redirect()->route('programme.index')->withSuccess('PDF deleted successfully.');
        }

        return redirect()->back()->withErrors('PDF not found.');
    }
}
