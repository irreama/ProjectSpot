$(function() {
	//datatables extensions and custom code
	//http://datatables.net/plug-ins/api#fnFilterAll
	$.fn.dataTableExt.oApi.fnFilterAll = function(oSettings, sInput, iColumn, bRegex, bSmart) {
		var settings = $.fn.dataTableSettings;
		 
		for ( var i=0 ; i<settings.length ; i++ ) {
		  settings[i].oInstance.fnFilter( sInput, iColumn, bRegex, bSmart);
		}
	};
	//custom filters
	$.fn.dataTableExt.afnFiltering.push(function( oSettings, aData, iDataIndex ) {
		if (oSettings.nTable.id == "students") {
			var showWithMQP = $('#with-mqp-check').is(':checked'),
				showWithoutMQP = $('#without-mqp-check').is(':checked'),
				mqp = $(aData[5]).text().trim();
			if (!showWithMQP && mqp != '') {
				return false;
			}
			if (!showWithoutMQP && mqp == '') {
				return false;
			}
			return true;
		}
		return true;
	});
	
	//properties for all tables
	var generalOptions = {
		sDom: 't',
		bPaginate: false
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
	
	$('#with-mqp-check, #without-mqp-check').on('change', function () {
		var showWithMQP = $('#with-mqp-check').is(':checked'),
			showWithoutMQP = $('#without-mqp-check').is(':checked');
		if (!showWithMQP && !showWithoutMQP) {
			$('#students-section').hide();
		} else {
			studentsTable.fnDraw();
			$('#students-section').show();
		}
	});
	
	$('#advisor-check').on('change', function () {
		if ($(this).is(':checked')) {
			$('#advisors-section').show();
		} else {
			$('#advisors-section').hide();
		}
	});
	
	$('#mqp-check').on('change', function () {
		if ($(this).is(':checked')) {
			$('#mqps-section').show();
		} else {
			$('#mqps-section').hide();
		}
	});
	
});