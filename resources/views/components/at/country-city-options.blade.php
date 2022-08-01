<option value="">--- Please Select --</option>

@foreach ($countries as $c)
    <optgroup label="{{ $c->name }}">
        @foreach($c->cities as $ci)
            <option value="{{ $ci->id }}">{{ $ci->name }}</option>
        @endforeach
    </optgroup>
@endforeach

<optgroup label="Other / Not Listed">
    <option value="other">Other / Not Listed</option>
</optgroup>
