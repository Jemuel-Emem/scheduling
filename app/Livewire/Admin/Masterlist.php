<?php

namespace App\Livewire\Admin;
use Illuminate\Support\Facades\DB;
use App\Models\Birthregistry;
use App\Models\bp_monitoring as BpMonitoring;
use App\Models\O71months;
use App\Models\Pregnancy;
use App\Models\Residents;
use Livewire\Component;
use Livewire\WithPagination;

class Masterlist extends Component
{
    use WithPagination;

    public $search = '';

    public $selectedRecordId = null;
public $selectedRecordType = null;
public $medicalRecords = [];
public $showModal = false;

public function showMedicalRecords($id, $type)
{
    $this->selectedRecordId = $id;
    $this->selectedRecordType = $type;
    $this->showModal = true;

    switch ($type) {
        case 'pregnancy':
            $this->medicalRecords = Pregnancy::where('id', $id)->get();
            break;
        case 'bp_monitoring':
            $this->medicalRecords = BpMonitoring::where('id', $id)->get();
            break;
        case 'o71month':
            $this->medicalRecords = O71months::where('id', $id)->get();
            break;
        case 'birthregistry':
            $this->medicalRecords = Birthregistry::where('id', $id)->get();
            break;
        case 'resident':
            // You can join with medical records here based on resident_id
            $this->medicalRecords = []; // placeholder
            break;
    }
}

    // public function render()
    // {
    //     $query = Residents::query()
    //         ->select(
    //             'id',
    //             'first_name',
    //             'surname',
    //             'date_of_birth',
    //             'gender',
    //             'phone_number',
    //             DB::raw("'resident' as type")
    //         );

    //     // Union with other tables
    //     $o71months = O71months::query()
    //         ->select(
    //             'id',
    //             'name_of_child as first_name',
    //             'name_of_parent as surname',
    //             'date_of_birth',
    //             DB::raw("'' as gender"),
    //             'phone_number',
    //             DB::raw("'o71month' as type")
    //         );

    //     $pregnancies = Pregnancy::query()
    //         ->select(
    //             'id',
    //             'name as first_name',
    //             DB::raw("'' as surname"),
    //             'date_of_birth',
    //             DB::raw("'' as gender"),
    //             'mobile_number as phone_number',
    //             DB::raw("'pregnancy' as type")
    //         );

    //     $birthregistries = Birthregistry::query()
    //         ->select(
    //             'id',
    //             'name_of_child as first_name',
    //             'name_of_parent as surname',
    //             'date_of_birth',
    //             'gender',
    //             'phone_number',
    //             DB::raw("'birthregistry' as type")
    //         );

    //     $bpMonitorings = BpMonitoring::query()
    //         ->select(
    //             'id',
    //             'resident_name as first_name',
    //             DB::raw("'' as surname"),
    //             DB::raw("'' as date_of_birth"),
    //             DB::raw("'' as gender"),
    //             'phone_number',
    //             DB::raw("'bp_monitoring' as type")
    //         );

    //     $combinedQuery = $query->unionAll($o71months)
    //         ->unionAll($pregnancies)
    //         ->unionAll($birthregistries)
    //         ->unionAll($bpMonitorings);

    //     if ($this->search) {
    //         $combinedQuery->where(function($q) {
    //             $q->where('first_name', 'like', '%' . $this->search . '%')
    //               ->orWhere('surname', 'like', '%' . $this->search . '%')
    //               ->orWhere('phone_number', 'like', '%' . $this->search . '%');
    //         });
    //     }

    //     $records = $combinedQuery->orderBy('first_name')->paginate(10);

    //     return view('livewire.admin.masterlist', [
    //         'records' => $records
    //     ]);
    // }
    public function render()
    {
        // Individual queries with standardized columns
        $residents = Residents::query()
            ->select(
                'id',
                'first_name',
                'surname',
                'date_of_birth',
                'gender',
                'phone_number',
                DB::raw("'resident' as type")
            );

        $o71months = O71months::query()
            ->select(
                'id',
                'name_of_child as first_name',
                'name_of_parent as surname',
                'date_of_birth',
                DB::raw("'' as gender"),
                'phone_number',
                DB::raw("'o71month' as type")
            );

        $pregnancies = Pregnancy::query()
            ->select(
                'id',
                'name as first_name',
                DB::raw("'' as surname"),
                'date_of_birth',
                DB::raw("'' as gender"),
                'mobile_number as phone_number',
                DB::raw("'pregnancy' as type")
            );

        $birthregistries = Birthregistry::query()
            ->select(
                'id',
                'name_of_child as first_name',
                'name_of_parent as surname',
                'date_of_birth',
                'gender',
                'phone_number',
                DB::raw("'birthregistry' as type")
            );

            $bpMonitorings = BpMonitoring::query()
            ->select(
                'id',
                'resident_name as first_name',
                DB::raw("'' as surname"),
                'date_of_birth', // <-- Actual column
                'gender',        // <-- Actual column
                'phone_number',
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
            ->mergeBindings($combinedQuery->getQuery()) // bind parameters
            ->when($this->search, function ($query) {
                $query->where(function ($q) {
                    $q->where('first_name', 'like', '%' . $this->search . '%')
                      ->orWhere('surname', 'like', '%' . $this->search . '%')
                      ->orWhere('phone_number', 'like', '%' . $this->search . '%');
                });
            })
            ->orderBy('first_name')
            ->paginate(10);

        return view('livewire.admin.masterlist', [
            'records' => $records
        ]);
    }

    public function sarch(){

    }
}
