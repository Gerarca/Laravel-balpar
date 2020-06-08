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
		$categories = Categoria::orderBy('orden')->get();
		$view->with('categories', $categories);
	}
}
