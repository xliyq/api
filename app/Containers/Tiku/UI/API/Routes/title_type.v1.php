<?php

Route::group(['prefix' => 'title_types'], function () {
    /**
     * @apiGroup             TitleType
     * @apiName              createTitleType
     * @api                 {post} api/v1/title_types 创建题型
     * @apiDescription       创建题型
     *
     * @apiParam            {String}  name 名称
     * @apiParam            {Integer} subject_id 科目ID
     *
     */
    Route::post('', 'TitleTypeController@createTitleType');


    /**
     * @apiGroup             TitleType
     * @apiName              getAllTitleTypes
     * @api                 {get} api/v1/title_types 获取科目下所有题型
     * @apiDescription       获取科目下所有题型
     *
     * @apiParam            {Integer} subject_id 科目ID
     *
     */
    Route::get('', 'TitleTypeController@getAllTitleTypes');


    /**
     * @apiGroup             TitleType
     * @apiName              deleteTitleType
     * @api                 {delete} api/v1/title_types/{id} 删除题型
     * @apiDescription       删除题型
     *
     *
     */
    Route::delete('{id}', 'TitleTypeController@deleteTitleType');

    /**
     * @apiGroup             TitleType
     * @apiName              updateTitleType
     * @api                 {patch} api/v1/title_types/{id} 更新题型
     * @apiDescription       根据id更新题型，只传递变化的数据
     *
     * @apiParam            {String}  name 名称
     *
     */
    Route::patch('{id}', 'TitleTypeController@updateTitleType');

    /**
     * @apiGroup             TitleType
     * @apiName              findTitleTypeById
     * @api                 {get} api/v1/title_types/{id} 查找题型
     * @apiDescription       根据ID查找题型
     *
     *
     */
    Route::get('{id}', 'TitleTypeController@findTitleTypeById');

});