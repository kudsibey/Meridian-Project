  function pickCustomerId() {
           var e = document.getElementById("CustomerDropdown");
           var strUser = e.options[e.selectedIndex].text;
           var index1 = strUser.indexOf("[");
           var index2 = strUser.indexOf("]");
           strUser = strUser.substr(index1 + 1, (index2 - index1 - 1));
           document.getElementById("CustomerId").value = strUser;
       }

      function pickTechnicianId() {
           var e = document.getElementById("TechnicianDropdown");
           var strTechId = e.options[e.selectedIndex].text;
           var index1 = strTechId.indexOf("[");
           var index2 = strTechId.indexOf("]");
           strTechId = strTechId.substr(index1 + 1, (index2 - index1 - 1));
           document.getElementById("TechnicianId").value = strTechId;

           var strTechName = e.options[e.selectedIndex].text;
           var index1 = 0;
           var index2 = strTechName.indexOf("-->");
           var strTechName = strTechName.substr(index1, (index2 - index1));
           document.getElementById("txtTechName").innerHTML = strTechName;
       }

  

       function toggleValue(whichOne, elementDependent) {
           if (document.getElementById(elementDependent).checked) {
               document.getElementById(whichOne).value = "YES";
           } else {
               document.getElementById(whichOne).value = "NO";
           }
        }
        function toggleValue1(whichOne, elementDependent) {
            if (document.getElementById(elementDependent).value == "YES") {
                document.getElementById(whichOne).value = true;
            } else {
                document.getElementById(whichOne).value = false;
            }
        }

       
       function checkifDate(whichOne) {
           var dateVal = document.getElementById(whichOne).value;
           var d = new Date(dateVal);
           var result = (d.toString() === 'Invalid Date' ? prevValue : dateVal);
           document.getElementById(whichOne).value = result;
       }

       function appropTick(whichOne, elementDependent) {
           if (document.getElementById(whichOne).value == "YES") {
               document.getElementById(elementDependent).checked = true;
           }
       }

     function pickTaskId() {
           var e = document.getElementById("TaskDropdown");
           var strUser = e.options[e.selectedIndex].text;
           var index1 = strUser.indexOf("[");
           var index2 = strUser.indexOf("]");
           strUser = strUser.substr(index1 + 1, (index2 - index1 - 1));
           document.getElementById("TaskId").value = strUser;
       }

function makeCustListVisibleOrNot() {
        var currentStatus = document.getElementById("CustomerDropdown").getAttribute("style");
        if (currentStatus == "visibility: hidden") {
            document.getElementById("CustomerDropdown").setAttribute("style", "visibility: visible");
            document.getElementById("lblCustList").setAttribute("style", "visibility: visible");
            document.getElementById("infoPanel1").textContent ="Please click on label (Customer ID) to hide list of customers"
        }
        if (currentStatus == "visibility: visible") {
            document.getElementById("CustomerDropdown").setAttribute("style", "visibility: hidden");
            document.getElementById("lblCustList").setAttribute("style", "visibility:  hidden");
            document.getElementById("infoPanel1").textContent ="Please click on label (Customer ID) label for list of customers"
        }
}

function makeTechListVisibleOrNot() {
        var currentStatus = document.getElementById("TechnicianDropdown").getAttribute("style");
        if (currentStatus == "visibility: hidden") {
            document.getElementById("TechnicianDropdown").setAttribute("style", "visibility: visible");
            document.getElementById("lblTechList").setAttribute("style", "visibility: visible");
            document.getElementById("infoPanel2").textContent ="Please click on label (Technician ID) to hide list of technicians"
        }
        if (currentStatus == "visibility: visible") {
            document.getElementById("TechnicianDropdown").setAttribute("style", "visibility: hidden");
            document.getElementById("lblTechList").setAttribute("style", "visibility:  hidden");
            document.getElementById("infoPanel2").textContent ="Please click on label (Technician ID) label for list of technicians"
        }
}    

function setRelevantChck(whichOneOnWhich){
  for (i = 0; i < whichOneOnWhich.length; i=i+2)
    if ((document.getElementById(whichOneOnWhich[i+1]).value).trim() == 'YES') {
        document.getElementById(whichOneOnWhich[i]).setAttribute("checked","true");
    } else {
        document.getElementById(whichOneOnWhich[i]).removeAttribute("checked","false");
    }
   
}

