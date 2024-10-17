const questions = document.querySelectorAll('.question__title');

questions.forEach(question => {
  // supprime la classe active de toutes les autres questions
    let questionContainer = question.parentElement;
    question.addEventListener('click', () => {
        questionContainer.classList.toggle('active');
        // calcule la hauteur de la questionContainer
        const answer = questionContainer.querySelector('.answer');
        const height = answer.scrollHeight;
        const questionContainerContent = questionContainer.querySelector('.question__content');
        if (questionContainer.classList.contains('active')) {
            questionContainerContent.style.height = height + 'px';
        } else {
            questionContainerContent.style.height = 0;
        }
        console.log(height);
        questionContainers.forEach(item => {
            if (item !== questionContainer) {
                item.classList.remove('active');
                item.querySelector('.question__content').style.height = 0;
            }
            });
    });
});
