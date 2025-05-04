<?php

namespace App\Livewire\Admin;

use App\Models\bp_monitoring as BpMonitoring;
use Livewire\Component;
use Livewire\WithPagination;

class Bp extends Component
{
    use WithPagination;

    public $resident_name, $age, $phone_number, $bp, $level, $date;
    public $bp_id, $editMode = false;
    public $showModal = false;
    public $viewMode = false;
    public $currentRecord;
    public $search = '';

    protected $rules = [
        'resident_name' => 'required|string|max:255',
        'age' => 'required|integer|min:0',
        'bp' => 'required|string|max:50',
        'level' => 'required|string|in:normal,elevated,high,low',
        'date' => 'required|date',
        'phone_number' => 'required'
    ];

    public function render()
    {
        $bp_monitorings = BpMonitoring::query()
            ->where('resident_name', 'like', '%' . $this->search . '%')
            ->orWhere('phone_number', 'like', '%' . $this->search . '%')
            ->paginate(10);

        return view('livewire.admin.bp', compact('bp_monitorings'));
    }

    public function openAddModal()
    {
        $this->resetForm();
        $this->editMode = false;
        $this->viewMode = false;
        $this->showModal = true;
    }

    public function submit()
    {
        $this->validate();

        if ($this->editMode) {
            $bpMonitoring = BpMonitoring::find($this->bp_id);
            $bpMonitoring->update([
                'resident_name' => $this->resident_name,
                'age' => $this->age,
                'bp' => $this->bp,
                'level' => $this->level,
                'date' => $this->date,
                'phone_number' => $this->phone_number,
            ]);
            session()->flash('success', 'BP Monitoring data updated successfully.');
        } else {
            BpMonitoring::create([
                'resident_name' => $this->resident_name,
                'age' => $this->age,
                'bp' => $this->bp,
                'level' => $this->level,
                'date' => $this->date,
                'phone_number' => $this->phone_number,
            ]);
            session()->flash('success', 'BP Monitoring data added successfully.');
        }

        $this->showModal = false;
        $this->resetForm();
    }

    public function view($id)
    {
        $this->currentRecord = BpMonitoring::findOrFail($id);
        $this->viewMode = true;
        $this->showModal = true;
        $this->editMode = false;
    }

    public function edit($id)
    {
        $bpMonitoring = BpMonitoring::findOrFail($id);

        $this->bp_id = $id;
        $this->resident_name = $bpMonitoring->resident_name;
        $this->age = $bpMonitoring->age;
        $this->bp = $bpMonitoring->bp;
        $this->level = $bpMonitoring->level;
        $this->date = $bpMonitoring->date;
        $this->phone_number = $bpMonitoring->phone_number;

        $this->editMode = true;
        $this->viewMode = false;
        $this->showModal = true;
    }

    public function delete($id)
    {
        BpMonitoring::findOrFail($id)->delete();
        session()->flash('success', 'BP Monitoring data deleted successfully.');
    }

    private function resetForm()
    {
        $this->reset([
            'resident_name', 'age', 'phone_number', 'bp',
            'level', 'date', 'bp_id', 'editMode', 'viewMode', 'currentRecord'
        ]);
        $this->resetErrorBag();
    }

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function sarch(){

    }
}
