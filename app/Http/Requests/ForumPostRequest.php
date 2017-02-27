<?php
/* ----------------------------------------------------------------------------
 * Simple Forum System - by Amila
 *
 * @author      Amila Tilakarathna<vishnaka23@gmail.com>
 * @copyright   Copyright (c) 2017, Amila
 * @link        http://forum.local/
 * @since       v1.0.0
 * ---------------------------------------------------------------------------- */

namespace SimpleForum\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/*
 * This is custom formrequest class to validate question input
*/

class ForumPostRequest extends FormRequest
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
        $this->sanitize();

        return [
          'question' => 'required'
        ];
    }

    public function sanitize()
    {
        $input = $this->all();
        $input['question'] = htmlentities($input['question']);
        $this->replace($input);
    }
}
