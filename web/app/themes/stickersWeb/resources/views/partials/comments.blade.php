@if (comments_open())
    <div class="comments-section">
        <h2>Commentaires</h2>
        {!! wp_list_comments() !!}
        {!! comment_form() !!}
    </div>
@endif
