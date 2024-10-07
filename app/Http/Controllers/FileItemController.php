<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FileItemController extends Controller
{
    public function index()
    {
        $filePath = 'project/application/assets/css/index1000.css';
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
        ]);
    
        // Get the file path from the request
        $filePath = $request->input('filePath');
    
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
    
        // Add responsive styles
        $responsiveStyles = "@media (max-width: 480px) {\n";
        $responsiveStyles .= "  .listliks {\n";
        $responsiveStyles .= "    top: 60%;\n";
        $responsiveStyles .= "    transform: translate(-50%, -50%);\n";
        $responsiveStyles .= "    flex-direction: column;\n";
        $responsiveStyles .= "    align-items: center;\n";
        $responsiveStyles .= "    left: 37%;\n";
        $responsiveStyles .= "  }\n";
        $responsiveStyles .= "  .listliks li {\n";
        $responsiveStyles .= "    width: 100%; /* Smaller button size */\n";
        $responsiveStyles .= "    margin-bottom: 10px; /* Space between buttons */\n";
        $responsiveStyles .= "  }\n";
        $responsiveStyles .= "  .listliks li a {\n";
        $responsiveStyles .= "    width: 100%;\n";
        $responsiveStyles .= "    text-align: center;\n";
        $responsiveStyles .= "  }\n";
        $responsiveStyles .= "  .listliks li a img {\n";
        $responsiveStyles .= "    height: 80px; /* Smaller button size */\n";
        $responsiveStyles .= "    width: auto;\n";
        $responsiveStyles .= "  }\n";
        $responsiveStyles .= "}\n";
    
        // Save updated content to the CSS file
        $updatedContent = str_replace($this->getOriginalStyles($fileContent, '.listliks'), $newStyles, $fileContent);
        $updatedContent = str_replace($this->getOriginalStyles($fileContent, '.listliks li'), $newListItemsStyles, $updatedContent);
        $updatedContent = str_replace($this->getOriginalStyles($fileContent, '.btnPoster'), $newBtnPosterStyles, $updatedContent);
        
        // Ensure responsive styles are included at the end of the file
        if (!str_contains($updatedContent, '@media (max-width: 480px)')) {
            $updatedContent .= $responsiveStyles;
        }
    
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
                    if (count($parts) === 2) {
                        $property = trim($parts[0]);
                        $value = trim($parts[1]);
                        $stylesArray[$property] = $value;
                    }
                }
            }
        }
        return $stylesArray;
    }
    
    private function getOriginalStyles($fileContent, $selector)
    {
        preg_match("/($selector\s*{[^}]*)}/", $fileContent, $matches);
        return !empty($matches) ? $matches[0] : '';
    }
}
