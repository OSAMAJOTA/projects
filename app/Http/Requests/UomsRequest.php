<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UomsRequest extends FormRequest
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
            'name'=>'required',
          
            'active'=>'required',
            'is_master'=>'required',
        ];
    }
    public function messages()
    {
        return [
        'name.required'=>'اسم  الوحدة مطلوب',
      
        
        'active.required'=>' الرجاء تحديد حالة الوحدة ' ,
         
        'is_master.required'=>' الرجاء تحديد نوع الوحدة ' ,
         
        ];
    }
}
