"use strict";var _typeof="function"==typeof Symbol&&"symbol"==typeof Symbol.iterator?function(t){return typeof t}:function(t){return t&&"function"==typeof Symbol&&t.constructor===Symbol&&t!==Symbol.prototype?"symbol":typeof t};"undefined"===_typeof(Craft.Freeform)&&(Craft.Freeform={}),Craft.Freeform.SubmissionsTableView=Craft.TableElementIndexView.extend({startDate:null,endDate:null,startDatepicker:null,endDatepicker:null,$chartExplorer:null,$totalValue:null,$chartContainer:null,$spinner:null,$error:null,$chart:null,$startDate:null,$endDate:null,afterInit:function(){this.$explorerContainer=$('<div class="chart-explorer-container"></div>').prependTo(this.$container),this.createChartExplorer(),this.base()},getStorage:function(t){return Craft.Freeform.SubmissionsTableView.getStorage(this.elementIndex._namespace,t)},setStorage:function(t,e){Craft.Freeform.SubmissionsTableView.setStorage(this.elementIndex._namespace,t,e)},createChartExplorer:function(){var t=$('<div class="chart-explorer"></div>').appendTo(this.$explorerContainer),e=$('<div class="chart-header"></div>').appendTo(t),a=$('<div class="date-range" />').appendTo(e),r=$('<div class="datewrapper"></div>').appendTo(a),s=($('<span class="to light">to</span>').appendTo(a),$('<div class="datewrapper"></div>').appendTo(a)),i=$('<div class="total"></div>').appendTo(e),n=($('<div class="total-label light">'+Craft.t("Total Submissions")+"</div>").appendTo(i),$('<div class="total-value-wrapper"></div>').appendTo(i)),o=$('<span class="total-value">&nbsp;</span>').appendTo(n);this.$chartExplorer=t,this.$totalValue=o,this.$chartContainer=$('<div class="chart-container"></div>').appendTo(t),this.$spinner=$('<div class="spinner hidden" />').prependTo(e),this.$error=$('<div class="error"></div>').appendTo(this.$chartContainer),this.$chart=$('<div class="chart"></div>').appendTo(this.$chartContainer),this.$startDate=$('<input type="text" class="text" size="20" autocomplete="off" />').appendTo(r),this.$endDate=$('<input type="text" class="text" size="20" autocomplete="off" />').appendTo(s),this.$startDate.datepicker($.extend({onSelect:$.proxy(this,"handleStartDateChange")},Craft.datepickerOptions)),this.$endDate.datepicker($.extend({onSelect:$.proxy(this,"handleEndDateChange")},Craft.datepickerOptions)),this.startDatepicker=this.$startDate.data("datepicker"),this.endDatepicker=this.$endDate.data("datepicker"),this.addListener(this.$startDate,"keyup","handleStartDateChange"),this.addListener(this.$endDate,"keyup","handleEndDateChange");var d=this.getStorage("startTime")||(new Date).getTime()-2592e6,l=this.getStorage("endTime")||(new Date).getTime();this.setStartDate(new Date(d)),this.setEndDate(new Date(l)),this.loadReport()},handleStartDateChange:function(){this.setStartDate(Craft.Freeform.SubmissionsTableView.getDateFromDatepickerInstance(this.startDatepicker))&&this.loadReport()},handleEndDateChange:function(){this.setEndDate(Craft.Freeform.SubmissionsTableView.getDateFromDatepickerInstance(this.endDatepicker))&&this.loadReport()},setStartDate:function(t){return(!this.startDate||t.getTime()!=this.startDate.getTime())&&(this.startDate=t,this.setStorage("startTime",this.startDate.getTime()),this.$startDate.val(Craft.formatDate(this.startDate)),this.endDate&&this.startDate.getTime()>this.endDate.getTime()&&this.setEndDate(new Date(this.startDate.getTime())),!0)},setEndDate:function(t){return(!this.endDate||t.getTime()!=this.endDate.getTime())&&(this.endDate=t,this.setStorage("endTime",this.endDate.getTime()),this.$endDate.val(Craft.formatDate(this.endDate)),this.startDate&&this.endDate.getTime()<this.startDate.getTime()&&this.setStartDate(new Date(this.endDate.getTime())),!0)},loadReport:function(){var t=this.settings.params;t.startDate=Craft.Freeform.SubmissionsTableView.getDateValue(this.startDate),t.endDate=Craft.Freeform.SubmissionsTableView.getDateValue(this.endDate),this.$spinner.removeClass("hidden"),this.$error.addClass("hidden"),this.$chart.removeClass("error"),Craft.postActionRequest("freeform/api/getSubmissionData",t,$.proxy(function(t,e){if(this.$spinner.addClass("hidden"),"success"==e&&"undefined"==typeof t.error){this.chart||(this.chart=new Craft.charts.Area(this.$chart));var a=new Craft.charts.DataTable(t.dataTable),r={localeDefinition:t.localeDefinition,orientation:t.orientation,formats:t.formats,dataScale:t.scale};this.chart.draw(a,r),this.$totalValue.html(t.totalHtml)}else{var s=Craft.t("An unknown error occurred.");"undefined"!=typeof t&&t&&"undefined"!=typeof t.error&&(s=t.error),this.$error.html(s),this.$error.removeClass("hidden"),this.$chart.addClass("error")}},this))}},{storage:{},getStorage:function(t,e){return Craft.Freeform.SubmissionsTableView.storage[t]&&Craft.Freeform.SubmissionsTableView.storage[t][e]?Craft.Freeform.SubmissionsTableView.storage[t][e]:null},setStorage:function(t,e,a){"undefined"==_typeof(Craft.Freeform.SubmissionsTableView.storage[t])&&(Craft.Freeform.SubmissionsTableView.storage[t]={}),Craft.Freeform.SubmissionsTableView.storage[t][e]=a},getDateFromDatepickerInstance:function(t){return new Date(t.currentYear,t.currentMonth,t.currentDay)},getDateValue:function(t){return t.getFullYear()+"-"+(t.getMonth()+1)+"-"+t.getDate()}});