<?php


use Admin\Models\Comment;
use Illuminate\Database\Seeder;

class CommentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Comment::create([
            'individual_id' => 1,
            'post_id' => 1,
            'en'   =>  [
                'description' => 'Description',
            ],
            'ar'        =>  [
                'description' => 'وصف',
            ],
        ]);
        Comment::create([
            'broker_id' => 1,
            'post_id' => 2,
            'en'   =>  [
                'description' => 'Description Description Description',
            ],
            'ar'        =>  [
                'description' => 'وصف',
            ],
        ]);
        Comment::create([
            'developer_id' => 1,
            'post_id' => 3,
            'en'   =>  [
                'description' => 'Description Descccc',
            ],
            'ar'        =>  [
                'description' => 'وصف',
            ],
        ]);
    }
}
