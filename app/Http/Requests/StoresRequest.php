<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoresRequest extends FormRequest
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
            'phone'=>'required',
            'address'=>'required',
        ];
    }
    public function messages()
    {
        return [
        'name.required'=>'اسم  الفئة مطلوب',
      
        
        'active.required'=>' الرجاء تحديد حالة الفئة ' ,
        'phone.required'=>'رقم الهاتف مطلوب    ',
      
        
        'address.required'=>'    العنوان مطلوب ' ,
         
        ];
    }
}
