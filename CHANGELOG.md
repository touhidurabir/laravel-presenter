# Changelog
All notable changes to this project will be documented in this file.

## [Unreleased]


## [1.0.0] - 2021-10-19
- Initial Release

## [1.0.1] - 2021-11-17
- Bug Fix.
- Test update.
- README update.

## [1.1.0] - 2026-10-28
- Laravel 11, 12 and 13 support added.
- PHPUnit 10, 11 and 12 support for tests; test methods now use `#[Test]` attributes alongside the `@test` annotations.
- Fixed PHP 8.4 implicit nullable parameter deprecations in `HasPresenter::initPresentable` and `CommandExceptionHandler::outputConsoleException`.
- Fixed `HasPresenter::setPresenter` referencing an undefined `$model` variable; it now throws the intended `PresenterException` for a missing presenter class.
- Fixed `BasePresenter::__get` calling `PresenterException::PresentableMethodNotDefine()` without its required arguments; it now throws the intended `PresenterException`.
- Code style formatted to PSR-12 with Laravel Pint (`composer format` / `composer lint`).
- Replaced Travis CI with GitHub Actions (PHP 8.1 × Laravel 8/9/10 and PHP 8.2–8.4 × Laravel 11/12/13, plus a code style check).
- Added the `presenter.class_name_suffix` config key, replacing the misnamed `class_name_prefix` (the value was always appended as a suffix). A published config that still has `class_name_prefix` keeps working: it is used unless `class_name_suffix` is set to something other than its default `Presenter`. Rename the key in your published config.
- Calling an undefined presentable method (`$model->present()->undefinedMethod()`) now throws a `PresenterException`, like accessing an undefined presentable property already did. **Behaviour change:** it used to raise a PHP `Error` ("Call to undefined method"); code that caught `Error` for this must catch `PresenterException` instead.
- Declared the `illuminate/console`, `illuminate/container`, `illuminate/database` and `illuminate/support` dependencies the package uses (`^8.0` to `^13.0`); they were only pulled in indirectly.
- `make:presenter` now returns an explicit exit code (`Command::SUCCESS` / `Command::FAILURE`) from `handle()` instead of `null` on success. The process exit code is unchanged.
