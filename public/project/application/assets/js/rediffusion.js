
$(document).ready(function() {
  var btnRediffusion=$('.btnRediffusion')
  var btnProgram=$('.btnProgram')
  var backgrounDiv=$('.background')
  var header=$('#header')
  var session=1


    // jsContent


    function updateOnClick(list) {
      let listItems = document.querySelectorAll('li[data-id]');
  
      listItems.forEach((item,index) => {
          let anchorTag = item.querySelector('a');
          if (anchorTag) {
              anchorTag.setAttribute('onclick', `vedioSource('./videos/${list[index]}', this)`);
          }
      });
  }
  
function addSession(numElements, startElementId, newElement, linkElement) {
    
  var targetElements = document.querySelectorAll('[data-id]');

  var firstTargetElement = targetElements[startElementId-1];


  if (!firstTargetElement) {
    console.error(`Element with ID '${startElementId}' not found.`);
    return;
  }
  firstTargetElement.insertAdjacentHTML('beforebegin', newElement);
  
  
  var lastTargetElement = targetElements[startElementId+numElements-1];
  
  if (lastTargetElement) {
      lastTargetElement.insertAdjacentHTML('beforebegin', linkElement);
      
  }else{
      var lastTargetElement = targetElements[targetElements.length-1];
      lastTargetElement.insertAdjacentHTML('afterend', linkElement);
    }
    
  return startElementId+numElements
  

}


function insertAfterElement(dataIdValue, newElementHTML) {
var targetElements = document.querySelectorAll('[data-id="' + dataIdValue + '"]');

if (targetElements.length > 0) {
  updateDataIdsGreaterThan(dataIdValue)
    var lastTargetElement = targetElements[targetElements.length - 1];
    lastTargetElement.insertAdjacentHTML('afterend', newElementHTML);
}

}
function updateDataIdsGreaterThan(dataIdValue) {
  var elementsWithDataId = document.querySelectorAll('[data-id]');

  elementsWithDataId.forEach(function (element) {
      var currentDataId = parseInt(element.getAttribute('data-id'));
      if (!isNaN(currentDataId) && currentDataId > dataIdValue) {
          element.setAttribute('data-id', (currentDataId + 1).toString());
      }
  });
}
function deleteRediffusion(dataId){
  var targetElement = document.querySelector('[data-id="' + dataId + '"]');
  targetElement.removeAttribute('data-id')
  targetElement.style.display='none'
  updateDataIdRemove(dataId)
}
function updateDataIdRemove(dataIdValue) {
  var elementsWithDataId = document.querySelectorAll('[data-id]');

  elementsWithDataId.forEach(function (element) {
      var currentDataId = parseInt(element.getAttribute('data-id'));
      if (!isNaN(currentDataId) && currentDataId > dataIdValue) {
          element.setAttribute('data-id', (currentDataId - 1).toString());
      }
  });
}
})

