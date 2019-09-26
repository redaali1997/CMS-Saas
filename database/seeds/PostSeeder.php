<?php

use Illuminate\Database\Seeder;
use App\Post;
use App\Category;
use App\Tag;
use App\User;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Categories
        $category1 = Category::create([
            'name' => 'News',
        ]);

        $category2 = Category::create([
            'name' => 'Desgin',
        ]);

        $category3 = Category::create([
            'name' => 'Partnership',
        ]);

        ///Users
        $user1 = User::create([
            'name' => 'amir',
            'email' => 'amir@example.com',
            'password' => Hash::make('password'),
        ]);

        $user2 = User::create([
            'name' => 'mohamed',
            'email' => 'mohamed@example.com',
            'password' => Hash::make('password'),
        ]);

        //Posts
        $post1 = Post::create([
            'title' => 'We relocated our office to a new designed garage',
            'description' => 'What is Lorem Ipsum?',
            'content' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.',
            'image' => 'posts/6.jpg',
            'category_id' => $category1->id,
            'user_id' => $user1->id,
        ]);

        $post2 = Post::create([
            'title' => 'Top 5 brilliant content marketing strategies',
            'description' => 'What is Lorem Ipsum?',
            'content' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.',
            'image' => 'posts/7.jpg',
            'category_id' => $category2->id,
            'user_id' => $user2->id,
        ]);

        $post3 = Post::create([
            'title' => 'Best practices for minimalist design with example',
            'description' => 'What is Lorem Ipsum?',
            'content' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.',
            'image' => 'posts/8.jpg',
            'category_id' => $category3->id,
            'user_id' => $user1->id,
        ]);

        $tag1 = Tag::create([
            'name' => 'record',
        ]);

        $tag2 = Tag::create([
            'name' => 'progress',
        ]);

        $tag3 = Tag::create([
            'name' => 'customer',
        ]);

        //tags
        $post1->tags()->attach([$tag1->id, $tag2->id]);
        $post2->tags()->attach([$tag2->id, $tag3->id]);
        $post3->tags()->attach([$tag1->id, $tag3->id]);

    }
}
