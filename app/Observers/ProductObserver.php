<?php

namespace App\Observers;

use App\Models\Product;
use App\Models\ProductLog;
use Illuminate\Support\Facades\Auth;

class ProductObserver
{
    /**
     * Handle the Product "created" event.
     *
     * @param  \App\Models\Product  $product
     * @return void
     */
    public function created(Product $product)
    {
        $this->logAction($product, 'created', null);
    }

    /**
     * Handle the Product "updated" event.
     *
     * @param  \App\Models\Product  $product
     * @return void
     */
    public function updated(Product $product)
    {
        $original = $product->getOriginal();
        $changes = [];

        foreach ($product->getChanges() as $key => $value) {
            if ($key !== 'updated_at') {
                $changes[$key] = [
                    'old' => $original[$key] ?? null,
                    'new' => $value,
                ];
            }
        }

        $this->logAction($product, 'updated', $changes);
    }


    /**
     * Handle the Product "deleted" event.
     *
     * @param  \App\Models\Product  $product
     * @return void
     */
    
    public function deleted(Product $product)
    {
        $this->logAction($product, 'deleted', null);
    }

    protected function logAction(Product $product, $action, $changes = null)
    {
        ProductLog::create([
            'product_id' => $product->id,
            'action' => $action,
            'changed_by' => Auth::id() ?? 1, // fallback if no auth
            'changes' => $changes,
        ]);
    }

    /**
     * Handle the Product "restored" event.
     *
     * @param  \App\Models\Product  $product
     * @return void
     */
    public function restored(Product $product)
    {
        //
    }

    /**
     * Handle the Product "force deleted" event.
     *
     * @param  \App\Models\Product  $product
     * @return void
     */
    public function forceDeleted(Product $product)
    {
        //
    }
}