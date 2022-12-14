<?php

namespace Database\Factories;

use App\Models\Subcategory;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
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
        $image=$this->faker->imageUrl(600,480);
        $description=$this->faker->text(100);
        $additional_info=$this->faker->text(100);
        $category_id = random_int(1,5);
        $subcategory_id = random_int(1,5);
        return [
            'name'=>$name,
            'slug'=>$slug,
            'image'=>$image,
            'description'=>$description,
            'additional_info'=>$additional_info,
            'price'=>rand(100,600),
            'category_id'=>$category_id,
            'subcategory_id'=>$subcategory_id,
        ];
    }
}
