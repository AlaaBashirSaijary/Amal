<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;
class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['name' => 'إنسانية'],
            ['name' => 'خدمية'],
            ['name' => 'تعليمية'],
            ['name' => 'بنائية'],
            ['name' => 'صحية'],
            ['name' => 'بيئية'],
            ['name' => 'تنموية'],
            ['name' => 'إغاثية'],
            ['name' => 'ثقافية'],
            ['name' => 'اجتماعية'],
        ];

        // إضافة التصنيفات إلى قاعدة البيانات
        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
