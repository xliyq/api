<?php

/**
 * @apiGroup OAuth2
 * @apiName  授权码登录
 * @api {post} /v1/oauth/token 授权码登录
 * @apiDescription  使用用户名和密码登录用户。（对于第三方账号）。
 * 您必须首先拥有客户ID和机密。您可以通过在我们的Web应用程序中创建新的客户端来生成它们。
 *
 * @apiPermission    Authenticated User
 *
 * @apiParam {String} client_id  客户端id
 * @apiParam {String} client_secret 客户端秘钥
 * @apiParam {String} grant_type 必须是  `client_credentials`
 * @apiParam {String} [scope] 可以为空
 *
 * @apiSuccessExample  {json}       成功:
 * {
 * "token_type": "Bearer",
 * "expires_in": 315360000,
 * "access_token": "eyJ0eXAiOiJKV1QiLCJhbG...",
 * }
 *
 */

/**
 *
 * @apiGroup OAuth2
 * @apiName  密码登录
 * @api {post} /v1/oauth/token 密码登录
 * @apiDescription  使用用户名和密码登录用户。
 *
 * @apiUse Test
 *
 * @apiDeprecated 2019-6-4 14:04:03
 * @apiError  UserNotFound The <code>id</code> of the User was not found.
 * @apiErrorExample {json} Error-Response:
 *     {
 *       "error": "UserNotFound"
 *     }
 * @apiExample {curl} Example usage:
 *     curl -i http://localhost/user/4711
 * @apiHeaderExample {json} Header-Example:
 *     {
 *       "Accept-Encoding": "Accept-Encoding: gzip, deflate"
 *     }
 * @apiParamExample [{type}] [title]
 * example
 * @apiSuccess {String} firstname Firstname of the User.
 * @apiVersion 1.6.2
 *
 * @apiPermission    Authenticated User
 *
 * @apiParam    {String} client_id
 * @apiParam    {String} client_secret
 * @apiParam    {String} grant_type 必须是  `password`
 * @apiParam    {String} [scope] 可以为空
 * @apiParam    {String} username 可以为`phone`的值
 * @apiParam    {String} password 密码
 *
 *  * @apiSuccessExample  {json}       成功:
 * {
 * "token_type": "Bearer",
 * "expires_in": 315360000,
 * "access_token": "eyJ0eXAiOiJKV1QiLCJhbG...",
 * "refresh_token": "Oukd61zgKzt8TBwRjnasd..."
 * }
 *
 */


/**
 * @apiGroup OAuth2
 * @apiName  退出登录
 * @api {post} /v1/logout 退出登录
 * @apiDescription   退出登录，删除token信息
 *
 * @apiPermission    Authenticated User
 *
 * @apiSuccessExample  {json}       成功:
 * {
 * "message": "退出成功"
 * }
 *
 */
Route::delete('logout', 'Controller@logout')->middleware('auth:api');

Route::group(['prefix' => 'clients/web'], function () {

    /**
     * @apiGroup OAuth2
     * @apiName  web代理登录
     * @api {post} /v1/clients/web/login web代理登录
     * @apiDescription    通过手机号和密码进行登录，不需要传client_id和client_secret
     *
     * @apiParam {String}  phone
     * @apiParam {String}  password
     *
     * @apiSuccessExample  {json}       成功:
     * {
     * "token_type": "Bearer",
     * "expires_in": 315360000,
     * "access_token": "eyJ0eXAiOiJKV1QiLCJhbG...",
     * "refresh_token": "ZFDPA1S7H8Wydjkjl+xt+hPGWTagX..."
     * }
     */
    Route::post('login', 'Controller@proxyLoginForWebClient');

    /**
     * @apiGroup OAuth2
     * @apiName  web代理刷新token
     * @api {post} /v1/clients/web/refresh web代理刷新token
     * @apiDescription    如果不传refresh_token，从cookie中尝试获取
     *
     * @apiParam {String} [refresh_token]  刷新token
     *
     * @apiSuccessExample  {json}       成功:
     * {
     * "token_type": "Bearer",
     * "expires_in": 315360000,
     * "access_token": "eyJ0eXAiOiJKV1QiLCJhbG...",
     * "refresh_token": "ZFDPA1S7H8Wydjkjl+xt+hPGWTagX..."
     * }
     */
    Route::post('refresh', 'Controller@proxyRefreshForWebClient');
});
