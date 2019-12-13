<?php

return [
    'defaults' => [
        'specify-queue' => true, // Should the --queue parameter be used?
        'timeout' => 60, // The timeout for the worker process.
        'sleep' => 10, // The sleep time when there are no jobs.
        'tries' => 3, // The maximum number of tries
    ],

    'queues' => [
        'default' => 1,
        // 'another' => [
        //     'amount' => 1, // The number of processes you want to run.
        //     'connection' => 'second-connection', // Optional: the connection you'd like to use.
        //     // Override any of the default queue:workerk options here.
        // ],
    ],

    // Should we schedule the ensurer command to run every minute?
    'schedule' => true,
];