@php($faq = get_field('FAQ', get_option('page_on_front')))
<section class="FAQ">
  <h2 class="h1">FAQ</h2>
  <div class="questions" data-aos="fade-up">
    @if($faq)
      @foreach($faq as $question)
        <div class="question">
          <div class="question__title">
            <h3>{{ $question['question'] }}</h3>
            <div class="more">
              <span></span><span></span>
            </div>
          </div>
          <div class="question__content">
            <div class="answer">
              {!! $question['reponse']!!}
            </div>
          </div>
        </div>
      @endforeach
    @endif
  </div>
</section>
