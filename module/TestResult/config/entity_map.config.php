<?php

namespace TestResult;

return [
    'TestResult' => [
        'entityClass' => Entity\TestResult::class,
        'collectionClass' => Entity\TestResultCollection::class,
        'table' => 'tr_results',
        'primaryKey' => 'id',
        'columnsAsAttributesMap' => [
            'id' => 'id',
            'run_id' => 'runId',
            'case_id' => 'caseId',
            'status' => 'status',
            'fail_message' => 'failMessage',
            'elapsed' => 'elapsed',
            'screen_url' => 'screenUrl',
            'started' => 'started',
        ],
        'criteriaMap' => [
            'id' => 'id_equalTo',
        ],
    ],
    'TestResultStep' => [
        'entityClass' => Entity\TestResultStep::class,
        'table' => 'tr_results_steps',
        'primaryKey' => 'id',
        'columnsAsAttributesMap' => [
            'id' => 'id',
            'run_id' => 'runId',
            'case_id' => 'caseId',
            'result_id' => 'resultId',
            'action_text' => 'actionText',
            'status' => 'status',
            'is_meta_step' => 'isMetaStep',
            'meta_step_id' => 'metaStepId',
            'artifacts' => 'artifacts',
            'elapsed' => 'elapsed',
        ],
        'criteriaMap' => [
            'id' => 'id_equalTo',
        ],
    ],
    'TestResultHistory' => [
        'entityClass' => Entity\TestResultHistory::class,
        'table' => 'tr_results_history',
        'primaryKey' => 'id',
        'columnsAsAttributesMap' => [
            'id' => 'id',
            'result_id' => 'resultId',
            'run_id' => 'runId',
            'case_id' => 'caseId',
            'status' => 'status',
            'executed' => 'executed',
        ],
        'criteriaMap' => [
            'id' => 'id_equalTo',
        ],
    ],
];