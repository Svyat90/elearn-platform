<?php

use Illuminate\Database\Seeder;
use App\Category;
use App\SubCategory;
use Carbon\Carbon;

class CategorySeeder extends Seeder
{
    /**
     * @var array
     */
    private array $categories = [
        'Нормативные акты' => [
            'выпущено Советом Национального института юстиции',
            'выдан директором Национального института юстиции',
            'другие, связанные с деятельностью Национального института юстиции'
        ],
        'Документы, связанные с оценкой (текущая / окончательная)' => [
            'календарь',
            'общая тема',
            'подробные  темы',
            'другие'
        ],
        'Методолого-дидактические материалы, разработанные в рамках начального и непрерывного обучения' => [
            'материалы курса',
            'модули',
            'дидактические рекомендации',
            'дидактические материалы',
            'гиды',
            'методические указания',
            'тексты курсов',
            'конспекты',
            'исследования',
            'отчеты',
            'презентаций',
            'планы курсов',
            'семинары'
        ],
        'Научные материалы' => [
            'книги',
            'монографии',
            'исследования',
            'научные статьи',
            'другие материалы, разработанные в процессе исследования'
        ]
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $time = Carbon::now()->toDateTimeString();

        foreach ($this->categories as $category => $subCategories) {
            $categoryId = Category::query()->insertGetId([
                'name_ru' => $category,
                'name_ro' => $category,
                'name_en' => $category,
                'created_at' => $time,
                'updated_at' => $time,
            ]);

            foreach ($subCategories as $subCategory) {
                SubCategory::query()->insert([
                    'parent_id' => $categoryId,
                    'name_ru' => $subCategory,
                    'name_ro' => $subCategory,
                    'name_en' => $subCategory,
                    'created_at' => $time,
                    'updated_at' => $time,
                ]);
            }
        }
    }

}
