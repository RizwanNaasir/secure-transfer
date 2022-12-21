<?php

namespace App\Http\Livewire\History;

use Livewire\Component;
use Livewire\WithPagination;

class Received extends Component
{
    use WithPagination;
    public string $tab = 'received';

    public function mount($tab)
    {
        $this->tab = $tab;
    }

    public function render()
    {
        return view('livewire.history.received',[
            'contracts' => auth()
                ->user()
                ->receivedContracts()
                ->with('status', 'user')
                ->orderByDesc('id')
                ->paginate(5),
            'tab' => $this->tab,
        ]);
    }
}
