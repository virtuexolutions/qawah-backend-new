<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api"   middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

  Route::POST('/auth/register',[App\Http\Controllers\ApiControllers\Auth\RegisterController::Class,"add"]);
  Route::POST('/user/gallery_files_upload',[App\Http\Controllers\ApiControllers\Auth\RegisterController::class,"upload_gallery_files"]);
  Route::POST('/user/profile_files_upload',[App\Http\Controllers\ApiControllers\Auth\RegisterController::class,"upload_profile_files"]);

  Route::POST('pr',[App\Http\Controllers\ApiControllers\Auth\RegisterController::Class,"email_check"]);
  Route::POST('/auth/login',[App\Http\Controllers\ApiControllers\Auth\LoginController::Class,"do_login"]);
  Route::POST('/auth/forget-password',[App\Http\Controllers\ApiControllers\Auth\ForgotPasswordController::Class,"send_mail"]);
  Route::POST('/auth/reset-password',[App\Http\Controllers\ApiControllers\Auth\ResetPasswordController::Class,"do_reset"]);
  
  

    Route::get('/home/cms',[App\Http\Controllers\ApiControllers\CmsController::Class,"home"]);
    Route::get('/product/premium-feature',[App\Http\Controllers\ApiControllers\CmsController::Class,"product_premimum_features"]);
    Route::get('/product/prcing-gold',[App\Http\Controllers\ApiControllers\CmsController::Class,"product_pricing_gold"]);
    Route::get('/product/prcing-platinium',[App\Http\Controllers\ApiControllers\CmsController::Class,"product_pricing_platinium"]);
    Route::get('/qavah/live',[App\Http\Controllers\ApiControllers\CmsController::Class,"qavah_live"]);
    Route::get('/qavah/court',[App\Http\Controllers\ApiControllers\CmsController::Class,"qavah_court"]);
    Route::get('/saftey',[App\Http\Controllers\ApiControllers\CmsController::Class,"saftey"]);
    
    
    // Saad Commit this code
    // Route::post('/support',[App\Http\Controllers\ApiControllers\CmsController::Class,"support"]);
    Route::get('admin/info', [\App\Http\Controllers\ApiControllers\CmsController::class, 'admininfo']);
    Route::post('support', [\App\Http\Controllers\ApiControllers\CmsController::class, 'contact_info']);
    
    Route::get('/about_us',[App\Http\Controllers\ApiControllers\CmsController::Class,"about"]);
    Route::get('/terms/and/conditions',[App\Http\Controllers\ApiControllers\CmsController::Class,"termsandconditions"]);
    Route::get('/privacy',[App\Http\Controllers\ApiControllers\CmsController::Class,"privacy"]);
    Route::get('/contact_us',[App\Http\Controllers\ApiControllers\CmsController::Class,"contact_us"]);
    Route::get('/front/logo',[App\Http\Controllers\ApiControllers\CmsController::Class,"logo"]);


 
//   Route::get('/send-mail', function () {
//     $details = [
//         'title' => 'Mail from Qavah.com',
//         'body' => 'This is for testing email using smtp'
//     ];
//     \Mail::to('tahirsandh78628@gmail.com')->send(new \App\Mail\email_template($details));
    
//     dd("Email is Sent.");
// });

  //Route::POST('/auth/user',[App\Http\Controllers\ApiControllers\Auth\LoginController::Class,"user"])->middleware("auth:api");
 
  //Discovery; 
  Route::POST('/swap/popup-showed',function(){
      echo json_encode(["message" => "ok" , "status" => true]);
  });
  Route::POST('swap/popup-showed-landing',function(){
    echo json_encode(["message" => "ok" , "status" => true]);
  }); 
  // Route::POST('/auth/resend-otp',function(){
  //   echo json_encode(["message" => "ok" , "status" => true]);
  // });
 
  Route::group(["middleware" => "auth:api"],function(){ 
    Route::get('/user/get-my-profile',[App\Http\Controllers\ApiControllers\UsersController::Class,'get_user_profile']);

  

    Route::get('/auth/user',[App\Http\Controllers\ApiControllers\UsersController::Class,"get_user_profile"]);
    Route::POST('user/online',[App\Http\Controllers\ApiControllers\UsersController::Class,"online_status"]);    
    Route::POST('/user/verification_image',[App\Http\Controllers\ApiControllers\UsersController::Class,"verification_image_upload"]);    
    
    
   
    Route::POST('/user/update-my-profile',[App\Http\Controllers\ApiControllers\UsersController::Class,"update_profile"]);    
    Route::POST('/user/add-new-profile-image',[App\Http\Controllers\ApiControllers\UsersController::Class,"upload_new_profile_image"]);
    Route::POST('/user/remove-profile-image',[App\Http\Controllers\ApiControllers\UsersController::Class,"remove_profile_image"]);
    Route::POST('/user/remove-gallery-image',[App\Http\Controllers\ApiControllers\UsersController::Class,"remove_gallery_image"]);
    Route::POST('/user/reorder-gallery-images',[App\Http\Controllers\ApiControllers\UsersController::Class,"reorder_gallery_images"]);
    Route::POST('/user/reorder-profile-images',[App\Http\Controllers\ApiControllers\UsersController::Class,"reorder_profile_images"]);
    Route::POST('/user/update-profile-image',[App\Http\Controllers\ApiControllers\UsersController::class,"update_profile_files"]);
    
    // Saad Commit this cpde
    Route::POST('/user/update-my-profile-app',[App\Http\Controllers\ApiControllers\UsersController::Class,"update_profile_app"]);    



    // Route::POST(' ',[App\Http\Controllers\ApiControllers\Auth\VerificationController::Class,"sendsms"]); 
    
    

    Route::POST('/auth/send-email-otp',[App\Http\Controllers\ApiControllers\Auth\VerificationController::Class,"send_email"]);
    Route::POST('/auth/resend-email-otp',[App\Http\Controllers\ApiControllers\Auth\VerificationController::Class,"send_email"]);
    Route::POST('/auth/verify-email-otp',[App\Http\Controllers\ApiControllers\Auth\VerificationController::Class,"email_verify_otp"]);
   
    Route::POST('/send/mobile_opt',[App\Http\Controllers\ApiControllers\Auth\VerificationController::Class,"send_mobile_otp"]);
    Route::get('/auth/logout',[App\Http\Controllers\ApiControllers\UsersController::Class,"logout"]);
    
    Route::POST('/user/search-users',[App\Http\Controllers\ApiControllers\UsersController::Class,"search_user"]);
    Route::POST('/options/hiddenUsers',[App\Http\Controllers\ApiControllers\UsersController::Class,"search_hide_user"]);
   

    
    Route::POST('/auth/verify-otp',[App\Http\Controllers\ApiControllers\Auth\VerificationController::Class,"verify_otp"]);
    Route::get('/packages',[App\Http\Controllers\ApiControllers\PackagesController::Class,"get_packages"]); 
    Route::POST('/packages/get_package',[App\Http\Controllers\ApiControllers\PackagesController::Class,"get_package_detail"]); 
   
    
    Route::get('/subscribion/get_payment_methods',[App\Http\Controllers\ApiControllers\SubcribtionsController::Class,"get_payment_mehtod"]); 
    Route::POST('/subscribion/buy',[App\Http\Controllers\ApiControllers\SubcribtionsController::Class,"buy_packages"]); 
    Route::POST('/subscriptions/paypal-buy',[App\Http\Controllers\ApiControllers\SubcribtionsController::Class,"buy_packages_with_paypal"]); 
    Route::POST('/subscribion/recurring',[App\Http\Controllers\ApiControllers\SubcribtionsController::Class,"recurring"]); 
    Route::get('/subscribion/pkg_recuring',[App\Http\Controllers\ApiControllers\SubcribtionsController::Class,"pkg_info"]); 
    Route::any('/subscribion/cancel',[App\Http\Controllers\ApiControllers\SubcribtionsController::Class,"cancel_subscription"]); 
    Route::any('/subscribion/getcoupon',[App\Http\Controllers\ApiControllers\SubcribtionsController::Class,"getcoupon"]); 

    

    Route::get('/discover/getPeople/{myUid?}/{seeking?}/{lat?}/{lng?}/{city?}/{zipcode?}',[App\Http\Controllers\ApiControllers\DiscoveryController::Class,"get_peoples"]);
    
    Route::POST('/swap/liked',[App\Http\Controllers\ApiControllers\DiscoveryController::Class,"liked"]);
    Route::POST('/swap/fancy',[App\Http\Controllers\ApiControllers\DiscoveryController::Class,"fancy"]);
    Route::POST('/swap/disliked',[App\Http\Controllers\ApiControllers\DiscoveryController::Class,"disliked"]);
    Route::POST('/swap/superLiked',[App\Http\Controllers\ApiControllers\DiscoveryController::Class,"superliked"]);
    Route::POST('/swap/rewind',[App\Http\Controllers\ApiControllers\DiscoveryController::Class,"rewind"]);
    Route::POST('/swap/activate_spotlight',[App\Http\Controllers\ApiControllers\DiscoveryController::Class,"activate_spotlight"]);
    Route::POST('/send-love-note',[App\Http\Controllers\ApiControllers\DiscoveryController::Class,"love_note"]);
    
    // Saad Commit This Code
    Route::get('/user_spotlights',[App\Http\Controllers\ApiControllers\DiscoveryController::Class,"users_spotlight"]);
   



    //Saad Commit these code 
    Route::POST('/seeking/seeking/app',[App\Http\Controllers\ApiControllers\SeekingController::Class,"get_users_app"]);

    Route::POST('/seeking/seeking',[App\Http\Controllers\ApiControllers\SeekingController::Class,"get_users"]);
    Route::POST('/seeking/filtertesting',[App\Http\Controllers\ApiControllers\SeekingController::Class,"filtertesting"]);
    Route::POST('/seeking/mutual-seeking',[App\Http\Controllers\ApiControllers\SeekingController::Class,"get_mutual_users"]);
    Route::POST('/seeking/reversed-seeking',[App\Http\Controllers\ApiControllers\SeekingController::Class,"get_reversed_users"]);
    Route::POST('/seeking/theyareyourtype',[App\Http\Controllers\ApiControllers\SeekingController::Class,"get_users_my_type"]);
    Route::POST('/seeking/save_search',[App\Http\Controllers\ApiControllers\SeekingController::Class,"save_search"]);
    Route::GET('/seeking/get_saved_all_searches',[App\Http\Controllers\ApiControllers\SeekingController::Class,"get_saved_all_searches"]);
   
  
    


    
    Route::POST('/settings/block-profile',[App\Http\Controllers\ApiControllers\SettingsController::Class,"block_user"]);
    Route::POST('/settings/unblock-profile',[App\Http\Controllers\ApiControllers\SettingsController::Class,"unblock_user"]);
    Route::POST('/settings/unmatch_user',[App\Http\Controllers\ApiControllers\SettingsController::Class,"unmatch_user"]);
    Route::POST('/settings/unmatch2_user',[App\Http\Controllers\ApiControllers\SettingsController::Class,"unmatch2_user"]);
    Route::POST('/settings/get-subscription',[App\Http\Controllers\ApiControllers\SettingsController::Class,"get_subscription"]);
    Route::POST('/settings/blocked-profiles',[App\Http\Controllers\ApiControllers\SettingsController::Class,"get_block_profile"]);
    Route::POST('/settings/blocked-profiles-by-me',[App\Http\Controllers\ApiControllers\SettingsController::Class,"block_user_by_me"]);
    Route::POST('/settings/report-profile',[App\Http\Controllers\ApiControllers\SettingsController::Class,"report_user"]);
    Route::POST('/settings/cancel-subscription',[App\Http\Controllers\ApiControllers\SettingsController::Class,"cancel_subscription"]);
    Route::get('/settings/notification',[App\Http\Controllers\ApiControllers\SettingsController::Class,"get_all_notications"]);
    Route::POST('/settings/remove_notification',[App\Http\Controllers\ApiControllers\SettingsController::Class,"remove_notications"]);
    Route::POST('/settings/view_notication',[App\Http\Controllers\ApiControllers\SettingsController::Class,"view_notications"]);
    Route::POST('/settings/change-email',[App\Http\Controllers\ApiControllers\SettingsController::Class,"change_email"]);
    Route::POST('/settings/feedback',[App\Http\Controllers\ApiControllers\SettingsController::Class,"feedback"]);
    Route::POST('/user/profile-settings',[App\Http\Controllers\ApiControllers\SettingsController::Class,"who_see_profile"]);
    Route::POST('/options/chooseWhoSeeYou',[App\Http\Controllers\ApiControllers\SettingsController::Class,"chooseWhoSeeYou"]);
    Route::POST('/settings/notification-update',[App\Http\Controllers\ApiControllers\SettingsController::Class,"Members_recommendations"]);
    
    
    // Saad Commit This Code
    Route::POST('/setting/change-password',[App\Http\Controllers\ApiControllers\SettingsController::Class,"change_password"]);

    Route::POST('/event/add',[App\Http\Controllers\ApiControllers\EventController::Class,"add"]);
    Route::get('/events/getEvents',[App\Http\Controllers\ApiControllers\EventController::Class,"get_upcoming_events"]);
   
    
    
    
  
   


    Route::get('/spotlight_testing',[App\Http\Controllers\ApiControllers\DiscoveryController::Class,"testing_testing"]);
    Route::post('/post_uid_friend_match',[App\Http\Controllers\ApiControllers\DiscoveryController::Class,"post_uid_friend_match"]);


    
    Route::POST('/swap/matchMe',function(){
      return response()->json(["success" => true , "message" => "retrived user"], 200);
    });





    Route::get('/user/get_profile_detail/{myUid?}/{targetUid?}/{lat?}/{lng?}',[App\Http\Controllers\ApiControllers\UsersController::Class,"get_profile_detail"]);
    Route::POST('/favoured/who-likes-me',[App\Http\Controllers\ApiControllers\FavouredController::Class,"who_likes_me"]);
    Route::POST('/favoured/who-i-like',[App\Http\Controllers\ApiControllers\FavouredController::Class,"whi_i_like"]);
    Route::post('/favoured/view-someone-profile', [App\Http\Controllers\ApiControllers\FavouredController::Class,"profile_viewed"]);
    Route::post('/favoured/someone-viewed-my-profile', [App\Http\Controllers\ApiControllers\FavouredController::Class,"who_view_my_profile"]);
    Route::post('/favoured/get_lovenotes', [App\Http\Controllers\ApiControllers\FavouredController::Class,"get_lovenotes"]);
     
    Route::get('/get_counts', [App\Http\Controllers\ApiControllers\UsersController::Class,"get_counts"]);
    
    // Route::POST('/swap/liked',function(){
    //   return response()->json(["status" => true , "message" => "match process complete"], 200);
    // });
    // Route::POST('/',function(){
    //   return response()->json(["status" => true , "message" => "match process complete"], 200);
    // });
    
    
    //Route::POST('/subscribtion/buyaddon',[App\Http\Controllers\ApiControllers\SubcribtionsController::Class,"buyAddon"]); 
  
  });

