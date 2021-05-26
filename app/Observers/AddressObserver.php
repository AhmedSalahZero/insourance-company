<?php

namespace App\Observers;

use App\Models\address;

class AddressObserver
{
    /**
     * Handle the address "created" event.
     *
     * @param  \App\Models\address  $address
     * @return void
     */
    public function creating(address $address)
    {
        
        if($address->default)
        {
            $address->user->addresses()->update([
                'default'=>false ,
            ]);
        }

    }
    public function created(address $address)
    {
        
    }

    /**
     * Handle the address "updated" event.
     *
     * @param  \App\Models\address  $address
     * @return void
     */
    public function updated(address $address)
    {
        //
    }

    /**
     * Handle the address "deleted" event.
     *
     * @param  \App\Models\address  $address
     * @return void
     */
    public function deleted(address $address)
    {
        //
    }

    /**
     * Handle the address "restored" event.
     *
     * @param  \App\Models\address  $address
     * @return void
     */
    public function restored(address $address)
    {
        //
    }

    /**
     * Handle the address "force deleted" event.
     *
     * @param  \App\Models\address  $address
     * @return void
     */
    public function forceDeleted(address $address)
    {
        //
    }
}
