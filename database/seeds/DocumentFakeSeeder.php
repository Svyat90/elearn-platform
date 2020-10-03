<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Document;

class DocumentFakeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Document::class)
            ->times(500)
            ->create();
    }

    /**
     * @deprecated
     */
    private function oldSeeder()
    {
        $types = ['type1', 'type2', 'type3'];
        $topics = ['topic1', 'topic2', 'topic3'];

        for ($i = 0; $i < 100; $i++) {
            $document = Document::query()->create([
                'type' => $types[rand(0,2)],
                'number' => 'number' . $i,
                'name_ru' => Str::random(20),
                'name_ro' => Str::random(20),
                'name_en' => Str::random(20),
                'name_issuer_ru' => Str::random(20),
                'name_issuer_ro' => Str::random(20),
                'name_issuer_en' => Str::random(20),
                'topic_ru' => $topics[rand(0,2)],
                'topic_ro' => $topics[rand(0,2)],
                'topic_en' => $topics[rand(0,2)],
                'image_path' => 'document/2020-09-24/5f6c92957a04f.jpg',
                'file_path' => 'document/2020-09-24/5f6c92998fb05.pdf',
                'description_ru' => Str::random(200),
                'description_ro' => Str::random(200),
                'description_en' => Str::random(200),
                'status' => 'initial',
                'access' => 'public'
            ]);

            $document->roles()->sync([1,2]);
            $document->users()->sync([1,2]);
            $document->categories()->sync([1,2,3,4]);
        }
    }
}
