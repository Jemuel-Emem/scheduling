<?php

namespace App\Livewire\Admin;

use App\Models\Appointment;
use Livewire\Component;
use Livewire\WithPagination;

class Appointments extends Component
{
    use WithPagination;

    public $name, $phone, $age, $address, $purpose, $date, $reschedule_option, $reschedule_date, $time, $health_condition, $health_status, $blood_pressure;
    public $search = '';
    public $appointmentId;
    public $editMode = false;
    public $showModal = false;
    public $viewMode = false;
    public $currentRecord;

    public $existingAppointment = null;
    protected $rules = [
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
    public function checkExistingAppointment()
    {
        if (strlen($this->name) > 3) {
            $this->existingAppointment = Appointment::where('full_name', 'like', '%'.$this->name.'%')
                ->latest()
                ->first();
        } else {
            $this->existingAppointment = null;
        }
    }

    public function useExistingInfo()
    {
        if ($this->existingAppointment) {
            $this->phone = $this->existingAppointment->phone;
            $this->age = $this->existingAppointment->age;
            $this->address = $this->existingAppointment->address;
            $this->existingAppointment = null; // Hide the info box after using the data
        }
    }
    public function openAddModal()
    {
        $this->resetFields();
        $this->editMode = false;
        $this->viewMode = false;
        $this->showModal = true;
    }

    public function submitAppointment()
    {
        $rules = $this->rules;

        if ($this->reschedule_option === 'date') {
            $rules['reschedule_date'] = 'required|date|after:date';
        }

        $this->validate($rules);

        $appointment = Appointment::create([
            'full_name' => $this->name,
            'phone' => $this->phone,
            'age' => $this->age,
            'address' => $this->address,
            'purpose' => $this->purpose,
            'date_schedule' => $this->date,
            'reschedule_option' => $this->reschedule_option ?: 'none',
            'reschedule_date' => $this->reschedule_date,
            'time_schedule' => $this->time,
            'health_condition' => $this->health_condition,
            'health_status' => $this->health_status,
            'blood_pressure' => $this->blood_pressure,
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
            'full_name' => $this->name,
            'phone' => $this->phone,
            'age' => $this->age,
            'address' => $this->address,
            'purpose' => $this->purpose,
            'date_schedule' => $this->date,
            'reschedule_option' => $this->reschedule_option ?: 'none',
            'reschedule_date' => $this->reschedule_date,
            'time_schedule' => $this->time,
            'health_condition' => $this->health_condition,
            'health_status' => $this->health_status,
            'blood_pressure' => $this->blood_pressure,
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
            'name', 'phone', 'age', 'address', 'purpose', 'date', 'reschedule_option',
            'reschedule_date', 'time', 'health_condition', 'health_status', 'blood_pressure',
            'appointmentId', 'editMode', 'viewMode', 'currentRecord'
        ]);
        $this->resetErrorBag();
    }
    public function sarch(){

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
            ->paginate(5);

        return view('livewire.admin.appointments', compact('appointments'));
    }
}
