<?php

namespace Database\Seeders;

use App\Models\FieldType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FieldTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $field_types =
            [
                'Text' => 'text',
                'Number' => 'number',
                'Select' => 'select'
            ];
        foreach ($field_types as $name => $type) {
            FieldType::create([
                'name' => $name,
                'type' => $type
            ]);
        }
    }
}
