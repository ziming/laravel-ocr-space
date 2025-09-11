<?php

namespace Codesmiths\LaravelOcrSpace\ValueObjects;

class ParsedResult
{
    public function __construct(
        private readonly ?TextOverlay $textOverlay,
        private readonly string $fileParseExitCode,
        private readonly string $parsedText,
        private readonly ?string $errorMessage,
        private readonly ?string $errorDetails,
    ) {}

    /**
     * @param array{
     *      TextOverlay?: array{
     *          Lines: array<int, array{
     *              Words: array<int, array{
     *                  WordText: string,
     *                  Left: int,
     *                  Top: int,
     *                  Height: int,
     *                  Width: int
     *              }>,
     *              MaxHeight: int,
     *              MinTop: int,
     *          }>,
     *          HasOverlay: bool,
     *          Message: string|null,
     *      }|null,
     *      FileParseExitCode: string,
     *      ParsedText: string,
     *      ErrorMessage: string|null,
     *      ErrorDetails: string|null,
     * } $data The response data
     */
    public static function fromResponse(array $data): self
    {
        $textOverlay = null;

        if (isset($data['TextOverlay']) && $data['TextOverlay'] !== null) {
            $lines = collect($data['TextOverlay']['Lines'])
                ->map(fn (array $line): Line => Line::fromResponse($line));

            $textOverlay = new TextOverlay(
                $lines,
                $data['TextOverlay']['HasOverlay'],
                $data['TextOverlay']['Message'] ?? null
            );
        }

        return new self(
            $textOverlay,
            $data['FileParseExitCode'],
            $data['ParsedText'],
            $data['ErrorMessage'],
            $data['ErrorDetails'],
        );
    }

    public function getTextOverlay(): ?TextOverlay
    {
        return $this->textOverlay;
    }

    public function getFileParseExitCode(): string
    {
        return $this->fileParseExitCode;
    }

    public function getParsedText(): string
    {
        return $this->parsedText;
    }

    public function getErrorMessage(): ?string
    {
        return $this->errorMessage;
    }

    public function getErrorDetails(): ?string
    {
        return $this->errorDetails;
    }

    public function getSerializedParsedText(): string
    {
        return str_replace(["\r\n", "\r", "\n"], '', $this->parsedText);
    }
}
