# Settings

`WebServCo\DiscogsApi\Settings`

---

## `processResponse`

### `true`
Discogs API response is processed and data is returned as an array.
In case of an error, an `ApiException` is thrown.

### `false`

No error or data processing is being done. Discogs API response is returned as it is, using a `\WebServCo\Framework\Http\Response` object.

---

## userAgent

https://www.discogs.com/developers/#page:home,header:home-general-information
