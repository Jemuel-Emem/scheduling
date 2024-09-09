<?php

namespace App\Livewire\Admin;

use App\Models\Medicine as Med;
use Livewire\Component;
use Livewire\WithPagination;

class Medicine extends Component
{
    use WithPagination;

    public $medicine_id, $name, $type, $description, $stocks;
    public $medicineToEdit = null;


    protected function rules()
    {
        $rules = [
            'name' => 'required|max:255',
            'type' => 'required|max:50',
            'description' => 'nullable|max:500',
            'stocks' => 'required|integer|min:0',
        ];


        if ($this->medicineToEdit) {
            $rules['medicine_id'] = 'required|max:10|unique:medicines,medicine_id,' . $this->medicineToEdit->id;
        } else {

            $rules['medicine_id'] = 'required|max:10|unique:medicines,medicine_id';
        }

        return $rules;
    }

    public function mount()
    {
        $this->resetForm();
    }

    public function resetForm()
    {
        $this->medicine_id = '';
        $this->name = '';
        $this->type = '';
        $this->description = '';
        $this->stocks = '';
        $this->medicineToEdit = null;
    }

    public function addOrUpdateMedicine()
    {

        $validatedData = $this->validate();

        if ($this->medicineToEdit) {

            $this->medicineToEdit->update($validatedData);
            session()->flash('message', 'Medicine updated successfully.');
        } else {

            Med::create($validatedData);
            session()->flash('message', 'Medicine added successfully.');
        }


        $this->resetForm();
    }

    public function editMedicine(Med $medicine)
    {

        $this->medicineToEdit = $medicine;
        $this->medicine_id = $medicine->medicine_id;
        $this->name = $medicine->name;
        $this->type = $medicine->type;
        $this->description = $medicine->description;
        $this->stocks = $medicine->stocks;
    }

    public function deleteMedicine(Med $medicine)
    {

        $medicine->delete();
        session()->flash('message', 'Medicine deleted successfully.');
    }

    public function render()
    {
        return view('livewire.admin.medicine', [
            'medicines' => Med::paginate(10),
        ]);
    }
}
