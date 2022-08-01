@php
    //Define Styles
    $stylemodule='';
    $styleheader='';
    $stylecopy='';

    //Create Styles
    if($item->headclr) { $styleheader.='color:'.htmlspecialchars($item->headclr).';'; }
    if($item->headbg) { $styleheader.='background:'.htmlspecialchars($item->headbg).';'; }
    if($item->copyclr) { $stylecopy.='color:'.htmlspecialchars($item->copyclr).';'; }
    if($item->copybg) { $stylecopy.='background:'.htmlspecialchars($item->copybg).';'; }
    if($item->modulebg) { $stylemodule.='background:'.htmlspecialchars($item->modulebg).';'; }

    //Set Styles
    if($stylemodule) { $stylemodule=' style="'.$stylemodule.'"'; }
    if($styleheader) { $styleheader=' style="'.$styleheader.'"'; }
    if($stylecopy) { $stylecopy=' style="'.$stylecopy.'"'; }

    //Work Out Colspan
    $colspan=1;
    if($item->type=='full2' || $item->type=='half2' || $item->type=='video2' || $item->type=='port2') { $colspan=2; }
    if($item->type=='full3') { $colspan=3; }

@endphp

<div {{ $stylemodule }} class="module {{ $item->type }}">
    <div class="relative">
        <img src="{{ $image }}" alt="" class="w-full">
        <div class="content">
            <h3 {{ $styleheader }}>{{ $item->headtxt }}</h3><br class="clear" /><p {{ $stylecopy }}>{{ $item->copytxt }}</p>
        </div>
        @if (isset($showRemove) && $showRemove)<x-button wire:click="remove({{ $item->id }})" negative icon="trash" class="absolute z-40 top-2 right-2"></x-button>@endif
    </div>
</div>
