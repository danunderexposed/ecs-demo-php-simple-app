<option value="">--- Please Select --</option>
@foreach ($schools as $s)
    @if(count($s->schools) > 0)
    <optgroup label="{{ $s->name }}">
        @foreach($s->schools as $sc)
            <option value="{{ $sc->id }}">{{ $sc->school }}</option>
        @endforeach
    </optgroup>
    @endif
@endforeach
<optgroup label="Other / Not Listed">
    <option value="other">Other / Not Listed</option>
</optgroup>
