/********************************************************************/
/*														            */
/* jquery.IncrementBox.js						                    */						
/* Плагин "IncrementBox. от LifeExample.ru" для jQuery            	*/
/*								Автор: Авдеев Марк		            */
/*										2013г.			            */
/*														            */
/* Для ипользования плагина необходимо определить                   */
/* контейнер и вложить в него элементы с классами inc, dec, counter */
/* Пример:    													    */
/*  <div class='conteiner1'>										*/
/*	<button class='inc'>											*/
/*		Увеличить													*/
/*	</button>														*/
/*	<input type="text" class='counter' value='100'/>				*/
/*	<button class='dec'>											*/
/*		уменьшить													*/
/*	</button>														*/
/*  </div>									                        */
/* После чего можно указать параметры для использования 			*/
/* плагина															*/
/* $('.container').IncrementBox({									*/
/*		timeout: 50,		                           			    */		
/*	});																*/
/* Или использовать параметры по умолчанию							*/
/* $('.container').IncrementBox();									*/
/*																	*/	
/********************************************************************/
  
  (function($){
  $.fn.IncrementBox = function(options) {
		
    // Настройки по умолчанию
    var settings = {						
      timeout: 50,  //скорость инкримента
      cursor: false						
    };
  
    return this.each(function() {
      if (options) {
        $.extend(settings, options); //устанавливаем пользовательские настройки 
      }
      
      // определяем переменные
      var $this = $(this);//родительский элемент (Блок в котором находится счетчик с переключателями)		
      
      var dec = $this.find('.dec');
      var inc = $this.find('.inc');
      var counter = $this.find(".counter");
      var iteration = 1;
      var timeout = 50;	
      var isDown = false;			
      updateCursor();
      mousePress(inc, doIncrease);
      mousePress(dec, doDecrease);
      
      function mousePress(obj, func) { 
          focusElement = obj;
          // запрет навешивания нескольких обработчиков одного события на один объект
          obj.unbind('mousedown');
          obj.unbind('mouseup');
          obj.unbind('mouseleave');
          obj.bind('mousedown', function() {							
            isDown = true;            
            setTimeout(func, settings.timeout);
          });
          
          obj.bind('mouseup', function() {							
            isDown = false;
            iteration = 1;
            clearTimeout(mousedownTimeout);
          });
          
          obj.bind('mouseleave', function() {							
            isDown = false;
            iteration = 1;
            clearTimeout(mousedownTimeout);
          });
        } 
      
      function updateCursor(){
        if(settings.cursor){ 
          dec.css('cursor','pointer');
          inc.css('cursor','pointer');
        }
      }
      
      // функция увеличения 
      function doIncrease() {
        if (isDown) {
          var increement = getIncrement(iteration); 
          counter.val(function(i, v) {          
            return Number(v) + increement;          
          });      
          iteration++;
          setTimeout(doIncrease, settings.timeout);
        } else {
          clearTimeout(mousedownTimeout);
        }
      }
      
      // функция уменьшения 
      function doDecrease() {
        if (isDown) {
          var increement = getIncrement(iteration);           
          counter.val(function(i, v) {  
            var result = Number(v) - increement
          //  if( result < 0 )result = 0;
            return result;          
          });      
          iteration++;
          setTimeout(doDecrease, settings.timeout);
        } else {
          clearTimeout(mousedownTimeout);
        }
      }
      
      // возвращает шаг на для изменения  стоимости
      function getIncrement(iteration){
        var increement = 1;
        
        if(iteration >= 20){
          increement = 10;
        }
        
        if(iteration >= 30){
          increement = 100;
        }
        
        if(iteration >= 40){
          increement = 1000;
        }
        
        return  increement;
      }      
    });
  };
})(jQuery);