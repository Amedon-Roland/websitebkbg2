<?php

namespace Database\Seeders;

use App\Models\Room;
use Illuminate\Database\Seeder;

class RoomSeeder extends Seeder
{
    public function run(): void
    {
        $rooms = [
            [
                'title' => 'Premium',
                'description' => 'Très spacieuses, bien équipées avec 2 lits doubles. Vue sur la Mer',
                'price' => 80.000,
                'is_available' => true,
                'capacity' => 4,
                'room_number' => 101
            ],
            [
                'title' => 'Privilege',
                'description' => 'Très spacieuses, bien équipées avec lit 3 places. Vue sur la Mer',
                'price' => 70.000,
                'is_available' => true,
                'capacity' => 3,
                'room_number' => 102
            ],
            [
                'title' => 'Senior',
                'description' => 'Très spacieuses, bien équipées avec lit double. Balcon avec vue sur la mer',
                'price' => 65.000,
                'is_available' => true,
                'capacity' => 2,
                'room_number' => 103
            ],
            [
                'title' => 'Standard',
                'description' => 'Chambre confortable avec tout le confort nécessaire',
                'price' => 50.000,
                'is_available' => true,
                'capacity' => 2,
                'room_number' => 104
            ],
            [
                'title' => 'Junior',
                'description' => 'Idéale pour les voyageurs seuls',
                'price' => 35.000,
                'is_available' => true,
                'capacity' => 1,
                'room_number' => 105
            ],
            [
                'title' => 'The Royal Room',
                'description' => 'Notre suite la plus luxueuse avec service VIP',
                'price' => 190.000,
                'is_available' => true,
                'capacity' => 4,
                'room_number' => 106
            ],
        ];

        foreach ($rooms as $room) {
            Room::create($room);
        }
    }
}
