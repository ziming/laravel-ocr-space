<?php

use Codesmiths\LaravelOcrSpace\Enums\Language;
use Codesmiths\LaravelOcrSpace\Enums\OcrSpaceEngine;

it('can be tranformed to array', function (): void {

    $options = new \Codesmiths\LaravelOcrSpace\OcrSpaceOptions(
        overlayRequired: true,
        fileType: 'image/png',
        isTable: true,
        OCREngine: OcrSpaceEngine::Engine1,
        scale: true,
        isSearchablePdfHideTextLayer: true,
        isCreateSearchablePdf: true,
        detectOrientation: true,
        language: Language::English,
    );

    expect($options->toArray())->toBe([
        [
            'name' => 'language',
            'contents' => 'eng',
        ],
        [
            'name' => 'isOverlayRequired',
            'contents' => 'true',
        ],
        [
            'name' => 'filetype',
            'contents' => 'image/png',
        ],
        [
            'name' => 'detectOrientation',
            'contents' => 'true',
        ],
        [
            'name' => 'isCreateSearchablePdf',
            'contents' => 'true',
        ],
        [
            'name' => 'isSearchablePdfHideTextLayer',
            'contents' => 'true',
        ],
        [
            'name' => 'scale',
            'contents' => 'true',
        ],
        [
            'name' => 'isTable',
            'contents' => 'true',
        ],
        [
            'name' => 'OCREngine',
            'contents' => '1',
        ],
    ]);
});

it('can be tranformed to array with null values', function (): void {
    $options = new \Codesmiths\LaravelOcrSpace\OcrSpaceOptions;

    expect($options->toArray())->toBe([
        [
            'name' => 'isOverlayRequired',
            'contents' => 'false',
        ],
        [
            'name' => 'detectOrientation',
            'contents' => 'false',
        ],
        [
            'name' => 'isCreateSearchablePdf',
            'contents' => 'false',
        ],
        [
            'name' => 'isSearchablePdfHideTextLayer',
            'contents' => 'false',
        ],
        [
            'name' => 'scale',
            'contents' => 'false',
        ],
        [
            'name' => 'isTable',
            'contents' => 'false',
        ],
    ]);
});

it('can set options', function (): void {
    $options = \Codesmiths\LaravelOcrSpace\OcrSpaceOptions::make()
        ->language(Language::English)
        ->overlayRequired(true)
        ->fileType('image/png')
        ->detectOrientation(true)
        ->isCreateSearchablePdf(true)
        ->isSearchablePdfHideTextLayer(true)
        ->scale(true)
        ->isTable(true)
        ->OCREngine(OcrSpaceEngine::Engine1);

    expect($options->toArray())->toBe([
        [
            'name' => 'language',
            'contents' => 'eng',
        ],
        [
            'name' => 'isOverlayRequired',
            'contents' => 'true',
        ],
        [
            'name' => 'filetype',
            'contents' => 'image/png',
        ],
        [
            'name' => 'detectOrientation',
            'contents' => 'true',
        ],
        [
            'name' => 'isCreateSearchablePdf',
            'contents' => 'true',
        ],
        [
            'name' => 'isSearchablePdfHideTextLayer',
            'contents' => 'true',
        ],
        [
            'name' => 'scale',
            'contents' => 'true',
        ],
        [
            'name' => 'isTable',
            'contents' => 'true',
        ],
        [
            'name' => 'OCREngine',
            'contents' => '1',
        ],
    ]);
});
