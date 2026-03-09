<?php

namespace Database\Seeders;

use App\Models\Card;
use Illuminate\Database\Seeder;

class CardSeeder extends Seeder
{
    public function run(): void
    {
        $cards = [
            // Office cards (VB001 - VB010)
            ['code' => 'VB001', 'rfid_code' => 'E20047A19C3F8D6B2E4C701A', 'tipe' => 'office'],
            ['code' => 'VB002', 'rfid_code' => 'E200471FB8A2D9C0E7135F4B', 'tipe' => 'office'],
            ['code' => 'VB003', 'rfid_code' => 'E20047D6C41A90B2F83E17D9', 'tipe' => 'office'],
            ['code' => 'VB004', 'rfid_code' => 'E2004790E2B7C14A6D3F8C21', 'tipe' => 'office'],
            ['code' => 'VB005', 'rfid_code' => 'E20047B5D1C90F2E7A36C8D4', 'tipe' => 'office'],
            ['code' => 'VB006', 'rfid_code' => 'E2004726F8C0A1D9B73E41C5', 'tipe' => 'office'],
            ['code' => 'VB007', 'rfid_code' => 'E200477C3A1E9D50B6F2C84A', 'tipe' => 'office'],
            ['code' => 'VB008', 'rfid_code' => 'E20047E8B2C617D90A4F3C51', 'tipe' => 'office'],
            ['code' => 'VB009', 'rfid_code' => 'E200474F0C9A2D7B1E86C3D5', 'tipe' => 'office'],
            ['code' => 'VB010', 'rfid_code' => 'E2004712D7C0B5E93A6F84C1', 'tipe' => 'office'],

            // Plant cards (VM001 - VM010)
            ['code' => 'VM001', 'rfid_code' => 'E20047C3D8A1F0B6E9274C5D', 'tipe' => 'plant'],
            ['code' => 'VM002', 'rfid_code' => 'E2004797B0E2C6A1D53F84B9', 'tipe' => 'plant'],
            ['code' => 'VM003', 'rfid_code' => 'E20047A8F3C1D60B2E9475CA', 'tipe' => 'plant'],
            ['code' => 'VM004', 'rfid_code' => 'E2004741C8D2B7A09F6E3C15', 'tipe' => 'plant'],
            ['code' => 'VM005', 'rfid_code' => 'E20047D2A9C5F81B06E734C0', 'tipe' => 'plant'],
            ['code' => 'VM006', 'rfid_code' => 'E2004786C1B0D9A25F3E74C8', 'tipe' => 'plant'],
            ['code' => 'VM007', 'rfid_code' => 'E2004739F6A1C8D0B2745ECA', 'tipe' => 'plant'],
            ['code' => 'VM008', 'rfid_code' => 'E20047B1D0C7A93F2E6854C6', 'tipe' => 'plant'],
            ['code' => 'VM009', 'rfid_code' => 'E2004705C9F2A1D7B83E6C41', 'tipe' => 'plant'],
            ['code' => 'VM010', 'rfid_code' => 'E20047F0B6D1C8A2397E54CA', 'tipe' => 'plant'],
        ];

        foreach ($cards as $card) {
            Card::firstOrCreate(
                ['code' => $card['code']],
                [
                    'rfid_code' => $card['rfid_code'],
                    'tipe' => $card['tipe'],
                    'status' => 'available',
                ]
            );
        }
    }
}
