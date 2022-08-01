<script>
// Quill Rich text editor
//document.addEventListener('load' , () => { //'alpine:init'
    document.addEventListener('alpine:init' , () => {
    Alpine.data('richText', (className, inputName) => ({
        model: null,
        inputName: null,
        init(){
            this.inputName = inputName;
            var content =  document.querySelector('.richText' + className).innerHTML;

            // setup rich text editor
            var quill = new Quill('.richText' + className, {
                modules: {
                        toolbar: [
                            [{ header: [1, 2, false] }],
                            ['bold', 'italic', 'underline'],
                        ]
                    },
                    theme: 'snow'
            });

            // set contents
            const delta = quill.clipboard.convert(content);
            quill.setContents(delta, 'silent')

            console.log('quill content' , content);

            // update livewire var on change
            quill.on('text-change', (delta, oldDelta, source) => {
                this.model = quill.root.innerHTML;
                Livewire.emit('updateInput', quill.root.innerHTML, this.inputName)
                console.log('quill content ', quill.root.innerHTML);
            })
        }
    }));
    });
//});
</script>
