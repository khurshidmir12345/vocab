<?php

namespace Database\Seeders;

use App\Models\Vocabulary;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VocabularySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $vocab = [
            [
                "word_uz" => 'it',
                "word_en" => 'dog',
                "description" => 'huradi',
                "user_id" => 1,
            ],
        ];

        Vocabulary::insert($vocab);

    }
}
