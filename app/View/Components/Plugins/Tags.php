<?php

namespace App\View\Components\Plugins;

use App\Tag;
use Illuminate\View\Component;

class Tags extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Calculate font size
     *
     * @param int $count
     * @return int
     */
    private function getSize(int $count) : int
    {
        if ($count > 0 && $count < 10) return 0;
        if ($count >= 10 && $count < 20) return 1;
        if ($count >= 20 && $count < 30) return 2;
        if ($count >= 30 && $count < 40) return 3;
        if ($count >= 40) return 4;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        $tags = Tag::limit(25)
            ->withCount('posts')
            ->orderBy('posts_count', 'desc')
            ->having('posts_count', '>', 0)
            ->get();

        $tagsSum = $tags->sum('posts_count');

        $tags = $tags->map(function ($item) use ($tagsSum) {
            $item['size'] = $this->getSize($item->posts_count);

            return $item;
        });

        return view('components.plugins.tags', compact(['tags', 'tagsSum']));
    }
}
