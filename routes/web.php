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

Route::get('dashboard', 'HomeController@index')->name('dashboard');

Route::get('landing', function(){
  return view(landing);
});

Route::get('/login', function(){
  return view('login');
});

Route::post('/checkOut', 'Admin@checkOut');


/*------------------------------------------------------------------
|   Admin Dashboard                                                |                                                                                                 |
--------------------------------------------------------------------
| Get all restaurants
| Add new restaurants
| Create a restaurant
| Get restaurant by @id
------------------------------------------------------------------*/

Route::prefix('admin')->group(function(){
  Route::get('/', function () {
      return view('admin.restaurants.home');
  });//Load Form
  Route::get('restaurants', 'RestaurantController@getRestaurants');//List all
  Route::get('orders', 'RestaurantController@orders');
  Route::get('delivery-man', 'RestaurantController@deliveryMan');
  Route::get('add_deliveryMan', 'RestaurantController@add_deliveryMan');
  Route::get('update_deliveryMan/{id}', 'RestaurantController@getinfoDeliveryMan');
  Route::get('update_restaurant/{restaurant_id}', 'RestaurantController@infoRestaurant');
  Route::get('add_restaurant', function () {
      $restaurant = null;
      return view('admin.restaurants.form',['restaurant' => $restaurant]);
  });//Load Form
  Route::post('create_restaurant', 'RestaurantController@createRestaurant');//Create
  Route::get('restaurant/{restaurant_id}', 'RestaurantController@getRestaurant');//Get instance

});

Route::post('/deleteRestaurant', 'RestaurantController@deleteRestaurant');//delete
Route::post('/add_delivery_man', 'RestaurantController@add_delivery_man');
Route::post('/deleteDeliveryMan', 'RestaurantController@deleteDeliveryMan');
Route::post('/update_delivery_man', 'RestaurantController@update_delivery_man');
Route::post('/updateRestaurant', 'RestaurantController@update_restaurant');
/*------------------------------------------------------------------
|   Restaurant Dashboard                                           |                                                                                                 |
--------------------------------------------------------------------
| Get all restaurants
| Add new restaurants
| Create a restaurant
| Get restaurant by @id
------------------------------------------------------------------*/
Route::prefix('restaurant')->group(function(){

  Route::get('home/{restaurant_id}', 'AdminRestaurantController@getCategories');//List all
  Route::get('{restaurant_id}/add_category', 'AdminRestaurantController@addCategory');//Load Form
  Route::post('{restaurant_id}/create_category', 'AdminRestaurantController@createCategory');//Create
  Route::post('res/{restaurant_id}/cat/{category_id}', 'RestaurantController@getCategory');//Get instance
  Route::get('all-orders', 'RestaurantController@all_orders');
  Route::get('ingredients/{id}', 'RestaurantController@ingredients');
  Route::get('meals/{id}', 'RestaurantController@meals');
  Route::get('add-meal/{id}', 'RestaurantController@addMeal');
});

/*------------------------------------------------------------------
|   User Register From App                                         |
------------------------------------------------------------------*/
Route::post('/register','User@register');
Route::post('/signup', 'User@signup');
Route::get('/checkNumber/{number}', 'User@checkNumber');
Route::post('/create-meal', 'RestaurantController@createMeal');
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
