<?php

namespace App\Http\Requests\Room;

use Illuminate\Foundation\Http\FormRequest;

class RoomRequest extends FormRequest
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
        return [
            'sort_column' => [
                'sometimes', 'string', 'in:net_price,tax_price,total_price',
            ],
            'sort_order' => [
                'sometimes', 'string', 'in:asc,desc',
            ],
            'hotel_id' => [
                'sometimes', 'numeric', 'exists:hotels,id',
            ],
        ];
    }
}
