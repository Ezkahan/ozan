<input type="text" v-validate="'{{ $validations }}'" class="control" id="{{ $attribute->code }}"
    name="{{ $attribute->code }}" value="{{ old($attribute->code) ?: $product[$attribute->code] }}"
    data-vv-as="&quot;{{ $attribute->admin_name }}&quot;" />
