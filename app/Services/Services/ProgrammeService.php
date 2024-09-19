<?php

namespace App\Services\Services;

use App\Services\Construct\ProgrammeConstruct;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;


class ProgrammeService implements ProgrammeConstruct
{
    /**
     * Display a listing of the resource.
     *
     * @return void
     */
    public function index()
    {
        $basePath = public_path('project/application/assets/img/app/programme');
        
        $files = File::files($basePath);
        $pdfs = [];

        foreach ($files as $file) {
            $pdfs[basename($file)] = $file->getPathname();
        }

        return view('programme.index', compact('pdfs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return void
     */
    public function create()
    {
        return view('programme.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return void
     */
    public function store(Request $request)
    {
        $request->validate([
            'pdf' => 'required|file|mimes:pdf|max:10240', // Validate PDF file
        ]);

        if ($request->hasFile('pdf')) {
            $file = $request->file('pdf');
            $fileName = $file->getClientOriginalName(); // Get the original file name
            $filePath = public_path('project/application/assets/img/app/programme');

            if (!File::isDirectory($filePath)) {
                File::makeDirectory($filePath, 0755, true);
            }

            try {
                $file->move($filePath, $fileName);
                return redirect()->route('programme.index')->withSuccess('PDF uploaded successfully.');
            } catch (\Exception $e) {
                return redirect()->back()->withErrors('Failed to upload PDF: ' . $e->getMessage());
            }
        }

        return redirect()->back()->withErrors('No file uploaded.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param [type] $pdfName
     * @return void
     */
    public function edit($pdfName)
    {
        $pdfPath = public_path("project/application/assets/img/app/programme/$pdfName");

        if (File::exists($pdfPath)) {
            return view('programme.edit', compact('pdfPath', 'pdfName'));
        }

        return redirect()->back()->withErrors('PDF not found.');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param [type] $pdfName
     * @return void
     */
    public function update(Request $request, $pdfName)
    {
        $pdfPath = public_path("project/application/assets/img/app/programme/$pdfName");

        if (File::exists($pdfPath)) {
            if ($request->hasFile('pdf')) {
                $file = $request->file('pdf');

                if ($file->isValid()) {
                    $newPdfPath = public_path("project/application/assets/img/app/programme/$pdfName");
                    $file->move(dirname($newPdfPath), $pdfName);
                }
            }

            return redirect()->route('programme.index')->withSuccess('PDF updated successfully.');
        }

        return redirect()->back()->withErrors('Unable to update PDF.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param [type] $pdfName
     * @return void
     */
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