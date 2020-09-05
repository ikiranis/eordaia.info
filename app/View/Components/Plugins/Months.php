<?php

namespace App\View\Components\Plugins;

use App\Post;
use DB;
use Illuminate\View\Component;

class Months extends Component
{
    private $monthNames = [
        'Ιανουάριος',
        'Φεβρουάριος',
        'Μάρτιος',
        'Απρίλιος',
        'Μάιος',
        'Ιούνιος',
        'Ιούλιος',
        'Αύγουστος',
        'Σεπτέμβριος',
        'Οκτώβριος',
        'Νοέμβριος',
        'Δεκέμβριος'
    ];

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
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        $months = Post::select(DB::raw('YEAR(created_at) year, MONTH(created_at) month'))
            ->groupBy('year', 'month')
            ->orderBy('year', 'desc')
            ->orderBy('month', 'desc')
            ->get();

        $names = $this->monthNames;

        return view('components.plugins.months', compact(['months', 'names']));
    }
}
