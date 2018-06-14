<?php

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

Route::get('/', function () {
  return view('landing');
});

/*For Register*/
Route::get('/unete-a-nosotros', function(){
  return view('register');
});

Route::post('/registrando', 'RegisterController@register');
/*End*/

Route::get('dashboard', 'HomeController@index')->name('dashboard');

Route::get('landing', function(){
  return view(landing);
});

Route::get('/login', function(){
  return view('login');
});

Route::get('ups', ['as' => 'login', function () {
  return view('login');
}]);

Route::get('/create', 'Admin@create');

Route::post('/checkOut', 'Admin@checkOut');

Route::post('/Enviando', 'RegisterRestaurantController@seend');

Route::get('/registrar', 'RegisterRestaurantController@register');


/*------------------------------------------------------------------
|   Admin Dashboard                                                |                                                                                                 |
--------------------------------------------------------------------
| Get all restaurants
| Add new restaurants
| Create a restaurant
| Get restaurant by @id
------------------------------------------------------------------*/

/*Rutas que van dentro del middleware*/

Route::middleware(['auth'])->group(function () {
  Route::get('/logout', 'Admin@logout');

  Route::prefix('administrador')->group(function(){
    Route::get('/', function () {
        return view('admin.restaurants.home');
    });//Load Form
    Route::get('restaurantes', 'AdminRestaurantController@getRestaurants');
    Route::get('restaurante/{id}', 'AdminRestaurantController@getCategories');
    //List all
    Route::get('repartidores', 'AdminRestaurantController@orders');
    Route::get('delivery-man', 'AdminRestaurantController@deliveryMan');
    Route::get('add_deliveryMan', 'AdminRestaurantController@add_deliveryMan');
    Route::get('update_deliveryMan/{id}', 'AdminRestaurantController@getinfoDeliveryMan');
    Route::get('modificar-restaurante/{restaurant_id}', 'AdminRestaurantController@infoRestaurant');
    Route::get('add_restaurant', function () {
        $restaurant = null;
        return view('admin.restaurants.form',['restaurant' => $restaurant]);
    });//Load Form
    Route::get('restaurante', 'AdminRestaurantController@getCateogrie');
    Route::get('ordenes', 'AdminRestaurantController@all_orders');
    Route::get('restaurante/comidas/{id}', 'AdminRestaurantController@meals');
    Route::get('restaurante/ingredientes/{id}', 'AdminRestaurantController@ingredients');

    /* Añadir Restaurante */
    Route::post('agregando', 'AdminRestaurantController@add_restaurant');
    /* Actualizar Restaurante */
    Route::post('actualizando', 'AdminRestaurantController@editRestaurant');

    Route::post('create_restaurant', 'AdminRestaurantController@createRestaurant');//Create
    Route::get('restaurant/{restaurant_id}', 'AdminRestaurantController@getRestaurant');//Get instance
    Route::post('/deleteRestaurant', 'AdminRestaurantController@deleteRestaurant');//delete
    Route::post('/add_delivery_man', 'AdminRestaurantController@add_delivery_man');
    Route::post('/deleteDeliveryMan', 'AdminRestaurantController@deleteDeliveryMan');
    Route::post('/update_delivery_man', 'AdminRestaurantController@update_delivery_man');
    Route::post('/updateRestaurant', 'AdminRestaurantController@update_restaurant');
  });
  /*------------------------------------------------------------------
  |   Restaurant Dashboard                                           |                                                                                                 |
  --------------------------------------------------------------------
  | Get all restaurants
  | Add new restaurants
  | Create a restaurant
  | Get restaurant by @id
  ------------------------------------------------------------------*/
  Route::prefix('restaurante')->group(function(){

    Route::get('inicio/{id}', 'RestaurantController@getCategories');//List all
    Route::get('{restaurant_id}/agregar-categoria', 'RestaurantController@addCategory');//Load Form
    Route::post('{restaurant_id}/create_category', 'RestaurantController@createCategory');//Create
    Route::post('res/{restaurant_id}/cat/{category_id}', 'RestaurantController@getCategory');//Get instance
    Route::get('ordenes', 'RestaurantController@all_orders');
    Route::get('ingredients/{id}', 'RestaurantController@ingredients');
    Route::get('meals/{id}', 'RestaurantController@meals');
    Route::get('add-meal/{id}', 'RestaurantController@addMeal');
    Route::post('create-meal', 'RestaurantController@createMeal');
    Route::post('agregando', 'RestaurantController@addMealC');
    /*Vista de las propiedades del restaurante*/
    //Route::get('inicio/{restaurant_id}', 'AdminRestaurantController@getCategories');
    Route::get('comidas/{id}', 'RestaurantController@meals');
    Route::get('ingredientes/{id}', 'RestaurantController@ingredients');

    Route::post('/dcomida', 'RestaurantController@deleteCategorie');

  });

  /*------------------------------------------------------------------
  |   User Register From App                                         |
  ------------------------------------------------------------------*/
  Route::post('/register','User@register');
  Route::post('/signup', 'User@signup');
  Route::get('/checkNumber/{number}', 'User@checkNumber');
  Route::post('/create-ingredient', 'RestaurantController@createIngredient');
  Route::post('/getDelivery/{id}', 'RestaurantController@getDelivery');


  /*------------------------------------------------------------------
  |   Utility Routes                                                 |                                                                                                 |
  --------------------------------------------------------------------
  | Get images from ./storage ( Azure Server )
  ------------------------------------------------------------------*/
  Route::get('/storage/{restaurant_id}', function($restaurant_id)
  {
      $path = storage_path('app/public/restaurants/'.$restaurant_id);

      $file = File::get($path);
      $type = File::mimeType($path);

      $response = Response::make($file, 200);
      $response->header("Content-Type", $type);

      return $response;
  });//Get images.

  Route::get('/getMeals','RestaurantController@getMeals');
  Route::post('/order','RestaurantController@saveOrder');
});

/*Fin de las rutas que van dentro del middleware*/

Route::get('/getMeals','RestaurantController@getMeals');
Route::post('/order','RestaurantController@saveOrder');
Route::get('/orders','RestaurantController@getOrders');
Route::post('/update','UserController@update');
Route::get('/get_restaurants', 'API@getRestaurants');
Route::get('/restaurant_meals/{restaurant_id}', 'API@getRestaurantMeals');


/*------------------------------------------------------------------
|   Delivery Coordinates Update/Get                                |                                                                                                 |
------------------------------------------------------------------*/
Route::get('/update_delivery_coords/{restaurant_id}', 'API@updateLocation');
Route::get('/get_delivery_coords/{restaurant_id}', 'API@getDeliveryLocation');
Route::get('/get_order/{order_id}', 'RestaurantController@getOrder');

/*------------------------------------------------------------------
| Payments                                                         |                                                                                                 |
------------------------------------------------------------------*/
Route::get('/openpay_order/{user_id}', 'PaymentController@createOrder');

?>
