<?php

namespace App\Http\Requests\Trade;

use App\Purchase;
use Illuminate\Foundation\Http\FormRequest;

class SoldRequest extends FormRequest
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
        if(!$this->purchase_id || !$this->qt || !$this->pu){
            return back()->withErrors(['product' => 'lkdfkjdslh'])->withInput();
        }
        $purchase = Purchase::where(['id',$this->purchase_id])->with(['trade'])->first();
        // purchase est required et appartient a cette company
        // la quantité est required et inférieur ou égale a la quantité offert par le purchase
        // le prix unitaire est obligatoire il est égale ou supérieur a 0.01
        if(!$purchase){
            return back();
        }
        if($purchase->qt < $this->qt){
            //
        }

    }
}
