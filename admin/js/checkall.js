function checkAll(obj) {
    'use strict';
      var input_items = obj.form.getElementsByTagName("input"), 
          item;             
      for (item in input_items) {
          if (input_items.hasOwnProperty(item)) {
              if (input_items[item].type === "checkbox") {
                  if (obj.checked) {
                      input_items[item].checked = true;
					  
                  } else {
                      input_items[item].checked = false;
					  
                  }
              }         
          }
      }
  }
