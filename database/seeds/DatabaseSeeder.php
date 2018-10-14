<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Lesson;
use App\Tag;

class DatabaseSeeder extends Seeder
{
    protected $tables = [
        'lessons',
        'tags',
        'lesson_tag'
    ];
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->cleanDatabase();

    	Eloquent::unguard();

         $this->call('LessonsTableSeeder');
         $this->call('tags');
         $this->call('LessonTagTableSeeder');
    }
    public function cleanDatabase()
    {

        foreach ($this->tables as $tableName) {
            DB::table($tableName)->truncate();
        }
       

        DB::table('lesson_tag')->truncate();
    }
}
