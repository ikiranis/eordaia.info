<?php

namespace App\View\Components;

use Illuminate\Support\ViewErrorBag;
use Illuminate\View\Component;

class Error extends Component
{
    public ViewErrorBag $errors;

    /**
     * Create a new component instance.
     *
     * @param $errors
     */
    public function __construct($errors)
    {
        $this->errors = $errors;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return <<<'blade'
            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <h4 class="alert-heading">Λάθος δεδομένα!</h4>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
            
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
blade;
    }
}
