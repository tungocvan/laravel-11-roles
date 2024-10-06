<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Category\Models\WpTerm;
use Modules\Category\Models\WpTermTaxonomy;

class CreateClassSeeder extends Seeder
{
    public function run()
    {
        // Tạo WpTerm cho 'Khối lớp'
        $term = WpTerm::create([
            'name' => 'Khối lớp',
            'slug' => 'khoi-lop',
        ]);

        // Tạo WpTermTaxonomy cho 'Khối lớp'
        WpTermTaxonomy::create([
            'term_id' => $term->term_id,
            'taxonomy' => 'class_cat', // Giả sử taxonomy là 'category'
            'description' => 'Các khối lớp',
            'parent' => 0,
            'count' => 5, // Số lượng các khối lớp
        ]);

        // Tạo các WpTerm cho 'khối lớp 1' đến 'khối lớp 5'
        for ($i = 1; $i <= 5; $i++) {
            $subTerm = WpTerm::create([
                'name' => "Khối lớp $i",
                'slug' => "khoi-lop-$i",
            ]);

            // Tạo WpTermTaxonomy cho từng khối lớp
            WpTermTaxonomy::create([
                'term_id' => $subTerm->term_id,
                'taxonomy' => 'class_cat',
                'description' => "Mô tả cho khối lớp $i",
                'parent' => $term->term_id, // Tham chiếu đến khối lớp cha
                'count' => 0, // Số lượng hiện tại, có thể cập nhật sau
            ]);
        }
    }
}
