<?php

namespace App\Http\Livewire\History;

use Livewire\Component;
use Livewire\WithPagination;

class Sent extends Component
{
    use WithPagination;

    public string $tab = 'sent';

    public function mount($tab)
    {
        $this->tab = $tab;
    }
    public function render()
    {
        return view('livewire.history.sent', [
            'contracts' => auth()
                ->user()
                ->contracts()
                ->with('status', 'recipient')
                ->orderByDesc('id')
                ->paginate(5),
            'tab' => $this->tab,
        ]);
    }
}
