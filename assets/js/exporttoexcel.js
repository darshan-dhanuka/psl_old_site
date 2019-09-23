/*file will export data in excel format
*usage: onclick="tableToExcel('table id','worksheet name', file name)"
*provide table_id and file name to export
*/
var tableToExcel = (function() {
    var uri = 'data:application/vnd.ms-excel;base64,', template = '<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40"><head><!--[if gte mso 9]><xml><x:ExcelWorkbook><x:ExcelWorksheets><x:ExcelWorksheet><x:Name>{worksheet}</x:Name><x:WorksheetOptions><x:DisplayGridlines/></x:WorksheetOptions></x:ExcelWorksheet></x:ExcelWorksheets></x:ExcelWorkbook></xml><![endif]--></head><body><table>{table}</table></body></html>', base64 = function(
            s) {
        return window.btoa(unescape(encodeURIComponent(s)))
    }, format = function(s, c) {
        return s.replace(/{(\w+)}/g, function(m, p) {
            return c[p];
        })
    }
    return function(table, name, filename) {
        if (!table.nodeType)
            table = document.getElementById(table);
        var cln=table.cloneNode(true);
        var paras = cln.getElementsByClassName('ignore');

        while(paras[0]) {
            paras[0].parentNode.removeChild(paras[0]);
        }
        var ctx = {
            worksheet : name || 'Worksheet',
            table : cln.innerHTML
        }
        var link = document.createElement('a');
        link.setAttribute('id', 'dlink');
        link.setAttribute('style', 'display:none;');
        document.getElementById('mainContainer').appendChild(link);
        document.getElementById("dlink").href = uri + base64(format(template, ctx));
        document.getElementById("dlink").download = filename;
        document.getElementById("dlink").click();
    }
})();