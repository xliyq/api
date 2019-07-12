<?php

Route::group(['prefix' => 'subjects'], function () {
    /**
     * @apiGroup             Subject
     * @apiName              createSubject
     * @api                 {post} api/v1/subjects 创建科目
     * @apiDescription       创建科目
     *
     * @apiParam            {String}  name 名称
     *
     */
    Route::post('', 'SubjectController@createSubject');


    /**
     * @apiGroup             Subject
     * @apiName              getAllSubjects
     * @api                 {get} api/v1/subjects 获取所有科目
     * @apiDescription       返回所有科目
     *
     */
    Route::get('', 'SubjectController@getAllSubjects');


    /**
     * @apiGroup             Subject
     * @apiName              deleteSubject
     * @api                 {delete} api/v1/subjects/{id} 删除科目
     * @apiDescription       删除科目
     *
     *
     */
    Route::delete('{id}', 'SubjectController@deleteSubject');

    /**
     * @apiGroup             Subject
     * @apiName              updateSubject
     * @api                 {patch} api/v1/subjects/{id} 更新科目
     * @apiDescription       根据id更新科目，只传递变化的数据
     *
     * @apiParam            {String}  name 名称
     *
     */
    Route::patch('{id}', 'SubjectController@updateSubject');

    /**
     * @apiGroup             Subject
     * @apiName              findSubjectById
     * @api                 {get} api/v1/subjects/{id} 查找科目
     * @apiDescription       根据ID查找科目
     *
     *
     */
    Route::get('{id}', 'SubjectController@findSubjectById');

});