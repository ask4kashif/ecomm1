<?php

namespace Database\Factories;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $name=$this->faker->unique()->name();
        $slug=Str::slug($name,'-');
        return [

           'name'=>$name,
           'slug'=>$slug,
           'description'=>$this->faker->text(),
           'image' => $this->faker->imageurl(640,480,'animals'),
        ];
    }
}
