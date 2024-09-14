<?php

/**
 * Returns the importmap for this application.
 *
 * - "path" is a path inside the asset mapper system. Use the
 *     "debug:asset-map" command to see the full list of paths.
 *
 * - "entrypoint" (JavaScript only) set to true for any module that will
 *     be used as an "entrypoint" (and passed to the importmap() Twig function).
 *
 * The "importmap:require" command can be used to add new entries to this file.
 */
return [
    'app' => [
        'path' => './assets/app.js',
        'entrypoint' => true,
    ],
    '@symfony/stimulus-bundle' => [
        'path' => './vendor/symfony/stimulus-bundle/assets/dist/loader.js',
    ],
    '@hotwired/stimulus' => [
        'version' => '3.2.2',
    ],
    '@hotwired/turbo' => [
        'version' => '8.0.4',
    ],
    'marked' => [
        'version' => '12.0.2',
    ],
    'motion' => [
        'version' => '10.17.0',
    ],
    '@motionone/dom' => [
        'version' => '10.17.0',
    ],
    '@motionone/types' => [
        'version' => '10.17.0',
    ],
    '@motionone/utils' => [
        'version' => '10.17.0',
    ],
    '@motionone/animation' => [
        'version' => '10.17.0',
    ],
    'hey-listen' => [
        'version' => '1.0.8',
    ],
    'tslib' => [
        'version' => '2.6.2',
    ],
    '@motionone/generators' => [
        'version' => '10.17.0',
    ],
    '@motionone/easing' => [
        'version' => '10.17.0',
    ],
    'morphdom' => [
        'version' => '2.7.2',
    ],
    'intl-messageformat' => [
        'version' => '10.5.14',
    ],
    '@formatjs/icu-messageformat-parser' => [
        'version' => '2.7.8',
    ],
    '@formatjs/fast-memoize' => [
        'version' => '2.2.0',
    ],
    '@formatjs/icu-skeleton-parser' => [
        'version' => '1.8.2',
    ],
    '@symfony/ux-translator' => [
        'path' => './vendor/symfony/ux-translator/assets/dist/translator_controller.js',
    ],
    '@app/translations' => [
        'path' => './var/translations/index.js',
    ],
    '@app/translations/configuration' => [
        'path' => './var/translations/configuration.js',
    ],
    '@symfony/ux-live-component' => [
        'path' => './vendor/symfony/ux-live-component/assets/dist/live_controller.js',
    ],
];
