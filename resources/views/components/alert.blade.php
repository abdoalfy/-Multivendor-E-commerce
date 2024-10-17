@if(Session::has('success'))
<p class="alert {{Session::get('alert-class','alert-info') }}">{{ Session::get('success') }}</p>
@endif
</div>

<div class="container">
@if(Session::has('danger'))
<p  style="padding: .75rem 1.25rem;border: 1px solid transparent;border-radius:.25rem;" class="alert-danger {{Session::get('alert-class','alert-info') }}">{{ Session::get('danger') }}</p>
@endif