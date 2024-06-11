<select v-validate="'{{ $validations }}'" class="control" id="{{ $attribute->code }}" name="{{ $attribute->code }}"
    data-vv-as="&quot;{{ $attribute->admin_name }}&quot;">

    <?php $selectedOption = old($attribute->code) ?: $product[$attribute->code]; ?>

    @if ($attribute->code != 'tax_category_id')
        @if ($attribute->code == 'brand')
            @foreach ($attribute->options()->orderBy('admin_name')->get() as $option)
                <option value="{{ $option->id }}" {{ $option->id == $selectedOption ? 'selected' : '' }}>
                    {{ $option->admin_name }}
                </option>
            @endforeach
        @else
            @foreach ($attribute->options()->orderBy('sort_order')->get() as $option)
                <option value="{{ $option->id }}" {{ $option->id == $selectedOption ? 'selected' : '' }}>
                    {{ $option->admin_name }}
                </option>
            @endforeach
        @endif
    @else
        <option value=""></option>

        @foreach (app('Webkul\Tax\Repositories\TaxCategoryRepository')->all() as $taxCategory)
            <option value="{{ $taxCategory->id }}" {{ $taxCategory->id == $selectedOption ? 'selected' : '' }}>
                {{ $taxCategory->name }}
            </option>
        @endforeach

    @endif

</select>
