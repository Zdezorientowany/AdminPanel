<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Content;
use App\Models\Tag;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Content>
 */
class ContentFactory extends Factory
{
    protected $model = Content::class;

    public function definition(): array
    {
        return [
            'title' => fake()->sentence(),
            'content' => fake()->paragraph(),
            'publish_date' => fake()->date(),
            'created_at' => fake()->dateTime(),
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function (Content $content) {
            // Generate a random number of tags between 1 and 3
            $numTags = rand(1, 3);

            // Generate unique tag names
            $tagNames = $this->faker->unique()->words($numTags);

            // Create or retrieve tags with the generated names
            $tags = [];
            foreach ($tagNames as $tagName) {
                $tag = Tag::firstOrCreate(['name' => $tagName]);
                $tags[] = $tag->id;
            }

            // Attach the tags to the content
            $content->tags()->attach($tags);
        });
    }
}
