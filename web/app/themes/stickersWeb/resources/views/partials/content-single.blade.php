<article>
  @include('partials.page-header')
  @include('partials.entry-meta')

  <div class="post-content">
      {!! the_content() !!}
  </div>
</article>
