<?php

use Illuminate\Database\Seeder;

class ClassInformationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $students = \EDU\Models\Student::all();
        $teachers = \EDU\Models\Teacher::all();
        $subjects = \EDU\Models\Subject::all();
        factory(\EDU\Models\ClassInformation::class,50)
            ->create()
            ->each(function(\EDU\Models\ClassInformation $model) use($students, $teachers, $subjects){
                /** @var \Illuminate\Support\Collection $studentsCol */
                $studentsCol = $students->random(10);
                $model->students()->attach($studentsCol->pluck('id'));

                $teaching = rand(3,9);

                $teachersCol = $teachers->random($teaching);
                $subjectsCol = $subjects->random($teaching);
                foreach (range(1,$teaching) as $value){
                    $model->teachings()->create([
                        'subject_id' => $subjectsCol->get($value-1)->id,
                        'teacher_id' => $teachersCol->get($value-1)->id,
                    ]);
                }
            });
    }
}