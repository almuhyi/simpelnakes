<div id="topFilters" class="shadow-lg border border-gray300 rounded-sm p-10 p-md-20">
    <div class="row align-items-center">
        <div class="col-lg-3 d-flex align-items-center">
            <div class="checkbox-button primary-selected">
                <input type="radio" name="card" id="gridView" value="grid" @if(empty(request()->get('card')) or request()->get('card') == 'grid') checked="checked" @endif>
                <label for="gridView" class="bg-white border-0 mb-0">
                    <i data-feather="grid" width="25" height="25" class="@if(empty(request()->get('card')) or request()->get('card') == 'grid') text-primary @endif"></i>
                </label>
            </div>

            <div class="checkbox-button primary-selected ml-10">
                <input type="radio" name="card" id="listView" value="list" @if(!empty(request()->get('card')) and request()->get('card') == 'list') checked="checked" @endif>
                <label for="listView" class="bg-white border-0 mb-0">
                    <i data-feather="list" width="25" height="25" class="{{ (!empty(request()->get('card')) and request()->get('card') == 'list') ? 'text-primary' : '' }}"></i>
                </label>
            </div>
        </div>



    </div>
</div>
