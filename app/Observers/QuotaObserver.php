<?php

namespace App\Observers;

use App\Models\Quota;

class QuotaObserver
{
   public function deleting(Quota $quota)
   {
       $quota->features()->delete();
   }
}
