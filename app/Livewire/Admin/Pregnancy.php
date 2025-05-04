<?php
namespace App\Livewire\Admin;

use App\Models\Pregnancy as Preg;
use Livewire\Component;
use Livewire\WithPagination;

class Pregnancy extends Component
{
    use WithPagination;

    public $name, $date_of_birth, $age, $family_no, $zone, $mobile_number, $estimated_due_date, $last_checkup, $child_name;
    public $editMode = false, $pregnancyId;
    public $search = '';
    public $showModal = false;
    public $viewMode = false;
    public $currentRecord;

    protected $rules = [
        'name' => 'required|string|max:255',
        'date_of_birth' => 'required|date',
        'age' => 'required|integer',
        'family_no' => 'required|integer',
        'zone' => 'required|string|max:255',
        'mobile_number' => 'required|string|max:20',
        'estimated_due_date' => 'required|date',
    ];

    public function render()
    {
        $pregnancies = Preg::query()
            ->where('name', 'like', '%' . $this->search . '%')
            ->orWhere('mobile_number', 'like', '%' . $this->search . '%')
            ->paginate(10);

        return view('livewire.admin.pregnancy', compact('pregnancies'));
    }

    public function openAddModal()
    {
        $this->resetFields();
        $this->editMode = false;
        $this->viewMode = false;
        $this->showModal = true;
    }

    public function addPregnancyRecord()
    {
        $this->validate();

        Preg::create([
            'name' => $this->name,
            'date_of_birth' => $this->date_of_birth,
            'age' => $this->age,
            'family_no' => $this->family_no,
            'zone' => $this->zone,
            'mobile_number' => $this->mobile_number,
            'estimated_due_date' => $this->estimated_due_date,
            'last_checkup' => $this->last_checkup,
            'child_name' => $this->child_name,
        ]);

        session()->flash('message', 'Pregnancy record added successfully!');
        $this->showModal = false;
        $this->resetFields();
    }

    public function view($id)
    {
        $this->currentRecord = Preg::findOrFail($id);
        $this->viewMode = true;
        $this->showModal = true;
        $this->editMode = false;
    }

    public function editPregnancy($id)
    {
        $pregnancy = Preg::findOrFail($id);

        $this->pregnancyId = $id;
        $this->name = $pregnancy->name;
        $this->date_of_birth = $pregnancy->date_of_birth;
        $this->age = $pregnancy->age;
        $this->family_no = $pregnancy->family_no;
        $this->zone = $pregnancy->zone;
        $this->mobile_number = $pregnancy->mobile_number;
        $this->estimated_due_date = $pregnancy->estimated_due_date;
        $this->last_checkup = $pregnancy->last_checkup;
        $this->child_name = $pregnancy->child_name;

        $this->editMode = true;
        $this->viewMode = false;
        $this->showModal = true;
    }

    public function updatePregnancy()
    {
        $this->validate();

        Preg::findOrFail($this->pregnancyId)->update([
            'name' => $this->name,
            'date_of_birth' => $this->date_of_birth,
            'age' => $this->age,
            'family_no' => $this->family_no,
            'zone' => $this->zone,
            'mobile_number' => $this->mobile_number,
            'estimated_due_date' => $this->estimated_due_date,
            'last_checkup' => $this->last_checkup,
            'child_name' => $this->child_name,
        ]);

        session()->flash('message', 'Pregnancy record updated successfully!');
        $this->showModal = false;
        $this->resetFields();
    }

    public function deletePregnancy($id)
    {
        Preg::findOrFail($id)->delete();
        session()->flash('message', 'Pregnancy record deleted successfully!');
    }

    private function resetFields()
    {
        $this->reset([
            'name', 'date_of_birth', 'age', 'family_no', 'zone',
            'mobile_number', 'estimated_due_date', 'last_checkup', 'child_name',
            'editMode', 'pregnancyId', 'viewMode', 'currentRecord'
        ]);
        $this->resetErrorBag();
    }

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function sarch(){

    }
}
