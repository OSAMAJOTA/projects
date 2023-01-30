<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class itemcardRequest extends FormRequest
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
          
            'item_type'=>'required',
            'inv_itemcard_cataegories_id'=>'required',
            'uom_id'=>'required',
            'dose_has_retailunit'=>'required',
           'retail_uom_id'=>'required_if:dose_has_retailunit,1',
          //  ''=>'required',
          //  ''=>'required',
        //    ''=>'required',
        ];
    }
    public function messages()
    {
        return [
        'name.required'=>'اسم  الصنف  مطلوب',
        'item_type.required'=>'نوع  الصنف  مطلوب',
        'inv_itemcard_cataegories_id.required'=>'فئة  الصنف  مطلوب',
        'uom_id.required'=>'الوحدة الاساسية  للصنف  مطلوبة',
        'dose_has_retailunit.required'=>'حالة هل للصنف وحدة تجزئة ' ,
        'retail_uom_id.required_if'=>'وحدة التجزئة مطلوبة' ,
        ];
    }
}
