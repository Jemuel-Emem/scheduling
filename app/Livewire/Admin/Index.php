<?php
namespace App\Livewire\Admin;
use App\Models\birthregistry;
use App\Models\Medicine;
use App\Models\bp_monitoring;
use App\Models\o71months;
use App\Models\pregnancy;
use App\Models\Appointment;
use App\Models\residents as Resident;
use Livewire\Component;

class Index extends Component
{
    public $residentCount;
    public $appointmentCount;

    public $birthRegistryCount;
    public $bpMonitoringCount;
    public $o71MonthsCount;
    public $pregnancyCount;
    public $medicineCount;
    public function mount()
    {
        $this->residentCount = Resident::count();
        $this->appointmentCount = Appointment::count();
        $this->birthRegistryCount = birthregistry::count();
        $this->bpMonitoringCount = bp_monitoring::count();
        $this->o71MonthsCount = o71months::count();
        $this->pregnancyCount = pregnancy::count();
        $this->medicineCount = Medicine::count();
    }

    public function render()
    {
        return view('livewire.admin.index');
    }
}
