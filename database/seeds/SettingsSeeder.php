<?php

use Illuminate\Database\Seeder;
use App\Setting;

class SettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $settings = [
            ['key' => 'address_ru', 'val' => 'MD-2004, Republica Moldova, Chișinău, str. S.Lazo, 1'],
            ['key' => 'address_ro', 'val' => 'MD-2004, Republica Moldova, Chișinău, str. S.Lazo, 1'],
            ['key' => 'address_en', 'val' => 'MD-2004, Republica Moldova, Chișinău, str. S.Lazo, 1'],
            ['key' => 'phone_fax', 'val' => '(+373 22) 232 755'],
            ['key' => 'email', 'val' => 'e-mail:inj@inj.gov.md'],
            ['key' => 'work_time', 'val' => '8.00-17.00'],
            ['key' => 'work_time_lunch', 'val' => '12.00-13.00'],
            ['key' => 'training_and_research_department_phone', 'val' => '(+373 22) 233 483'],
            ['key' => 'initial_training_section_phone', 'val' => '(+373 22) 228 186'],
            ['key' => 'continuing_education_section_phone', 'val' => '(+373 22) 930 115'],
            ['key' => 'training_and_research_department_phone', 'val' => '(+373 22) 233 483'],
            ['key' => 'didactic_methodical_section_phone', 'val' => '(+373 22) 930 114/233 068'],
            ['key' => 'e_training_section_phone', 'val' => '(+373 22) 930 124'],
            ['key' => 'information_technology_department_phone_mob', 'val' => '(+373 68) 185 791'],
            ['key' => 'information_technology_department_phone', 'val' => '(+373 22) 930 124'],
            ['key' => 'international_relations_section_phone', 'val' => '(+373 22) 930 221'],
        ];

        Setting::query()->insert($settings);
    }
}
