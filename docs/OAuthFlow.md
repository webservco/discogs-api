# OAuth Flow

https://www.discogs.com/developers/#page:authentication,header:authentication-oauth-flow

---

## Step 1
Obtain `Consumer Key` and `Consumer Secret`.

---

## Step 2

`GET` `https://api.discogs.com/oauth/request_token`

Send
```
Content-Type: application/x-www-form-urlencoded
Authorization:
        OAuth oauth_consumer_key="your_consumer_key",
        oauth_nonce="qwerty",
        oauth_signature="your_consumer_secret&",
        oauth_signature_method="PLAINTEXT",
        oauth_timestamp="current_timestamp",
        oauth_callback="your_callback"
User-Agent: some_user_agent
```
Receive
```
oauth_token
oauth_token_secret
oauth_callback_confirmed
```

> Example project: `Oauth/requestToken`
>
> Note `oauth_token` and `oauth_token_secret`, add to Discogs configuration array, `api/oauth/flow`.

---

## Step 3

Redirect user to authorization page

```
https://discogs.com/oauth/authorize?oauth_token=<your_oauth_request_token>
```
Redirects to `oauth_callback` (`GET`).

> Example project: `Oauth/redirect`
>
> After authorization, you will be redirected to the callback url: `Oauth/callback`.

### Authorized
Receive: `oauth_token` (from step 2), `oauth_verifier`.

> Note: `oauth_verifier`, add to Discogs configuration array, `api/oauth/flow`.

### Denied
Receive: `denied` (oauth token from step 2)

---

## Step 4

`POST` `https://api.discogs.com/oauth/access_token`

Send
```
Content-Type: application/x-www-form-urlencoded
Authorization:
        OAuth oauth_consumer_key="your_consumer_key",
        oauth_nonce="random_string_or_timestamp",
        oauth_token="oauth_token_received_from_step_2"
        oauth_signature="your_consumer_secret&",
        oauth_signature_method="PLAINTEXT",
        oauth_timestamp="current_timestamp",
        oauth_verifier="users_verifier"
User-Agent: some_user_agent
```
Receive
```
oauth_token
oauth_token_secret
```

> Example project: `Oauth/accessToken`
>
> Note `oauth_token` and `oauth_token_secret`, add to Discogs configuration array, `api/oauth/access`.

---

## Step 5

`GET` `https://api.discogs.com/oauth/identity`

Verify.

> Example project: `Oauth/identity`
