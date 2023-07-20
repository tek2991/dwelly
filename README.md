## About Dwelly

This is the repository for dwelly.in, it is build on Laravel 9.

### PHP ini settings
upload_max_filesize = 130M
post_max_size = 130M


### Flush and import Scout(meilisearch) index
php artisan scout:flush "App\Models\Property"
php artisan scout:import "App\Models\Property"

