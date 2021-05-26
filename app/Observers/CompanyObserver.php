<?php

namespace App\Observers;

use App\Models\company;

class CompanyObserver
{

    public function created(company $company)
    {
        //
    }

    /**
     * Handle the company "updated" event.
     *
     * @param  \App\Models\company  $company
     * @return void
     */
    public function updated(company $company)
    {
        //
    }

    public function deleting(company $company)
    {

        $company->servicesType()->detach();

        $company->services()->detach();
        
       
    }

    /**
     * Handle the company "deleted" event.
     *
     * @param  \App\Models\company  $company
     * @return void
     */
    public function deleted(company $company)
    {
        //
    }

    /**
     * Handle the company "restored" event.
     *
     * @param  \App\Models\company  $company
     * @return void
     */
    public function restored(company $company)
    {
        //
    }

    /**
     * Handle the company "force deleted" event.
     *
     * @param  \App\Models\company  $company
     * @return void
     */
    public function forceDeleted(company $company)
    {
        //
    }
}
