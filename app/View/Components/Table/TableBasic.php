<?php

namespace App\View\Components\Table;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
use Illuminate\View\Component;

class TableBasic extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public string $name,
        public object $heading,
        public Collection $data,
        public bool $with_footer = false,
    ) {
        $this->prepare_data();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.table.table-basic', [
            'name' => $this->name,
            'heading' => $this->heading,
            'data' => $this->data,
            'with_footer' => $this->with_footer,
        ]);
    }

    private function prepare_data()
    {
        $heading = collect([]);

        collect($this->heading)->map(function ($row) use (&$heading) {
            $heading->push($row['key']);
        });

        // Usar la colección $heading en lugar de $head_text
        $this->data = $this->data->map(function ($row) use ($heading) {
            return $row->only($heading->toArray());
        });
    }
}
