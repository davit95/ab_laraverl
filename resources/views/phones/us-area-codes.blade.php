@forelse($codes as $code)
	<option value="{{ $code->prefix }}">{{ $code->prefix }}</option>
@empty
	No data
@endforelse