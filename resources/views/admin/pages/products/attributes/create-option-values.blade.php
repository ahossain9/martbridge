<div class="modal fade" id="addVariantOptionValue-{{ $attribute->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-transparent">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body px-sm-5 pb-5">
                <div class="text-center mb-2 border-bottom">
                    <h1 class="mb-1">{{ $attribute->name }} </h1>
                    <p>Create attribute values for {{ $attribute->name }}.</p>
                </div>
                <attribute-values :variant_id="{{ $attribute->id }}"></attribute-values>
            </div>
        </div>
    </div>
</div>
