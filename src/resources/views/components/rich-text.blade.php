<div
    wire:ignore
    x-data="{{ $class }}RichText()"
    {{ $attributes }}
    >
    <x-label for="" class="mb-5">{{ $label }}</x-label>
    <div class="{{ $class }}RichText" style="height:175px">
        {!! $slot !!}
    </div>
</div>
<script>
    function {{ $class }}RichText(content) {
        return {
            init() {
                // get rich text content
                var content =  document.querySelector('.{{ $class }}RichText').innerHTML;

                // setup rich text editor
                var quill = new Quill('.{{ $class }}RichText', {
                    modules: {
                            toolbar: [
                                [{ header: [1, 2, false] }],
                                ['bold', 'italic', 'underline'],
                            ]
                        },
                        placeholder: '{{ $placeholder }}',
                        theme: 'snow'
                });

                // set contents
                const delta = quill.clipboard.convert(content);
                quill.setContents(delta, 'silent')

                // update livewire var on change
                quill.on('text-change', function(delta, oldDelta, source){
                    @this.set('{{ $model }}', quill.root.innerHTML, true);
                })
            }
        }
    }



    </script>
