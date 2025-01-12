<?php
namespace App\Livewire\Admin;

use App\Models\Appointment;
use App\Models\residents as Resident;
use Livewire\Component;

class Index extends Component
{
    public $residentCount;
    public $appointmentCount;

    public function mount()
    {

        $this->residentCount = Resident::count();
        $this->appointmentCount = Appointment::count();
    }

    public function render()
    {
        return view('livewire.admin.index');
    }
}
