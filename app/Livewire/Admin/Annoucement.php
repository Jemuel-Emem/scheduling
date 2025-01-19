<?php

namespace App\Livewire\Admin;

use App\Models\residents;
use App\Models\announcement as Announcement;
use Livewire\Component;

class Annoucement extends Component
{
    public $title;
    public $details;
    public $date;
    public $time;
    public $announcements;

    protected $rules = [
        'title' => 'required|string|max:255',
        'details' => 'required|string',
        'date' => 'required|date',
        'time' => 'required|date_format:H:i',
    ];

    // public function sendAnnouncementSMS($announcement)
    // {
    //     $residents = residents::all();

    //     if ($residents->isEmpty()) {
    //         session()->flash('error', 'No residents found to send the announcement.');
    //         return;
    //     }

    //     foreach ($residents as $resident) {
    //         $ch = curl_init();
    //         $parameters = [
    //             'apikey' => '046125f45f4f187e838905df98273c4e',
    //             'number' => $resident->phone_number,
    //             'message' => "Hello {$resident->name}, there's a new announcement:\nTitle: {$announcement->title}\nDescription: {$announcement->details}\nDate: {$announcement->date}\nTime: {$announcement->time}. - Estanz",
    //             'sendername' => 'Estanz',
    //         ];

    //         curl_setopt($ch, CURLOPT_URL, 'https://semaphore.co/api/v4/messages');
    //         curl_setopt($ch, CURLOPT_POST, 1);
    //         curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($parameters));
    //         curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    //         curl_exec($ch);
    //         curl_close($ch);
    //     }

    //     session()->flash('message', 'SMS notifications successfully sent to all residents.');
    // }

    public function submitAnnouncement()
    {
        $this->validate();


        $announcement = Announcement::create([
            'title' => $this->title,
            'details' => $this->details,
            'date' => $this->date,
            'time' => $this->time,
        ]);


        $residents = residents::all();


        if ($residents->isEmpty()) {
            session()->flash('error', 'No residents found to send the announcement.');
            return;
        }

        foreach ($residents as $resident) {
            $ch = curl_init();

            $parameters = [
                'apikey' => '046125f45f4f187e838905df98273c4e',
                'number' => $resident->phone_number,
                'message' => "Hello {$resident->first_name}, there's a new announcement:\n"
                    . "Title: {$announcement->title}\n"
                    . "Description: {$announcement->details}\n"
                    . "Date: {$announcement->date}\n"
                    . "Time: {$announcement->time}. - Estanz",
                'sendername' => 'Estanz',
            ];

            curl_setopt($ch, CURLOPT_URL, 'https://semaphore.co/api/v4/messages');
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($parameters));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

            $output = curl_exec($ch);
            curl_close($ch);
        }


        $this->reset();


        session()->flash('message', 'Announcement successfully added and SMS sent to all residents!');


        $this->loadAnnouncements();
    }


    public function mount()
    {
        $this->loadAnnouncements();
    }

    public function loadAnnouncements()
    {
        $this->announcements = Announcement::orderBy('date', 'desc')->get();
    }

    public function render()
    {
        return view('livewire.admin.annoucement', [
            'announcements' => $this->announcements ?? [],
        ]);
    }
}
