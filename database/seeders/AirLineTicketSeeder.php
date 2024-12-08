<?php

namespace Database\Seeders;

use App\Models\AirLineTicket;
use Illuminate\Database\Seeder;

class AirLineTicketSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $data = [
            [
                'area_id_start' => 1,
                'area_id_end' => 2,
                'start_date' => '2024-12-10 08:00:00',
                'end_date' => '2024-12-15 18:00:00',
                'quantity' => 100,
                'logo' => 'airline_ticket/Vietnam_Airlines.png',
                'price' => 1990000,
                'name' => 'Vietnam Airlines',
            ],
            [
                'area_id_start' => 1,
                'area_id_end' => 2,
                'start_date' => '2024-12-10 08:00:00',
                'end_date' => '2024-12-15 18:00:00',
                'quantity' => 100,
                'logo' => 'airline_ticket/Bamboo_Airways.png',
                'price' => 1990000,
                'name' => 'Bamboo Airways',
            ],
            [
                'area_id_start' => 2,
                'area_id_end' => 3,
                'start_date' => '2024-12-12 08:00:00',
                'end_date' => '2024-12-18 18:00:00',
                'quantity' => 150,
                'logo' => 'airline_ticket/Vietnam_Airlines.png',
                'price' => 2500000,
                'name' => 'Vietnam Airlines',
            ],
            [
                'area_id_start' => 2,
                'area_id_end' => 3,
                'start_date' => '2024-12-14 08:00:00',
                'end_date' => '2024-12-20 18:00:00',
                'quantity' => 200,
                'logo' => 'airline_ticket/Bamboo_Airways.png',
                'price' => 3000000,
                'name' => 'Bamboo Airways',
            ],
            [
                'area_id_start' => 1,
                'area_id_end' => 3,
                'start_date' => '2024-12-12 08:00:00',
                'end_date' => '2024-12-18 18:00:00',
                'quantity' => 150,
                'logo' => 'airline_ticket/Vietnam_Airlines.png',
                'price' => 2500000,
                'name' => 'Vietnam Airlines',
            ],
            [
                'area_id_start' => 1,
                'area_id_end' => 3,
                'start_date' => '2024-12-14 08:00:00',
                'end_date' => '2024-12-20 18:00:00',
                'quantity' => 200,
                'logo' => 'airline_ticket/Bamboo_Airways.png',
                'price' => 3000000,
                'name' => 'Bamboo Airways',
            ],
            [
                'area_id_start' => 2,
                'area_id_end' => 1,
                'start_date' => '2024-12-10 08:00:00',
                'end_date' => '2024-12-15 18:00:00',
                'quantity' => 100,
                'logo' => 'airline_ticket/Vietnam_Airlines.png',
                'price' => 1999900,
                'name' => 'Vietnam Airlines',
            ],
            [
                'area_id_start' => 2,
                'area_id_end' => 1,
                'start_date' => '2024-12-10 08:00:00',
                'end_date' => '2024-12-15 18:00:00',
                'quantity' => 100,
                'logo' => 'airline_ticket/Bamboo_Airways.png',
                'price' => 1999900,
                'name' => 'Bamboo Airways',
            ],
            [
                'area_id_start' => 3,
                'area_id_end' => 2,
                'start_date' => '2024-12-12 08:00:00',
                'end_date' => '2024-12-18 18:00:00',
                'quantity' => 150,
                'logo' => 'airline_ticket/Vietnam_Airlines.png',
                'price' => 2500000,
                'name' => 'Vietnam Airlines',
            ],
            [
                'area_id_start' => 3,
                'area_id_end' => 2,
                'start_date' => '2024-12-14 08:00:00',
                'end_date' => '2024-12-20 18:00:00',
                'quantity' => 200,
                'logo' => 'airline_ticket/Bamboo_Airways.png',
                'price' => 3000000,
                'name' => 'Bamboo Airways',
            ],
            [
                'area_id_start' => 3,
                'area_id_end' => 1,
                'start_date' => '2024-12-12 08:00:00',
                'end_date' => '2024-12-18 18:00:00',
                'quantity' => 150,
                'logo' => 'airline_ticket/Vietnam_Airlines.png',
                'price' => 2500000,
                'name' => 'Vietnam Airlines',
            ],
            [
                'area_id_start' => 3,
                'area_id_end' => 1,
                'start_date' => '2024-12-14 08:00:00',
                'end_date' => '2024-12-20 18:00:00',
                'quantity' => 200,
                'logo' => 'airline_ticket/Bamboo_Airways.png',
                'price' => 3000000,
                'name' => 'Bamboo Airways',
            ]
        ];

        AirLineTicket::insert($data);
    }
}
