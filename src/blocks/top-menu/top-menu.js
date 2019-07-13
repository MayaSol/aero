(function() {
document.addEventListener('DOMContentLoaded', function (){
  const container = document.querySelector('.main-menu');
  let itemsHasChildren = container.querySelectorAll('.menu-item-has-children > a:first-of-type, .page-item-has-children > a:first-of-type');

  // Вставить insertedElem перед prevElem
  function insertAfter(insertedElem, prevElem) {
    prevElem.parentNode.insertBefore(insertedElem, prevElem.nextSibling);
  }

  function createSvg(href) {
    const svg = document.createElementNS('http://www.w3.org/2000/svg', 'svg');
    const use = document.createElementNS('http://www.w3.org/2000/svg', 'use');
    use.setAttributeNS('http://www.w3.org/1999/xlink', 'xlink:href', href);
    svg.appendChild(use);
    return svg;
  }

  // Создать кнопку открытия подменю.
  // link - ссылка в пункте меню, к которому добавляется кнопка
  function createDropDownToggle(link){
    let dropdownToggle = document.createElement('button');
    dropdownToggle.classList.add('dropdown-toggle', 'btn');
    let svg = createSvg('#icon-angle-down');
    svg.classList.add('icon', 'icon-angle-down');
    svg.setAttribute('aria-hidden', 'true');
    svg.setAttribute('role', 'img');
    let fontSize = getComputedStyle(link).fontSize;
    svg.setAttribute('width', fontSize);
    svg.setAttribute('height', fontSize);
    dropdownToggle.appendChild(svg);
    return dropdownToggle;
  }

  // Добавить кнопки открытия подменю к соответствующим пунктам меню
  for (let i = 0; i < itemsHasChildren.length; i++) {
    let dropdownToggle = createDropDownToggle(itemsHasChildren[i]);
    insertAfter(dropdownToggle, itemsHasChildren[i]);
  }

  // Обработчики на кнопки открытия подменю
  function onDropdownToggleClick() {
    this.classList.toggle('toggled-on');
    this.parentNode.querySelector('.sub-menu').classList.toggle('toggled-on');
  }

  let dropdownToggleAll = container.querySelectorAll('.dropdown-toggle');
  for (let i = 0; i < dropdownToggleAll.length; i++) {
    dropdownToggleAll[i].addEventListener('click', onDropdownToggleClick);
  }


});
})();
