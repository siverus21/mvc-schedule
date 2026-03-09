<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ScheduleTemplatesSeeder extends Seeder
{
    public function run()
    {
        $now = date('Y-m-d H:i:s');

        $timeSlots = [
            ['08:00', '09:30'],
            ['09:45', '11:15'],
            ['11:30', '13:00'],
            ['13:30', '15:00'],
            ['15:15', '16:45'],
        ];

        $numGroups = 15;
        $numTeachers = 10;
        $numSubjects = 15;
        $numRooms = 10;
        // Дни 0–5 = понедельник–суббота (воскресенье 6 не используем)
        $daysOfWeek = [0, 1, 2, 3, 4, 5];

        $templates = [];

        for ($studentGroupId = 1; $studentGroupId <= $numGroups; $studentGroupId++) {
            foreach ($daysOfWeek as $dayOfWeek) {
                // В каждом дне от 1 до 5 занятий (разное для разных групп/дней)
                $lessonsPerDay = 1 + (($studentGroupId + $dayOfWeek) % 5);
                for ($slotIndex = 0; $slotIndex < $lessonsPerDay && $slotIndex < 5; $slotIndex++) {
                    $i = $dayOfWeek * 5 + $slotIndex;
                    $semesterId = ($dayOfWeek + $slotIndex) % 2 + 1;
                    $subjectId = (($studentGroupId + $i) % $numSubjects) + 1;
                    $teacherId = (($studentGroupId + $i * 2) % $numTeachers) + 1;
                    $lessonTypeId = ($i % 7) + 1;
                    $roomId = (($studentGroupId + $i) % $numRooms) + 1;

                    $templates[] = [
                        'student_group_id' => $studentGroupId,
                        'semester_id' => $semesterId,
                        'subject_id' => $subjectId,
                        'teacher_id' => $teacherId,
                        'room_id' => $roomId,
                        'lesson_type_id' => $lessonTypeId,
                        'day_of_week' => $dayOfWeek,
                        'week_parity' => ($dayOfWeek + $slotIndex) % 2,
                        'start_time' => $timeSlots[$slotIndex][0],
                        'end_time' => $timeSlots[$slotIndex][1],
                        'ordinal' => $slotIndex + 1,
                        'notes' => null,
                        'is_active' => true,
                        'created_at' => $now,
                        'updated_at' => $now,
                    ];
                }
            }
        }

        foreach (array_chunk($templates, 50) as $chunk) {
            DB::table('schedule_templates')->insert($chunk);
        }
    }
}
