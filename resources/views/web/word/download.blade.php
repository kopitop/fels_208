<h1>{{ trans('web/word.download') }}</h1>
<div class="row wordlist">
    @foreach ($data as $word)
    <div class="col-md-6">
        <p>{{ $word->content }}</p>
    </div>
    @endforeach
</div>
