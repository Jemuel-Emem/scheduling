<?php
namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\medical_record as Medical_Records;
use App\Models\Residents;
use App\Models\O71months;
use App\Models\Pregnancy;
use App\Models\Birthregistry;
use App\Models\Bp_Monitoring;

class MedicalRecord extends Component
{
    public $records;
    public $selectedCategory = '';
    public $searchName = '';
    public $full_name, $age, $gender;




    public $diagnosis, $symptoms, $prescriptions;
    public function mount()
    {
        $this->fetchRecords();
    }
    public function fetchRecords()
    {
        $query = Medical_Records::query();

        if (!empty($this->searchName)) {
            $query->where('full_name', 'like', '%' . $this->searchName . '%');
        }

        $this->records = $query->latest()->get();
    }
    public function updatedSearchName()
    {
        $this->fetchRecords();
    }

    public function fetchByName()
    {
        $this->reset(['full_name', 'age', 'gender']);

        if (!$this->selectedCategory || !$this->searchName) {
            session()->flash('error', 'Please select category and enter a name.');
            return;
        }

        $record = null;

        switch ($this->selectedCategory) {
            case 'residents':
                $record = Residents::whereRaw("CONCAT(first_name, ' ', surname) LIKE ?", ["%{$this->searchName}%"])->first();
                if ($record) {
                    $this->full_name = "{$record->first_name} {$record->surname}";
                    $this->age = $record->age;
                    $this->gender = $record->gender;
                }
                break;

            case 'o71months':
                $record = O71months::where('name_of_child', 'like', "%{$this->searchName}%")->first();
                if ($record) {
                    $this->full_name = $record->name_of_child;
                    $this->age = $record->age_in_month;
                    $this->gender = 'N/A';
                }
                break;

            case 'pregnancy':
                $record = Pregnancy::where('name', 'like', "%{$this->searchName}%")->first();
                if ($record) {
                    $this->full_name = $record->name;
                    $this->age = $record->age;
                    $this->gender = 'Female';
                }
                break;

            case 'birthregistry':
                $record = Birthregistry::where('name_of_child', 'like', "%{$this->searchName}%")->first();
                if ($record) {
                    $this->full_name = $record->name_of_child;
                    $this->age = now()->diffInYears($record->date_of_birth);
                    $this->gender = $record->gender;
                }
                break;

            case 'bpmonitoring':
                $record = Bp_Monitoring::where('resident_name', 'like', "%{$this->searchName}%")->first();
                if ($record) {
                    $this->full_name = $record->resident_name;
                    $this->age = $record->age;
                    $this->gender = 'N/A';
                }
                break;
        }

        if (!$record) {
            session()->flash('error', 'No matching record found.');
        }
    }

    public function save()
    {
        $this->validate([
            'diagnosis' => 'required|string',
            'symptoms' => 'required|string',
            'prescriptions' => 'required|string',
        ]);

        Medical_Records::create([
            'full_name' => $this->full_name,
            'age' => $this->age,
            'gender' => $this->gender,
            'diagnosis' => $this->diagnosis,
            'symptoms' => $this->symptoms,
            'prescriptions' => $this->prescriptions,
            'category' => $this->selectedCategory,
        ]);

        session()->flash('success', 'Medical record saved.');

$this->render();
        $this->reset(['searchName', 'full_name', 'age', 'gender', 'diagnosis', 'symptoms', 'prescriptions']);
    }

    public function render()
    {
        return view('livewire.admin.medical-record');
    }
}
