<div class="dropdown">
    <button type="button" <?php echo e((empty($userCarts) or count($userCarts) < 1) ? 'disabled' : ''); ?> class="btn btn-transparent dropdown-toggle" id="navbarShopingCart" data-toggle="dropdown"
            aria-haspopup="true" aria-expanded="false">
        <i data-feather="shopping-cart" width="20" height="20" class="mr-10"></i>

        <?php if(!empty($userCarts) and count($userCarts)): ?>
            <span class="badge badge-circle-primary d-flex align-items-center justify-content-center"><?php echo e(count($userCarts)); ?></span>
        <?php endif; ?>
    </button>

    <div class="dropdown-menu" aria-labelledby="navbarShopingCart">
        <div class="d-md-none border-bottom mb-20 pb-10 text-right">
            <i class="close-dropdown" data-feather="x" width="32" height="32" class="mr-10"></i>
        </div>
        <div class="h-100">
            <div class="navbar-shopping-cart h-100" data-simplebar>
                <?php if(!empty($userCarts) and count($userCarts) > 0): ?>
                    <div class="mb-auto">
                        <?php $__currentLoopData = $userCarts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cart): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php
                                $cartItemInfo = $cart->getItemInfo();
                            ?>

                            <?php if(!empty($cartItemInfo)): ?>
                                <div class="navbar-cart-box d-flex align-items-center">

                                    <a href="<?php echo e(url($cartItemInfo['itemUrl'])); ?>" target="_blank" class="navbar-cart-img">
                                        <img src="<?php echo e(asset($cartItemInfo['imgPath'])); ?>" alt="product title" class="img-cover"/>
                                    </a>

                                    <div class="navbar-cart-info">
                                        <a href="<?php echo e(url($cartItemInfo['itemUrl'])); ?>" target="_blank">
                                            <h4><?php echo e($cartItemInfo['title']); ?></h4>
                                        </a>
                                        <div class="price mt-10">
                                            <?php if(!empty($cartItemInfo['discountPrice'])): ?>
                                                <span class="text-primary font-weight-bold"><?php echo e(handlePrice($cartItemInfo['discountPrice'])); ?></span>
                                                <span class="off ml-15"><?php echo e(handlePrice($cartItemInfo['price'])); ?></span>
                                            <?php else: ?>
                                                <span class="text-primary font-weight-bold"><?php echo e(handlePrice($cartItemInfo['price'])); ?></span>
                                            <?php endif; ?>

                                            <?php if(!empty($cartItemInfo['quantity'])): ?>
                                                <span class="font-12 text-warning font-weight-500 ml-10">(<?php echo e($cartItemInfo['quantity']); ?> Produk)</span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                    <div class="navbar-cart-actions">
                        <div class="navbar-cart-total mt-15 border-top d-flex align-items-center justify-content-between">
                            <strong class="total-text">Total</strong>
                            <strong class="text-primary font-weight-bold"><?php echo e(!empty($totalCartsPrice) ? handlePrice($totalCartsPrice) : 0); ?></strong>
                        </div>

                        <a href="<?php echo e(url('/cart')); ?>" class="btn btn-sm btn-primary btn-block mt-50 mt-md-15">Lihat keranjang</a>
                    </div>
                <?php else: ?>
                    <div class="d-flex align-items-center text-center py-50">
                        <i data-feather="shopping-cart" width="20" height="20" class="mr-10"></i>
                        <span class="">Keranjang masih kosong</span>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<?php /**PATH C:\laragon\www\simpelnakes\resources\views/web/default/includes/shopping-cart-dropdwon.blade.php ENDPATH**/ ?>