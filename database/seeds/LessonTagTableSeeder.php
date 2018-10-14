<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Lesson;
use App\Tag;
use Illuminate\Support\Facades\DB;

class LessonTagTableSeeder extends Seeder 
{
	public function run()
	{
		$faker = Faker::create();

		$lessonIds = Lesson::where('id' ,'>' ,0)->pluck('id')->toArray();
		$tagIds = Tag::where('id' ,'>' ,0)->pluck('id')->toArray();


		foreach (range(1,30) as $lesson) {
			DB::table('lesson_tag')->insert([
				'lesson_id' => $faker->randomElement($lessonIds),
				'tag_id' => $faker->randomElement($tagIds)
			]);
		}
	}


}