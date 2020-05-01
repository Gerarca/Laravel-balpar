<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'FrontController@index')->name('front.index');
Route::get('/contacto', 'FrontController@contacto')->name('front.contacto');
Route::get('/catalogo', 'FrontController@catalogo')->name('front.catalogo');
Route::get('/producto', 'FrontController@producto')->name('front.producto');
Route::get('/presupuesto', 'FrontController@presupuesto')->name('front.presupuesto');
Route::get('/nosotros', 'FrontController@nosotros')->name('front.nosotros');
Route::get('/servicio_tecnico', 'FrontController@servicio_tecnico')->name('front.servicio_tecnico');
Route::post('/dejar_testimonio', 'FrontController@cargar_testimonio')->name('cargar.testimonio');

Route::post('/ajax/addProducto', 'Ajax\CarritoController@addProducto')->name('ajax.addProducto');
Route::get('/ajax/getProductos', 'Ajax\CarritoController@getProductos')->name('ajax.getProductos');
Route::post('/ajax/delProducto', 'Ajax\CarritoController@delProducto')->name('ajax.delProducto');

Route::post('send_contacto', 'FrontController@sendContacto')->name('front.contacto.send');
Route::post('add_newsletter', 'FrontController@addNewsletter')->name('front.newsletter.add');
Route::post('/ajax/getDescuento', 'Ajax\CarritoController@getDescuento')->name('ajax.getDescuento');



Route::get('/marcas', 'FrontController@marcas')->name('front.marcas');
Route::get('/marca/{id}/{titulo}',  ['as' => 'front.marcas.ver', 'uses' => 'Front\MarcaController@ver']);
Route::get('/categoria/{id}/{titulo}', 'Front\CategoriaController@ver')->name('front.categorias.ver');
Route::post('/categoria/{id}/{titulo}', 'Front\CategoriaController@ver')->name('front.categorias.ver_post');
Route::get('/producto/{cod_articulo}/{titulo}', 'Front\ProductoController@ver')->name('front.productos.ver');

Auth::routes();

/* Backend routes solo para quienes tienen permisos */
Route::group(['middleware' => 'role:usuario', 'middleware' => 'role:administrador'], function() {
	Route::get('panel', 'PanelController@index')->name('panel.index');
	Route::resource('panel/users', 'Panel\UsersController', ['except' => ['show']]);
	// Route::resource('panel/clientes', 'Panel\ClientesController', ['except' => ['show']]);
	Route::get('/home', 'HomeController@index')->name('home');
	Route::get('panel/editar_perfil', 'Panel\UsersController@editar_perfil')->name('editar_perfil');
	Route::get('panel/opciones', ['as' => 'panel.opciones.index', 'uses' => 'Panel\OpcionesController@index']);
	Route::put('panel/opciones/update', ['as' => 'panel.opciones.update', 'uses' => 'Panel\OpcionesController@store']);
	Route::get('panel/pedidos', 'Panel\PedidosController@index')->name('pedidos.index');
	Route::get('panel/pedidos/export', 'Panel\PedidosController@export')->name('pedidos.export');
	Route::get('panel/pedidos/{pedido}/edit', 'Panel\PedidosController@edit')->name('pedidos.edit');
	Route::put('panel/pedidos/{pedido}', 'Panel\PedidosController@update')->name('pedidos.update');


	Route::get('panel/reportes/ventas', 'Panel\ReporteController@ventas')->name('reportes.venta');
	Route::post('panel/reportes/ventasAjax', 'Panel\ReporteController@ventasAjax')->name('reportes.ventaAjax');
	Route::get('panel/reportes/usuarios', 'Panel\ReporteController@usuarios')->name('reportes.usuario');
	Route::post('panel/reportes/usuariosAjax', 'Panel\ReporteController@usuariosAjax')->name('reportes.usuarioAjax');
	Route::get('panel/reportes/productos', 'Panel\ReporteController@productos')->name('reportes.producto');
	Route::post('panel/reportes/productosAjax', 'Panel\ReporteController@productosAjax')->name('reportes.productoAjax');
	Route::get('panel/reportes/marcas', 'Panel\ReporteController@marcas')->name('reportes.marca');
	Route::post('panel/reportes/marcasAjax', 'Panel\ReporteController@marcasAjax')->name('reportes.marcaAjax');

	Route::resource('panel/banner', 'Panel\BannerController', ['except' => ['show']]);
	Route::resource('panel/ciudad', 'Panel\CiudadController', ['except' => ['show']]);
	Route::resource('panel/solicitudtarjeta', 'Panel\SolicitudTarjetaController', ['except' => ['show']]);
	Route::resource('panel/newsletter', 'Panel\NewsletterController', ['except' => ['show']]);
	Route::resource('panel/categorias', 'Panel\CategoriaController', ['except' => ['show']]);
	Route::resource('panel/marcas', 'Panel\MarcaController', ['except' => ['show']]);
	Route::resource('panel/sucursal', 'Panel\SucursalController', ['except' => ['show']]);
	Route::resource('panel/color', 'Panel\ColorController', ['except' => ['show']]);
	Route::resource('panel/tamano', 'Panel\TamanoController', ['except' => ['show']]);
	Route::resource('panel/etiqueta', 'Panel\EtiquetaController', ['except' => ['show']]);
	Route::resource('panel/datos_dinamicos', 'Panel\DatosDinamicoController', ['except' => ['show', 'create', 'store', 'destroy']]);
	Route::resource('panel/testimonios', 'Panel\TestimonioController', ['except' => ['show']]);

	Route::get('panel/producto/{cod_articulo}/cuotas', 'Panel\CuotasController@index')->name('panel.cuotas.index');
	Route::post('panel/producto/{cod_articulo}/cuotas', 'Panel\CuotasController@store')->name('panel.cuotas.store');
	Route::put('panel/producto/{cod_articulo}/cuotas', 'Panel\CuotasController@update')->name('panel.cuotas.update');
	Route::delete('panel/producto/{cod_articulo}/cuotas', 'Panel\CuotasController@delete')->name('panel.cuotas.delete');
	#-- Productos --#
	Route::resource('panel/producto', 'Panel\ProductoController', ['except' => ['show']]);
	Route::get('panel/producto/crear', 'Panel\ProductoController@crearIndividual')->name('producto.crear');
	Route::post('panel/producto/guardar', 'Panel\ProductoController@guardarIndividual')->name('producto.guardar');
	Route::post('panel/producto/{id}/guardar_fotos', 'Panel\ProductoController@subirFotos')->name('producto.guardar.fotos');
	Route::get('panel/producto/galeria', 'Panel\ProductoController@galeriaFotos')->name('producto.obtener.galeria');
	Route::post('panel/producto/eliminar_galeria', 'Panel\ProductoController@eliminarImagen')->name('producto.eliminar.galeria');
	Route::post('panel/producto/editar_orden', 'Panel\ProductoController@actualizarOrden')->name('producto.editar.galeria');
});
