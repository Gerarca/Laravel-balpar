<?php

namespace App\Http\ViewComposers;

use App\Categoria;
use Illuminate\View\View;
use Illuminate\Database\Eloquent\Builder;

class InjectCategory
{
	protected $categories;

	public function __construct(Categoria $categories)
	{
		$this->categories = $categories;
	}

	public function compose(View $view)
	{
		$categories = Categoria::whereHas('productos', function (Builder $query) {
		    $query->where('visible', 1);
		})->orderBy('orden')->get();
		$view->with('categories', $categories);
	}
}
