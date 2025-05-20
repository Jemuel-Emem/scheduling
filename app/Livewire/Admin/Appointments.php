<?php

namespace App\Livewire\Admin;

use App\Models\birthregistry;
use App\Models\bp_monitoring;
use App\Models\o71months;
use App\Models\pregnancy;
use App\Models\Appointment;
use Livewire\Component;
use Livewire\WithPagination;

class Appointments extends Component
{
     use WithPagination;

    public $id_number, $name, $phone, $age, $address, $purpose, $date, $reschedule_option = 'none',
           $reschedule_date, $time, $health_condition, $health_status, $blood_pressure;
    public $search = '';
    public $appointmentId;
    public $editMode = false;
    public $showModal = false;
    public $viewMode = false;
    public $currentRecord;
    public $sourceTable = null;
    public $existingRecord = null;
    public $showExistingRecordInfo = false;

    protected $rules = [
        'id_number' => 'required|string|max:255',
        'name' => 'required|string|max:255',
        'phone' => 'required|numeric',
        'age' => 'required|integer|min:1',
        'address' => 'required|string|max:255',
        'purpose' => 'nullable|string',
        'date' => 'required|date',
        'reschedule_option' => 'nullable|string',
        'reschedule_date' => 'nullable|date|after:date',
        'time' => 'required',
        'health_condition' => 'nullable|string',
        'health_status' => 'nullable|string',
        'blood_pressure' => 'nullable|string',
    ];

    public function openAddModal()
    {
        $this->resetFields();
        $this->editMode = false;
        $this->viewMode = false;
        $this->showModal = true;
    }

    public function checkExistingRecord()
    {
        $this->reset(['existingRecord', 'name', 'phone', 'age', 'address', 'sourceTable', 'showExistingRecordInfo']);

        if (strlen($this->id_number) >= 3) {
            $tables = [
                'birthregistry' => birthregistry::class,
                'bp_monitoring' => bp_monitoring::class,
                'o71months' => o71months::class,
                'pregnancy' => pregnancy::class
            ];

            foreach ($tables as $tableName => $model) {
                $record = $model::where('id_number', $this->id_number)->first();
                if ($record) {
                    $this->existingRecord = $record;
                    $this->sourceTable = $tableName;
                    $this->fillFieldsFromRecord();
                    $this->showExistingRecordInfo = true;
                    break;
                }
            }
        }
    }

    public function sarch(){

    }
    public function searchByIdNumber()
    {
        $this->checkExistingRecord();
    }

    protected function fillFieldsFromRecord()
    {
        if (!$this->existingRecord) return;

        $record = $this->existingRecord;

        // Set common fields
        $this->name = $record->name_of_child ?? $record->name ?? $record->resident_name ?? null;
        $this->phone = $record->phone_number ?? $record->mobile_number ?? null;
      $this->age = $record->age ?? (isset($record->date_of_birth) ? now()->diffInYears($record->date_of_birth) : null);

        $this->address = $record->zone ?? $record->address ?? null;

        // Handle specific cases
        if ($this->sourceTable === 'pregnancy') {
            $this->name = $record->name;
            $this->phone = $record->mobile_number;
            $this->health_condition = 'pregnant';
        }

        if ($this->sourceTable === 'bp_monitoring') {
            $this->name = $record->resident_name;
            $this->phone = $record->phone_number;
            $this->blood_pressure = $record->bp;
            $this->health_condition = 'highblood';
        }

        if ($this->sourceTable === 'o71months') {
            $this->name = $record->name_of_child;
            $this->phone = $record->phone_number;
        }

        if ($this->sourceTable === 'birthregistry') {
            $this->name = $record->name_of_child;
            $this->phone = $record->phone_number;
        }
    }


    public function submitAppointment()
    {
        $rules = $this->rules;

        if ($this->reschedule_option === 'date') {
            $rules['reschedule_date'] = 'required|date|after:date';
        }

        $this->validate($rules);

        $appointment = Appointment::create([
            'id_number' => $this->id_number,
            'full_name' => $this->name,
            'phone' => $this->phone,
            'age' => $this->age,
            'address' => $this->address,
            'purpose' => $this->purpose,
            'date_schedule' => $this->date,
            'reschedule_option' => $this->reschedule_option,
            'reschedule_date' => $this->reschedule_option === 'date' ? $this->reschedule_date : null,
            'time_schedule' => $this->time,
            'health_condition' => $this->health_condition,
            'health_status' => $this->health_status,
            'blood_pressure' => $this->blood_pressure,
            'source_table' => $this->sourceTable,
        ]);

        session()->flash('message', 'Appointment successfully booked!');
        $this->sendSMS($this->phone, $this->name, $this->date, $this->time, 'scheduled');
        $this->showModal = false;
        $this->resetFields();
    }

    public function view($id)
    {
        $this->currentRecord = Appointment::findOrFail($id);
        $this->viewMode = true;
        $this->showModal = true;
        $this->editMode = false;
    }

    public function editAppointment($id)
    {
        $appointment = Appointment::findOrFail($id);

        $this->appointmentId = $id;
        $this->id_number = $appointment->id_number;
        $this->name = $appointment->full_name;
        $this->phone = $appointment->phone;
        $this->age = $appointment->age;
        $this->address = $appointment->address;
        $this->purpose = $appointment->purpose;
        $this->date = $appointment->date_schedule;
        $this->reschedule_option = $appointment->reschedule_option;
        $this->reschedule_date = $appointment->reschedule_date;
        $this->time = $appointment->time_schedule;
        $this->health_condition = $appointment->health_condition;
        $this->health_status = $appointment->health_status;
        $this->blood_pressure = $appointment->blood_pressure;
        $this->sourceTable = $appointment->source_table;

        $this->editMode = true;
        $this->viewMode = false;
        $this->showModal = true;
    }

    public function updateAppointment()
    {
        $rules = $this->rules;

        if ($this->reschedule_option === 'date') {
            $rules['reschedule_date'] = 'required|date|after:date';
        }

        $this->validate($rules);

        $appointment = Appointment::find($this->appointmentId);
        $appointment->update([
            'id_number' => $this->id_number,
            'full_name' => $this->name,
            'phone' => $this->phone,
            'age' => $this->age,
            'address' => $this->address,
            'purpose' => $this->purpose,
            'date_schedule' => $this->date,
            'reschedule_option' => $this->reschedule_option,
            'reschedule_date' => $this->reschedule_option === 'date' ? $this->reschedule_date : null,
            'time_schedule' => $this->time,
            'health_condition' => $this->health_condition,
            'health_status' => $this->health_status,
            'blood_pressure' => $this->blood_pressure,
            'source_table' => $this->sourceTable,
        ]);

        session()->flash('message', 'Appointment successfully updated!');
        $this->sendSMS($this->phone, $this->name, $this->date, $this->time, 'rescheduled');
        $this->showModal = false;
        $this->resetFields();
    }

    public function deleteAppointment($id)
    {
        Appointment::findOrFail($id)->delete();
        session()->flash('message', 'Appointment deleted successfully!');
    }

    private function sendSMS($phone, $name, $date, $time, $type)
    {
        $ch = curl_init();

        $message = $type === 'scheduled'
            ? "Hello $name, your appointment is scheduled for $date at $time. - Estanz"
            : "Hello $name, your appointment was rescheduled for $date at $time. - Estanz";

        $parameters = [
            'apikey' => '046125f45f4f187e838905df98273c4e',
            'number' => $phone,
            'message' => $message,
            'sendername' => 'Estanz'
        ];

        curl_setopt($ch, CURLOPT_URL, 'https://semaphore.co/api/v4/messages');
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($parameters));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $output = curl_exec($ch);
        curl_close($ch);
    }

    private function resetFields()
    {
        $this->reset([
            'id_number', 'name', 'phone', 'age', 'address', 'purpose', 'date', 'reschedule_option',
            'reschedule_date', 'time', 'health_condition', 'health_status', 'blood_pressure',
            'appointmentId', 'editMode', 'viewMode', 'currentRecord', 'sourceTable', 'existingRecord'
        ]);
        $this->resetErrorBag();
        $this->reschedule_option = 'none';
    }

    public function render()
    {
        $appointments = Appointment::query()
            ->when($this->search, function ($query) {
                $query->where(function ($q) {
                    $q->where('full_name', 'like', '%'.$this->search.'%')
                      ->orWhere('phone', 'like', '%'.$this->search.'%')
                      ->orWhere('date_schedule', 'like', '%'.$this->search.'%');

                });
            })
            ->orderBy('date_schedule', 'desc')
            ->paginate(10);

        return view('livewire.admin.appointments', compact('appointments'));
    }
}
