<?php

namespace App\Livewire\Admin;

use App\Models\Residents;
use App\Models\Birthregistry;
use App\Models\bp_monitoring as BpMonitoring;
use App\Models\O71months;
use App\Models\Pregnancy;
use Illuminate\Support\Facades\DB;
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

    public $showFormModal = false;
    public $showViewModal = false;
    public $viewingResident;
    public $is_desease = false;
    public $status;
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
        'status' => 'required',
        'is_desease' => 'nullable|boolean',
    ];

    public function openAddModal()
    {
        $this->resetForm();
        $this->editMode = false;
        $this->showFormModal = true;
    }

    public function view($id, $type)
    {
        switch ($type) {
            case 'resident':
                $this->viewingResident = Residents::findOrFail($id);
                break;
            case 'birthregistry':
                $this->viewingResident = Birthregistry::findOrFail($id);
                break;
            case 'bp_monitoring':
                $this->viewingResident = BpMonitoring::findOrFail($id);
                break;
            case 'o71month':
                $this->viewingResident = O71months::findOrFail($id);
                break;
            case 'pregnancy':
                $this->viewingResident = Pregnancy::findOrFail($id);
                break;
        }

        $this->showViewModal = true;
        $this->showFormModal = false;
    }

    public function sarch()
    {
        $this->render();
    }

    public function addResident()
    {
        $this->validate();

        Residents::updateOrCreate(
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
                'status' => $this->status,
                'is_desease' => $this->is_desease,
            ]
        );

        session()->flash('message', $this->editResidentId ? 'Resident updated successfully.' : 'Resident added successfully.');
        $this->showFormModal = false;
        $this->resetForm();
    }

    public function edit($id)
    {
        $this->editMode = true;
        $this->editResidentId = $id;
        $resident = Residents::find($id);

        $this->surname = $resident->surname;
        $this->first_name = $resident->first_name;
        $this->phone_number = $resident->phone_number;
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
        $this->status = $resident->status;
        $this->is_desease = $resident->is_desease ?? false;

        $this->showFormModal = true;
    }

    public function delete($id)
    {
        Residents::find($id)->delete();
        session()->flash('message', 'Resident deleted successfully.');
    }

    public function render()
    {
        $residents = Residents::query()
            ->select(
                'id',
                DB::raw("CONCAT(first_name, ' ', surname) as full_name"),
                'date_of_birth',
                'gender',
                'phone_number',
                'status',
                DB::raw("'resident' as type")
            );

        $o71months = O71months::query()
            ->select(
                'id',
                DB::raw("CONCAT(name_of_child, ' ', name_of_parent) as full_name"),
                'date_of_birth',
                DB::raw("'' as gender"),
                'phone_number',
                'status',
                DB::raw("'o71month' as type")
            );

        $pregnancies = Pregnancy::query()
            ->select(
                'id',
                'name as full_name',
                'date_of_birth',
                DB::raw("'' as gender"),
                'mobile_number as phone_number',
                'status',
                DB::raw("'pregnancy' as type")
            );

        $birthregistries = Birthregistry::query()
            ->select(
                'id',
                DB::raw("CONCAT(name_of_child, ' ', name_of_parent) as full_name"),
                'date_of_birth',
                'gender',
                'phone_number',
                'status',
                DB::raw("'birthregistry' as type")
            );

        $bpMonitorings = BpMonitoring::query()
            ->select(
                'id',
                'resident_name as full_name',
                'date_of_birth',
                'gender',
                'phone_number',
                'status',

                DB::raw("'bp_monitoring' as type")
            );

        // Combine all queries using unionAll
        $combinedQuery = $residents
            ->unionAll($o71months)
            ->unionAll($pregnancies)
            ->unionAll($birthregistries)
            ->unionAll($bpMonitorings);

        // Wrap in DB::table(...) to allow further filtering and pagination
        $records = DB::table(DB::raw("({$combinedQuery->toSql()}) as sub"))
            ->mergeBindings($combinedQuery->getQuery())
            ->when($this->search, function ($query) {
                $query->where(function ($q) {
                    $q->where('full_name', 'like', '%' . $this->search . '%')
                      ->orWhere('phone_number', 'like', '%' . $this->search . '%');
                });
            })
            ->orderBy('full_name')
            ->paginate(10);

        return view('livewire.admin.all-residents', [
            'residents' => $records
        ]);
    }


    private function resetForm()
    {
        $this->reset([
            'surname', 'first_name', 'middle_name', 'date_of_birth', 'age', 'gender','status',
            'place_of_birth', 'relationship_with_family_head', 'civil_status',
            'occupation', 'religion', 'citizenship', 'family_number', 'zone_or_purok', 'phone_number', 'is_desease'
        ]);
        $this->editMode = false;
        $this->editResidentId = null;
    }
}
