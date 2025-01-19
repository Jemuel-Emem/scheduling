<?php

namespace App\Livewire\Admin;

use App\Models\residents as Resident;
use Livewire\Component;
use Livewire\WithPagination;
use Carbon\Carbon;

class AllResidents extends Component
{
    use WithPagination;
    public $phone_number;
    public $surname;
    public $first_name;
    public $middle_name;
    public $date_of_birth;
    public $age;
    public $gender;
    public $place_of_birth;
    public $relationship_with_family_head;
    public $civil_status;
    public $occupation;
    public $religion;
    public $citizenship;
    public $family_number;
    public $zone_or_purok;
    public $search = '';
    public $editMode = false;
    public $editResidentId;

    protected $rules = [
        'surname' => 'required|string|max:255',
        'first_name' => 'required|string|max:255',
        'middle_name' => 'nullable|string|max:255',
        'date_of_birth' => 'required|date',
        'age' => 'required|integer',
        'gender' => 'required|in:Male,Female',
        'place_of_birth' => 'required|string|max:255',
        'relationship_with_family_head' => 'required|string|max:255',
        'civil_status' => 'required|in:Single,Married,Widowed,Separated,Divorced',
        'occupation' => 'nullable|string|max:255',
        'religion' => 'nullable|string|max:255',
        'citizenship' => 'required|string|max:255',
        'family_number' => 'required|integer',
        'zone_or_purok' => 'required|string|max:255',
        'phone_number' => 'required',
    ];

    public function sarch(){
        $this->render();
    }
    public function addResident()
    {
        $this->validate();

        Resident::updateOrCreate(
            ['id' => $this->editResidentId],
            [
                'surname' => $this->surname,
                'first_name' => $this->first_name,
                'middle_name' => $this->middle_name,
                'date_of_birth' => $this->date_of_birth,
                'age' => $this->age,
                'gender' => $this->gender,
                'place_of_birth' => $this->place_of_birth,
                'relationship_with_family_head' => $this->relationship_with_family_head,
                'civil_status' => $this->civil_status,
                'occupation' => $this->occupation,
                'religion' => $this->religion,
                'citizenship' => $this->citizenship,
                'family_number' => $this->family_number,
                'zone_or_purok' => $this->zone_or_purok,
                'phone_number' => $this->phone_number,
            ]
        );

        session()->flash('message', $this->editResidentId ? 'Resident updated successfully.' : 'Resident added successfully.');

        $this->resetForm();
    }

    public function edit($id)
    {
        $this->editMode = true;
        $this->editResidentId = $id;
        $resident = Resident::find($id);

        $this->surname = $resident->surname;
        $this->first_name = $resident->first_name;
        $this->middle_name = $resident->middle_name;
        $this->date_of_birth = $resident->date_of_birth;
        $this->age = $resident->age;
        $this->gender = $resident->gender;
        $this->place_of_birth = $resident->place_of_birth;
        $this->relationship_with_family_head = $resident->relationship_with_family_head;
        $this->civil_status = $resident->civil_status;
        $this->occupation = $resident->occupation;
        $this->religion = $resident->religion;
        $this->citizenship = $resident->citizenship;
        $this->family_number = $resident->family_number;
        $this->zone_or_purok = $resident->zone_or_purok;
        $this->phone_number = $resident->phone_number;
    }

    public function delete($id)
    {
        Resident::find($id)->delete();
        session()->flash('message', 'Resident deleted successfully.');
    }

    public function render()
    {
        $residents = Resident::where('surname', 'like', '%' . $this->search . '%')
                             ->orWhere('first_name', 'like', '%' . $this->search . '%')
                             ->orWhere('middle_name', 'like', '%' . $this->search . '%')
                             ->paginate(5);

       
        $residents->each(function ($resident) {
            $resident->date_of_birth = Carbon::parse($resident->date_of_birth);
        });

        return view('livewire.admin.all-residents', ['residents' => $residents]);
    }

    private function resetForm()
    {
        $this->reset([
            'surname', 'first_name', 'middle_name', 'date_of_birth', 'age', 'gender',
            'place_of_birth', 'relationship_with_family_head', 'civil_status',
            'occupation', 'religion', 'citizenship', 'family_number', 'zone_or_purok', 'phone_number'
        ]);
        $this->editMode = false;
        $this->editResidentId = null;
    }
}
