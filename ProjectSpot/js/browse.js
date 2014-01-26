$(function() {
	//datatables extensions and custom code
	
	//http://datatables.net/plug-ins/api#fnFilterAll
	$.fn.dataTableExt.oApi.fnFilterAll = function(oSettings, sInput, iColumn, bRegex, bSmart) {
		var settings = $.fn.dataTableSettings;
		 
		for ( var i=0 ; i<settings.length ; i++ ) {
		  settings[i].oInstance.fnFilter( sInput, iColumn, bRegex, bSmart);
		}
	};
	
	//properties for all tables
	var generalOptions = {
		sDom: 't'
	};
	
	var studentsTable = $('#students').dataTable($.extend(generalOptions, {
		//more table specific properties
	})),
	advisorsTable = $('#advisors').dataTable($.extend(generalOptions, {
		//more table specific properties
	})),
	mqpsTable = $('#mqps').dataTable($.extend(generalOptions, {
		//more table specific properties
	}));
	
	$('#search').on('keyup', function () {
		studentsTable.fnFilterAll(this.value);
	});
	
});