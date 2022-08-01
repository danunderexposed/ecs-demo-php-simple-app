export default {
    init() {
        // Quill Rich text editor
        document.addEventListener('alpine:init', () => {
            Alpine.data('richText', (className, modelName) => ({
                init(){
                    console.log('blah', className);
                    // var content =  document.querySelector('.richText' + className).innerHTML;

                    // // setup rich text editor
                    // var quill = new Quill('.richText' + className, {
                    //     modules: {
                    //             toolbar: [
                    //                 [{ header: [1, 2, false] }],
                    //                 ['bold', 'italic', 'underline'],
                    //             ]
                    //         },
                    //         theme: 'snow'
                    // });
                    // console.log('quill' , quill);
                    // // set contents
                    // const delta = quill.clipboard.convert(content);
                    // quill.setContents(delta, 'silent')

                    // // update livewire var on change
                    // quill.on('text-change', function(delta, oldDelta, source){
                    //     this.model = quill.root.innerHTML;

                    // })
                }
            }));
        });

    }
};
