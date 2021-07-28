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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index')->name('home');

Route::get('upgrade-to-v3-4-0', function () {
    try {

        \Artisan::call('migrate', [
            '--path' => '/database/migrations/2020_10_19_133700_move_all_existing_devices_to_new_table.php',
            '--force' => true
        ]);

        return 'You are successfully migrated to v3.4.0';
    } catch (Exception $exception){
        return $exception->getMessage();
    }
});


Auth::routes();
Route::get('activate', 'AuthController@verifyAccount');

// Route::get('/home', 'HomeController@index');
Route::post('update-language', 'UserController@updateLanguage')->middleware('auth');

Route::group(['middleware' => ['role:admin', 'web', 'auth', 'user.activated']], function () {
    Route::resource('countries', 'CountryController');

    Route::resource('states', 'StateController');
    Route::post('/getStates', 'StateController@getStates')->name('getStates');

    Route::resource('cities', 'CityController');
    Route::post('/getCities', 'CityController@getCities')->name('getCities');
    
    Route::get('settings', 'SettingsController@index')->name('settings.index');
    Route::post('settings', 'SettingsController@update')->name('settings.update');

    Route::resource('reported-users', 'ReportUserController');
    Route::resource('meetings', 'MeetingController');
    Route::get('meetings/{meeting}/change-status', 'MeetingController@changeMeetingStatus');
    Route::resource('/users/deleted', 'SoftDeletesController', [
        'only' => [
            'index', 'show', 'update', 'destroy',
        ],
    ]);

    Route::resource('users', 'UsersManagementController', [
        'names' => [
            'index'   => 'users',
            'destroy' => 'user.destroy',
        ],
        'except' => [
            'deleted',
        ],
    ]);
    Route::post('users/store', 'UsersManagementController@store')->name('users.store');
    Route::post('users/{user}/update', 'UsersManagementController@update')->name('users.update');

    Route::resource('plans', 'PlanController');
    Route::get('/bonus/{id}', 'PlanController@bonus')->name('plans.bonus');
    Route::get('/createbonus', 'PlanController@createbonus')->name('plans.createbonus');
    Route::post('/plans/updatebonus/{id}', 'PlanController@updatebonus')->name('plans.updatebonus');
    Route::get('/bonuses', 'PlanController@bonuses')->name('plans.bonuses');
});

Route::group(['middleware' => ['user.activated', 'auth']], function () {
    //view routes
    Route::get('/conversations', 'ChatController@index')->name('conversations');

    Route::get('/messages/inbox', 'MessagesController@index')->name('messages.inbox');
    Route::get('/messages/outbox', 'MessagesController@outbox')->name('messages.outbox');
    Route::get('/messages/compose', 'MessagesController@compose')->name('messages.compose');
    Route::get('/messages/view/{id}', 'MessagesController@view')->name('messages.view');
    Route::get('/messages/reply/{id}', 'MessagesController@reply')->name('messages.reply');
    Route::get('/messages/delete/{id}', 'MessagesController@destroy')->name('messages.delete');
    Route::post('/messages/store', 'MessagesController@store')->name('messages.store');
    Route::post('/messages/{id}/update', 'MessagesController@update')->name('messages.update');

    Route::get('/packages', 'PlanController@mlmPackages')->name('mlm.packages');
    Route::get('/purchase/{package_id}', 'PlanController@purchasePackage')->name('purchase.package');

    Route::group(['namespace' => 'API'], function () {
        Route::get('logout', 'Auth\LoginController@logout');

        //get all user list for chat
        Route::get('users-list', 'UserAPIController@getUsersList');
        Route::get('get-users', 'UserAPIController@getUsers');
        Route::delete('remove-profile-image', 'UserAPIController@removeProfileImage');
        /** Change password */
        Route::post('change-password', 'UserAPIController@changePassword');
        Route::get('conversations/{ownerId}/archive-chat', 'UserAPIController@archiveChat');

        Route::get('get-profile', 'UserAPIController@getProfile');
        Route::post('profile', 'UserAPIController@updateProfile')->name('update.profile');
        Route::post('update-last-seen', 'UserAPIController@updateLastSeen');

        Route::post('send-message',
            'ChatAPIController@sendMessage')->name('conversations.store')->middleware('sendMessage');
        Route::get('users/{id}/conversation', 'UserAPIController@getConversation');
        Route::get('conversations-list', 'ChatAPIController@getLatestConversations');
        Route::get('archive-conversations', 'ChatAPIController@getArchiveConversations');
        Route::post('read-message', 'ChatAPIController@updateConversationStatus');
        Route::post('file-upload', 'ChatAPIController@addAttachment')->name('file-upload');
        Route::post('image-upload', 'ChatAPIController@imageUpload')->name('image-upload');
        Route::get('conversations/{userId}/delete', 'ChatAPIController@deleteConversation');
        Route::post('conversations/message/{conversation}/delete', 'ChatAPIController@deleteMessage');
        Route::post('conversations/{conversation}/delete', 'ChatAPIController@deleteMessageForEveryone');
        Route::get('/conversations/{conversation}', 'ChatAPIController@show');
        Route::post('send-chat-request', 'ChatAPIController@sendChatRequest')->name('send-chat-request');
        Route::post('accept-chat-request', 'ChatAPIController@acceptChatRequest')->name('accept-chat-request');
        Route::post('decline-chat-request', 'ChatAPIController@declineChatRequest')->name('decline-chat-request');

        /** Web Notifications */
        Route::put('update-web-notifications', 'UserAPIController@updateNotification');

        /** BLock-Unblock User */
        Route::put('users/{user}/block-unblock', 'BlockUserAPIController@blockUnblockUser');
        Route::get('blocked-users', 'BlockUserAPIController@blockedUsers');

        /** My Contacts */
        Route::get('my-contacts', 'UserAPIController@myContacts')->name('my-contacts');

        /** Groups API */
        Route::post('groups', 'GroupAPIController@create');
        Route::post('groups/{group}', 'GroupAPIController@update');
        Route::get('groups', 'GroupAPIController@index');
        Route::get('groups/{group}', 'GroupAPIController@show');
        Route::put('groups/{group}/add-members', 'GroupAPIController@addMembers');
        Route::delete('groups/{group}/members/{user}', 'GroupAPIController@removeMemberFromGroup');
        Route::delete('groups/{group}/leave', 'GroupAPIController@leaveGroup');
        Route::delete('groups/{group}/remove', 'GroupAPIController@removeGroup');
        Route::put('groups/{group}/members/{user}/make-admin', 'GroupAPIController@makeAdmin');
        Route::put('groups/{group}/members/{user}/dismiss-as-admin', 'GroupAPIController@dismissAsAdmin');
        Route::get('users-blocked-by-me', 'BlockUserAPIController@blockUsersByMe');

        Route::get('notification/{notification}/read', 'NotificationController@readNotification');
        Route::get('notification/read-all', 'NotificationController@readAllNotification');

        /** Web Notifications */
        Route::put('update-web-notifications', 'UserAPIController@updateNotification');
        Route::put('update-player-id', 'UserAPIController@updatePlayerId');
        //set user custom status route
        Route::post('set-user-status', 'UserAPIController@setUserCustomStatus')->name('set-user-status');
        Route::get('clear-user-status', 'UserAPIController@clearUserCustomStatus')->name('clear-user-status');
        
        //report user
        Route::post('report-user', 'ReportUserController@store')->name('report-user.store');
    });
});

// Registered, activated, and is current user routes.
Route::group(['middleware' => ['auth', 'user.activated', 'currentUser']], function () {

    // User Profile and Account Routes
    Route::resource(
        'profile',
        'ProfileController', [
            'only' => [
                'show',
                'edit',
                'update',
                'create',
            ],
        ]
    );
    Route::put('profile/{username}/updateUserAccount', [
        'as'   => '{username}',
        'uses' => 'ProfileController@updateUserAccount',
    ]);
    Route::put('profile/{username}/updateUserPassword', [
        'as'   => '{username}',
        'uses' => 'ProfileController@updateUserPassword',
    ]);
    Route::delete('profile/{username}/deleteUserAccount', [
        'as'   => '{username}',
        'uses' => 'ProfileController@deleteUserAccount',
    ]);

    // Route to show user avatar
    Route::get('images/profile/{id}/avatar/{image}', [
        'uses' => 'ProfileController@userProfileAvatar',
    ]);

    // Route to upload user avatar.
    Route::post('avatar/upload', ['as' => 'avatar.upload', 'uses' => 'ProfileController@upload']);
});

Route::group(['middleware' => ['role:admin|user', 'auth', 'user.activated']], function () {
    Route::get('member/meetings', 'MeetingController@showMemberMeetings')->name('meetings.member_index');
});

Route::group(['middleware' => ['web']], function () {

    Route::get('login/{provider}', 'Auth\SocialAuthController@redirect');
    Route::get('login/{provider}/callback', 'Auth\SocialAuthController@callback');
});