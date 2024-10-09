<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FileItemController extends Controller
{
    public function index()
    {
        $filePath = 'project/application/assets/css/index1000.css';

        // Ensure the file exists before trying to read it
        if (!file_exists($filePath)) {
            return redirect()->back()->withErrors('CSS file not found.');
        }

        $fileContent = file_get_contents($filePath);

        // Parse the existing CSS styles
        $stylesArray = $this->parseCssStyles($fileContent, '.listliks');
        $listItemsStylesArray = $this->parseCssStyles($fileContent, '.listliks li');
        $btnPosterStylesArray = $this->parseCssStyles($fileContent, '.btnPoster');

        return view('items.file', compact('fileContent', 'filePath', 'stylesArray', 'listItemsStylesArray', 'btnPosterStylesArray'));
    }

    public function update(Request $request)
    {
        // Validate only specified request fields
        $request->validate([
            'filePath' => 'required|string',
            'listliks_top' => 'nullable|string',
            'listliks_right' => 'nullable|string',
            'listliks_bottom' => 'nullable|string',
            'listliks_left' => 'nullable|string',
            'listliks_li_margin_bottom' => 'nullable|string',
            'listliks_li_width' => 'nullable|string',
            'btnPoster_width' => 'nullable|string',
            'btnPoster_height' => 'nullable|string',
            'btnPoster_object_fit' => 'nullable|string',
            'btnPoster_justify_content' => 'nullable|string',
            'responsive_top' => 'nullable|string',
            'responsive_right' => 'nullable|string',
            'responsive_bottom' => 'nullable|string',
            'responsive_left' => 'nullable|string',
        ]);

        // Get the file path from the request
        $filePath = $request->input('filePath');

        // Ensure the file exists before trying to read it
        if (!file_exists($filePath)) {
            return redirect()->back()->withErrors('CSS file not found.');
        }

        // Read the existing CSS content
        $fileContent = file_get_contents($filePath);

        // Parse existing CSS properties for .listliks, .listliks li, and .btnPoster
        $stylesArray = $this->parseCssStyles($fileContent, '.listliks');
        $listItemsStylesArray = $this->parseCssStyles($fileContent, '.listliks li');
        $btnPosterStylesArray = $this->parseCssStyles($fileContent, '.btnPoster');

        // Update properties from request for base styles (.listliks)
        $propertiesToUpdate = [
            'top' => 'listliks_top',
            'right' => 'listliks_right',
            'bottom' => 'listliks_bottom',
            'left' => 'listliks_left',
        ];

        foreach ($propertiesToUpdate as $cssProperty => $inputName) {
            if ($request->has($inputName)) {
                $stylesArray[$cssProperty] = $request->input($inputName);
            }
        }

        // Update properties from request for .listliks li styles
        if ($request->has('listliks_li_margin_bottom')) {
            $listItemsStylesArray['margin-bottom'] = $request->input('listliks_li_margin_bottom');
        }
        if ($request->has('listliks_li_width')) {
            $listItemsStylesArray['width'] = $request->input('listliks_li_width');
        }

        // Update properties from request for .btnPoster styles
        $btnPosterProperties = [
            'width' => 'btnPoster_width',
            'height' => 'btnPoster_height',
            'object-fit' => 'btnPoster_object_fit',
            'justify-content' => 'btnPoster_justify_content',
        ];

        foreach ($btnPosterProperties as $cssProperty => $inputName) {
            if ($request->has($inputName)) {
                $btnPosterStylesArray[$cssProperty] = $request->input($inputName);
            }
        }

        // Build the new CSS content for base styles
        $newStyles = ".listliks {\n";
        foreach ($stylesArray as $property => $value) {
            $newStyles .= "    {$property}: {$value};\n";
        }
        $newStyles .= "}\n";

        // Build the new CSS content for .listliks li styles
        $newListItemsStyles = ".listliks li {\n";
        foreach ($listItemsStylesArray as $property => $value) {
            $newListItemsStyles .= "    {$property}: {$value};\n";
        }
        $newListItemsStyles .= "}\n";

        // Build the new CSS content for .btnPoster styles
        $newBtnPosterStyles = ".btnPoster {\n";
        foreach ($btnPosterStylesArray as $property => $value) {
            $newBtnPosterStyles .= "    {$property}: {$value};\n";
        }
        $newBtnPosterStyles .= "}\n";

        // Update the responsive styles if provided
        $responsiveStyles = "@media (max-width: 480px) {\n";
        $responsiveStyles .= "  .listliks {\n";

        // Update the top value if provided in the request
        if ($request->has('responsive_top')) {
            $responsiveStyles .= "    top: {$request->input('responsive_top')};\n";
        } else {
            $responsiveStyles .= "    top: 60%;\n"; // Default value if not provided
        }

        // Update the right value if provided in the request
        if ($request->has('responsive_right')) {
            $responsiveStyles .= "    right: {$request->input('responsive_right')};\n";
        }

        // Update the bottom value if provided in the request
        if ($request->has('responsive_bottom')) {
            $responsiveStyles .= "    bottom: {$request->input('responsive_bottom')};\n";
        }

        // Update the left value if provided in the request
        if ($request->has('responsive_left')) {
            $responsiveStyles .= "    left: {$request->input('responsive_left')};\n";
        }

        $responsiveStyles .= "}\n";

        // Save updated content to the CSS file
        $updatedContent = str_replace($this->getOriginalStyles($fileContent, '.listliks'), $newStyles, $fileContent);
        $updatedContent = str_replace($this->getOriginalStyles($fileContent, '.listliks li'), $newListItemsStyles, $updatedContent);
        $updatedContent = str_replace($this->getOriginalStyles($fileContent, '.btnPoster'), $newBtnPosterStyles, $updatedContent);

        // Ensure responsive styles are included at the end of the file
        if (!str_contains($updatedContent, '@media (max-width: 480px)')) {
            $updatedContent .= $responsiveStyles;
        } else {
            // Replace the existing responsive styles if they already exist
            $updatedContent = preg_replace('/@media \(max-width: 480px\)\s*{[^}]*}/', $responsiveStyles, $updatedContent);
        }

        // Save the updated content to the CSS file
        file_put_contents($filePath, $updatedContent);

        // Redirect back with a success message
        return redirect()->back()->with('success', 'CSS file updated successfully!');
    }

    private function parseCssStyles($fileContent, $selector)
    {
        $stylesArray = [];
        preg_match("/$selector\s*{([^}]*)}/", $fileContent, $matches);

        // Check if the matches are found and the first capturing group exists
        if (isset($matches[1])) {
            $currentStyles = trim($matches[1]);
            foreach (explode(';', $currentStyles) as $style) {
                if (trim($style)) {
                    // Use explode with limit of 2 to avoid notices if no colon is found
                    $parts = explode(':', $style, 2);
                    if (count($parts) == 2) {
                        $stylesArray[trim($parts[0])] = trim($parts[1]);
                    }
                }
            }
        }

        return $stylesArray;
    }

    private function getOriginalStyles($fileContent, $selector)
    {
        preg_match("/$selector\s*{([^}]*)}/", $fileContent, $matches);

        return isset($matches[0]) ? $matches[0] : '';
    }
}
