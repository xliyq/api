<?php

/**
 * @apiGroup            Users
 * @apiName             注册用户
 * @api                 {post} /v1/register 注册用户
 * @apiDescription      注册普通用户
 *
 * @apiPermission       Authenticated User
 *
 * @apiParam            {String}    phone
 * @apiParam            {String}    password
 * @apiParam            {String}    name
 * @apiParam            {String}    avatar_url
 *
 * @apiSuccess          {Number} id 用户id
 */
Route::post('/register', 'UserController@registerUser');


Route::group(['prefix' => 'users', 'middleware' => 'auth:api'], function () {
    /**
     * @apiGroup            Users
     * @apiName             获取所有的用户
     * @api                 {get} /v1/users 获取所有的用户
     * @apiDescription      获取所有的用户（包括管理员）,如果仅查询管理员用户请使用`/admins`
     *
     * @apiPermission       Authenticated User
     */
    Route::get('/', 'UserController@getAllUsers');

    /**
     * @apiGroup            Users
     * @apiName             根据ID更新用户
     * @api                 {put} /v1/admins/:id 根据ID更新用户
     * @apiDescription      根据ID更新用户
     *
     * @apiPermission       Authenticated User
     *
     * @apiParam            {String} password
     * @apiParam            {String} name
     */
    Route::put('{id}', 'UserController@updateUser');

    /**
     * @apiGroup            Users
     * @apiName             根据ID查找用户
     * @api                 {get} /v1/users/:id 根据ID查找用户
     * @apiDescription      根据ID查找用户
     *
     * @apiPermission       Authenticated User
     */
    Route::get('{id}', 'UserController@findUserById');

    /**
     * @apiGroup            Users
     * @apiName             删除用户
     * @api                 {delete} /v1/users/:id 删除用户
     * @apiDescription      根据id删除任何类型的用户
     *
     * @apiPermission       Authenticated User
     */
    Route::delete('{id}', 'UserController@deleteUser');
});

// 密码相关
Route::group(['prefix' => 'password'], function () {
    /**
     * @apiGroup            Users
     * @apiName             忘记密码
     * @api                 {post} /v1/password/forgot 忘记密码
     * @apiDescription      忘记密码
     *
     * @apiPermission       Authenticated User
     *
     * @apiParam            {String} phone
     */
    Route::post('forgot', 'UserController@forgotPassword');

    /**
     * @apiGroup            Users
     * @apiName             重置密码
     * @api                 {get|post} /v1/password/forgot 重置密码
     * @apiDescription      重置用户密码
     *
     * @apiPermission       Authenticated User
     *
     * @apiParam            {String} phone
     * @apiParam            {String} token
     * @apiParam            {String} password
     */
    Route::any('reset', 'UserController@resetPassword');
});

// 管理员相关
Route::group(['prefix' => 'admins', 'middleware' => 'auth:api'], function () {
    /**
     * @apiGroup            Users
     * @apiName             创建管理员
     * @api                 {post} /v1/admins 创建管理员
     * @apiDescription      创建一个管理员用户
     *
     * @apiParam            {String} phone
     * @apiParam            {String} password
     * @apiParam            {String} name
     */
    Route::post('/', 'UserController@createAdmin');

    /**
     * @apiGroup            Users
     * @apiName             获取所有管理员
     * @api                 {get} /v1/admins 获取所有管理员用户
     * @apiDescription      获取所有管理员用户
     *                      可以根据`phone`、`name`、`id`进行搜索
     *                      example：?search=zhangshang 或者?search=158xxxxx5
     *
     */
    Route::get('/', 'UserController@getAllAdmins');
});

/**
 * @apiGroup            Users
 * @apiName             获取当前认证用户的信息
 * @api                 {get} /v1/user/profile 获取当前认证用户的信息
 * @apiDescription      获取当前认证用户的信息
 */
Route::get('/user/profile', 'UserController@GetAuthenticatedUser')->middleware('auth:api');