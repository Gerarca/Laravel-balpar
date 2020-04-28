<?php

namespace App\Http\ViewComposers;

use App\Opcion;
use Illuminate\View\View;

class InjectOptionsMain
{
	protected $opcionesMain;

	public function __construct(Opcion $opcionesMain)
	{
		$this->opcionesMain = $opcionesMain;
	}

	public function compose(View $view)
	{
	$opcionesMain['facebook'] = Opcion::where('name','facebook')->get();
  if (sizeof($opcionesMain['facebook'])) {
    $opcionesMain['facebook']=$opcionesMain['facebook'][0];
  }else {
    $opcionesMain['facebook']=NULL;
  }
	$opcionesMain['instagram'] = Opcion::where('name','instagram')->get();
  if (sizeof($opcionesMain['instagram'])) {
    $opcionesMain['instagram']=$opcionesMain['instagram'][0];
  }else {
    $opcionesMain['instagram']=NULL;
  }
	$opcionesMain['mail'] = Opcion::where('name','mail')->get();
  if (sizeof($opcionesMain['mail'])) {
    $opcionesMain['mail']=$opcionesMain['mail'][0];
  }else {
    $opcionesMain['mail']=NULL;
  }
	$opcionesMain['telefono'] = Opcion::where('name','telefono')->get();
  if (sizeof($opcionesMain['telefono'])) {
    $opcionesMain['telefono']=$opcionesMain['telefono'][0];
  }else {
    $opcionesMain['telefono']=NULL;
  }
	$opcionesMain['messenger'] = Opcion::where('name','messenger')->get();
  if (sizeof($opcionesMain['messenger'])) {
    $opcionesMain['messenger']=$opcionesMain['messenger'][0];
  }else {
    $opcionesMain['messenger']=NULL;
  }
	$opcionesMain['whatsApp'] = Opcion::where('name','whatsApp')->get();
  if (sizeof($opcionesMain['whatsApp'])) {
    $opcionesMain['whatsApp']=$opcionesMain['whatsApp'][0];
  }else {
    $opcionesMain['whatsApp']=NULL;
  }
	$opcionesMain['twitter'] = Opcion::where('name','twitter')->get();
  if (sizeof($opcionesMain['twitter'])) {
    $opcionesMain['twitter']=$opcionesMain['twitter'][0];
  }else {
    $opcionesMain['twitter']=NULL;
  }
	$opcionesMain['direccion'] = Opcion::where('name','direccion')->get();
  if (sizeof($opcionesMain['direccion'])) {
    $opcionesMain['direccion']=$opcionesMain['direccion'][0];
  }else {
    $opcionesMain['direccion']=NULL;
  }
	$opcionesMain['horario'] = Opcion::where('name','horario')->get();
  if (sizeof($opcionesMain['horario'])) {
    $opcionesMain['horario']=$opcionesMain['horario'][0];
  }else {
    $opcionesMain['horario']=NULL;
  }
	$opcionesMain['nombre_comercio'] = Opcion::where('name','nombre_comercio')->first();
	$opcionesMain['descripcion_comercio'] = Opcion::where('name','descripcion_comercio')->first();
	$opcionesMain['mail_contacto'] = Opcion::where('name','mail_contacto')->first();
	$opcionesMain['mail_pedido'] = Opcion::where('name','mail_pedido')->first();
	$opcionesMain['mail_pedido'] = Opcion::where('name','mail_pedido')->first();
	$opcionesMain['color_principal'] = Opcion::where('name','color_principal')->first();
	$opcionesMain['color_secundario'] = Opcion::where('name','color_secundario')->first();
	$opcionesMain['logo'] = Opcion::where('name','logo')->first();
	$opcionesMain['get'] = function($valor){
		$opcion=Opcion::where('name',$valor)->first();
		if ($opcion==NULL) {
			return '';
		}else {
			return $opcion->value;
		}
	};


		$view->with('opcionesMain', $opcionesMain);
	}
}
