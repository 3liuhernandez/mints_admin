<?php

namespace App\View\Components\Form;

use App\Models\CourseStatus;
use App\Models\CourseType;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
use Illuminate\View\Component;

class ModalForm extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public string $id,
        public string $modalTitle,
        public Collection $courseTypes,
        public Collection $courseStatuses
    ) {}

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.form.modal-form');
    }
}
