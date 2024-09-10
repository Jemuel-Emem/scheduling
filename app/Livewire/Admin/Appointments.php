<?php

namespace App\Livewire\Admin;

use App\Models\Appointment;
use Livewire\Component;

class Appointments extends Component
{
    public $name;
    public $phone;
    public $age;
    public $address;
    public $purpose;
    public $date;
    public $reschedule_option;
    public $reschedule_date;
    public $time;
    public $health_condition;
    public $health_status;
    public $blood_pressure;

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

    public function submitAppointment()
    {
        $rules = $this->rules;

        if ($this->reschedule_option === 'date') {
            $rules['reschedule_date'] = 'required|date|after:date';
        } else {
            $rules['reschedule_date'] = 'nullable';
        }

        $this->validate($rules);


        $rescheduleOption = $this->reschedule_option ?: 'none';

        Appointment::create([
            'full_name' => $this->name,
            'phone' => $this->phone,
            'age' => $this->age,
            'address' => $this->address,
            'purpose' => $this->purpose,
            'date_schedule' => $this->date,
            'reschedule_option' => $rescheduleOption,
            'reschedule_date' => $this->reschedule_date,
            'time_schedule' => $this->time,
            'health_condition' => $this->health_condition,
            'health_status' => $this->health_status,
            'blood_pressure' => $this->blood_pressure,
        ]);

        $this->reset();

        session()->flash('message', 'Appointment successfully booked!');
    }


    public function render()
    {
        return view('livewire.admin.appointments');
    }
}
