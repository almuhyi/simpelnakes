<div id="topFilters" class="mt-25 shadow-lg border border-gray300 rounded-sm p-10 p-md-20">
    <div class="row align-items-center">
        <div class="col-lg-9 d-block d-md-flex align-items-center justify-content-start my-25 my-lg-0">
            <div class="d-flex align-items-center justify-content-between justify-content-md-center">
                <label class="mb-0 mr-10 cursor-pointer" for="available_for_meetings">Tersedia untuk pertemuan</label>
                <div class="custom-control custom-switch">
                    <input type="checkbox" name="available_for_meetings" class="custom-control-input" id="available_for_meetings" <?php if(request()->get('available_for_meetings',null) == 'on'): ?> checked="checked" <?php endif; ?>>
                    <label class="custom-control-label" for="available_for_meetings"></label>
                </div>
            </div>

            

            

        </div>

        <div class="col-lg-3 d-flex align-items-center">
            <select name="sort" class="form-control">
                <option disabled selected>Filter</option>
                <option value="">Semua</option>
                <option value="top_rate" <?php if(request()->get('sort',null) == 'top_rate'): ?> selected="selected" <?php endif; ?>>Top rating</option>
                <option value="top_sale" <?php if(request()->get('sort',null) == 'top_sale'): ?> selected="selected" <?php endif; ?>>Top penjualan</option>
            </select>
        </div>

    </div>
</div>
<?php /**PATH C:\laragon\www\simpelnakes\resources\views/web/default/instructorFinder/components/top_filters.blade.php ENDPATH**/ ?>