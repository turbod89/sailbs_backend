<a name="top"></a>
# Sail BS v0.1.0

Backend API for Sailbs

- [Authorization](#authorization)
	- [User Login](#user-login)
	- [User Logout](#user-logout)
	- [User Signup](#user-signup)
	
- [Token](#token)
	- [Get session token](#get-session-token)
	


# <a name='authorization'></a> Authorization

## <a name='user-login'></a> User Login
[Back to top](#top)



	POST /auth





### Parameter Parameters

| Name     | Type       | Description                           |
|:---------|:-----------|:--------------------------------------|
|  username | String | <p>Username.</p>|
|  password | String | <p>User's password.</p>|



### Success 200

| Name     | Type       | Description                           |
|:---------|:-----------|:--------------------------------------|
|  errors | Array | <p>An array with errors.</p>|

## <a name='user-logout'></a> User Logout
[Back to top](#top)



	DELETE /auth






### Success 200

| Name     | Type       | Description                           |
|:---------|:-----------|:--------------------------------------|
|  errors | Array | <p>An array with errors.</p>|

## <a name='user-signup'></a> User Signup
[Back to top](#top)



	POST /auth/signup





### Parameter Parameters

| Name     | Type       | Description                           |
|:---------|:-----------|:--------------------------------------|
|  username | String | <p>Username.</p>|
|  password | String | <p>User's password.</p>|
|  email | String | <p>User's email.</p>|



### Success 200

| Name     | Type       | Description                           |
|:---------|:-----------|:--------------------------------------|
|  errors | Array | <p>An array with errors.</p>|

# <a name='token'></a> Token

## <a name='get-session-token'></a> Get session token
[Back to top](#top)



	GET /tokens






### Success 200

| Name     | Type       | Description                           |
|:---------|:-----------|:--------------------------------------|
|  errors | Array | <p>An array with errors.</p>|

