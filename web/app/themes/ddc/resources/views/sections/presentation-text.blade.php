<section class="presentation">

  <div class="presentation__text-part" data-aos="fade-right">
    @php($id = get_the_ID())
    <h1 class="presentation__text-part__title">{{ get_field('titre_h1', $id) }}</h1>
    <div class="presentation__text-part__content">
      {!! the_field('texte', $id) !!}
      @php($lien = get_field('presentation-lien', $id))
      @if($lien)
        <a href="{{ $lien['url'] }}" class="btn">{{ $lien['title'] }}</a>
      @endif
    </div>
  </div>

  <?php $imagePresentation = get_field('image', $id) ?>
  @if($imagePresentation)
    <div class="presentation__img-part" data-aos="fade-up">
      <div class="img-clip l-side">
        <img src="{{$imagePresentation['url']}}" alt="{{$imagePresentation['alt']}}">
      </div>
    </div>
  @endif



</section>
