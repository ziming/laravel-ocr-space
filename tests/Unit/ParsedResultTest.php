<?php

use Codesmiths\LaravelOcrSpace\ValueObjects\ParsedResult;

it('handles missing TextOverlay key in response data', function (): void {
    $responseDataWithoutTextOverlay = [
        'FileParseExitCode' => '1',
        'ParsedText' => 'Sample extracted text from image',
        'ErrorMessage' => null,
        'ErrorDetails' => null,
    ];

    $result = ParsedResult::fromResponse($responseDataWithoutTextOverlay);

    expect($result)->toBeInstanceOf(ParsedResult::class)
        ->and($result->getParsedText())->toBe('Sample extracted text from image')
        ->and($result->getFileParseExitCode())->toBe('1')
        ->and($result->getTextOverlay())->toBeNull()
        ->and($result->getErrorMessage())->toBeNull()
        ->and($result->getErrorDetails())->toBeNull();
});

it('handles null TextOverlay in response data', function (): void {
    $responseDataWithNullTextOverlay = [
        'TextOverlay' => null,
        'FileParseExitCode' => '1',
        'ParsedText' => 'Sample extracted text from image',
        'ErrorMessage' => null,
        'ErrorDetails' => null,
    ];

    $result = ParsedResult::fromResponse($responseDataWithNullTextOverlay);

    expect($result)->toBeInstanceOf(ParsedResult::class)
        ->and($result->getParsedText())->toBe('Sample extracted text from image')
        ->and($result->getFileParseExitCode())->toBe('1')
        ->and($result->getTextOverlay())->toBeNull();
});

it('handles valid TextOverlay in response data', function (): void {
    $responseDataWithTextOverlay = [
        'TextOverlay' => [
            'Lines' => [
                [
                    'Words' => [
                        [
                            'WordText' => 'Hello',
                            'Left' => 10,
                            'Top' => 20,
                            'Height' => 15,
                            'Width' => 30,
                        ],
                    ],
                    'MaxHeight' => 15,
                    'MinTop' => 20,
                ],
            ],
            'HasOverlay' => true,
            'Message' => null,
        ],
        'FileParseExitCode' => '1',
        'ParsedText' => 'Hello',
        'ErrorMessage' => null,
        'ErrorDetails' => null,
    ];

    $result = ParsedResult::fromResponse($responseDataWithTextOverlay);

    expect($result)->toBeInstanceOf(ParsedResult::class)
        ->and($result->getParsedText())->toBe('Hello')
        ->and($result->getFileParseExitCode())->toBe('1')
        ->and($result->getTextOverlay())->not()->toBeNull()
        ->and($result->getTextOverlay()?->hasOverlay())->toBeTrue()
        ->and($result->getTextOverlay()?->getLines())->toHaveCount(1);
});
