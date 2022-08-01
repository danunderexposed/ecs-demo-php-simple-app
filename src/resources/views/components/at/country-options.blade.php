<option value="">--- Please Select --</option>
@foreach($countries as $c)
    <option value="{{ $c->id }}">{{ $c->name }}</option>
@endforeach
