<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VideoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'day' => 'nullable|string',
            'theme' => 'nullable|string',
            'video_source' => 'nullable|in:upload,youtube',
            'video' => 'nullable|required_if:video_source,upload|file|mimes:mp4,mov,avi,wmv',
            'youtube_url' => 'nullable|required_if:video_source,youtube',
        ];
    }
}
