# Changelog

All notable changes to `laravel-ocr-space` will be documented in this file.

## [Unreleased]

### Changed
- Updated PHP requirement from ^8.3 to ^8.2 for broader compatibility

### Fixed
- Fixed "Undefined array key 'TextOverlay'" error in `ParsedResult::fromResponse()` when OCR API response doesn't include the TextOverlay field
- Updated PHPDoc type annotations to reflect that TextOverlay field is optional in response data