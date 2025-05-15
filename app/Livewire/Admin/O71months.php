<?php
namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\O71months as O71month;

class O71months extends Component
{
    use WithPagination;

    public $name_of_child, $name_of_parent, $date_of_birth, $age_in_month, $weight, $height, $family_no, $zone, $phone_number;
    public $selectedId;
    public $editMode = false;
    public $search = '';
    public $showModal = false;
    public $viewMode = false;
    public $currentRecord;
    public $is_desease = false;
    public $status;
    public $gender;
    protected $rules = [
        'name_of_child' => 'required|string|max:255',
        'name_of_parent' => 'required|string|max:255',
        'date_of_birth' => 'required|date',
        'age_in_month' => 'required|integer',
        'weight' => 'nullable|numeric',
        'height' => 'nullable|numeric',
        'family_no' => 'required|integer',
        'zone' => 'required|string|max:255',
        'phone_number' => 'required',
        'status' => 'required',
        'is_desease' => 'nullable|boolean',
        'gender' => 'required|in:Male,Female',
    ];

    public function sarch(){

    }
    public function render()
    {
        $query = O71month::query();

        if ($this->search) {
            $query->where('name_of_child', 'like', '%' . $this->search . '%')
                  ->orWhere('name_of_parent', 'like', '%' . $this->search . '%')
                  ->orWhere('family_no', 'like', '%' . $this->search . '%');
        }

        $o71months = $query->paginate(5);

        return view('livewire.admin.o71months', ['o71months' => $o71months]);
    }

    public function openAddModal()
    {
        $this->resetFields();
        $this->editMode = false;
        $this->viewMode = false;
        $this->showModal = true;
    }

    public function addO71month()
    {
        $this->validate();

        O71month::create([
            'name_of_child' => $this->name_of_child,
            'name_of_parent' => $this->name_of_parent,
            'date_of_birth' => $this->date_of_birth,
            'age_in_month' => $this->age_in_month,
            'weight' => $this->weight,
            'height' => $this->height,
            'family_no' => $this->family_no,
            'zone' => $this->zone,
            'phone_number' => $this->phone_number,
            'status' => $this->status,
            'is_desease' => $this->is_desease,
            'gender' =>$this->gender
        ]);

        session()->flash('message', 'O71 Month added successfully.');
        $this->showModal = false;
        $this->resetFields();
    }

    public function view($id)
    {
        $this->currentRecord = O71month::findOrFail($id);
        $this->viewMode = true;
        $this->showModal = true;
        $this->editMode = false;
    }

    public function edit($id)
    {
        $o71month = O71month::findOrFail($id);

        $this->selectedId = $id;
        $this->name_of_child = $o71month->name_of_child;
        $this->name_of_parent = $o71month->name_of_parent;
        $this->date_of_birth = $o71month->date_of_birth->format('Y-m-d');
        $this->age_in_month = $o71month->age_in_month;
        $this->weight = $o71month->weight;
        $this->height = $o71month->height;
        $this->family_no = $o71month->family_no;
        $this->zone = $o71month->zone;
        $this->phone_number = $o71month->phone_number;
        $this->status = $o71month->status;
        $this->gender = $o71month->gender;
        $this->is_desease = $o71month->is_desease ?? false;
        $this->editMode = true;
        $this->viewMode = false;
        $this->showModal = true;
    }

    public function updateO71month()
    {
        $this->validate();

        O71month::findOrFail($this->selectedId)->update([
            'name_of_child' => $this->name_of_child,
            'name_of_parent' => $this->name_of_parent,
            'date_of_birth' => $this->date_of_birth,
            'age_in_month' => $this->age_in_month,
            'weight' => $this->weight,
            'height' => $this->height,
            'family_no' => $this->family_no,
            'zone' => $this->zone,
            'phone_number' => $this->phone_number,
            'status' => $this->status,
            'is_desease' => $this->is_desease,
            'gender' => $this->gender,
        ]);

        session()->flash('message', 'O71 Month updated successfully.');
        $this->showModal = false;
        $this->resetFields();
    }

    public function delete($id)
    {
        O71month::findOrFail($id)->delete();
        session()->flash('message', 'O71 Month deleted successfully.');
    }

    private function resetFields()
    {
        $this->reset([
            'name_of_child', 'name_of_parent', 'date_of_birth', 'age_in_month',
            'weight', 'height', 'family_no', 'zone', 'phone_number',
            'editMode', 'selectedId','gender', 'viewMode', 'currentRecord','is_desease','status',
        ]);
        $this->resetErrorBag();
    }
}
