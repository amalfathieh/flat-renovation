<?php

namespace Database\Seeders;

use App\Models\ProjectRating;
use Illuminate\Database\Seeder;

class ProjectRatingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $comments = [
            'مشروع ممتاز وتنفيذ دقيق.',
            'الخدمة جيدة لكن يوجد تأخير بسيط.',
            'لم أكن راضيًا عن الجودة.',
            'أنصح بالتعامل معهم.',
            'تم تنفيذ العمل بسرعة وكفاءة.',
            'تجربة رائعة جدًا!',
            'يحتاج إلى تحسين في بعض التفاصيل.',
            null,
        ];

        foreach (ProjectSeeder::$projects as $project) {
            ProjectRating::create([
                'project_id' => $project->id,
                'customer_id' => 1,
                'rating' => random_int(1, 5),
                'comment' => $comments[array_rand($comments)],
            ]);
        }
    }
}
