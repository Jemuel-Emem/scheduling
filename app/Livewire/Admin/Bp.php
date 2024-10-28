<?php

namespace App\Livewire\Admin;

use App\Models\bp_monitoring as BpMonitoring;
use Livewire\Component;
use Livewire\WithPagination;

class Bp extends Component
{
    use WithPagination;


    public $resident_name;
    public $age;
    public $bp;
    public $level;
    public $date;
    public $bp_id;


    protected $rules = [
        'resident_name' => 'required|string|max:255',
        'age' => 'required|integer|min:0',
        'bp' => 'required|string|max:50',
        'level' => 'required|string|in:normal,elevated,high,low',
        'date' => 'required|date',
    ];


    public function updated($propertyName)
    {
        $this->resetPage();
    }


    public function render()
    {
        $bp_monitorings = BpMonitoring::paginate(10);
        return view('livewire.admin.bp', compact('bp_monitorings'));
    }


    public function submit()
    {
        $this->validate();

        if ($this->bp_id) {

            $bpMonitoring = BpMonitoring::find($this->bp_id);
            $bpMonitoring->update([
                'resident_name' => $this->resident_name,
                'age' => $this->age,
                'bp' => $this->bp,
                'level' => $this->level,
                'date' => $this->date,
            ]);
            session()->flash('success', 'BP Monitoring data updated successfully.');
        } else {

            BpMonitoring::create([
                'resident_name' => $this->resident_name,
                'age' => $this->age,
                'bp' => $this->bp,
                'level' => $this->level,
                'date' => $this->date,
            ]);
            session()->flash('success', 'BP Monitoring data added successfully.');
        }

        $this->resetForm();
    }


    public function resetForm()
    {
        $this->resident_name = '';
        $this->age = '';
        $this->bp = '';
        $this->level = '';
        $this->date = '';
        $this->bp_id = null;
    }


    public function edit($id)
    {
        $bpMonitoring = BpMonitoring::find($id);

        $this->bp_id = $bpMonitoring->id;
        $this->resident_name = $bpMonitoring->resident_name;
        $this->age = $bpMonitoring->age;
        $this->bp = $bpMonitoring->bp;
        $this->level = $bpMonitoring->level;
        $this->date = $bpMonitoring->date;
    }


    public function delete($id)
    {
        BpMonitoring::find($id)->delete();
        session()->flash('success', 'BP Monitoring data deleted successfully.');
    }
}
