<?php

namespace Tiketux\Token;

use Illuminate\Support\ServiceProvider;

class TokenServiceProvider extends ServiceProvider
{
  /**
   * Bootstrap services.
   *
   * @return void
   */
  public function boot()
  { 
    $this->publishes([
        __DIR__.'/migrations' => database_path('migrations'),
    ],"tiketux_token_migrations");
  }

  /**
   * Register services.
   *
   * @return void
   */
  public function register()
  {
  }
}
