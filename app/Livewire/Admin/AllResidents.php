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

class AllResidents extends Component
{
    use WithPagination;

    // Common properties
    public $search = '';
    public $showModal = false;
    public $editMode = false;
    public $viewMode = false;
    public $currentRecord;
    public $modalType = ''; // 'resident', 'o71month', 'pregnancy', 'birthregistry', 'bp_monitoring'

    // Resident properties
    public $residentId;
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
    public $phone_number;
    public $status;
    public $is_desease = false;

    // O71 Month properties
    public $id_number;
    public $o71monthId;
    public $name_of_child;
    public $name_of_parent;
    public $age_in_month;
    public $weight;
    public $height;
    public $zone;

    // Pregnancy properties
       public $id_number1;
    public $pregnancyId;
    public $pregnancy_name;
    public $mobile_number;
    public $estimated_due_date;
    public $last_checkup;
    public $child_name;
      public $pregnancy_family_number;

    // Birth Registry properties
   public $id_number2;
    public $birthRegistryId;
    public $birth_weight;
    public $is_registered;
        public $birthregistry_fam_number;
public $b_date_of_birth;

    // BP Monitoring properties
       public $id_number3;
    public $bpMonitoringId;
    public $resident_name;
    public $bp;
    public $level;
    public $date;

    public function openAddModal($type)
    {
        $this->modalType = $type;
        $this->resetForm();
        $this->editMode = false;
        $this->viewMode = false;
        $this->showModal = true;
    }

    public function view($id, $type)
    {
        $this->modalType = $type;
        $this->viewMode = true;
        $this->editMode = false;

        switch ($type) {
            case 'resident':
                $this->currentRecord = Residents::findOrFail($id);
                break;
            case 'o71month':
                $this->currentRecord = O71months::findOrFail($id);
                break;
            case 'pregnancy':
                $this->currentRecord = Pregnancy::findOrFail($id);
                break;
            case 'birthregistry':
                $this->currentRecord = Birthregistry::findOrFail($id);
                break;
            case 'bp_monitoring':
                $this->currentRecord = BpMonitoring::findOrFail($id);
                break;
        }

        $this->showModal = true;
    }

    public function edit($id, $type)
    {
        $this->modalType = $type;
        $this->editMode = true;
        $this->viewMode = false;

        switch ($type) {
            case 'resident':
                $resident = Residents::findOrFail($id);
                $this->residentId = $id;
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
                $this->status = $resident->status;
                $this->is_desease = $resident->is_desease ?? false;
                break;

            case 'o71month':
                $o71month = O71months::findOrFail($id);
                $this->o71monthId = $id;
                 $this->id_number=  $o71month->id_number;
                $this->name_of_child = $o71month->name_of_child;
                $this->name_of_parent = $o71month->name_of_parent;
                $this->date_of_birth = $o71month->date_of_birth;
                $this->age_in_month = $o71month->age_in_month;
                $this->weight = $o71month->weight;
                $this->height = $o71month->height;
                $this->gender = $o71month->gender;
                $this->family_number = $o71month->family_no;
                $this->zone = $o71month->zone;
                $this->phone_number = $o71month->phone_number;
                $this->status = $o71month->status;
                $this->is_desease = $o71month->is_desease ?? false;
                break;

            case 'pregnancy':
                $pregnancy = Pregnancy::findOrFail($id);
                $this->pregnancyId = $id;
                $this->id_number1=  $pregnancy->id_number;
                $this->pregnancy_name = $pregnancy->name;
                $this->date_of_birth = $pregnancy->date_of_birth;
                $this->age = $pregnancy->age;
                $this->pregnancy_family_number = $pregnancy->family_no;
                $this->zone = $pregnancy->zone;
                $this->mobile_number = $pregnancy->mobile_number;
                $this->estimated_due_date = $pregnancy->estimated_due_date;
                $this->last_checkup = $pregnancy->last_checkup;
                $this->child_name = $pregnancy->child_name;
                $this->gender = $pregnancy->gender;
                $this->status = $pregnancy->status;
                $this->is_desease = $pregnancy->is_desease ?? false;
                break;

            case 'birthregistry':
                $birthRegistry = Birthregistry::findOrFail($id);
                $this->birthRegistryId = $id;
                    $this->id_number2=   $birthRegistry->id_number;
                $this->name_of_child = $birthRegistry->name_of_child;
                $this->name_of_parent = $birthRegistry->name_of_parent;
                $this->date_of_birth = $birthRegistry->date_of_birth;
                $this->birthregistry_fam_number = $birthRegistry->family_no;
                $this->zone = $birthRegistry->zone;
                $this->gender = $birthRegistry->gender;
                $this->birth_weight = $birthRegistry->birth_weight;
                $this->place_of_birth = $birthRegistry->place_of_birth;
                $this->is_registered = $birthRegistry->is_registered;
                $this->phone_number = $birthRegistry->phone_number;
                $this->status = $birthRegistry->status;
                $this->is_desease = $birthRegistry->is_desease ?? false;
                break;

            case 'bp_monitoring':
                $bpMonitoring = BpMonitoring::findOrFail($id);
                $this->bpMonitoringId = $id;
                $this->id_number3=  $bpMonitoring->id_number;
                $this->resident_name = $bpMonitoring->resident_name;
                $this->age = $bpMonitoring->age;
                $this->phone_number = $bpMonitoring->phone_number;
                $this->bp = $bpMonitoring->bp;
                $this->level = $bpMonitoring->level;
                $this->date = $bpMonitoring->date;
                $this->gender = $bpMonitoring->gender;
                $this->date_of_birth = $bpMonitoring->date_of_birth;
                $this->status = $bpMonitoring->status;
                $this->is_desease = $bpMonitoring->is_desease ?? false;
                break;
        }

        $this->showModal = true;
    }

    public function save()
    {
        switch ($this->modalType) {
            case 'resident':
                $this->validateResident();
                $this->saveResident();
                break;

            case 'o71month':
                $this->validateO71Month();
                $this->saveO71Month();
                break;

            case 'pregnancy':
                // $this->validatePregnancy();
                $this->savePregnancy();
                break;

            case 'birthregistry':
               // $this->validateBirthRegistry();
                $this->saveBirthRegistry();
                break;

            case 'bp_monitoring':
               // $this->validateBpMonitoring();
                $this->saveBpMonitoring();
                break;
        }

        $this->showModal = false;
        session()->flash('message', 'Record saved successfully.');
    }

    protected function validateResident()
    {
        $this->validate([
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
        ]);
    }

    protected function validateO71Month()
    {
        $this->validate([
            'name_of_child' => 'required|string|max:255',
            'name_of_parent' => 'required|string|max:255',
            'date_of_birth' => 'required|date',
            'age_in_month' => 'required|integer',
            'weight' => 'nullable|numeric',
            'height' => 'nullable|numeric',
            'gender' => 'required|in:Male,Female',
            'family_number' => 'required|integer',
            'zone' => 'required|string|max:255',
            'phone_number' => 'required',
            'status' => 'required',
            'is_desease' => 'nullable|boolean',
            'id_number' =>'required'
        ]);
    }

    protected function validatePregnancy()
    {
        $this->validate([
            'pregnancy_name' => 'required|string|max:255',
            'date_of_birth' => 'required|date',
            'age' => 'required|integer',
            'family_number' => 'required|integer',
            'zone' => 'required|string|max:255',
            'mobile_number' => 'required',
            'estimated_due_date' => 'required|date',
            'last_checkup' => 'nullable|date',
            'child_name' => 'nullable|string|max:255',
            'gender' => 'required|in:Male,Female',
            'status' => 'required',
            'is_desease' => 'nullable|boolean',
            'id_number' =>'required'
        ]);
    }

    protected function validateBirthRegistry()
    {
        $this->validate([
            'name_of_child' => 'required|string|max:255',
            'name_of_parent' => 'required|string|max:255',
            'date_of_birth' => 'required|date',
            'family_number' => 'required|integer',
            'zone' => 'required|string|max:255',
            'gender' => 'required|in:Male,Female',
            'birth_weight' => 'required|numeric',
            'place_of_birth' => 'required|string|max:255',
            'is_registered' => 'required|boolean',
            'phone_number' => 'required',
            'status' => 'required',
            'is_desease' => 'nullable|boolean',
            'id_number2' =>'required'
        ]);
    }

    protected function validateBpMonitoring()
    {
        $this->validate([
            'resident_name' => 'required|string|max:255',
            'age' => 'required|integer',
            'phone_number' => 'required',
            'bp' => 'required|string|max:255',
            'level' => 'required|in:normal,elevated,high,low',
            'date' => 'required|date',
            'gender' => 'required|in:Male,Female,Other',
            'date_of_birth' => 'nullable|date',
            'status' => 'required',
            'is_desease' => 'nullable|boolean',
            'id_number3' =>'required'
        ]);
    }

    protected function saveResident()
    {
        Residents::updateOrCreate(
            ['id' => $this->residentId],
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
    }

    protected function saveO71Month()
    {
        O71months::updateOrCreate(
            ['id' => $this->o71monthId],
            [
                'name_of_child' => $this->name_of_child,
                'name_of_parent' => $this->name_of_parent,
                'date_of_birth' => $this->date_of_birth,
                'age_in_month' => $this->age_in_month,
                'weight' => $this->weight,
                'height' => $this->height,
                'gender' => $this->gender,
                'family_no' => $this->family_number,
                'zone' => $this->zone,
                'phone_number' => $this->phone_number,
                'status' => $this->status,
                'is_desease' => $this->is_desease,
                'id_number' =>$this->id_number,
            ]
        );
    }

    protected function savePregnancy()
    {


       Pregnancy::updateOrCreate(
        ['id' => $this->pregnancyId],
        [
            'name' => $this->pregnancy_name, // Changed from pregnancy_name to match database
            'date_of_birth' => $this->date_of_birth,
            'age' => $this->age,
            'family_no' => $this->pregnancy_family_number,
            'zone' => $this->zone,
            'mobile_number' => $this->mobile_number,
            'estimated_due_date' => $this->estimated_due_date,
            'last_checkup' => $this->last_checkup,
            'child_name' => $this->child_name,
            'gender' => $this->gender,
            'status' => $this->status,
            'is_desease' => $this->is_desease,
            'id_number' => $this->id_number1, // Added missing field
        ]
    );
    }

    protected function saveBirthRegistry()
    {
        Birthregistry::updateOrCreate(
            ['id' => $this->birthRegistryId],
            [
                'name_of_child' => $this->name_of_child,
                'name_of_parent' => $this->name_of_parent,
                'date_of_birth' => $this->b_date_of_birth,
                'family_no' => $this->birthregistry_fam_number,
                'zone' => $this->zone,
                'gender' => $this->gender,
                'birth_weight' => $this->birth_weight,
                'place_of_birth' => $this->place_of_birth,
                'is_registered' => $this->is_registered,
                'phone_number' => $this->phone_number,
                'status' => $this->status,
                'is_desease' => $this->is_desease,
                 'id_number' =>$this->id_number2,
            ]
        );
    }

    protected function saveBpMonitoring()
    {
        BpMonitoring::updateOrCreate(
            ['id' => $this->bpMonitoringId],
            [
                'resident_name' => $this->resident_name,
                'age' => $this->age,
                'phone_number' => $this->phone_number,
                'bp' => $this->bp,
                'level' => $this->level,
                'date' => $this->date,
                'gender' => $this->gender,
                'date_of_birth' => $this->b_date_of_birth,
                'status' => $this->status,
                'is_desease' => $this->is_desease,
                 'id_number' =>$this->id_number3,
            ]
        );
    }

    public function delete($id, $type)
    {
        switch ($type) {
            case 'resident':
                Residents::findOrFail($id)->delete();
                break;
            case 'o71month':
                O71months::findOrFail($id)->delete();
                break;
            case 'pregnancy':
                Pregnancy::findOrFail($id)->delete();
                break;
            case 'birthregistry':
                Birthregistry::findOrFail($id)->delete();
                break;
            case 'bp_monitoring':
                BpMonitoring::findOrFail($id)->delete();
                break;
        }

        session()->flash('message', 'Record deleted successfully.');
    }

    public function render()
    {
        $records = $this->getCombinedRecords();

        return view('livewire.admin.all-residents', [
            'residents' => $records
        ]);
    }
public function sarch(){

}
    protected function getCombinedRecords()
    {
        $residents = Residents::query()
    ->select(
        'id',
   DB::raw("CONCAT(first_name, ' ', surname) as full_name"),
        'date_of_birth',
        'gender',
        'phone_number',
        'status',
        DB::raw("NULL as id_number"), // Added NULL for missing column
        DB::raw("'resident' as type")
    );

$o71months = O71months::query()
    ->select(
        'id',
        DB::raw("CONCAT(name_of_child, ' ', name_of_parent) as full_name"),
        'date_of_birth',
        'gender',
        'phone_number',
        'status',
        'id_number', // Keeping actual column for tables that have it
        DB::raw("'o71month' as type")
    );

$pregnancies = Pregnancy::query()
    ->select(
        'id',
        'name as full_name',
        'date_of_birth',
        'gender',
        'mobile_number as phone_number',
        'status',
        'id_number',
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
        'id_number',
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
        'id_number',
        DB::raw("'bp_monitoring' as type")
    );

$combinedQuery = $residents
    ->unionAll($o71months)
    ->unionAll($pregnancies)
    ->unionAll($birthregistries)
    ->unionAll($bpMonitorings);

return DB::table(DB::raw("({$combinedQuery->toSql()}) as sub"))
    ->mergeBindings($combinedQuery->getQuery())
    ->when($this->search, function ($query) {
        $query->where(function ($q) {
            $q->where('full_name', 'like', '%' . $this->search . '%')
              ->orWhere('phone_number', 'like', '%' . $this->search . '%')
              ->orWhere('id_number', 'like', '%' . $this->search . '%');
        });
    })
    ->orderBy('full_name')
    ->paginate(10);
    }

    private function resetForm()
    {
        $this->reset([
            'residentId', 'surname', 'first_name', 'middle_name', 'date_of_birth', 'age', 'gender',
            'place_of_birth', 'relationship_with_family_head', 'civil_status', 'occupation', 'religion',
            'citizenship', 'family_number', 'zone_or_purok', 'phone_number', 'status', 'is_desease',

            'o71monthId', 'name_of_child', 'name_of_parent', 'age_in_month', 'weight', 'height', 'zone',

            'pregnancyId', 'pregnancy_name', 'mobile_number', 'estimated_due_date', 'last_checkup', 'child_name',

            'birthRegistryId', 'birth_weight', 'is_registered',

            'bpMonitoringId', 'resident_name', 'bp', 'level', 'date'
        ]);

        $this->editMode = false;
        $this->viewMode = false;
    }
}
