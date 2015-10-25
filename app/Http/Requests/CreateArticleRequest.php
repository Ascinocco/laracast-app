<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class CreateArticleRequest extends Request
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
     * @return array
     */
    public function rules()
    {
        //these are our Article creation validation rules
        //these fields match the ones from our create.blade.php
        //and should always match the fields you need validated
        return [
            'title' => 'required|min:3',
            'body' => 'required',
            'published_at' => 'required|date'
        ];
    }
}
