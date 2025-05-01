<?php

namespace App\Livewire\Admin;

use App\Models\Appointment;
use Livewire\Component;
use Livewire\WithPagination;

class Reschedule extends Component
{
    use WithPagination;

    public $search = '';

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $reschedules = Appointment::where('reschedule_option', 'date')
            ->when($this->search, fn($query) =>
                $query->where('full_name', 'like', '%' . $this->search . '%')
                      ->orWhere('phone', 'like', '%' . $this->search . '%')
            )
            ->orderBy('reschedule_date', 'desc')
            ->paginate(10);

        return view('livewire.admin.reschedule', compact('reschedules'));
    }
}
