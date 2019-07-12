<?php

Route::group(['prefix' => 'titles'], function () {
    /**
     * @apiGroup             Title
     * @apiName              createTitle
     * @api                 {post} api/v1/titles 创建试题
     * @apiDescription       创建试题
     *
     * @apiParam            {String}  content 题干
     * @apiParam            {String}  analysis 解析
     * @apiParam            {Array}   answers 标答
     * @apiParam            {Array}   [options] 选项
     * @apiParam            {Array}   knowledge 知识点ID
     * @apiParam            {Integer} subject_id 科目ID
     * @apiParam            {Integer} grade_id 年级ID
     * @apiParam            {Integer} title_id 题型ID
     *
     */
    Route::post('', 'TitleController@createTitle');


    /**
     * @apiGroup             Title
     * @apiName              getAllTitles
     * @api                 {get} api/v1/titles 获取所有试题
     * @apiDescription       获取所有试题
     *
     * @apiParam            {Integer} subject_id 科目ID
     * @apiParam            {Integer} [type_id] 题型ID
     * @apiParam            {Integer} [grade_id] 年级ID
     * @apiParam            {Integer} [knowledge_id] 知识点ID
     *
     */
    Route::get('', 'TitleController@getAllTitles');


    /**
     * @apiGroup             Title
     * @apiName              deleteTitle
     * @api                 {delete} api/v1/titles/{id} 删除试题
     * @apiDescription       删除试题
     *
     *
     */
    Route::delete('{id}', 'TitleController@deleteTitle');

    /**
     * @apiGroup             Title
     * @apiName              updateTitle
     * @api                 {patch} api/v1/titles/{id} 更新题型
     * @apiDescription       根据id更新题型，只传递变化的数据
     *
     * @apiParam            {String}  [content] 题干
     * @apiParam            {String}  [analysis] 解析
     * @apiParam            {Array}   [answers] 标答
     * @apiParam            {Array}   [options] 选项
     * @apiParam            {Array}   [knowledge] 知识点ID
     * @apiParam            {Integer} [subject_id] 科目ID
     * @apiParam            {Integer} [grade_id] 年级ID
     * @apiParam            {Integer} [title_id] 题型ID
     *
     */
    Route::patch('{id}', 'TitleController@updateTitle');

    /**
     * @apiGroup             Title
     * @apiName              findTitleById
     * @api                 {get} api/v1/titles/{id} 查找试题
     * @apiDescription       根据ID查找试题
     *
     *
     */
    Route::get('{id}', 'TitleController@findTitleById');

});