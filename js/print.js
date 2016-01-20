

function printContent(el,cim) {
   
        //HTML előállítása az el nevű div -ből
        var title = document.title;
        var divElements = document.getElementById(el).innerHTML;
        var printWindow = window.open("", "_blank", "");
        
        //Mai dátum előállítása
        var today = new Date();
        var dd = today.getDate();
        var mm = today.getMonth()+1; //January is 0!
        var yyyy = today.getFullYear();
        if(dd<10) {
            dd='0'+dd
        } 
        if(mm<10) {
            mm='0'+mm
        } 
        today = yyyy+'.'+mm+'.'+dd;
        
        //Új ablak nyitása
        printWindow.document.open();
        
        //HTML megírása, új css -el, a belső div tartalmának beillesztése
        printWindow.document.write('<html><head><title>' + title + '</title><link rel="stylesheet" type="text/css" href="../css/print.css"></head><body>');
        printWindow.document.write('<p align="center"><b>'+cim+'</b></p>')
        printWindow.document.write(divElements);
        printWindow.document.write('<p align="left">Kelt: '+today+'</p>');
        printWindow.document.write('</body></html>');
        printWindow.document.close();
        printWindow.focus();
        //The Timeout is ONLY to make Safari work, but it still works with FF, IE & Chrome.
        setTimeout(function() {
            printWindow.print();
            printWindow.close();
        }, 100);
    }