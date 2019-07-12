<?php

Route::group(['prefix' => 'knowledge'], function () {
    /**
     * @apiGroup             Knowledge
     * @apiName              createKnowledge
     * @api                 {post} api/v1/knowledge 创建知识点
     * @apiDescription       创建知识点
     *
     * @apiParam            {String}  name 名称
     * @apiParam            {Integer} subject_id 科目id
     * @apiParam            {Integer} [pid]  父级id,默认0
     * @apiParam            {Integer} [sort] 排序，默认50
     *
     */
    Route::post('', 'KnowledgeController@createKnowledge');


    /**
     * @apiGroup             Knowledge
     * @apiName              getAllKnowledge
     * @api                 {get} api/v1/knowledge 获取所有知识点
     * @apiDescription       根据科目ID返回所有知识点(树型结构)
     *
     * @apiParam            {Integer}  subject_id 知识点id
     *
     */
    Route::get('', 'KnowledgeController@getAllKnowledge');


    /**
     * @apiGroup             Knowledge
     * @apiName              deleteKnowledge
     * @api                 {delete} api/v1/knowledge/{id} 删除知识点
     * @apiDescription       删除知识点
     *
     *
     */
    Route::delete('{id}', 'KnowledgeController@deleteKnowledge');

    /**
     * @apiGroup             Knowledge
     * @apiName              updateKnowledge
     * @api                 {patch} api/v1/knowledge/{id} 更新知识点
     * @apiDescription       根据id更新知识点，只传递变化的数据
     *
     * @apiParam            {String}  name 名称
     * @apiParam            {Integer}  [sort] 排序
     *
     */
    Route::patch('{id}', 'KnowledgeController@updateKnowledge');

    /**
     * @apiGroup             Knowledge
     * @apiName              findKnowledgeById
     * @api                 {get} api/v1/knowledge/{id} 查找知识点
     * @apiDescription       根据ID查找知识点，可用include有`children`,`subject`
     *
     * @apiParam            {String}  key
     *
     */
    Route::get('{id}', 'KnowledgeController@findKnowledgeById');

});