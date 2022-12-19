<?php

namespace App\Http\Requests;

use App\Models\GroupsProjects;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class projectsGroupsUpdateRequest extends FormRequest
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
            'id' =>[
                'exists:groups_projects,idL'
            ],
            'name' => [
                'required',
                'min:3',
                'max:30',
                // уникальное название группы для пользователя
                function ($attribute, $value, $fail) {
                    if (GroupsProjects::where('user_id', Auth::id())->where('name', $value)->exists()) {
                        $fail('Название группы существует');
                    }
                }
            ]
        ];
    }
}
