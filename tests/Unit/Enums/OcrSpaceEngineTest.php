<?php

it('can parse a engine type 1', function (): void {
    $engine = \Codesmiths\LaravelOcrSpace\Enums\OcrSpaceEngine::from('1');

    expect($engine)->toBe(\Codesmiths\LaravelOcrSpace\Enums\OcrSpaceEngine::Engine1);
});

it('can parse a engine type 2', function (): void {
    $engine = \Codesmiths\LaravelOcrSpace\Enums\OcrSpaceEngine::from('2');

    expect($engine)->toBe(\Codesmiths\LaravelOcrSpace\Enums\OcrSpaceEngine::Engine2);
});

it('can parse an engine type 3', function (): void {
    $engine = \Codesmiths\LaravelOcrSpace\Enums\OcrSpaceEngine::from('3');

    expect($engine)->toBe(\Codesmiths\LaravelOcrSpace\Enums\OcrSpaceEngine::Engine3);
});
