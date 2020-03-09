<?php

namespace App\Providers;

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

use Illuminate\Cache\NullStore;
use Cache;

class AppServiceProvider extends ServiceProvider
{
   /**
   * Bootstrap any application services.
   *
   * @return void
   */
   public function boot()
   {

      Cache::extend( 'none', function( $app ) {
          return Cache::repository( new NullStore );
      } );
      
      Schema::defaultStringLength(191);
      date_default_timezone_set('Asia/Almaty');

      Collection::macro('paginate', function($perPage, $total = null, $page = null, $pageName = 'page') {
         $page = $page ?: LengthAwarePaginator::resolveCurrentPage($pageName);
         return new LengthAwarePaginator(
            $this->forPage($page, $perPage),
            $total ?: $this->count(),
            $perPage,
            $page,
            [
               'path' => LengthAwarePaginator::resolveCurrentPath(),
               'pageName' => $pageName,
               'to' => 4,
            ]
         );
      });

      Builder::macro('whereLike', function ($attributes, string $searchTerm) {
         $this->where(function (Builder $query) use ($attributes, $searchTerm) {
            foreach (array_wrap($attributes) as $attribute) {
               $query->when(
                  str_contains($attribute, '.'),
                  function (Builder $query) use ($attribute, $searchTerm) {
                     [$relationName, $relationAttribute] = explode('.', $attribute);

                     $query->orWhereHas($relationName, function (Builder $query) use ($relationAttribute, $searchTerm) {
                        $query->where($relationAttribute, 'LIKE', "%{$searchTerm}%");
                     });
                  },
                  function (Builder $query) use ($attribute, $searchTerm) {
                     $query->orWhere($attribute, 'LIKE', "%{$searchTerm}%");
                  }
               );
            }
         });

         return $this;
      });

   }

   /**
   * Register any application services.
   *
   * @return void
   */
   public function register()
   {
      //
   }
}
