# Routenote Tech Test - Spotify API
## Required Assets
Both PHP and VueJS dependencies are required for the project to run. Both of the following statements need to be ran on the root of the project:
```
yarn install
composer install
```
## Executing the project
To execute the project on my local machine I ran the `yarn serve` command from the project directory

I then had a second command window where I ran `php -t ./ -S 0.0.0.0:8000` from the public directory
## Resources Used
I used the following resources:
- NPM
- NodeJS
- VueJS
- PHP
- Axios
- Flight ([Found here](http://flightphp.com/))
- spotify-web-api-php ([Found here](https://github.com/jwilsson/spotify-web-api-php) )
- vue-select ([Found here](https://vue-select.org/))
## Future Improvements
The Frontend still requires further styling, due to how much time I could put into the project. The vue-select styling can be improved and the artist details could be presented in a cleaner way. With more time something the top tracks slider could be more eye-catching.

In the future I think I would try to build the project in Laravel and VueJS, as I found the Flight Routing tricky to understand at times. Laravel looks to be a much better solution.

I would also implement a better token system where it is only updated when necessary, rather than on every request. At Intouch I achieved this by storing the access and refresh tokens on a database table for each scope.
