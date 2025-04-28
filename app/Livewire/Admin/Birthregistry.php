<?php

namespace App\Livewire\Admin;

use App\Models\birthregistry as Birth;
use Livewire\Component;
use Livewire\WithPagination;

class Birthregistry extends Component
{
    use WithPagination;

    public $search = '';
    public $phone_number, $name_of_child, $name_of_parent, $date_of_birth, $family_no, $zone, $gender, $birth_weight, $place_of_birth, $is_registered;
    public $birthRegistryId, $editMode = false;

    public function render()
    {
        $birthregistries = Birth::query()
            ->where('name_of_child', 'like', '%' . $this->search . '%')
            ->orWhere('name_of_parent', 'like', '%' . $this->search . '%')
            ->paginate(10);

        return view('livewire.admin.birthregistry', compact('birthregistries'));
    }

    public function sarch(){
        $this->render();
    }
    public function store()
    {
        $this->validate([
            'name_of_child' => 'required|string|max:255',
            'name_of_parent' => 'required|string|max:255',
            'date_of_birth' => 'required|date',
            'family_no' => 'required|integer',
            'zone' => 'required|string|max:255',
            'gender' => 'required|string|max:255',
            'birth_weight' => 'required|numeric',
            'place_of_birth' => 'required|string|max:255',
            'is_registered' => 'required|boolean',
            'phone_number' => 'required'
        ]);

        Birth::create([
            'name_of_child' => $this->name_of_child,
            'name_of_parent' => $this->name_of_parent,
            'date_of_birth' => $this->date_of_birth,
            'family_no' => $this->family_no,
            'zone' => $this->zone,
            'gender' => $this->gender,
            'birth_weight' => $this->birth_weight,
            'place_of_birth' => $this->place_of_birth,
            'is_registered' => $this->is_registered,
            'phone_number' => $this->phone_number
        ]);

        session()->flash('message', 'Birth Registry Record Added Successfully!');
        $this->resetInputFields();
    }

    private function resetInputFields()
    {
        $this->name_of_child = '';
        $this->name_of_parent = '';
        $this->date_of_birth = '';
        $this->family_no = '';
        $this->zone = '';
        $this->gender = '';
        $this->birth_weight = '';
        $this->place_of_birth = '';
        $this->is_registered = '';
        $this->phone_number= '';
    }

    public function edit($id)
    {
        $birthRegistry = Birth::findOrFail($id);
        $this->birthRegistryId = $birthRegistry->id;
        $this->name_of_child = $birthRegistry->name_of_child;
        $this->name_of_parent = $birthRegistry->name_of_parent;
        $this->date_of_birth = $birthRegistry->date_of_birth;
        $this->family_no = $birthRegistry->family_no;
        $this->zone = $birthRegistry->zone;
        $this->gender = $birthRegistry->gender;
        $this->birth_weight = $birthRegistry->birth_weight;
        $this->place_of_birth = $birthRegistry->place_of_birth;
        $this->is_registered = $birthRegistry->is_registered;
        $this->phone_number = $birthRegistry->phone_number;
        $this->editMode = true;
    }

    public function update()
    {
        $this->validate([
            'name_of_child' => 'required|string|max:255',
            'name_of_parent' => 'required|string|max:255',
            'date_of_birth' => 'required|date',
            'family_no' => 'required|integer',
            'zone' => 'required|string|max:255',
            'gender' => 'required|string|max:255',
            'birth_weight' => 'required|numeric',
            'place_of_birth' => 'required|string|max:255',
            'is_registered' => 'required|boolean',
        ]);

        $birthRegistry = Birth::find($this->birthRegistryId);
        $birthRegistry->update([
            'name_of_child' => $this->name_of_child,
            'name_of_parent' => $this->name_of_parent,
            'date_of_birth' => $this->date_of_birth,
            'family_no' => $this->family_no,
            'zone' => $this->zone,
            'gender' => $this->gender,
            'birth_weight' => $this->birth_weight,
            'place_of_birth' => $this->place_of_birth,
            'is_registered' => $this->is_registered,
            'phone_number' => $this->phone_number,
        ]);

        session()->flash('message', 'Birth Registry Record Updated Successfully!');
        $this->resetInputFields();
        $this->editMode = false;
    }

    public function delete($id)
    {
        Birth::findOrFail($id)->delete();
        session()->flash('message', 'Birth Registry Record Deleted Successfully!');
    }

    public function updatedSearch()
    {
        $this->render();
    }
}
