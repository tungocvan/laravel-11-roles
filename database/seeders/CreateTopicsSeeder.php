<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Modules\Category\Models\WpTerm;
use Modules\Category\Models\WpTermTaxonomy;

class CreateTopicsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Tạo WpTerm cho 'Môn học'
        $term = WpTerm::create([
            'name' => 'Môn học',
            'slug' => 'mon-hoc',
        ]);

        // Tạo WpTermTaxonomy cho 'Môn học'
        WpTermTaxonomy::create([
            'term_id' => $term->term_id,
            'taxonomy' => 'topic_cat', // Giả sử taxonomy là 'category'
            'description' => 'Danh sách các môn học',
            'parent' => 0,
            'count' => 3, // Số lượng các môn học
        ]);

        // Mảng chứa tên và slug của các môn học
        $subjects = [
            ['name' => 'Toán', 'slug' => 'toan'],
            ['name' => 'Tiếng Việt', 'slug' => 'tieng-viet'],
            ['name' => 'Tiếng Anh', 'slug' => 'tieng-anh'],
        ];

        // Tạo các WpTerm cho từng môn học
        foreach ($subjects as $subject) {
            $subTerm = WpTerm::create([
                'name' => $subject['name'],
                'slug' => $subject['slug'],
            ]);

            // Tạo WpTermTaxonomy cho từng môn học
            WpTermTaxonomy::create([
                'term_id' => $subTerm->term_id,
                'taxonomy' => 'topic_cat',
                'description' => "Mô tả cho môn học: {$subject['name']}",
                'parent' => $term->term_id, // Tham chiếu đến môn học cha
                'count' => 0, // Số lượng hiện tại, có thể cập nhật sau
            ]);
        }
    }
}
