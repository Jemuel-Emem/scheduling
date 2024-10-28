<?php

namespace App\Livewire\Admin;
use Illuminate\Support\Facades\Log;
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

    public function resetFields()
    {
        $this->reset(['name', 'phone', 'age', 'address', 'purpose', 'date', 'reschedule_option', 'reschedule_date', 'time', 'health_condition', 'health_status', 'blood_pressure']);
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


        $ch = curl_init();

        $parameters = array(
            'apikey' => '046125f45f4f187e838905df98273c4e',
            'number' => $this->phone,
           'message' => "Hello {$this->name}, your appointment is scheduled for {$this->date} at {$this->time}. - Estanz",
            'sendername' => 'Estanz'
        );

        curl_setopt($ch, CURLOPT_URL, 'https://semaphore.co/api/v4/messages');
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($parameters));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);


        $output = curl_exec($ch);
        curl_close($ch);

        $this->resetFields();
    }



    public function editAppointment($id)
    {
        $appointment = Appointment::findOrFail($id);
        $this->appointmentId = $appointment->id;
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

        $this->editMode = false;

        $ch = curl_init();

        $parameters = array(
            'apikey' => '046125f45f4f187e838905df98273c4e',
            'number' => $this->phone,
           'message' => "Hello {$this->name}, your appointment was rescheduled for {$this->date} at {$this->time}. - Estanz",
            'sendername' => 'Estanz'
        );

        curl_setopt($ch, CURLOPT_URL, 'https://semaphore.co/api/v4/messages');
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($parameters));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);


        $output = curl_exec($ch);
        curl_close($ch);

        $this->resetFields();
    }


    public function deleteAppointment($id)
    {
        Appointment::find($id)->delete();
        session()->flash('message', 'Appointment deleted successfully!');
    }

    public function searchname(){

    }

    public function render()
    {
        $appointments = Appointment::query();

        if (!empty($this->search)) {
            $appointments = $appointments->where(function ($query) {
                $query->where('full_name', 'like', '%'.$this->search.'%')
                      ->orWhere('phone', 'like', '%'.$this->search.'%')
                      ->orWhere('date_schedule', 'like', '%'.$this->search.'%');
            });
        }

        return view('livewire.admin.appointments', [
            'appointments' => $appointments->paginate(5)
        ]);
    }
}
