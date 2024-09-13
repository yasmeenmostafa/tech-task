<?php

namespace App\Policies;

use App\Models\Product;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ProductPolicy
{
    public function update(User $user, Product $product)
    {
        return $user->id === $product->user_id; // Only the product owner can update it
    }

    /**
     * Determine if the given product can be deleted by the user.
     */
    public function delete(User $user, Product $product)
    {
        return $user->id === $product->user_id; // Only the product owner can delete it
    }
}
