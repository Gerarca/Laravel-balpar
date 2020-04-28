<?php

namespace App\Http\ViewComposers;

use App\Categoria;
use Illuminate\View\View;

class InjectCategory
{
	protected $categories;

	public function __construct(Categoria $categories)
	{
		$this->categories = $categories;
	}

	public function compose(View $view)
	{
	$categories = Categoria::where('cod_padre',NULL)
  ->orderBy('orden', 'asc')->get();

		$view->with('categories', $categories);
	}
}
