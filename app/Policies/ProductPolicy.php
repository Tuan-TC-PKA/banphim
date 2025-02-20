<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Product;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProductPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return true; // Tất cả user đều có thể xem danh sách sản phẩm
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Product $product): bool
    {
        return true; // Tất cả user đều có thể xem chi tiết sản phẩm
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        dd('Policy create() được gọi');
    return $user->isAdmin();
 // Chỉ admin mới có thể tạo sản phẩm (giả sử bạn có method isAdmin() trong model User)
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Product $product): bool
    {
        return $user->isAdmin(); // Chỉ admin mới có thể sửa sản phẩm
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Product $product): bool
    {
        return $user->isAdmin(); // Chỉ admin mới có thể xóa sản phẩm
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Product $product): bool
    {
        return $user->isAdmin(); // Quyền restore (nếu dùng soft delete)
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Product $product): bool
    {
        return $user->isAdmin(); // Quyền force delete (nếu dùng soft delete)
    }
}