<?php

Route::group(['prefix' => 'roles', 'middleware' => 'auth:api'], function () {

    /**
     * @apiGroup        RolePermission
     * @apiName         createRole
     * @api             {post} /v1/roles 创建角色
     * @apiDescription  .
     *
     * @apiPermission   Authenticated User
     *
     * @apiParam        {String} name 权限key，不能重复
     * @apiParam        {String} display_name 显示名称
     * @apiParam        {String} [description] 描述
     *
     */
    Route::post('/', 'RoleController@createRole');

    /**
     * @apiGroup        RolePermission
     * @apiName         getAllRoles
     * @api             {post} /v1/roles 获取所有角色
     * @apiDescription  获取所有角色
     *
     * @apiPermission   Authenticated User
     *
     *
     */
    Route::get('/', 'RoleController@getAllRoles');

    /**
     * @apiGroup        RolePermission
     * @apiName         revokeRoleFromUser
     * @api             {post} /v1/roles/revoke 删除用户的角色
     * @apiDescription  删除用户的角色
     *
     * @apiPermission   Authenticated User
     *
     * @apiParam        {Number} user_id 用户ID
     * @apiParam        {String-Array} roles_ids 角色ID
     *
     */
    Route::post('revoke', 'RoleController@revokeRoleFromUser');

    /**
     * @apiGroup        RolePermission
     * @apiName         assignUserToRole
     * @api             {post} /v1/roles/assign 给用户分配Role
     * @apiDescription  为用户分配新的Role，不将用户与新Role同步，
     *
     * @apiPermission   Authenticated User
     *
     * @apiParam        {Number} user_id 用户id
     * @apiParam        {String-Array} roles_ids 角色id
     *
     */
    Route::post('assign', 'RoleController@assignUserToRole');

    /**
     * @apiGroup        RolePermission
     * @apiName         findRole
     * @api             {post} /v1/roles/{id} 查找角色
     * @apiDescription  根据ID查找角色
     *
     * @apiPermission   Authenticated User
     *
     * @apiParam        {Number} user_id 用户id
     * @apiParam        {String-Array} roles_ids 角色id
     *
     */
    Route::get('{id}', 'RoleController@findRole');

    /**
     * @apiGroup        RolePermission
     * @apiName         deleteRole
     * @api             {post} /v1/delete/{id} 删除角色
     * @apiDescription  根据id删除角色
     *
     * @apiPermission   Authenticated User
     *
     */
    Route::delete('{id}', 'RoleController@deleteRole');

    /**
     * @apiGroup        RolePermission
     * @apiName         deleteRole
     * @api             {post} /v1/roles/sync 同步用户的角色
     * @apiDescription  同步用户的角色
     *
     * @apiPermission   Authenticated User
     *
     * @apiParam        {Number} user_id 用户id
     * @apiParam        {String-Array} roles_ids 角色id
     *
     */
    Route::post('sync', 'RoleController@syncUserRoles');

});

Route::group(['prefix' => 'permissions', 'middleware' => 'auth:api'], function () {

    /**
     * @apiGroup        RolePermission
     * @apiName         getAllPermissions
     * @api             {post} /v1/permissions 获取所有权限
     * @apiDescription  获取所有权限
     *
     * @apiPermission   Authenticated User
     *
     *
     */
    Route::get('/', 'PermissionController@getAllPermissions');

    /**
     * @apiGroup        RolePermission
     * @apiName         findPermission
     * @api             {post} /v1/permissions/{id} 查找权限
     * @apiDescription  根据ID查找权限
     *
     * @apiPermission   Authenticated User
     *
     *
     */
    Route::get('{id}', 'PermissionController@findPermission');

    /**
     * @apiGroup        RolePermission
     * @apiName         attachPermissionToRole
     * @api             {post} /v1/permissions/attach 给角色分配权限
     * @apiDescription  为角色分配新的权限
     *
     * @apiPermission   Authenticated User
     *
     * @apiParam        {Number} role_id 角色id
     * @apiParam        {String-Array} permissions_ids 权限id
     *
     */
    Route::post('attach', 'PermissionController@attachPermissionToRole');

    /**
     * @apiGroup        RolePermission
     * @apiName         detachPermissionToRole
     * @api             {post} /v1/permissions/detach 移除角色中的权限
     * @apiDescription  移除角色中的权限
     *
     * @apiPermission   Authenticated User
     *
     * @apiParam        {Number} role_id 角色id
     * @apiParam        {String-Array} permissions_ids 权限id
     *
     */
    Route::post('detach', 'PermissionController@detachPermissionToRole');

    /**
     * @apiGroup        RolePermission
     * @apiName         syncPermissionOnRole
     * @api             {post} /v1/permissions/sync 同步角色的权限
     * @apiDescription  同步角色的权限
     *
     * @apiPermission   Authenticated User
     *
     * @apiParam        {Number} role_id 角色id
     * @apiParam        {String-Array} permissions_ids 权限id
     *
     */
    Route::post('sync', 'PermissionController@syncPermissionOnRole');

});