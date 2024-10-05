// jsContent






function deletePoster(dataId){
  var targetElement = document.querySelector('[data-id="' + dataId + '"]');
  targetElement.removeAttribute('data-id')
  targetElement.style.display='none'
}