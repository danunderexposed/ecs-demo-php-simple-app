<option value="">--- Please Select --</option>
@foreach ($sectors as $sector)
    <optgroup label="{{ $sector->sector }}">
        @foreach($sector->specialisms as $s)
            <option @if($id == $s->id)selected="selected"@endif value="{{ $s->id }}" data-sector="{{ $sector->id }}">{{ $s->specialism }}</option>
        @endforeach
    </optgroup>
@endforeach
