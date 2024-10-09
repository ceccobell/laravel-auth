<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProjectRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'required|string|max:100',
            'summary' => 'nullable|string',
            'project_image' => 'nullable|image|max:2048',  
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'Il nome del progetto è obbligatorio.',
            'name.string' => 'Il nome del progetto deve essere una stringa.',
            'name.max' => 'Il nome del progetto non può superare i 100 caratteri.',
            'summary.string' => 'Il sommario deve essere una stringa.',
            'project_image.image' => "Il file caricato deve essere un'immagine.",
            'project_image.max' => "L'immagine non può superare i 2MB.",
        ];
    }
}