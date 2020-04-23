<?php
/**
 *
 * File: PostService.php
 *
 * Created by Yiannis Kiranis <rocean74@gmail.com>
 * http://www.apps4net.eu
 *
 * Date: 14/4/20
 * Time: 11:06 μ.μ.
 *
 * Services foc Posts controller
 *
 */

namespace App\Services;

use App\Category;

class PostService
{

    /**
     * Get all categories with checked for specific $post
     *
     * @param object $post
     * @return object
     */
    static function getCheckedCategories(object $post) : object
    {
        $checkedCategories = $post->categories()->get()->map(function ($item) {
            return $item->id;
        })->toArray();

        return Category::all()->map(function ($item) use ($checkedCategories) {
            return [
                'id' => $item->id,
                'name' => $item->name,
                'checked' => (in_array($item->id, $checkedCategories)) ? true : false
            ];
        });
    }

    /**
     * Get mapped tags
     *
     * @param object $post
     * @return object
     */
    static function getTags(object $post) : object
    {
        return $post->tags()->get()->map(function($item) {
            return ['id' => $item->id, 'name' => $item->name];
        });
    }
}
