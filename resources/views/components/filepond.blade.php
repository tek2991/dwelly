<div wire:ignore x-data x-init="() => {
    const post = FilePond.create($refs.input);
    post.setOptions({
        allowMultiple: {{ $attributes->has('multiple') ? 'true' : 'false' }},
        server: {
            process: (fieldName, file, metadata, load, error, progress, abort, transfer, options) => {
                @this.upload('{{ $attributes->whereStartsWith('wire:model')->first() }}', file, load, error, progress)
            },
            revert: (filename, load) => {
                @this.removeUpload('{{ $attributes->whereStartsWith('wire:model')->first() }}', filename, load)
            },
        },

        allowImagePreview: {{ $attributes->has('allowFileTypeValidation') ? 'true' : 'false' }},
        imagePreviewMaxHeight: {{ $attributes->has('imagePreviewMaxHeight') ? $attributes->get('imagePreviewMaxHeight') : '200' }},
        imagePreviewMinHeight: '100px',
        allowFileTypeValidation: {{ $attributes->has('allowFileTypeValidation') ? 'true' : 'false' }},
        acceptedFileTypes: {!! $attributes->get('acceptedFileTypes') ?? 'null' !!},
        allowFileSizeValidation: {{ $attributes->has('allowFileSizeValidation') ? 'true' : 'false' }},
        maxFileSize: {!! $attributes->has('maxFileSize') ? "'".$attributes->get('maxFileSize')."'" : 'null' !!},
        allowImageResize: {{ $attributes->has('allowImageResize') ? 'true' : 'false' }},
        imageResizeTargetWidth: {{ $attributes->has('imageResizeTargetWidth') ? "'".$attributes->get('imageResizeTargetWidth')."'" : '1920' }},
        imageResizeTargetHeight: {{ $attributes->has('imageResizeTargetHeight') ? "'".$attributes->get('imageResizeTargetHeight')."'" : '1080' }},
        imageResizeMode: {{ $attributes->has('imageResizeMode') ? "'".$attributes->get('imageResizeMode')."'" : "'contain'" }},
        imageResizeUpscale: {{ $attributes->has('imageResizeUpscale') ? 'true' : 'false' }},
        allowImageTransform: {{ $attributes->has('allowImageResize') ? 'true' : 'false' }},
        imageTransformOutputQuality: {{ $attributes->has('imageTransformOutputQuality') ? "'".$attributes->get('imageTransformOutputQuality')."'" : '90' }},
        imageTransformOutputMimeType: {{ $attributes->has('imageTransformOutputMimeType') ? "'".$attributes->get('imageTransformOutputMimeType')."'" : "'image/jpeg'" }},
    });
}">
    <input type="file" x-ref="{{ $attributes->get('ref') ?? 'input' }}" />
</div>
