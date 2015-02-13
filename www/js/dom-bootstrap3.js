'use strict';

$(document).ready(function () {
    var responsiveHelper = undefined;
	var responsiveHelper2 = undefined;
		var responsiveHelper3 = undefined;
		var responsiveHelper4 = undefined;
    var breakpointDefinition = {
        tablet: 1024,
        phone : 480
    };
	
	
    var tableElement = $('#example');
	var tableElement2 = $('#example2');
	var tableElement3 = $('#example3');
var tableElement4 = $('#example4');


    tableElement.dataTable({
        autoWidth        : false,
        preDrawCallback: function () {
            // Initialize the responsive datatables helper once.
            if (!responsiveHelper) {
                responsiveHelper = new ResponsiveDatatablesHelper(tableElement, breakpointDefinition);
            }
        },
        rowCallback    : function (nRow) {
            responsiveHelper.createExpandIcon(nRow);
        },
        drawCallback   : function (oSettings) {
            responsiveHelper.respond();
        }
    });
	
	    tableElement2.dataTable({
        autoWidth        : false,
        preDrawCallback: function () {
            // Initialize the responsive datatables helper once.
            if (!responsiveHelper2) {
                responsiveHelper2 = new ResponsiveDatatablesHelper(tableElement2, breakpointDefinition);
            }
        },
        rowCallback    : function (nRow) {
            responsiveHelper2.createExpandIcon(nRow);
        },
        drawCallback   : function (oSettings) {
            responsiveHelper2.respond();
        }
    });
	
	
		    tableElement3.dataTable({
        autoWidth        : false,
        preDrawCallback: function () {
            // Initialize the responsive datatables helper once.
            if (!responsiveHelper3) {
                responsiveHelper3 = new ResponsiveDatatablesHelper(tableElement3, breakpointDefinition);
            }
        },
        rowCallback    : function (nRow) {
            responsiveHelper3.createExpandIcon(nRow);
        },
        drawCallback   : function (oSettings) {
            responsiveHelper3.respond();
        }
    });
	
	
	
			    tableElement4.dataTable({
        autoWidth        : false,
        preDrawCallback: function () {
            // Initialize the responsive datatables helper once.
            if (!responsiveHelper4) {
                responsiveHelper4 = new ResponsiveDatatablesHelper(tableElement4, breakpointDefinition);
            }
        },
        rowCallback    : function (nRow) {
            responsiveHelper4.createExpandIcon(nRow);
        },
        drawCallback   : function (oSettings) {
            responsiveHelper4.respond();
        }
    });
});
