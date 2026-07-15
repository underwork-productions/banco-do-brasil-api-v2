# Changelog
All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](http://keepachangelog.com/)
and this project adheres to [Semantic Versioning](http://semver.org/).

## [Unreleased]
### Added
- Support for passing an OAuth `scope` when authenticating, via the new
  `scope` parameter on `Configuration`.

### Fixed
- `NullConfiguration` now accepts `cert`, `verify` and `sslKey`, matching the
  `BBConfiguration` contract.

## [0.0.6] - 2025-01-01
### Added
- First version
