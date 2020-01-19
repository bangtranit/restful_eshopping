<?php

namespace App\Providers;

use App\Buyer;
use App\Policies\BuyerPolicy;
use Illuminate\Support\Carbon;
use Laravel\Passport\Passport;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Mockery\Generator\StringManipulation\Pass\Pass;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = array(
        // 'App\Model' => 'App\Policies\ModelPolicy',
        Buyer::class => BuyerPolicy::class

    );

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Passport::routes();
        Passport::tokensExpireIn(Carbon::now()->addMinutes(30));
        Passport::refreshTokensExpireIn(Carbon::now()->addDays(30));
        Passport::enableImplicitGrant();
        //

        Passport::tokensCan([
            'purchase-product' => 'Create a new transaction for a specific product',
            'manage-products' => 'Create, reade, update and delete products (CURD)',
            'manage-account' => 'Read your account data, id, name, email if verified and if admin (cannot read password)
                            Modify your account data (email,password) but cannot delete account',
            'read-general' => 'Read general information like purchasing categories, 
                            purchased products, selling products, selling categories, 
                            your transactions (purchases and sales)',
        ]);
    }
}
