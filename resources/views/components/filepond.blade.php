<div
    wire:ignore
    x-data
    x-init="() => {
        const post = FilePond.create($refs.input);
        post.setOptions({
            server: {
                process:(fieldName, file, metadata, load, error, progress, abort, transfer, options) => {
                    @this.upload('{{ $attributes->whereStartsWith('wire:model')->first() }}', file, load, error, progress)
                },
                revert: (filename, load) => {
                    @this.removeUpload('{{ $attributes->whereStartsWith('wire:model')->first() }}', filename, load)
                },
            }
        });
    }"
>
    <input type="file" x-ref="input" />
</div>