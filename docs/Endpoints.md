# Discogs API Endpoints

---

## Authentication

https://www.discogs.com/developers/#page:authentication

| Endpoint               | Method | Notes                                                    | Implementation                                 |
|------------------------|--------|----------------------------------------------------------|------------------------------------------------|
| `/oauth/request_token` | `GET`  | Generate the request token                               | `\WebServCo\DiscogsApi\Api\OAuth\RequestToken` |
| `/oauth/access_token`  | `POST` | Generate the access token                                | `\WebServCo\DiscogsApi\Api\OAuth\AccessToken`  |
| `/oauth/identity`      | `GET`  | Retrieve basic information about the authenticated user. | `\WebServCo\DiscogsApi\Api\OAuth\Identity`     |

---

### User Identity

https://www.discogs.com/developers/#page:user-identity

| Endpoint               | Method | Notes                                                    | Implementation                                    |
|------------------------|--------|----------------------------------------------------------|---------------------------------------------------|
| `/users/{username}`    | `GET`  | Retrieve a user by username.                             | `\WebServCo\DiscogsApi\Api\User\Identity\Profile` |

---

### User Collection

https://www.discogs.com/developers/#page:user-collection

#### Fields

https://www.discogs.com/developers/#page:user-collection,header:user-collection-list-custom-fields

| Endpoint                              | Method | Notes                                                    | Implementation                                     |
|---------------------------------------|--------|----------------------------------------------------------|----------------------------------------------------|
| `/users/{username}/collection/fields` | `GET`  | Retrieve a list of user-defined collection notes fields. | `\WebServCo\DiscogsApi\Api\User\Collection\Fields` |


#### Value

https://www.discogs.com/developers/#page:user-collection,header:user-collection-collection-value

| Endpoint                             | Method | Notes                                                       | Implementation                                    |
|--------------------------------------|--------|-------------------------------------------------------------|---------------------------------------------------|
| `/users/{username}/collection/value` | `GET`  | Returns the min, med, and max value of a user’s collection. | `\WebServCo\DiscogsApi\Api\User\Collection\Value` |

---
