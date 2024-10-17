<form role="search" method="get" class="search-form" action="{{ home_url('/') }}">
  <label>
      <input type="search" class="search-field" placeholder="Rechercher…" value="{{ get_search_query() }}" name="s" />
  </label>
  <button type="submit" class="search-submit">Rechercher</button>
</form>
