# Tableau Connect Changelog

## 1.0.0-beta.15 - 2019-10-23

## Fixed

- Replaced references to removed `canView` variable.

## 1.0.0-beta.14 - 2019-10-23

## Updated

- Changed `canView` to `token` and now outputs token value if true. Still outputs `false` if the handled exception is an HTTP 401 error.

## 1.0.0-beta.13 - 2018-11-20

## Fixed

- Prevent encoding of URL parts in visualization URL.

## 1.0.0-beta.12 - 2018-10-23

## Fixed

- Make `requiresAuthorization` optional.

## 1.0.0-beta.11 - 2018-10-23

## Added

- Add per-view `requiresAuthorization` override to `renderVisualization`.

## Updated

- `canView` returns `false` if the handled exception is an HTTP 401 error.

## 1.0.0-beta.10 - 2018-10-17

### Updated

- Renamed `prefix` to `key`.

### Fixed

- Moved unique key to end of element classname.

## 1.0.0-beta.9 - 2018-10-16

### Fixed

- Fixed an issue caused when the unique code prepended to the JS initialization function started with a number.

## 1.0.0-beta.8 - 2018-10-15

### Fixed

- Pass through headers and form data in the GuzzleHttp client `post` call.

## 1.0.0-beta.7 - 2018-10-15

### Fixed

- Include `"Content-Type"` header in Tableau authorization requests.

## 1.0.0-beta.6 - 2018-10-15

### Added

- Added the `craft.tableauconnect.canView` variable so authentication issues can be handled by the template.

## 1.0.0-beta.5 - 2018-10-12

### Updated

- `client_ip` is now optional and not passed through to Tableau by default.

## 1.0.0-beta.4 - 2018-10-12

### Fixed

- Use correct view in the visualization template.

## 1.0.0-beta.3 - 2018-10-09

### Added

- Implemented Tableau trusted authentication.

## 1.0.0-beta.2 - 2018-10-07

### Updated

- Include visualization container in custom JavaScript callback.

## 1.0.0-beta.1 - 2018-09-27

### Added

- Initial release.
