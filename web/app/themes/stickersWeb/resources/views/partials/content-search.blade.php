@if (have_posts())
    <h2>Résultats de recherche pour : "{{ get_search_query() }}"</h2>
    
    <ul class="search-results">
        @while (have_posts()) 
            @php the_post(); @endphp
            <li>
                <h3><a href="{{ get_permalink() }}">{{ get_the_title() }}</a></h3>
                <div class="search-excerpt">
                    {!! wp_trim_words(get_the_excerpt(), 20, '...') !!}
                </div>
            </li>
        @endwhile
    </ul>
    
    {{ the_posts_pagination() }}
@else
    <h2>Aucun résultat trouvé</h2>
    <p>Désolé, mais aucun résultat ne correspond à votre recherche. Essayez un autre terme de recherche.</p>
@endif
