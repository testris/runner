<?php

namespace TestRun;

use TestRun\Entity\TestRunOutput;

return [
    'TestRun' => [
        'entityClass' => Entity\TestRun::class,
        'table' => 'tr_runs',
        'primaryKey' => 'id',
        'columnsAsAttributesMap' => [
            'id' => 'id',
            'title' => 'title',
            'environment' => 'environment',
            'branch' => 'branch',
            'host' => 'host',
            'created' => 'created',
            'run_by' => 'runBy',
            'updated' => 'updated',
            'started' => 'started',
            'status' => 'status',
            'jenkins_build_id' => 'jenkinsBuildId',
            'jenkins_output' => 'jenkinsOutput',
            'ended' => 'ended',
        ],
        'criteriaMap' => [
            'id' => 'id_equalTo',
        ],
    ],
    'TestRunOutput' => [
        'entityClass' => TestRunOutput::class,
        'table' => 'tr_runs_output',
        'primaryKey' => 'id',
        'columnsAsAttributesMap' => [
            'id' => 'id',
            'run_id' => 'runId',
            'ip' => 'ip',
            'tests_output' => 'testsOutput',
        ],
        'criteriaMap' => [
            'id' => 'id_equalTo',
        ],
    ],
    'ApiLog' => [
        'entityClass' => Entity\ApiLog::class,
        'table' => 'tr_runs_api_log',
        'primaryKey' => 'id',
        'columnsAsAttributesMap' => [
            'id' => 'id',
            'run_id' => 'runId',
            'uri' => 'uri',
            'request' => 'request',
            'response' => 'response',
            'created' => 'created',
        ],
        'criteriaMap' => [
            'id' => 'id_equalTo',
        ],
    ],
];