@servers(['web' => '45.55.35.18'])



@task('deployfirst', ['on' => 'web'])
    composer self-update
    cd /var/www/html
    ls -la
    git clone https://github.com/Symfomany/laravelcinema.git
    cd laravelcinema
    composer install -n --no-dev --no-scripts
    mkdir storage
    sudo chown -R www-data:www-data /var/www/html/laracinema
    mkdir storage/framework storage/app storage/logs storage/framework/sessions storage/framework/views
    chmod 777 -R *
    php artisan cache:clear
    ls -la
    echo "Fin de transmission..."
@endtask


@task('deploy', ['on' => 'web'])
    cd /var/www/html/laravelcinema
    ls -la
    git pull origin {{ $branch }}
    composer update  --prefer-dist --no-dev --no-scripts
    chmod 777 -R storage
    echo "Fin de updating..."
@endtask