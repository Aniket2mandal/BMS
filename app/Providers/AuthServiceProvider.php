<?php

namespace App\Providers;

use App\Models\Blood;
use App\Models\Bloodbank;
use App\Models\Donor;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        // FOR BLOODS


        Gate::define('add-quantity', function ($authUser, Blood $blood) {

            if (method_exists($authUser, 'hasRole') && $authUser->hasRole('Sub Admin')) {
                return true;
            }

            return false;
        });

        Gate::define('edit-blood', function ($authUser) {
            if (method_exists($authUser, 'hasRole') && $authUser->hasRole('Admin')) {
                return true;
            }
            return false;
        });


        Gate::define('create-blood', function ($authUser) {
            if (method_exists($authUser, 'hasRole') && $authUser->hasRole('Admin')) {
                return true;
            }
            return false;
        });



        // FOR BLOOD BANKS
        Gate::define('create-bloodbank', function ($authUser, $bloodBank) {
            if (method_exists($authUser, 'hasRole') && $authUser->hasRole('Admin')) {
                return true;
            }
            return false;
        });
        Gate::define('edit-bloodbank', function ($authUser, $bloodBank) {
            if (method_exists($authUser, 'hasRole') && $authUser->hasRole('Admin')) {
                return true;
            }
            return false;
        });

        Gate::define('delete-bloodbank', function ($authUser, $bloodBank) {
            if (method_exists($authUser, 'hasRole') && $authUser->hasRole('Admin')) {
                return true;
            }
            return false;
        });

        Gate::define('change-bloodbank-status', function ($authUser, $bloodBank) {
            if (method_exists($authUser, 'hasRole') && $authUser->hasRole('Admin')) {
                return true;
            }
            return false;
        });


        // FOR DONORS
        Gate::define('create-donor', function ($authUser) {

            // if (method_exists($authUser, 'hasRole') && $authUser->hasRole('Admin')) {
            //     return true;
            // }

            if (method_exists($authUser, 'hasRole') && $authUser->hasRole('Sub Admin')) {
                // Get the single blood bank id assigned to the user
                $userBloodBank = $authUser->bloodBank()->first();
                Log::info('User is subadmin, assigned blood bank ID: ' . ($userBloodBank ? $userBloodBank->id : 'none'));
                return $userBloodBank ? true : false; // allow if user has a blood bank assigned
            }

            return false; // no permission for other users
        });



        Gate::define('edit-donor', function ($authUser, Donor $donor) {
            // if (method_exists($authUser, 'hasRole') && $authUser->hasRole('Admin')) {
            //     return true;
            // }

            if (method_exists($authUser, 'hasRole') && $authUser->hasRole('Sub Admin')) {
                // Get the single blood bank id assigned to the user
                $userBloodBank = $authUser->bloodBank()->first();
                Log::info('User is subadmin, assigned blood bank ID: ' . ($userBloodBank ? $userBloodBank->id : 'none'));
                if (!$userBloodBank) {
                    return false; // no assigned blood bank, no permission
                }

                // Check if this donor record is linked to that blood bank
                return $donor->bloodBanks->contains('id', $userBloodBank->id);
            }
        });

        Gate::define('delete-donor', function ($authUser, Donor $donor) {
            // if (method_exists($authUser, 'hasRole') && $authUser->hasRole('Admin')) {
            //     return true;
            // }

            if (method_exists($authUser, 'hasRole') && $authUser->hasRole('Sub Admin')) {
                // Get the single blood bank id assigned to the user
                $userBloodBank = $authUser->bloodBank()->first();
                Log::info('User is subadmin, assigned blood bank ID: ' . ($userBloodBank ? $userBloodBank->id : 'none'));
                if (!$userBloodBank) {
                    return false; // no assigned blood bank, no permission
                }

                // Check if this donor record is linked to that blood bank
                return $donor->bloodBanks->contains('id', $userBloodBank->id);
            }

            return false;
        });


        Gate::define('add-bloodbank', function ($authUser, $bloodBank) {
            // if (method_exists($authUser, 'hasRole') && $authUser->hasRole('Admin')) {
            //     return true;
            // }

            if (method_exists($authUser, 'hasRole') && $authUser->hasRole('Sub Admin')) {
                // Get the single blood bank id assigned to the user
                // $userBloodBank = $authUser->bloodBank()->first();
                // Log::info('User is subadmin, assigned blood bank ID: ' . ($userBloodBank ? $userBloodBank->id : 'none'));
                // if (!$userBloodBank) {
                //     return false; // no assigned blood bank, no permission
                // }

                // Check if this donor record is linked to that blood bank
                // return $bloodBank->bloodBanks->contains('id', $userBloodBank->id);
                return true;
            }


            return false; // no permission for other users
        });



        // FOR CAMPS

        Gate::define('create-camp', function ($authUser, $camp) {
            // if (method_exists($authUser, 'hasRole') && $authUser->hasRole('Admin')) {
            //     return true;
            // }

            if (method_exists($authUser, 'hasRole') && $authUser->hasRole('Sub Admin')) {
                // Get the single blood bank id assigned to the user
                $userBloodBank = $authUser->bloodBank()->first();
                Log::info('User is subadmin, assigned blood bank ID: ' . ($userBloodBank ? $userBloodBank->id : 'none'));
                return $userBloodBank ? true : false; // allow if user has a blood bank assigned
            }
            return false; // no permission for other users
        });


        Gate::define('edit-camp', function ($authUser, $camp) {
            // if (method_exists($authUser, 'hasRole') && $authUser->hasRole('Admin')) {
            //     return true;
            // }

            if (method_exists($authUser, 'hasRole') && $authUser->hasRole('Sub Admin')) {
                // Get the single blood bank id assigned to the user
                $userBloodBank = $authUser->bloodBank()->first();
                Log::info('User is subadmin, assigned blood bank ID: ' . ($userBloodBank ? $userBloodBank->id : 'none'));
                if (!$userBloodBank) {
                    return false; // no assigned blood bank, no permission
                }

                // Check if this camp record is linked to that blood bank
                return $camp->bloodBanks->contains('id', $userBloodBank->id);
            }
            return false;
        });

        Gate::define('delete-camp', function ($authUser, $camp) {
            // if (method_exists($authUser, 'hasRole') && $authUser->hasRole('Admin')) {
            //     return true;
            // }

            if (method_exists($authUser, 'hasRole') && $authUser->hasRole('Sub Admin')) {
                // Get the single blood bank id assigned to the user
                $userBloodBank = $authUser->bloodBank()->first();
                Log::info('User is subadmin, assigned blood bank ID: ' . ($userBloodBank ? $userBloodBank->id : 'none'));
                if (!$userBloodBank) {
                    return false; // no assigned blood bank, no permission
                }

                // Check if this camp record is linked to that blood bank
                return $camp->bloodBanks->contains('id', $userBloodBank->id);
            }
            return false;
        });

        Gate::define('change-camp-status', function ($authUser, $camp) {
            // if (method_exists($authUser, 'hasRole') && $authUser->hasRole('Admin')) {
            //     return true;
            // }

            if (method_exists($authUser, 'hasRole') && $authUser->hasRole('Sub Admin')) {
                // Get the single blood bank id assigned to the user
                $userBloodBank = $authUser->bloodBank()->first();
                Log::info('User is subadmin, assigned blood bank ID: ' . ($userBloodBank ? $userBloodBank->id : 'none'));
                if (!$userBloodBank) {
                    return false; // no assigned blood bank, no permission
                }

                // Check if this camp record is linked to that blood bank
                return $camp->bloodBanks->contains('id', $userBloodBank->id);
            }
            return false;
        });



        // FOR USERS

        Gate::define('create-user', function ($authUser, $user) {
            if (method_exists($authUser, 'hasRole') && $authUser->hasRole('Admin')) {
                return true;
            }
            return false;
        });


        Gate::define('edit-user', function ($authUser, $user) {
            if (method_exists($authUser, 'hasRole') && $authUser->hasRole('Admin')) {
                return true;
            }
            return false;
        });

        Gate::define('delete-user', function ($authUser, $user) {
            if (method_exists($authUser, 'hasRole') && $authUser->hasRole('Admin')) {
                return true;
            }
            return false;
        });

        Gate::define('change-user-status', function ($authUser, $user) {
            if (method_exists($authUser, 'hasRole') && $authUser->hasRole('Admin')) {
                return true;
            }
            return false;
        });

        // FOR ROLES

        Gate::define('create-role', function ($authUser, $role) {
            if (method_exists($authUser, 'hasRole') && $authUser->hasRole('Admin')) {
                return true;
            }
            return false;
        });

        Gate::define('edit-role', function ($authUser, $role) {
            if (method_exists($authUser, 'hasRole') && $authUser->hasRole('Admin')) {
                return true;
            }
            return false;
        });

        Gate::define('delete-role', function ($authUser, $role) {
            if (method_exists($authUser, 'hasRole') && $authUser->hasRole('Admin')) {
                return true;
            }
            return false;
        });
    }
}
