<?php

namespace App\Events;

use App\Models\Pendaftaran;
use Illuminate\Broadcasting\Channel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\InteractsWithSockets;

class PasienDipanggil implements ShouldBroadcast
{
    use InteractsWithSockets, SerializesModels;

    public $pendaftaran;

    public function __construct(Pendaftaran $pendaftaran)
    {
        $this->pendaftaran = $pendaftaran->load('pasien');
    }

    public function broadcastOn()
    {
        return new Channel('antrian');
    }

    public function broadcastAs()
    {
        return 'PasienDipanggil';
    }
}
