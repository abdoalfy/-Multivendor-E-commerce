<input type="{{ $type }}" value="{{ $value }}" name="{{ $name }}" class="form-control @error($name) is-invalid @enderror" id="exampleInputEmail1">
@error($name)
  <div class="text-danger">
   {{ $message }}
  </div>
@enderror