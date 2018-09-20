<?php

use Illuminate\Http\Request;

use App\User;
Use App\Riesgo;
Use App\Actividad;
Use App\Control;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('riesgos', function() {
    // If the Content-Type and Accept headers are set to 'application/json', 
    // this will return a JSON structure. This will be cleaned up later.
    return Riesgo::all();
});


/////////////////// ACTIVIDADES /////////////////////
Route::post('treeexcel', 'TreeController@export')->name('treeexcel');



/////////////////// Coloca solo las actividaes y controles que va seleccionando, sin concateniar /////////////////////
// ACTIVIDADES
// cargar_actividades:  Obtiene los actividades que correspondan con el rgo_id seleccionado en el checkbox del arbol y el rgo_id de la actividad
Route::get('cargar_actividades/{rgo_id}', function($rgo_id) {
    $actividades = Actividad::where('rgo_id',$rgo_id);
    return $actividades->get();// regresa en tree.js -> $.get("http://127.0.0.1:8000/api/cargar_actividades/" + rgo_id, function (data) { 
                               // los controles que coincidan con rgo_id
});
// CONTROLES
// cargar_controles: Obtiene los controles que correspondan con el rgo_id seleccionado en el checkbox del arbol y el rgo_id del  control
Route::get('cargar_controles/{rgo_id}', function($rgo_id) {
    $controles = Control::where('rgo_id',$rgo_id);
    return $controles->get(); // regresa en tree.js -> $.get("http://127.0.0.1:8000/api/cargar_controles/" + rgo_id, function (data) { 
                              // los controles que coincidan con rgo_id
});




/////////////////// va añadiendo los controles y actividades /////////////////////
// Obtiene los controles que correspondan con el rgo_id seleccionado en el checkbox del arbol y el rgo_id del  control
Route::get('addContr/{rgo_id}', function($rgo_id) {
    $controles = Control::where('rgo_id',$rgo_id);
    return $controles->get(); // regresa en tree.js -> $.get("http://127.0.0.1:8000/api/addContr/" + rgo_id, function (data) { 
                              // los controles que coincidan con rgo_id
});
// Obtiene las actividades que correspondan con el rgo_id seleccionado en el checkbox del arbol y el rgo_id del  control
Route::get('addAct/{rgo_id}', function($rgo_id) {
    $actividades = Actividad::where('rgo_id',$rgo_id);
    return $actividades->get(); // regresa en tree.js -> $.get("http://127.0.0.1:8000/api/addAct/" + rgo_id, function (data) { 
                              // las actividades que coincidan con rgo_id
});


/////////////////// DATOS USUARIO /////////////////////
Route::get('cargar_datosUser/{username}', function($username) {
    $usuario = User::where('username',$username);
    return $usuario->get(); 
});
