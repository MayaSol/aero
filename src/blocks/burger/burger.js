(function(){
document.addEventListener('DOMContentLoaded', function () {

  function $$(selector, context) {
    context = context || document;
    const elements = context.querySelectorAll(selector);
    return Array.prototype.slice.call(elements);
  }

  function showBurgerTarget() {
    console.log('Show Burger Target');
    console.log(this);
    const targetId = this.getAttribute('data-target-id');
    const targetClassToggle = this.getAttribute('data-target-class-toggle');
    const ariaHidden = this.getAttribute('aria-expanded');
    if (targetId && targetClassToggle) {
      if (ariaHidden === 'true') {
        this.setAttribute('aria-expanded', 'false');
      }
      else if (ariaHidden === 'false') {
        this.setAttribute('aria-expanded', 'true');
      }
      this.classList.toggle('burger--close');
      document.getElementById(targetId).classList.toggle(targetClassToggle);
    }
  }

  const burgers = $$('.burger');

  for (let i = 0; i < burgers.length; i++) {
    let burger = burgers[i];
    burger.addEventListener('click', showBurgerTarget);
  }

});
})();
