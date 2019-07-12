<?php

Route::group(['prefix' => 'grades'], function () {
    /**
     * @apiGroup             Grades
     * @apiName              getAllGrades
     * @api                 {get} api/v1/grades 获取所有年级
     * @apiDescription        获取所有年级
     *
     *
     */
    Route::get('/', 'GradeController@getAllGrades');

    /**
     * @apiGroup             Grades
     * @apiName              createGrade
     * @api                 {post} api/v1/grades 创建年级
     * @apiDescription       创建年级
     *
     * @apiParam            {String}  name 名称
     *
     */
    Route::post('/', 'GradeController@createGrade');

    /**
     * @apiGroup             Grades
     * @apiName              updateGrade
     * @api                 {patch} api/v1/grades/{id}  更新年级
     * @apiDescription       更新年级
     *
     * @apiParam            {String}  name 名称
     *
     */
    Route::patch('/{id}', 'GradeController@updateGrade');

    /**
     * @apiGroup             Grades
     * @apiName              deleteGrade
     * @api                 {delete} api/v1/grades/{id} 删除年级
     * @apiDescription       删除年级
     *
     *
     */
    Route::delete('/{id}', 'GradeController@deleteGrade');

    /**
     * @apiGroup             Grades
     * @apiName              findGradeById
     * @api                 {get} api/v1/grades/{id} 年级详情
     * @apiDescription       根据id获取年级信息
     *
     *
     */
    Route::get('/{id}', 'GradeController@findGradeById');
});