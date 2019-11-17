<?php

namespace TestCase;

return [
    'TestCase' => [
        'entityClass' => Entity\TestCase::class,
        'collectionClass' => Entity\TestCaseCollection::class,
        'table' => 'tr_tests',
        'primaryKey' => 'id',
        'columnsAsAttributesMap' => [
            'id' => 'id',
            'section_id' => 'sectionId',
            'case_id' => 'caseId',
            'site_id' => 'siteId',
            'title' => 'title',
            'status' => 'status',
            'preconditions' => 'preconditions',
            'steps' => 'steps',
            'result' => 'result',
            'created' => 'created',
            'updated' => 'updated',
            'automated_class' => 'automatedClass',
        ],
        'criteriaMap' => [
            'id' => 'id_equalTo',
        ],
    ],
    'Section' => [
        'entityClass' => Entity\Section::class,
        'table' => 'tr_sections',
        'primaryKey' => 'id',
        'columnsAsAttributesMap' => [
            'id' => 'id',
            'name' => 'name',
            'parent_id' => 'parentId',
        ],
        'criteriaMap' => [
            'id' => 'id_equalTo',
        ],
    ],
    'TestCaseDiff' => [
        'entityClass' => Entity\TestCaseDiff::class,
        'table' => 'tr_tests_diff',
        'primaryKey' => 'id',
        'columnsAsAttributesMap' => [
            'id' => 'id',
            'branch' => 'branch',
            'created' => 'created',
            'updated' => 'updated',
            'existing_classes' => 'existingClasses',
        ],
        'criteriaMap' => [
            'id' => 'id_equalTo',
        ],
    ],
];