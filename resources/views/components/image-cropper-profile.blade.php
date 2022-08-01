<!--the input wrapper-->
<div {{ $attributes->merge(['class' => 'image-cropper relative w-full p-8 my-5 bg-white']) }} >
  <div x-data="{{ $inputName }}()" x-init="initCroppie()" x-cloak class="active:shadow-sm active:border-blue-500" wire:ignore>
    <div class="w-full py-5">
      @if ($image)
      <div class="" x-show="!showCroppie && !hasImage">
        <img src="{{ $image }}" alt="" class="mx-auto mb-16">
      </div>
      @endif
      <!--show the input-->
      <div x-show="!showCroppie && !hasImage" class="">
          <input type="file" name="{{ $inputName }}File" accept="image/*" class="absolute inset-0 w-full h-full p-0 m-0 outline-none opacity-0" x-ref="input" x-on:change="updatePreview()" x-on:dragover="$el.classList.add('active')" x-on:dragleave="$el.classList.remove('active')" x-on:drop="$el.classList.remove('active')">

          <div class="flex flex-col items-center justify-center space-y-2 ">
              <x-icon name="cloud-upload" class="w-5 h-5" />
              <label for="{{ $inputName }}File" class="py-2 text-center uppercase cursor-pointer text-bold">
                  @if ($image)
                  <span>Drag an image here or click in this area to replace image</span>
                  @else
                  <span>Drag an image here or click in this area.</span>
                  @endif
              </label>
              <x-button secondary class="flex items-center px-4 py-2 mx-auto font-medium text-center text-white bg-teal-700 border border-transparent rounded-md outline-none">Select a file</x-button>
          </div>
      </div>

      <!--show the cropper-->
      <div x-show="showCroppie">
          <div class="step1" :class="{ 'hidden': step > 1 }">
            <div class="mx-auto"><img src alt x-ref="croppie1" class="w-full display-block"></div>
          </div>
          <div class="step2" :class="{ 'hidden': step < 2 }">
            <div class="mx-auto"><img src alt x-ref="croppie2" class="w-full display-block"></div>
          </div>
          <div class="flex items-center justify-between py-2">
              <x-button warning class="" x-on:click="clearPreview(); step = 1">Swap image</x-button>
              <x-button primary class="" x-show="step < 2" x-on:click="saveMain(); step = 2">Next</x-button>
              <x-button primary class="" x-show="step > 1" x-on:click="step = 1">Back</x-button>
              <x-button primary class="" x-show="step > 1" x-on:click="saveCroppie()">Save</x-button>
          </div>
      </div>
    </div>
  </div>
</div>

<script>
function {{ $inputName }}() {
  return {
    showCroppie: false,
    hasImage: false,
    originalSrc: "",
    croppie1: {},
    croppie2: {},
    result: "",
    resultMini: "",
    step: 1,

    updatePreview() {
      var reader,
        files = this.$refs.input.files;

      reader = new FileReader();

      reader.onload = (e) => {
        this.showCroppie = true;
        this.originalSrc = e.target.result;
        this.bindCroppie(e.target.result);
      };

      reader.readAsDataURL(files[0]);
    },
    initCroppie() {
      if (!this.$refs.croppie1 || this.$refs.croppie2){
        return;
      }
      this.croppie1 = new Croppie(this.$refs.croppie1, {
        viewport: { width: {{ $viewportWidth }}, height: {{ $viewportHeight }}, type: "{{ isset($viewportShape) ? $viewportShape : 'square' }}" },
        boundary: { width: {{ $boundaryWidth }}, height: {{ $boundaryHeight }} }, //default boundary container
        showZoomer: true,
        enableResize: {{ isset($enableResize) ? $enableResize : "true" }},
        enableOrientation: true
      });

      this.croppie2 = new Croppie(this.$refs.croppie2, {
        viewport: { width: {{ $viewportWidth2 }}, height: {{ $viewportHeight2 }}, type: "{{ isset($viewportShape) ? $viewportShape : 'square' }}" },
        boundary: { width: {{ $boundaryWidth2 }}, height: {{ $boundaryHeight2 }} }, //default boundary container
        showZoomer: true,
        enableResize: {{ isset($enableResize) ? $enableResize : "true" }},
        enableOrientation: true
      });
    },
    clearPreview() {
      this.$refs.input.value = null;
      this.showCroppie = false;
    },
    swap() {
      this.$refs.input.value = null;
      this.showCroppie = false;
      this.hasImage = false;
      this.$refs.result.src = "";
    },
    edit() {
      this.$refs.input.value = null;
      this.showCroppie = true;
      this.hasImage = false;
      this.$refs.result.src = "";
      this.step = 1;
      this.bindCroppie(this.originalSrc); //this.$refs.result.src //or some array value
    },
    saveMain() {
      this.croppie1
        .result({
          type: "base64",
          size:
          @if (isset($resultHeight) && isset($resultWidth))
            { width: {{ $resultWidth }}, height: {{ $resultHeight }}}
          @else
          "viewport"
          @endif
        })
        .then((croppedImage) => {
          // emit to parent livewire class function
          Livewire.emit('{{ $listenerName }}', croppedImage);
          console.log('listener emitted')
        });
    },
    saveCroppie() {

      this.croppie2
        .result({
          type: "base64",
          size:
          @if (isset($resultHeight) && isset($resultWidth))
            { width: {{ $resultWidth }}, height: {{ $resultHeight }}}
          @else
          "viewport"
          @endif
        })
        .then((croppedImage) => {
          console.log("croppedImage2",croppedImage)
          //this.$refs.resultMini.src = croppedImage;
          this.showCroppie = false;
          this.hasImage = true;

          // emit to parent livewire class function
          Livewire.emit('{{ $listenerName2 }}', croppedImage);
          Livewire.emit('saveProfileImages');
          console.log('listener emitted')
        });
    },
    bindCroppie(src) {
      setTimeout(() => {
        //avoid problems with croppie container not being visible when binding
        this.croppie1.bind({
          url: src
        });
        this.croppie2.bind({
          url: src
        });
      }, 200);
    }
  };
}
</script>
