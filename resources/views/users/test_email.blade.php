<form class="pl-3 pr-3" method="post" action="{{ route('test.email.send') }}">
    @csrf
    <div class="form-group">
        <label for="email">{{ __('E-Mail Address') }}</label>
        <input type="email" class="form-control" id="email" name="email" required/>
    </div>
    <div class="form-group">
        <button class="btn btn-primary" type="submit">{{ __('Send Test Mail') }}</button>
    </div>
</form>