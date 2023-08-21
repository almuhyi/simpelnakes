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


</div>
