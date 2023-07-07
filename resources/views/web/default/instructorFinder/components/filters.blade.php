<div class="mt-20 p-20 rounded-sm shadow-lg border border-gray300 filters-container">
    <h3 class="category-filter-title font-20 font-weight-bold text-dark-blue">Filter</h3>

    <div class="form-group mt-20">
        <label for="category_id">Kategori</label>

        <select name="category_id" id="category_id" class="form-control">
            <option value="">Pilih Kategori</option>

            @if(!empty($categories))
                @foreach($categories as $category)
                    @if(!empty($category->subCategories) and count($category->subCategories))
                        <optgroup label="{{  $category->title }}">
                            @foreach($category->subCategories as $subCategory)
                                <option value="{{ $subCategory->id }}" @if(request()->get('category_id') == $subCategory->id) selected="selected" @endif>{{ $subCategory->title }}</option>
                            @endforeach
                        </optgroup>
                    @else
                        <option value="{{ $category->id }}" @if(request()->get('category_id') == $category->id) selected="selected" @endif>{{ $category->title }}</option>
                    @endif
                @endforeach
            @endif
        </select>
    </div>

    <div class="form-group">
        <label for="level_of_training">Tingkat pelatihan</label>

        <select name="level_of_training" class="form-control">
            <option value="">Semua</option>
            <option value="beginner" {{ (request()->get('level_of_training') == 'beginner') ? 'selected' : '' }}>Pemula</option>
            <option value="middle" {{ (request()->get('level_of_training') == 'middle') ? 'selected' : '' }}>Menengah</option>
            <option value="expert" {{ (request()->get('level_of_training') == 'expert') ? 'selected' : '' }}>Ahli</option>
        </select>
    </div>

    <div class="form-group">
        <label for="gender">Gender instruktur</label>

        <select name="gender" id="gender" class="form-control">
            <option value="">Semua</option>

            <option value="man" {{ (request()->get('gender') == 'man') ? 'selected' : '' }}>Pria</option>
            <option value="woman" {{ (request()->get('gender') == 'woman') ? 'selected' : '' }}>Wanita</option>
        </select>
    </div>

    <div class="form-group">
        <label for="instructor_type">Jenis instruktur</label>

        <select name="role" id="instructor_type" class="form-control">
            <option value="">Semua</option>
            <option value="{{ \App\Models\Role::$teacher }}" {{ (request()->get('role') == \App\Models\Role::$teacher) ? 'selected' : '' }}>Instruktur</option>
            <option value="{{ \App\Models\Role::$organization }}" {{ (request()->get('role') == \App\Models\Role::$organization) ? 'selected' : '' }}>Organisasi</option>
        </select>
    </div>

    {{-- <div class="form-group">
        <label class="input-label">{{ trans('update.meeting_type') }}</label>

        <div class="d-flex align-items-center wizard-custom-radio mt-5">
            <div class="wizard-custom-radio-item flex-grow-1">
                <input type="radio" name="meeting_type" value="all" id="all" class="" {{ (request()->get('meeting_type') == 'all') ? 'checked' : '' }}>
                <label class="font-12 cursor-pointer px-15 py-10" for="all">{{ trans('public.all') }}</label>
            </div>

            <div class="wizard-custom-radio-item flex-grow-1">
                <input type="radio" name="meeting_type" value="in_person" id="in_person" class="" {{ (request()->get('meeting_type') == 'in_person') ? 'checked' : '' }}>
                <label class="font-12 cursor-pointer px-15 py-10" for="in_person">{{ trans('update.in_person') }}</label>
            </div>

            <div class="wizard-custom-radio-item flex-grow-1">
                <input type="radio" name="meeting_type" value="online" id="online" class="" {{ (request()->get('meeting_type') == 'online') ? 'checked' : '' }}>
                <label class="font-12 cursor-pointer px-15 py-10" for="online">{{ trans('update.online') }}</label>
            </div>
        </div>
    </div> --}}

    {{-- <div class="form-group">
        <label class="input-label">{{ trans('update.population') }}</label>

        <div class="d-flex align-items-center wizard-custom-radio mt-5">
            <div class="wizard-custom-radio-item flex-grow-1">
                <input type="radio" name="population" value="all" id="population_all" class="" {{ (request()->get('population') == 'all') ? 'checked' : '' }}>
                <label class="font-12 cursor-pointer px-15 py-10" for="population_all">{{ trans('public.all') }}</label>
            </div>

            <div class="wizard-custom-radio-item flex-grow-1">
                <input type="radio" name="population" value="single" id="population_single" class="" {{ (request()->get('population') == 'single') ? 'checked' : '' }}>
                <label class="font-12 cursor-pointer px-15 py-10" for="population_single">{{ trans('update.single') }}</label>
            </div>

            <div class="wizard-custom-radio-item flex-grow-1">
                <input type="radio" name="population" value="group" id="population_group" class="" {{ (request()->get('population') == 'group') ? 'checked' : '' }}>
                <label class="font-12 cursor-pointer px-15 py-10" for="population_group">{{ trans('update.group') }}</label>
            </div>
        </div>
    </div> --}}

    {{-- <div class="form-group pb-20">
        <label class="form-label">{{ trans('update.price_range') }}</label>
        <div
            class="range wrunner-value-bottom"
            id="priceRange"
            data-minLimit="0"
            data-maxLimit="1000"
        >
            <input type="hidden" name="min_price" value="{{ request()->get('min_price') ?? null }}">
            <input type="hidden" name="max_price" value="{{ request()->get('max_price') ?? null }}">
        </div>
    </div>

    <div class="form-group pb-20">
        <label class="form-label">{{ trans('update.instructor_age') }}</label>
        <div
            class="range wrunner-value-bottom"
            id="instructorAgeRange"
            data-minLimit="0"
            data-maxLimit="100"
        >
            <input type="hidden" name="min_age" value="{{ request()->get('min_age') ?? null }}">
            <input type="hidden" name="max_age" value="{{ request()->get('max_age') ?? null }}">
        </div>
    </div> --}}
</div>
