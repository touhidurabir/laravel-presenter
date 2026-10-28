# Changelog
All notable changes to this project will be documented in this file.

## [Unreleased]
- Laravel 11, 12 and 13 support added.
- PHPUnit 10, 11 and 12 support for tests; test methods now use `#[Test]` attributes alongside the `@test` annotations.
- Fixed PHP 8.4 implicit nullable parameter deprecations in `HasPresenter::initPresentable` and `CommandExceptionHandler::outputConsoleException`.
- Fixed `HasPresenter::setPresenter` referencing an undefined `$model` variable; it now throws the intended `PresenterException` for a missing presenter class.
- Fixed `BasePresenter::__get` calling `PresenterException::PresentableMethodNotDefine()` without its required arguments; it now throws the intended `PresenterException`.


## [1.0.0] - 2021-10-19
- Initial Release

## [1.0.1] - 2021-11-17
- Bug Fix.
- Test update.
- README update.
